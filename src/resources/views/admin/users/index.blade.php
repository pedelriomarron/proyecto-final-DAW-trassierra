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
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered datatable-user " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">Id</th>
                        <th width="5%">Avatar</th>
                        <th width="35%">Name</th>
                        <th width="20%">Roles</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>






<script type="text/javascript">
    $(document).ready(function() {




        $('.datatable-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.index') }}",
            },

            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    name: 'avatar'
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    name: 'roles',
                    data: 'roles',
                    orderable: false

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },

            ],
            columnDefs: [{
                targets: 1,
                render: function(a, b, row) {
                    let img = "{{ asset('uploads/avatars') }}" + "/" + row.avatar

                    return '<img height="100vw" src="' + img + '">'
                }
            }]
        });


    });



    function readURL(input, id_prev) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id_prev).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>



@endsection

{{--


<!--


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
</div>
</div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @endif
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @can('user-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endcan

        </td>
    </tr>
    @endforeach
</table>


{!! //$data->render() !!}






Page Heading -->

--}}