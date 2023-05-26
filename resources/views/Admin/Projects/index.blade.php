@extends('layouts/admin')

@section('content')
<div class="container">
    {{-- Le main section dividono lo spazio in grandi screen che dovrebbero essere poi scrollabli --}}
    {{-- Section 1 --}}
    <section class="_main-section">
        <div class="main-title border-bottom  border-success mb-5 w-25 d-flex flex-column">
            <h1 class="title p-2">Progetti</h1>
            <h6 class="subtitle">Rivedi i tuoi progetti quando vuoi.</h6>
        </div>
        
        <span class="py-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum iure enim adipisci natus id laudantium hic aliquam, unde non velit tempora quaerat laborum reiciendis nostrum incidunt et architecto sint ipsa!</span>
        <div class="row mt-5">

            <div class="container d-flex flex-column align-items-center  col-4 my-3 pt-5">
                <h5>Creatività, Produzione</h5>
                <span>Aggiungi un nuovo progetto al tuo Portfolio</span>
                <a href="{{route('admin.projects.create')}}" class="btn btn-success py-4 my-5 bg-transparent text-success"><i class="fa-solid fa-plus text-success"></i> Aggiungi Nuovo</a>
            </div>
            <div class="container d-flex flex-column align-items-center  col-4 my-3">
                <h5>Controllo, calma</h5>
                <span>Tieni sotto controllo le caratteristiche dei tuoi Progetti.</span>
                <a href="{{route('admin.technologies.index')}}" class="btn btn-primary py-4 my-5 bg-transparent text-primary"><i class="fa-solid fa-magnifying-glass-chart text-primary mx-2"></i>Guarda le Tecnologie</a>
            </div>
            <div class="container  d-flex flex-column align-items-center col-4 my-3 pt-5">
                <h5>Gestione del Portfolio</h5>
                <span>Aggiungi un nuovo progetto al tuo Portfolio</span>
                <a href="{{route('admin.dashboard')}}" class="btn btn-warning py-4 my-5 bg-transparent text-warning"><i class="fa-solid fa-route text-warning mx-2"></i> Torna alla Dashboard</a>
            </div>
        </div>
            

    </section>

{{-- Section 2 --}}
    <section class="_main-section">
        <div class="contaniner row" id="__my-container">
            @foreach ($projects as $project)
                <a href="{{ route('admin.projects.show', $project->slug)}}" class="__my-card border-0 decoration-none text-white">
                    <img class="card-img-top" src="{{asset('storage/' . $project->cover_image)}}" alt="Card image cap">
                    <div class="__my-card-body">
                        <h5 class="p-1">{{$project->type->name ?? 'Nessuna'}}</h5>
                        <h5 class="card-title py-2 text-center">{{$project->title}}</h5>
                        <p class="card-text px-4 py-2">{{$project->description}}</p>
                        <div class="description w-100 d-flex">
                            <h5 class="p-1">Tecnologie</h5>
                            @foreach($project->technologies as $technology)
                            <div class="d-flex justify-content-center align-items-center" style="">
                                <span class=" mx-1 px-2 rounded" style=" background-color:  {{$technology->color}}">{{$technology->name ?? 'Nessuna'}}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                  </a>
            @endforeach
        </div>
    </section>
</div>

@endsection