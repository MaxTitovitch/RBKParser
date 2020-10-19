<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ $novelty->name }} - Новости из RBK.RU</title>
</head>
<body>
<h1 class="w-100 text-center"><a class="text-dark" href="{{ route('novelty', ['id' => $novelty->id]) }}">{{ $novelty->name }}</a></h1>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 pb-5 d-flex flex-wrap justify-content-between align-items-center flex-column">
            <p class="mt-2 font-weight-bold text-uppercase">{{ $novelty->subtitle }}</p>
            <a href="{{ route('novelty', ['id' => $novelty->id]) }}">
                <img src="{{ asset("/storage/novelty/{$novelty->slug}.png") }}" alt="{{ $novelty->name }}" class="w-100" onerror="this.src = '{{ asset('img/default.png') }}'">
            </a>
            @foreach($novelty->noveltyParts as $part)
                @if($part->type == 'text')
                    {!! $part->content !!}
                @elseif($part->type == 'twit')
                    <iframe src="{{ $part->content }}" frameborder="1" class="w-100"></iframe>
                @endif
            @endforeach
            <p class="font-weight-bold text-right w-100">{{ date('H:i, d.m.Y', strtotime($novelty->date)) }}</p>
            <a href="{{ route('index') }}" class="btn btn-lg btn-dark mt-5">На Главную</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
