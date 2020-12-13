@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 border">
            <div class="row text-center">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="col-lg-4 border">
                    <select name="comparate" id="car_1" class="form-control select2">
                        @foreach($cars as $val)
                        <option value="{{ $val->id }}" data-logo="{{ $val->getIMG() }}">
                            {{ $val->brand->name }} {{ $val->name }}</option>
                        @endforeach
                    </select>
                    <div id="car_1_data">
                    </div>
                </div>
                <div class="col-lg-4 border">
                    1
                </div>
                <div class="col-lg-4 border">
                    <select name="comparate" id="car-2" class="form-control select2">
                        @foreach($cars as $val)
                        <option value="{{ $val->id }}" data-logo="{{ $val->getIMG() }}">
                            {{ $val->brand->name }} {{ $val->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "{{ asset('uploads/gallery/') }}"
            var $state = $(
                '<span><img class="img-fluid" width="20%" src="' + baseUrl + '/' + state.element.dataset
                .logo + '" class="img-flag" /> ' + state.text + '</span>'
            );

            return $state;
        };

        $(".select2").select2({
            templateResult: formatState,
            //templateSelection: formatState

        });


        $('.select2').on('select2:select', async function (e) {
            var data = e.params.data;
            //console.log(data);
            //console.log(this.id)
            let section = this.id
            let car = data.id
            let carOb = await getCar(car)
            drawCar(carOb, section)
        });

        async function getCar(id) {
            let url = "{{ env('APP_URL') }}"
            let res = await fetch(`${url}api/car/${id}`, {
                headers: {
                    'key': 'key',
                    'user': '1',
                }
            })
            let car = await res.json();
            console.log('car_', car)
            return car[0]
        }

        function drawCar(car, id) {
            let pathIMG = "{{ asset('uploads/gallery') }}"
            let elemento = document.getElementById(`${id}_data`);
            console.log(car)
            alert(`${pathIMG}/${id}`)
            let foto = document.createElement("img");
            foto.setAttribute('width', '100%');
            foto.setAttribute('src', `${pathIMG}/${car.images[0].image}`);
            elemento.appendChild(foto);

            //var textnode = document.createTextNode("Water"); // Create a text node


        }
        // $('.select2').select2();
    });

</script>
@endpush
