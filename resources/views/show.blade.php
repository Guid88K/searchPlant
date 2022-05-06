@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <h2 class="text-center"> {{$publication->title}} <span
                class="badge {{ !$publication->result ? 'bg-secondary' :'bg-success'}} float-end m-2">{{ !$publication->result ? 'Розшукується' :'Знайдено'}}</span>
        </h2>


        <div class="row m-4">
            <div class="col-md-4">
                <img src="{{asset('/images/' . $publication->image)}}" class="img-fluid" alt="...">
            </div>
            <div class="col-md-8">
                <h6 class="text-end">{{$publication->updated_at}}</h6>

                <h4>Опис:</h4>
                <p>
                    {{$publication->description}}</p>
                <h5>Адрес:</h5>
                <p>
                    {{$publication->address}}</p>
                <h5>Розміщення на карті:</h5>

                <iframe frameborder="0" width="100%" height="400"
                        src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q={{str_replace(" ,
                ", "", str_replace(" ", "+", $publication->address))}}&z=14&output=embed"></iframe>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Панель коментарів
                    </div>
                    <div class="panel-body">
                        <div class="p-2">
                            <form method="post" action="{{ url('comment', $publication->id)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <textarea class="form-control" name="description" placeholder="write a comment..."
                                          rows="3"></textarea>
                                <button type="submit" class="btn btn-primary float-end m-1">Відправити</button>
                            </form>
                        </div>
                        <br>
                        <hr>
                        @foreach($comments as $c)
                            <div class="row m-2">
                                <div class="col-md-2">
                                    <img
                                        src="{{null !== \App\Models\User::find($c->user_id)->image ? asset('/images/' . \App\Models\User::find($c->user_id)->image) :  'https://bootdey.com/img/Content/user_1.jpg'}}"
                                        alt=""
                                        class="img-circle">
                                </div>
                                <div class="col-md-10">
                                    <strong
                                        class="text-success text-center">{{\App\Models\User::find($c->user_id)->name}}</strong>
                                    <p>
                                        {{$c->description}}
                                    </p>

                                    <small class="float-end">{{$c->create_at}}</small>
                                </div>
                                @if('Admin' === Auth::user()->role || $c->user_id=== Auth::user()->id)
                                    <a
                                        onclick="event.preventDefault();
                                                     document.getElementById('delete_comment').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-trash3-fill float-end" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </a>
                                @endif

                                <form id="delete_comment" action="{{route('comments.destroy' , $c->id)}}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                </form>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
