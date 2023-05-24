@extends('layouts/admin')

@section('content')

<div class="show-container">
    
    
    <h1 class="text-center m-2">{{$type->name}}</h1>

    <div class="container d-flex flex-column justify-content-center align-items-center mt-5">

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">Descrizione</h5>
            <p class="py-2 w-75">{{$type->description}}</p>
        </div>

        <div class="description w-100 d-flex">
            <h5 class="py-2 w-25">slug</h5>
            <p class="py-2 w-75">{{$type->slug}}</p>
        </div>

    </div>

    <div class="btn-wrapper col-12 m-4 d-flex flex-column justify-content-center align-items-center">

        <div class="edit-btn-wrapper  m-2">
            <a href="{{route('admin.types.edit', $type)}}" class="m-3 btn btn-success">Modifica</a>   
            {{-- ELIMINA  --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Elimina</button>
            
        </div>

        <a href="{{route('admin.types.index')}}" class="btn px-4 py-2">Altri Tipi</a>
    </div>

</div>


 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Elimina <strong>{{$type->name}}</strong> ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        L'eleminazione sarà permanente, sei sicuro di voler continuare?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{route('admin.types.destroy', $type)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="m-3 btn btn-danger" type="submit">Elimina</button>    
        </form>
        </div>
    </div>
    </div>
</div>


@endsection