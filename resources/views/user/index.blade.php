@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 p-4">
        <h1>Usuários</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Documento</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->cpf }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Ações
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu p-2"
                                aria-labelledby="dropdownMenu1">
                                <li class="mb-2"><a href="{{route('user.show', ['id'=> $user->id])}}">Ver
                                        Perfil</a></li>
                                <li><a href="{{route('admin.vehicle.create', ['user_id' => $user->id])}}">Cadastrar
                                        veículo</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
