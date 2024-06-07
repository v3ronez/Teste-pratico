@extends('layouts.app')
@section('content')
    {{--    @dd($users)--}}
    <div class="w-100 h-100 p-5">
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
                    <td>Action</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
