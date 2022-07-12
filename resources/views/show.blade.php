<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Продукт</title>
</head>
<body>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Статус</th>
        <th>Артикль</th>
        <th>Информация</th>
        <th>Управление</th>
    </thead>
    <tbody>
    <tr>
        <td>{{ $product->id}}</td>
        <td>{{ $product->name}}</td>
        <td>{{ $product->status}}</td>
        <td>{{ $product->article}}</td>
        <td>
            @php
                $data = ($product->data);
                $color = $data['color'];
                $size = $data['size'];
            @endphp
            &nbsp;@if(!empty ($color))
                {{ $color }}
            @endif
            &nbsp;@if(!empty($size))
                {{ $size }}
            @endif
        </td>
        <td>
            <form action="{{ route('product.edit', $product->id) }}" method="get">
                @csrf
                @method("GET")
                <button type="submit" class="btn-danger">Редактированиe</button>
            </form>
        </td>
    </tr>
    </tbody>
</table>
<form action="{{ route('product.index') }}" method="get">
    @csrf
    @method("GET")
    <button type="submit" class="btn-danger">Вернуться на главную страницу</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
