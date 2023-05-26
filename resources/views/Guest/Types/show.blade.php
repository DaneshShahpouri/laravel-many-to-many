@extends('layouts/app')

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

</div>


@endsection