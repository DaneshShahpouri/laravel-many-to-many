@extends('layouts/app')

@section('content')

<div class="show-container">
    
    
    <h1 class="text-center m-2">{{$technology->name}}</h1>

    <div class="container d-flex flex-column justify-content-center align-items-center mt-5">

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">Descrizione</h5>
            <p class="py-2 w-75">{{$technology->description}}</p>
        </div>

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">slug</h5>
            <p class="py-2 w-75">{{$technology->slug}}</p>
        </div>

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">color</h5>
            <p class="p-1 rounded text-white" style="background: {{$technology->color}}">{{$technology->color}}</p>
        </div>

    </div>

</div>

@endsection