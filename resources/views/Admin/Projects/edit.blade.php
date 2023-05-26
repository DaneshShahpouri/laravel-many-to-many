@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Modifica Progetto</h1>
   <form action="{{route('admin.projects.update', $project->slug)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="mb-3">
            <label for="title">Titolo</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title') ?? $project->title}}">
            @error('title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description">Descrizione</label>
            <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{old('description') ?? $project->description}}">
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year">Anno</label>
            <input class="form-control @error('year') is-invalid @enderror" type="number" name="year" id="year" value="{{old('year') ?? $project->year}}">
            @error('year')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

       {{-- Immagine --}}
        <div class="mb-3">
            <label for="cover_image">Immagine</label>
            <input class="form-control @error('cover_image') is-invalid @enderror" type="file" name="cover_image" id="cover_image" >
            @error('cover_image')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id">Tipologia</label>
            <select name="type_id" id="type_id" class="w-100">
                <option></option>
                @foreach ($types as $type)
                    <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ($type->id == $project->type_id ? 'selected' : '')}}>{{$type->name}}</option>
                @endforeach
            </select>
        </div>

        
        <div class="mb-3 form-group">
            @foreach ($technologies as $technology)
            <div class="form-check">
                <input type="checkbox" name="technology[]" id="technology{{$technology->id}}" value="{{$technology->id}}" @checked($project->technologies->contains($technology))>
                <label for="{{$technology->id}}">{{$technology->name}}</label>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            <a href="{{route('admin.projects.show', $project)}}" class="btn btn-secondary border m-3">Annulla</a>
            <input type="submit" class="btn btn-success m-3" value="Modifica">
        </div>
    </form>
</div>
@endsection