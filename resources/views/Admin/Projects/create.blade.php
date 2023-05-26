@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Aggiungi un nuovo Progetto</h1>
   <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="title">Titolo</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title')}}">
            @error('title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description">Descrizione</label>
            <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{old('description')}}">
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year">Anno</label>
            <input class="form-control @error('year') is-invalid @enderror" type="number" name="year" id="year" value="{{old('year')}}">
            @error('year')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        {{-- Immagine --}}
        <div class="mb-3">
            <label for="cover_image">Immagine</label>
            <input class="form-control @error('cover_image') is-invalid @enderror" type="file" name="cover_image" id="cover_image" value="{{old('cover_image')}}">
            @error('cover_image')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        {{-- Tipologia --}}
        <div class="mb-3">
            <label for="type_id">Tipologia</label>
            <select name="type_id" id="type_id" class="w-100">
                <option value=""></option>

                @foreach ($types as $type)
                    <option value="{{$type->id}}"{{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
                @endforeach
            </select>
        </div>

        {{-- Tecnologia --}}
        <div class="mb-3 form-group">
            @foreach ($technologies as $technology)
            <div class="form-check">
                <input type="checkbox" name="technology[]" id="technology{{$technology->id}}" value="{{$technology->id}}">
                <label for="{{$technology->id}}">{{$technology->name}}</label>
            </div>
            @endforeach
        </div>

        <input type="submit" class="btn btn-primary" value="Crea">
    </form>
</div>
@endsection