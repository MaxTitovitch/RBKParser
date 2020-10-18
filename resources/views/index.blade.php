<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Новости из RBK.RU</title>
</head>
<body>
    <h1 class="w-100 text-center"><a class="text-dark" href="{{ route('index') }}">Новости из RBK.RU</a></h1>
    <form action="{{ route('parse') }}" method="POST" class="w-100 text-right px-3">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-dark">
            Обновить Данные
        </button>
    </form>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-error">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="container mt-3">
        <div class="row">
            @foreach($novelties as $novelty)
                <div class="col-sm-6 col-md-3 pb-5 d-flex flex-wrap justify-content-between align-items-center flex-column">
                    <a href="{{ route('novelty', ['id' => $novelty->id]) }}" class="text-dark font-weight-bold text-center">{{ $novelty->name }}</a>
                    <p style="flex-grow: 2" class="mt-2">{{ $novelty->subtitle }}</p>
                    <p class="font-weight-bold">{{ date('H:i, d.m.Y', strtotime($novelty->date)) }}</p>
                    <a href="{{ route('novelty', ['id' => $novelty->id]) }}" class="btn btn-dark">Посмотреть</a>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
