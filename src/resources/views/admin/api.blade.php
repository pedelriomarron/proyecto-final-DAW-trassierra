@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <!-- Title Card  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">@lang('manage-api')</h3>
    </div>

    <!-- Body Card  -->
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Key</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($apis as $api)
                <tr>
                    <td>
                        {{ Auth::user()->id }}
                    </td>
                    <td>{{ $api->key }}</td>
                </tr>
                @empty
                <td>
                    {{ Form::open(array('url' => route('admin.api.generate'), 'method' => 'post')) }}
                    <button type="submit" class="btn btn-primary">New Key</button>
                    {{ Form::close() }}
                </td>
                @endforelse


            </tbody>
        </table>
        <table class="table">

            <tbody>
                <tr>
                    <th scope="row">URL</th>
                    <td>http://www.iestrassierra.net/alumnado/curso1920/DAW/daw1920a5/proyecto-final/proyecto-final-DAW-trassierra/src/public/api/
                    </td>
                </tr>

            </tbody>
        </table>
        <hr>
        <p style="font-weight:900">Instrucciones de uso:</p>
        <p> Añadir a las cabezeras de la peticion los siguientes atributos <span style="font-weight:900">(user,
                key)</span> con
            sus valores</p>
        <p style="font-weight:900">Rutas</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ruta</th>
                    <th scope="col">Parametro</th>
                    <th scope="col">Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>/car/<span style="font-weight:900">x</span></td>
                    <td>Number</td>
                    <td>Devuelve un vehiculo buscado por ID</td>
                </tr>
                <tr>
                    <td>/car/</td>
                    <td>Empty</td>
                    <td>Devuelve todos los vehiculos</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>


@endsection
