@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="m-4 text-center">Tipi</h1>
    <div class="contaniner row" id="__my-container">
        <a href="{{route('admin.types.create')}}" class="btn btn-success py-4 my-5 bg-transparent text-success">Aggiungi Nuovo</a>

        <table class="table">
            <thead>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Dettagli</th>
            </thead>

            <tbody>
                @foreach ($types as $type)
                <tr>
                    <td>{{$type->name}}</td>
                    <td>{{$type->slug}}</td>
                    <td>{{$type->description}}</td>
                    <td><a href="{{ route('admin.types.show', $type->slug)}}" class=" px-1 text-decoration-none">Vedi</a></td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection