@extends('layouts.admin_layout')
@section('title', 'Просмотреть запись')
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fas fa-check"></i>{{session('success')}}</h4>
                </div>
            @elseif($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <h3 class="card-title p-3">Просмотреть запись - {{$type->type_name}}</h3>
                    </div>
                    <div class="card-body px-3">
                        <h1>{{$type->type_name}}</h1>
                        <hr>
                        <h4>
                            <form action="{{ route('drink_types.destroy', ['drink_type' => $type->id]) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот тип напитка?');">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('drink_types.edit', ['drink_type' => $type->id]) }}" class="badge badge-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="badge badge-danger btn hover:text-white">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
