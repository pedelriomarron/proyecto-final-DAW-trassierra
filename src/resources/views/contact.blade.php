@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="section-title">
                    <h1 style="font-weight:900;font-size:2em">{{ __('Contacta con nosotros') }}</h1>
                    <hr>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter your email">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ __('Full Name') }}</label>
                        <input name="name" type="text" class="form-control" id="name" aria-describedby="name"
                            placeholder="Your name">
                        <span class="text-danger">{{ $errors->first('name') }}</span>

                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="exampleInputPassword1">{{ __('Message') }}</label>
                        <textarea name="comment" class="form-control" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
