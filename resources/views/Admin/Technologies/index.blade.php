@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="m-4 text-center">Tecnologie</h1>
    <div class="contaniner row" id="__my-container">
        <a href="{{route('admin.technologies.create')}}" class="btn btn-success py-4 my-5 bg-transparent text-success">Aggiungi Nuovo</a>

        <table class="table">
            <thead>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Color</th>
                <th>Dettagli</th>
            </thead>

            <tbody>
                @foreach ($technologies as $technology)
                <tr>
                    <td>{{$technology->name}}</td>
                    <td>{{$technology->slug}}</td>
                    <td>{{$technology->description}}</td>
                    <td><span class="text-white rounded px-1" style="background:{{$technology->color}} ">{{$technology->color}}</span></td>
                    <td><a href="{{ route('admin.technologies.show', $technology->slug)}}" class=" px-1 text-decoration-none">Vedi</a></td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection