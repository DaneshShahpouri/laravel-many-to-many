@extends('layouts/admin')

@section('content')
<div class="container">
    <h1 class="m-4 text-center">Progetti</h1>
    <div class="contaniner row" id="__my-container">
        <a href="{{route('admin.projects.create')}}" class="btn btn-success py-4 my-5 bg-transparent text-success">Aggiungi Nuovo</a>
        @foreach ($projects as $project)
            <a href="{{ route('admin.projects.show', $project->slug)}}" class="__my-card card p-1 col-md-6 col-12 border-0 decoration-none text-white">
                <img class="card-img-top" src="{{$project->thumb}}" alt="Card image cap">
                <div class="__my-card-body">
                    <h5 class="card-title py-2 text-center">{{$project->title}}</h5>
                    <p class="card-text px-4 py-2">{{$project->description}}</p>
                </div>
              </a>
        @endforeach
    </div>
</div>
@endsection