@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <!-- Title Card  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">@lang('manage-profile')</h3>
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

    <!-- Body Card  -->
    <div class="card-body">
        <div class="col-md-12">
            <div class="form-group text-center">
                <img style="width: 10rem; height: 10rem; border-radius:50%; margin-right: 25px;margin-bottom:3em"
                    class="img-fluid rounded-circle" id="logo_preview"
                    src="{{ asset('uploads/avatars/'.$user->avatar.'') }}" style="">
                <h1>{{ $user->name }} @lang('profile')</h1>

            </div>
            <form enctype="multipart/form-data" action="{{ route('profile') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">
                        <label>@lang('update.profile.image')</label><br>
                        <input id="logo" type="file" name="avatar">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input value="{{$user->name}}" type="text" name="name" class="form-control" id="name"
                            placeholder="name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'Password','class' =>
                        'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' =>
                        'form-control')) !!}
                    </div>
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </div>

            </form>
        </div>

    </div>
</div>


@endsection

<!-- Scripts  -->
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        // img change
        document.getElementById('logo').addEventListener('change', (event) => {
            changeImgPreview(document.getElementById('logo'), '#logo_preview');
        });

    });

</script>
@endpush
