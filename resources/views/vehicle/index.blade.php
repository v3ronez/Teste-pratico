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
            </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->plate}}</td>
                    <td>{{$vehicle->renavam}}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->year }}</td>
                    <td>
                        <a href="{{route('admin.user.show', ['id'=> $vehicle->user->id])}}">{{$vehicle->user->name}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $vehicles->links('pagination::bootstrap-4') }}
    </div>
@endsection
