<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Товары</title>
</head>
<body class="antialiased">
@csrf
<h1>Продукты</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong> {{ $message }} </strong>
    </div>
@endif
@if ($message = Session::get('del'))
    <div class="alert alert-success alert-block">
        <strong> {{ $message }} </strong>
    </div>
@endif
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Название</th>
        <th>Статус</th>
        <th>Информация</th>
        <th>Управление</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name}}</td>
            <td>{{ $product->status}}</td>
            <td>
                @php
                    $data = ($product->data);
                    $color = $data['color'];
                    $size = $data['size'];
                @endphp
                @if(!empty ($color))
                    {{ $color }}
                @endif
                @if(!empty($size))
                    {{ $size }}
                @endif
            </td>
            <td>
                <form action="{{ route('product.show', $product->id) }}" method="get">
                    @csrf
                    @method("GET")
                    <button type="submit" class="btn-danger">Просмотреть</button>
                </form>
                &nbsp;<form action="{{ route('product.show', $product->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn-danger">Удалить</button>
                </form>
            </td>
            @endforeach
        </tr>
    </tbody>
</table>
<form action="{{ route('product.create') }}" method="get">
    @csrf
    @method("GET")
    <button type="submit" class="btn-danger">Добавление продукта</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
