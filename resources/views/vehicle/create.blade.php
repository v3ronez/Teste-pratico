@extends('layouts.app')
@section('content')
    <section class="w-100 h-100 p-5 bg-white">
        <h2>Cadastrar veículo para: {{$user->name}}</h2>
        <form method="POST" action="{{ route('admin.vehicle.store', ['user_id' => $user->id]) }}">
            @csrf
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="plate" class="form-label">Placa</label>
                        <input type="text" class="form-control" id="plate" name="plate"
                               aria-describedby="plate"/>
                        <div id="plateHelp" class="form-text">Deve seguir o padrão de placa (AAA1111)</div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="renavam" class="form-label">Renavam</label>
                        <input type="text" class="form-control" id="renavam" name="renavam"
                               aria-describedby="renavam"/>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="model" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="model" name="model"
                               aria-describedby="model"/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand"
                               aria-describedby="brand"/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="year" class="form-label">Ano</label>
                        <input class="form-control" type="number" min="1900" max="2099" step="1"
                               name="year"/>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar!</button>
        </form>
    </section>
@endsection
