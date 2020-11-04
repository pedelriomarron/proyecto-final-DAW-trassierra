@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="{{ asset('uploads/avatars/'.$user->avatar.'') }}" style="width: 10rem; height: 10rem;float:left; border-radius:50%; margin-right: 25px">
            <h2>{{ $user->name }} Profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection