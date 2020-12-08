@extends('layouts.admin')


@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Administradir de Brand</h3>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif



        <div class="row">
            <div class="col-lg-12 margin-tb pb-5">

                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
        </div>


        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        {!! Form::model($user, ['method' => 'PATCH','route' => ['experts.update', $user->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    <strong>@lang('brand'):</strong>
                    {{--   {!! Form::select('brand', $brands, null, ['class' => 'form-control select2 ', ]) !!} --}}
                    <select multiple="multiple" name="brands[]" class="form-control select2">
                        @foreach($brands as $val)
                        <option @foreach($old_records as $old) @if($old->brand_id ==$val->id)
                            selected="selected"
                            @endif
                            @endforeach
                            value="{{ $val->id }}" data-logo="{{ $val->logo }}">
                            {{ $val->name }}
                        </option>
                        @endforeach
                    </select>

                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}




    </div>
</div>





@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "{{ asset('uploads/brands/') }}"
            var $state = $(
                '<span><img class="img-fluid" width="20px" src="' + baseUrl + '/' + state.element.dataset
                .logo + '" class="img-flag" /> ' + state.text + '</span>'
            );

            return $state;
        };

        $(".select2").select2({
            templateResult: formatState,
            templateSelection: formatState

        });



        // $('.select2').select2();
    });

</script>
@endpush
