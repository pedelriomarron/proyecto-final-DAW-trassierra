@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Laravel 8 CRUD </h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('cars.create') }}" title="Create a car"> <i class="fas fa-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table class="table table-bordered table-responsive-lg">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                    </tr>
                    @foreach ($cars as $car)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $car->name }}</td>
                        <td>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST">

                                <a href="{{ route('cars.show', $car->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>

                                <a href="{{ route('cars.edit', $car->id) }}">
                                    <i class="fas fa-edit  fa-lg"></i>

                                </a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                {!! $cars->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection