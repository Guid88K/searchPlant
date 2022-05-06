@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <p class="fs-4 text-center">Кожного з них розшукують їхні господарі...</p>
        <div class="row pt-2">
            @foreach($publications as $p)
                <div class="col-md-4">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">

                                <img
                                    src="{{asset('/images/' . $p->image)}}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$p->title}}

                                        <span class="badge {{ !$p->result ? 'bg-secondary' :'bg-success'}} float-end"> {{ !$p->result ? 'Розшукується' :'Знайдено' }}</span>

                                    </h5>
                                    <p class="card-text">{{\mb_substr($p->description, 0, 220)."..."}}</p>
                                    <p class="card-text float-end"><small class="text-muted ">{{$p->updated_at}}</small></p>
                                </div>

                            </div>
                            <a href="{{url('/publications/' . $p->id) }}" class="p-2"
                               style="text-decoration: none">
                                <button type="button" class="btn btn-primary float-end">Переглянути</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
