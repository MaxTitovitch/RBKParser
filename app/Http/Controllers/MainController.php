<?php

namespace App\Http\Controllers;

use App\Facades\RBKParser;
use App\Models\Novelty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    private const NOVELTY_QUANTITY = 15;

    public function index()
    {
        return view('index', ['novelties' => Novelty::all()]);
    }

    public function show($id)
    {
        $novelty = Novelty::find($id);
        if($novelty) {
            return view('show', ['novelty' => $novelty]);
        } else {
            Session::flash('error', 'Страница не найдена!');
            return redirect()->route('index');
        }
    }

    public function parse()
    {
        $message = RBKParser::parseNovelties(self::NOVELTY_QUANTITY);
//        return $message;
        Session::flash($message, $message == 'success' ? 'Данные обновлены!' : 'Ошибка парсинга!');
        return redirect()->route('index');
    }
}
