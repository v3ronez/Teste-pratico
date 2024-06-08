@extends('layouts.app')
@section('content')
    <section class="w-100 h-100 p-5 bg-white">
        <h2>Editar Usuário: {{$user->name}} </h2>
        <form method="POST" action="{{route('user.update', ['id' => $user->id])}}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" value="{{$user->name}}" class="form-control" id="name" name="name"
                               aria-describedby="name"/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="email" class="form-label">Nome</label>
                        <input type="email" value="{{$user->email}}" class="form-control" id="email" name="email"
                               aria-describedby="email"/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" value="{{mask_cpf($user->cpf)}}" class="form-control" id="cpf"
                               name="cpf"
                               aria-describedby="cpf"/>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" value="{{$user->phone}}" class="form-control" id="phone" name="phone"
                               aria-describedby="phone"/>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Editar!</button>
        </form>
    </section>
@endsection
