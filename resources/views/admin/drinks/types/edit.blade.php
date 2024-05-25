@extends('layouts.admin_layout')
@section('title', 'Редактировать запись')
@section('main_content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <h3 class="card-title p-3">Редактировать запись - {{$type->type_name}}</h3>
                    </div>
                    <div class="card-body px-3 row">
                        <div class="col-6">
                            <form action="{{route('drink_types.update', ['drink_type' => $type->id])}}">
                                @csrf
                                @method('PATCH')
                                <input class="form-control form-control-lg" type="text" value="{{$type->type_name}}" name="type_name">
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
