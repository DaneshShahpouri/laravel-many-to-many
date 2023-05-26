@extends('layouts/admin')

@section('content')

<div class="show-container container">
    
    <div id="img-container" src="{{asset('storage/' . $project->cover_image)}}">
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

        {{-- @dd($project->technologies[0]->name) --}}
        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">Tecnologie</h5>
            @foreach($project->technologies as $technology)
            <div class="d-flex justify-content-center align-items-center" style="">
                <span class=" mx-1 py-1 px-3 rounded" style="color: {{$technology->color}}; border: 1px solid {{$technology->color}}">{{$technology->name ?? 'Nessuna'}}</span>
            </div>
            @endforeach
        </div>

    </div>

    <div class="btn-wrapper col-12 m-4 d-flex flex-column justify-content-center align-items-center">

        <div class="edit-btn-wrapper  m-2">
            <a href="{{route('admin.projects.edit', $project)}}" class="m-3 btn btn-success">Modifica</a>   
            {{-- ELIMINA  --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Elimina</button>
            
        </div>

        <a href="{{route('admin.projects.index')}}" class="btn px-4 py-2">Altri Progetti</a>
    </div>

</div>


 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Elimina <strong>{{$project->title}}</strong> ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        L'eleminazione sarà permanente, sei sicuro di voler continuare?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="m-3 btn btn-danger" type="submit">Elimina</button>    
        </form>
        </div>
    </div>
    </div>
</div>


@endsection