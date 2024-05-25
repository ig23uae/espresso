@extends('layouts.admin_layout')
@section('title', 'Добавить запись')
@section('main_content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <h3 class="card-title p-3">Добавить новую запись</h3>
                    </div>
                    <div class="card-body px-3 row">
                        <div class="col-6">
                            <form action="{{route('drink_types.store')}}" method="post">
                                @csrf
                                @method('post')
                                <input class="form-control form-control-lg" type="text" placeholder="type_name" name="type_name">
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
