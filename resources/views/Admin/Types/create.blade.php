@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Aggiungi un nuovo Tipo</h1>
   <form action="{{route('admin.projects.store')}}" method="POST">
    @csrf
        <div class="mb-3">
            <label for="name">Nome</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" class="form-control" value="">{{old('description')}}</textarea>
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <input type="submit" class="btn btn-primary" value="Crea">
    </form>
</div>
@endsection