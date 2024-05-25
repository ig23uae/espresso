@extends('layouts.admin_layout')

@section('title', 'Типы')
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fas fa-check"></i>{{session('success')}}</h4>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fas fa-times"></i>{{session('error')}}</h4>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class=" m-0 float-left">Типы напитков</h1>
                        <div class="card-tools">
                            <a href="{{route('drink_types.create')}}" class="btn btn-success mt-2">Добавить запись</a>
                        </div>
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
                                                <form action="{{ route('drink_types.destroy', ['drink_type' => $type->id]) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот тип напитка?');" class="text-center">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ route('drink_types.edit', ['drink_type' => $type->id]) }}" class="badge badge-primary">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="submit" class="badge badge-danger btn hover:text-white">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
