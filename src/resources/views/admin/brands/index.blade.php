@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
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
            <table class="table table-bordered datatable-brand " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">Id</th>
                        <th width="5%">Logo</th>
                        <th width="35%">Name</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>




<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-1">
                <h4 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <span id="form_result"></span>
            <form method="post" id="sample_form" class="" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name brand:</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Name brand">
                        <small id="nameHelp" class="form-text text-muted">Your information is safe with us.</small>
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo :</label>
                        <input type="file" class="form-control-file" name="logo" id="logo">
                    </div>

                    <div class="form-group text-center">
                        <img id="logo_preview" class="img-responsive img-thumbnail" src="" style="max-height:250px;">
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                </div>
            </form>
        </div>
    </div>
</div>




<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {




        $('.datatable-brand').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('brands.index') }}",
            },

            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    name: 'logo'
                },
                {
                    data: 'name',
                    name: 'name'
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
                    let img = "{{ asset('uploads/brands/') }}" + "/" + row.logo

                    return '<img height="100vw" src="' + img + '">'
                }
            }]
        });

        $('#create_record').click(function() {
            $('.modal-title').text('Add New Record');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $("#logo_preview").attr("src", "{{ asset('uploads/brands/') }}" + "/default.png");
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
                action_url = "{{ route('brands.store') }}";
            }

            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('brands.update') }}";
            }

            $.ajax({
                url: action_url,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('.datatable-brand').DataTable().ajax.reload();
                        $('#formModal').modal('toggle');
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            var url = '{{ route("brands.edit", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.result.name);
                    $("#logo_preview").attr("src", "{{ asset('uploads/brands/') }}" + '/' + data.result.logo);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Record');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            var url = '{{ route("brands.deletebyid", ":id") }}';
            url = url.replace(':id', user_id);
            $.ajax({
                url: url,
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('.datatable-brand').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

        $("#logo").change(function() {
            readURL(this, '#logo_preview');
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


<!-- /.container-fluid -->

@endsection