@extends('layouts.admin_layout')
@section('title', 'Редактировать запись')
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            @foreach($errors->all() as $message)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fas fa-times"></i>{{$message}}</h4>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <h3 class="card-title p-3">Редактировать запись - {{$size->size_name}}</h3>
                    </div>
                    <div class="card-body px-3 row">
                        <div class="col-6">
                            <form action="{{route('drink_sizes.update', ['drink_size' => $size->id])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input class="form-control form-control-lg" type="text" value="{{$size->size_name}}" name="size_name">
                                <br>
                                <input class="form-control form-control-lg" type="text" value="{{$size->price}}" name="price">
                                <br>
                                <button type="submit" class="btn-success btn">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
