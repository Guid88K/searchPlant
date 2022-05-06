@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <form method="post" action="{{ route('publications.update', $publication->id) }}" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редагувати публікацію</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Титулка</label>
                    <input type="text" class="form-control" value="{{$publication->title}}" name="title" id="title"
                           placeholder="Назва">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Опис</label>
                    <textarea class="form-control" name="description" id="description"
                              rows="3">{{$publication->description}}</textarea>
                </div>
                <div class="mb-3">
                    <input id="date" name="date" class="form-control" value="{{$publication->date}}" type="date"/>
                    <span id="startDateSelected"></span>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="{{$publication->address}}"
                           placeholder="вулиця Глушець, 16, Луцьк, Волинська область, 43000">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Зображення</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Категорія</label>
                    <select class="form-select" name="category_id">
                        @foreach($categories as $c)
                            <option
                                {{$c->id !== $publication->category_id ?: 'selected'}} value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" value="1" name="result" id="flexCheckIndeterminate">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Виконано
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    </div>
@endsection
