@extends('layouts/app')

@section('content')
<div class="container">
    <h1 class="m-4 text-center">Progetti</h1>
    <div class="contaniner row" id="__my-container">

         @foreach ($projects as $project)
        <a href="{{ route('projects.show', $project->slug)}}" class="__my-card card p-1 col-md-6 col-12 border-0 decoration-none text-white">
            <img class="card-img-top" src="{{asset('storage/' . $project->cover_image)}}" alt="Card image cap">
            <div class="__my-card-body">
                <h5 class="p-1">{{$project->type->name ?? 'Nessuna'}}</h5>
                <h5 class="card-title py-2 text-center">{{$project->title}}</h5>
                <p class="card-text px-4 py-2">{{$project->description}}</p>
                <div class="description w-100 d-flex">
                    <h5 class="p-1">Tecnologie</h5>
                    @foreach($project->technologies as $technology)
                    <div class="d-flex justify-content-center align-items-center" style="">
                        <span class=" mx-1 py-1 px-3 rounded" style="color: {{$technology->color}}; border: 1px solid {{$technology->color}}">{{$technology->name ?? 'Nessuna'}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection