@extends('layouts.admin')


@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Administradir de experts</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered datatable-user " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">Id</th>
                        <th width="5%">Avatar</th>
                        <th width="35%">Name</th>
                        <th width="20%">Brands</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



<!-- Modal delete-->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal title-->
            <div class="modal-header">
                <h4 class="modal-title">@lang('confirmation-delete-title')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal text-->
            <div class="modal-body">
                <h4 align="center" style="margin:0;">@lang('confirmation-delete-text')</h4>
            </div>
            <!-- Modal footer-->
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">@lang('ok')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('cancel')</button>
            </div>
        </div>
    </div>
</div>





@endsection




@push('scripts')


<script type="text/javascript">
    $(document).ready(function() {




        $('.datatable-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('experts.index') }}",
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


 var user_id;
        // Click Delete
        $(document).on('click', '.delete', function () {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        // click ok delete
        $('#ok_button').click(function () {
            var url = '{{ route("users.deletebyid", ":id") }}';
            url = url.replace(':id', user_id);
            $.ajax({
                url: url,
                beforeSend: function () {
                    $('#ok_button').text("@lang('deleting')");
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('.datatable-user').DataTable().ajax.reload();
                        $('#ok_button').text("@lang('ok')");
                    }, 2000);
                }
            })
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



@endpush
