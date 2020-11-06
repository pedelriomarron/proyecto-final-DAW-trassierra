@extends('layouts.admin')


@section('content')


<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Administradir de Brand</h3>
    </div>
    <div>
        <div align="left" class=" p-3 pt-4">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>

        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>





@endsection