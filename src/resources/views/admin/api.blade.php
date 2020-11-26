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

    </div>
</div>


@endsection
