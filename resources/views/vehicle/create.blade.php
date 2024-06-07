@extends('layouts.app')
@section('content')
    <section class="w-100 h-100 p-5 bg-white">
        <h2>Cadastrar veículo para: {{$user->name}}</h2>
        <div>
            <form>
                <div class="row">
                    <div class="col-2">
                        <div class="mb-3">
                            <label for="plate" class="form-label">Placa</label>
                            <input type="text" class="form-control" id="plate"
                                   aria-describedby="plate"/>
                            <div id="plateHelp" class="form-text">Deve seguir o padrão de placa (AAA1111)</div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-3">
                            <label for="renavam" class="form-label">Renavam</label>
                            <input type="text" class="form-control" id="renavam"
                                   aria-describedby="renavam"/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="model" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="model"
                                   aria-describedby="model"/>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-3">
                            <label for="brand" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="brand"
                                   aria-describedby="brand"/>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-3">
                            <label for="year" class="form-label">Ano</label>
                            <input class="form-control" type="number" min="1900" max="2099" step="1"
                                   value=""/>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">Cadastrar!</button>
            </form>
        </div>
    </section>
@endsection
