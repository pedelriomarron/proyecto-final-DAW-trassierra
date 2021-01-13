@push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
    media="screen">

<meta name="csrf_token" content="{{ csrf_token() }}" />
<style>
    .gallery {
        /* display: inline-block;
        margin-top: 20px; */

    }

    #sortable div a img {
        width: 100vw;
        height: 20vh;
    }

    .close-icon {
        float: right
    }

    .order-icon {
        float: right
    }

    .form-image-upload {
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 15px;
    }

</style>
@endpush



<form action="{{ url('image-gallery') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    {{--
          
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
    --}}






    <div class="row">

        <div class="col-md-5">
            <strong>@lang('Image'):</strong>
            <input type="file" name="image[]" class="form-control-file" multiple>
        </div>
        <div class="col-md-2">
            <br />
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </div>
    <input type="hidden" value="{{$car->id}}" name="car_id">
</form>
<div class="">
    <div id="sortable" class='gallery row  my-5'>
        @if($images->count())
        @foreach($images as $image)
        <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3 my-3 border ' id="{{ $image->id }}">
            <a class="thumbnail fancybox" rel="ligthbox" href="{{ asset('uploads/gallery/') }}/{{ $image->image }}">
                <img class="img-fluid" alt="" src="{{ asset('uploads/gallery/') }}/{{ $image->image }}" />
                <!-- <div class='text-center'>
                            <small class='text-muted'>{{ $image->title }}</small>
                        </div>  text-center / end -->
            </a>
            <div style="background: #e8e8e8" class="row">
                <div class="col">
                    <form action="{{ url('image-gallery',$image->id) }}" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        {!! csrf_field() !!}
                        <button type="submit" class="close-icon btn btn-danger m-1"><i
                                class="fas fa-times"></i></button>
                        <button class="order-icon btn btn-primary m-1">{{ $image->order }}</button>
                    </form>

                </div>

            </div>

        </div> <!-- col-6 / end -->
        @endforeach
        @endif
    </div>
    <button class="btn btn-primary" id="submitOrder" onClick="submit()">Enviar</button>
    <p class="my-2"> <span style="font-weight:900">@lang('Nota'):</span> @lang("Puedes editar el orden de aparición de
        imagenes
        arrastrondolas y colocandolas en su orden deseado, despues pulsa el boton enviar, al guardarse los numeros
        indicaran el orden empezando desde 0")</p>
</div>






@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });

</script>

<script>
    $(function () {
        $("#sortable").sortable();



        $("#sortable").disableSelection();
    });

    function submit() {
        var idsInOrder = $("#sortable").sortable("toArray");
        //-----------------^^^^
        console.log(idsInOrder);
        var json_arr = JSON.stringify(idsInOrder);
        document.getElementById('submitOrder').disabled = true

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: "{{ route('gallery.order') }}",
            method: "POST",
            data: {
                order: json_arr
            },
            dataType: 'JSON',
        }).always(function () {
            // Por ejemplo removemos la imagen "cargando..."
            location.reload()
        })
    }

</script>


@endpush
