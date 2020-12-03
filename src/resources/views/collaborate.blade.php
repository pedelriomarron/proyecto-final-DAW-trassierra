@extends('layouts.app')
@section('content')
<div class="collaborate">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-8">
                <div class="section-title">
                    <h2>Collaborate Us</h2>
                </div>
            </div>
        </div>

        @if(session('status'))
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success ! </strong> &nbsp; {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8">
                <div class="login-form">
                    <form method="POST" action="{{ route('addCollaborate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Full Name') }}</label>

                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                        name="fullname"
                                        value="{{ isset(Auth::user()->firstname) ? Auth::user()->firstname : '' }} {{ isset(Auth::user()->lastname) ? Auth::user()->lastname : '' }}"
                                        required autocomplete="Fullname" autofocus>

                                    @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">

                                <div class="form-group">
                                    <label for="email"
                                        class="col-form-label text-md-right">{{ __('Email Address') }}</label>

                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}"
                                        required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group">
                                    <label for="name"
                                        class="col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        name="phone_number"
                                        value="{{ isset(Auth::user()->phone_number) ? Auth::user()->phone_number : '' }}"
                                        required autocomplete="phone_number" autofocus>

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">


                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Subject') }}</label>

                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        name="subject" required autofocus>

                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">

                                    <label for="password"
                                        class="col-form-label text-md-right">{{ __('Message') }}</label>

                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message"
                                        required></textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">

                                <div class="form-group">
                                    <label for="name"
                                        class="col-form-label text-md-right">{{ __('Attach Screenshot') }}</label>

                                    <input type="file" 
                                        class="form-control @error('screenshot') is-invalid @enderror" name="screenshot"
                                        autofocus>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Message') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
