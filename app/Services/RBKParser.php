<?php


namespace App\Services;

use App\Models\Novelty;
use App\Models\NoveltyPart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPHtmlParser\Dom;

class RBKParser
{
    private const RBK_RUL = 'https://www.rbc.ru';

    public function parseNovelties(int $quantity) : string
    {
        try {
            $this->clearRepository();
            $this->parseMainPage($quantity);
            return 'success';
        } catch (\Exception $exception){
            return 'error';
        }
    }

    private function parseMainPage(int $quantity) : void
    {
        $dom = new Dom;
        $dom->loadFromUrl(self::RBK_RUL);
        $linkTags = $dom->find('.js-news-feed-list')[0]->find('a');
        for ($i = 0; $i < count($linkTags); $i++) {
            $link = $linkTags[$i]->getAttribute('href');
            if(!$this->parseOneNovelty($link)){
                $quantity++;
                continue;
            }
            if ($i + 1 >= $quantity) break;
        }
    }

    private function parseOneNovelty(string $link) : bool
    {
        $dom = new Dom;
        $dom->loadFromUrl($link);
        if(!count($dom->find('.article__header__title-in '))){
            return false;
        }
        $name = $dom->find('h1')[0]->innertext;
        $author = $dom->find('.article__authors__row')[0];
        $subtitle = $dom->find('.article__text__overview')[0];
        $novelty = Novelty::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'author' => trim(str_replace('Автор', '', $author ? $author->innerText : null)),
            'date' => $dom->find('.article__header__date')[0]->getAttribute('content'),
            'subtitle' => $subtitle ? $subtitle->innertext : null,
        ]);
        $this->savePhoto($dom, $novelty->slug);
        $this->parseNoveltyParts($dom, $novelty);
        return true;
    }

    private function parseNoveltyParts(Dom $dom, Novelty $novelty) : void
    {
        $contents = $dom->find('.l-col-main')[0]->find('.article__content')->find('p,ul,iframe');

        foreach ($contents as $content){
            if($content->getTag()->name() == 'p' || $content->getTag()->name() == 'ul'){
                $type = 'text';
                $contentText = $content->outerhtml;
            } else {
                $type = 'twit';
                $contentText = $content->getAttribute('src');
            }
            NoveltyPart::create([
                'type' => $type,
                'content' =>  $contentText,
                'novelty_id' => $novelty->id
            ]);
        }
    }

    private function savePhoto(Dom $dom, string $slug) : void
    {
        $imgNode = $dom->find('.article__main-image__wrap');
        if(count($imgNode)) {
            $url = $imgNode->find('img')->getAttribute('src');
            $contents = file_get_contents($url);
            Storage::put("public/novelty/$slug.png", $contents);
        }
    }

    private function clearRepository()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        NoveltyPart::query()->truncate();
        Novelty::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Storage::deleteDirectory('public/novelty');
    }
}
