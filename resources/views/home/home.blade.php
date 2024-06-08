@php use App\User;use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 p-5 flex flex-column">
        <div class="flex flew-row justify-content-center align-content-center">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ver Perfil</h5>
                    <p class="card-text">
                        Visualize ou atualize suas informaçãoes aqui
                    </p>
                    <a href="{{route('user.show', ['id' => Auth::id()])}}" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
@endsection
