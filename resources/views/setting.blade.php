@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <form method="post" action="{{ url('/setting',$user->id)}}" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Налаштування</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Логін</label>
                    <input type="text" class="form-control" value="{{$user->name}}" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Пошта</label>
                    <input type="text" class="form-control" value="{{$user->email}}" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Повне ім'я</label>
                    <input type="text" class="form-control" value="{{$user->full_name}}" name="full_name" id="full_name">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Телефон</label>
                    <input type="text" class="form-control" value="{{$user->phone}}" name="phone" id="phone">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    </div>
@endsection
