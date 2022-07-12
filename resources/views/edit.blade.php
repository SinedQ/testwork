<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Редактирование</title>
</head>
<body>
<h1>Форма обновления продукции</h1>
@if ($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endforeach
@endif
<form method="post" action="{{ route('product.update', $products) }}">
    @csrf
    @method('PUT')
    <input type="text" name="article" value="{{ $products->article }}">
    <input type="text" name="name" value="{{ $products->name }}">
    <select name="status">
        <option disabled>Выберите статус</option>
        <option value="available">В наличии</option>
        <option value="unavailable">Не имеющийся в наличии</option>
    </select>
    <select name="size">
        <option disabled>Выберите размер</option>
        <option value="l">L</option>
        <option value="xxl">XXL</option>
    </select>
    <select name="color">
        <option disabled>Выберите цвет</option>
        <option value="black">черный</option>
        <option value="white">белый</option>
    </select>
    <input type="submit" name="button" value="Обновить">
</form>
<form action="{{ route('product.index') }}" method="get">
    @method('GET')
    <button type="submit" class="btn-danger">Вернуться на главную</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
