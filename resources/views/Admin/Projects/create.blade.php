@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Aggiungi un nuovo Progetto</h1>
   <form action="{{route('admin.projects.store')}}" method="POST">
    @csrf
        <div class="mb-3">
            <label for="title">Titolo</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
            @error('title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description">Descrizione</label>
            <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" class="form-control" value="{{old('description')}}">
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year">Anno</label>
            <input class="form-control @error('year') is-invalid @enderror" type="number" name="year" id="year" class="form-control" value="{{old('year')}}">
            @error('year')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="thumb">Immagine</label>
            <input class="form-control @error('thumb') is-invalid @enderror" type="text" name="thumb" id="thumb" class="form-control" value="{{old('thumb')}}">
            @error('thumb')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id">Tipologia</label>
            <select name="type_id" id="type_id" class="w-100">
                <option value=""></option>

                @foreach ($types as $type)
                    <option value="{{$type->id}}"{{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" class="btn btn-primary" value="Crea">
    </form>
</div>
@endsection