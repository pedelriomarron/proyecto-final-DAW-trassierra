@extends('layouts.admin')
@section('content')
<!-- Card  -->
<div class="card shadow mb-4">
    <!-- Title Card  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">@lang('manage-cars')</h3>
    </div>
    <!-- Button Add  -->
    <div>
        <div class=" p-3 pt-4">
            <a href="{{ route('cars.create') }}" type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> @lang('create-record')</a>
        </div>
    </div>
    <!-- Body Card  -->
    <div class="card-body">
        <div class="table-responsive">
            <!-- Table  -->
            <table class="table table-bordered datatable-car " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">@lang('car-id')</th>
                        <th width="35%">@lang('car-name')</th>
                        <th width="10%">@lang('car-actions')</th>
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
<!-- Scripts  -->
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Datables ajax 
        $('.datatable-car').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "url": "{{ getDatatablesURLLang()}}"
            },
            ajax: {
                url: "{{ route('cars.index') }}",
            },
            columns: [{
                    data: 'id',
                    name: 'id'
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
            /*columnDefs: [
                // Add img to table
                {
                    targets: 1,
                    render: function(a, b, row) {
                        let img = "{{ asset('uploads/cars/') }}" + "/" + row.logo
                        return '<img class="img-fluid" width="100vw" src="' + img + '">'
                    }
                }
            ]*/
        });

        // Click Create new record
        $('#create_record').click(function() {
            $('#title-modal-edit-create').text("@lang('create-record')");
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $("#logo_preview").attr("src", "{{ asset('uploads/cars/') }}" + "/default.png");
            $('#formModal').modal('show');
        });

        // Submit form
        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
               // action_url = "{{ route('cars.store') }}";
            }

            if ($('#action').val() == 'Edit') {
               {{--  action_url = "{{ route('cars.update') }}";--}} 
            }
            // Ajax send form
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
                        $('.datatable-car').DataTable().ajax.reload();
                        $('#formModal').modal('toggle');
                    }
                    $('#form_result').html(html);
                }
            });
        });

        // Click Edit 
        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            var url = '{{ route("cars.edit", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.result.name);
                    $("#logo_preview").attr("src", "{{ asset('uploads/cars/') }}" + '/' + data.result.logo);
                    $('#hidden_id').val(id);
                    $('#title-modal-edit-create').text("@lang('edit-record')");
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;
        // Click Delete
        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        // click ok delete
        $('#ok_button').click(function() {
            var url = '{{ route("cars.deletebyid", ":id") }}';
            url = url.replace(':id', user_id);
            $.ajax({
                url: url,
                beforeSend: function() {
                    $('#ok_button').text("@lang('deleting')");
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('.datatable-car').DataTable().ajax.reload();
                        $('#ok_button').text("@lang('ok')");
                    }, 2000);
                }
            })
        });

        // img change
        document.getElementById('logo').addEventListener('change', (event) => {
            changeImgPreview(document.getElementById('logo'), '#logo_preview');
        });


    });
</script>
@endpush