@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 p-5 flex flex-column">
        <div class="flex flew-row justify-content-center align-content-center">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuários</h5>
                    <p class="card-text">
                        Acompanhe os usuários cadastrados no sistema.
                    </p>
                    <a href="{{route('admin.user.index')}}" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Veículos</h5>
                    <p class="card-text">
                        Acompanhe os veículos cadastrados.
                    </p>
                    <button type="button" class="btn btn-primary">Ver</button>
                </div>
            </div>
        </div>
    </div>
@endsection
