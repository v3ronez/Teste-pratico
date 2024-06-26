@php use App\User; @endphp
@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 p-4">
        <section class="vh-100" style="background-color: #f4f5f7;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-6 mb-4 mb-lg-0">
                        <div class="card mb-3" style="border-radius: .5rem;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white"
                                     style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="https://st3.depositphotos.com/1767687/16607/v/450/depositphotos_166074422-stock-illustration-default-avatar-profile-icon-grey.jpg"
                                         alt="Avatar" class="img-fluid my-5" style="width: 80px;"/>
                                    <button type="button" class="btn btn-discovery btn-primary rounded-2">
                                        <a href="{{route('user.edit', ['id' => $user->id])}}" class="text-white"> Editar
                                            perfil</a>
                                    </button>
                                    @if(Auth::user()->role == User::ROLE_ADMIN)
                                        <form method="POST"
                                              action="{{route('admin.user.delete', ['id' => $user->id])}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-discovery btn-danger rounded-2 mt-3">
                                                Deletar perfil
                                            </button>
                                        </form>
                                    @endif
                                    <h5>{{$user->name}}</h5>
                                    <p></p>
                                    <i class="far fa-edit mb-5"></i>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h6>Informações básicas</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3">
                                                <h6>Nome</h6>
                                                <p class="text-muted">{{$user->name}}</p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>Email</h6>
                                                <p class="text-muted">{{$user->email}}</p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>Phone</h6>
                                                <p class="text-muted">{{$user->phone}}</p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>documento</h6>
                                                <p class="text-muted">{{mask_cpf($user->cpf)}}</p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>Qtd carros</h6>
                                                <p class="text-muted">{{count($user->vehicles)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="table-responsive p-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Renavam</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Ano</th>
                    @if(Auth::user()->role == User::ROLE_ADMIN)
                        <th scope="col">Ações</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @forelse ($user->vehicles as $vehicle)
                    <tr>
                        <td></td>
                        <td>{{ $vehicle->plate }}</td>
                        <td>{{ $vehicle->renavam}}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->year }}</td>
                        @if(Auth::user()->role == User::ROLE_ADMIN)
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Ações
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu p-2"
                                        aria-labelledby="dropdownMenu1">
                                        <li class="mb-2"><a
                                                    href="{{route('admin.vehicle.edit', ['id'=> $vehicle->id])}}">Editar</a>
                                        </li>
                                        <li class="mb-2">
                                            <form method="POST"
                                                  action="{{route('admin.vehicle.destroy', ['id'=> $vehicle->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-discovery btn-danger rounded-2 mt-3">
                                                    Excluir
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <td colspan="6">Não há veículos vinculados ainda.</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
