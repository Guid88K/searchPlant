@extends('layouts.layout')

@section('content')
    <div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('publications.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавити публікацію</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Титулка</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Назва">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Опис</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <input id="date" name="date" class="form-control" type="date"/>
                            <span id="startDateSelected"></span>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address"
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
                                    <option selected value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавити категорію</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Назва</label>
                            <input type="text" class="form-control" name="name" id="title"
                                   placeholder="Назва">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <p class="fs-4 text-center">Адміністративна панель</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addForm">
                    Добавити публікацію
                </button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addCategory">
                    Добавити категорію
                </button>
            </div>
        </div>

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
                                    <h5 class="card-title">{{$p->title}}<span
                                            class="badge {{!$p->result ? 'bg-secondary': 'bg-success'}} float-end">
                                            {{!$p->result ? 'Розшукується' :'Знайдено'}}
                                            </span>
                                    </h5>
                                    <p class="card-text">{{\mb_substr($p->description, 0, 220)."..."}}</p>
                                    <p class="card-text float-end"><small class="text-muted ">{{$p->created_at}}</small>
                                    </p>
                                </div>

                            </div>
                            <div class="row m-2">
                                <div class="col-md-4"><a href="{{url('publications/'.$p->id)}}" class="p-2"
                                                         style="text-decoration: none">
                                        <button type="button" class="btn btn-primary ">Переглянути</button>
                                    </a></div>
                                <div class="col-md-4">
                                    <a href="{{route('publications.edit', $p->id)}}" class="p-2"
                                       style="text-decoration: none">
                                        <button type="button" class="btn btn-secondary ">Редагувати</button>
                                    </a></div>


                                <div class="col-md-4">
                                    <form action="{{ route('publications.destroy',$p->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">Видалити</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
