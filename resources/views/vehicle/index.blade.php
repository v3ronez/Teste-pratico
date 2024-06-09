@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 p-4">
        <h1>Veiculos</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Placa</th>
                <th scope="col">Renavam</th>
                <th scope="col">Modelo</th>
                <th scope="col">Marca</th>
                <th scope="col">Ano</th>
                <th scope="col">Dono</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->plate}}</td>
                    <td>{{$vehicle->renavam}}</td>
                    <td>{{$vehicle->model}}</td>
                    <td>{{$vehicle->brand}}</td>
                    <td>{{$vehicle->year}}</td>
                    <td>
                        <a href="{{route('user.show', ['id'=> $vehicle->user->id])}}">{{$vehicle->user->name}}</a>
                    </td>
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
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $vehicles->links('pagination::bootstrap-4') }}
    </div>
@endsection
