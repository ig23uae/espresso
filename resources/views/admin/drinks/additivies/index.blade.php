@extends('layouts.admin_layout')

@section('title', 'Главная')
@section('main_content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Типы напитков</h3>
                    </div>
                    <div class="card-body table-responsive p-0" >
                        <table class="table table-hover table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Название типа</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($types->count() > 0)
                                @foreach($types as $type)
                                    <tr class="active">
                                        <td><h3>{{ $type->id}}</h3></td>
                                        <td><h3>{{ $type->type_name }}</h3></td>
                                        <td>
                                            <h4>
                                                <a href="{{route('drink_types.show', ['drink_type' => $type->id])}}">
                                                    <span class="badge badge-success">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                </a>
                                                <a href="">
                                                    <span class="badge badge-primary">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                </a>
                                                <a href="">
                                                    <span class="badge badge-danger">
                                                     <i class="fas fa-trash"></i>
                                                </span>
                                                </a>
                                            </h4>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">No types found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="container">
                            {{ $types->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
