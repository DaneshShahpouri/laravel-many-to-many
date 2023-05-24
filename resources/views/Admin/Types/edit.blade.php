@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Modifica Tipo</h1>
   <form action="{{route('admin.types.update', $type->slug)}}" method="POST">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="name">Nome</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" class="form-control" value="{{old('name ') ?? $type->name }}">
            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" class="form-control">{{old('description') ?? $type->description}}</textarea>
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <a href="{{route('admin.types.show', $type)}}" class="btn btn-secondary" value="Modifica">Annulla</a>
        <input type="submit" class="btn btn-primary" value="Modifica">
    </form>
</div>
@endsection