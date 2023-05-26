@extends('layouts/app')

@section('content')

<div class="show-container">
    
    <div id="img-container" style="background-image: url('{{$project->thumb}}')">
        <h1 class="text-white">{{$project->title}}</h1>
        <div id="layer"></div>
    </div>
    
    <h6 class="text-mute"> <strong>Tipo:</strong>{{$project->type->name ?? 'Nessuna'}}</h6>

    <div class="container d-flex flex-column justify-content-center align-items-center mt-5">
        <h4 class="card-text">Panoramica</h4>
        
        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">Anno</h5>
            <p class="py-2 w-75">{{$project->year}}</p>
        </div>

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">Descrizione</h5>
            <p class="py-2 w-75">{{$project->description}}</p>
        </div>

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">slug</h5>
            <p class="py-2 w-75">{{$project->slug}}</p>
        </div>

        
        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">Tecnologie</h5>
            @foreach($project->technologies as $technology)
            <div class="d-flex justify-content-center align-items-center" style="">
                <span class=" mx-1 py-1 px-3 rounded" style="color: {{$technology->color}}; border: 1px solid {{$technology->color}}">{{$technology->name ?? 'Nessuna'}}</span>
            </div>
            @endforeach
        </div>

    </div>

</div>



@endsection