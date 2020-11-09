@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<div class="card shadow mb-4">
    <!-- Title Card  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">@lang('create-car')</h3>
    </div>
    <!-- Button Add 
    <div>
        <div class=" p-3 pt-4">
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> @lang('create-cars')</button>
        </div>
    </div>
     -->
    <!-- Body Card  -->
    <div class="card-body">
         <div class="">
                <div class="row">
                    <div class="col-lg-12 margin-tb ">
                        <div class="pull-left">
                            <h2> @lang('add.car')</h2>
                        </div>
                        <div class="pull-right my-3">
                            <a class="btn btn-primary" href="{{ route('cars.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger my-1">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('cars.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>@lang('car-name'):</strong>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <strong>@lang('brand'):</strong>
                                {!! Form::select('brand', $brands, null, ['class' => 'form-control select2']) !!}
                             </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">@lang('submit')</button>
                        </div>
                    </div>

                </form>
            </div>
    </div>
</div>


@endsection

@push('scripts')
<script>

$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endpush