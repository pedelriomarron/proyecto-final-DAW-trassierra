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

                <div class="col-lg-6 border my-2">
                    <select name="comparate" id="car_1" class="form-control select2">
                        @foreach($cars as $val)
                        <option value="{{ $val->id }}" data-logo="{{ $val->getIMG() }}">
                            {{ $val->brand->name }} {{ $val->name }}</option>
                        @endforeach
                    </select>
                    <div id="car_1_data" class="mt-3">
                    </div>
                </div>

                <div class="col-lg-6 border my-2">
                    <select name="comparate" id="car_2" class="form-control select2">
                        @foreach($cars as $val)
                        <option value="{{ $val->id }}" data-logo="{{ $val->getIMG() }}">
                            {{ $val->brand->name }} {{ $val->name }}</option>
                        @endforeach
                    </select>
                    <div id="car_2_data" class="mt-3">
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12 border">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" id="text_car_1">#</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col" id="text_car_2">#</th>
                            </tr>
                        </thead>
                        <tbody id="table_comparative">

                        </tbody>
                    </table>
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
                '<span><img class="img-fluid border" width="20%" src="' + baseUrl + '/' + state.element
                .dataset
                .logo + '" class="img-flag" /> ' + state.text + '</span>'
            );

            return $state;
        };

        $(".select2").select2({
            templateResult: formatState,
            //templateSelection: formatState
        });


        $('.select2').on('select2:select', async function (e) {
            //var data = e.params.data;
            //console.log(data);
            //console.log(this.id)
            //let section = this.id
            //let car = data.id
            //let carOb = await getCar(car)
            //drawCar(carOb, section)
            drawCar(await getCar($("#car_1").val()), "car_1")
            drawCar(await getCar($("#car_2").val()), "car_2")

            compareCars();
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
            return car
        }

        function drawCar(car, id) {

            let pathIMG = "{{ asset('uploads/gallery') }}"
            let elemento = document.getElementById(`${id}_data`);
            elemento.textContent = '';
            let foto = document.createElement("img");
            foto.setAttribute('width', '100%');
            foto.setAttribute('height', '200rem');

            foto.setAttribute('src', `${pathIMG}/${car.images[0].image}`);
            foto.setAttribute('class', ' border');

            elemento.appendChild(foto);
            //Useable Battery
            /*
            let div1 = document.createElement("div");
            var useableBatteryTXT = document.createTextNode("Useable Battery: ");
            div1.appendChild(useableBatteryTXT);
            let span1 = document.createElement("span");
            var useableBatteryNumber = document.createTextNode(car.car[0]["id"]);
            span1.appendChild(useableBatteryNumber);
            div1.appendChild(span1);



            elemento.appendChild(div1);
            //Real Range
            var realrangeTXT = document.createTextNode("Real Range");
            elemento.appendChild(realrangeTXT);
            //Efficiency
            var efficiencyTXT = document.createTextNode("Efficiency");
            elemento.appendChild(efficiencyTXT);
            */


        }

        function normalize(string) {
            string = string[0].toUpperCase() + string.slice(1).toLowerCase();
            return string.replaceAll("_", " ")
        }

        async function compareCars() {
            let finalOk = true
            let table_comparative = document.getElementById(`table_comparative`);
            table_comparative.textContent = '';
            let car1 = await getCar($("#car_1").val())
            let car2 = await getCar($("#car_2").val())

            try {
                document.getElementById("text_car_2").innerHTML = `${car2.car[0].name}`;
                document.getElementById("text_car_1").innerHTML = `${car1.car[0].name}`;
            } catch (error) {
                finalOk = false
                alert('')
            }




            let exception = ["id", "brand_id", 'bodystyle_id', 'drive_id', 'segment_id',
                'name', 'youtube', 'created_at', 'updated_at'
            ]
            let extension = {
                range_city_cold: "km",
                range_city_mild: "km",
                range_highway_cold: "km",
                range_highway_mild: "km",
                range_combined_cold: "km",
                range_combined_mild: "km",
                acceleration: "sec",
                topspeed: "km/h",
                electricrange: "km",
                totalpower: "kW",
                totaltorque: "nm",
                batterycapacity: "kWh",
                batteryuseable: "kWh",
                realrange: "km",
                realco2emissions: "g/km",
                realconsumption: "Wh/km",
                realfuelequivalent: " l/100km",
                wltprange: "km",
                wltpco2emissions: "g/km",
                wltpconsumption: "Wh/km",
                wltpfuelequivalent: "l/100km",
                energy_city_cold: "km",
                energy_city_mild: "km",
                energy_highway_cold: "km",
                energy_highway_mild: "km",
                energy_combined_cold: "km",
                energy_combined_mild: "km",
                length: "mm",
                width: "mm",
                height: "mm",
                wheelbase: "mm",
                weightunladen: "kg",
                gvwr: "kg",
                cargovolume: "L",
                cargovolumemax: "L",
                towingweightunbraked: "Kg",
                towingweightbraked: "Kg",
                roofload: "Kg",
                maxpayload: "Kg",
                seat: "personas",
                isofix: "asientos",
                turningcircle: "m",
                roofrails: "",
            }
            if (finalOk) {
                for (var key in car1.car[0]) {
                    let ok = true;
                    var attrName = key;
                    var attrValue = car1.car[0][key];
                    exception.map(ex => {
                        if (ex == key) ok = false
                    })
                    if (ok) {
                        let normalizeName = normalize(attrName)
                        console.log(attrName, attrValue)
                        let tr = document.createElement("tr");
                        let th1 = document.createElement("th");
                        let th1_text = document.createTextNode(`${normalizeName}`);
                        table_comparative.appendChild(tr)
                        tr.appendChild(th1);
                        th1.appendChild(th1_text)

                        //__
                        let td1 = document.createElement("td");
                        let td1_text = document.createTextNode(
                            `${car1.car[0][key]} ${extension[attrName]} `);
                        tr.appendChild(td1);
                        td1.appendChild(td1_text)
                        //__
                        let td2 = document.createElement("td");
                        let td2_text = document.createTextNode(
                            `${car2.car[0][key]} ${extension[attrName]}`);
                        tr.appendChild(td2);
                        td2.appendChild(td2_text)
                        //---
                        let th2 = document.createElement("th");
                        let th2_text = document.createTextNode(`${normalizeName}`);
                        tr.appendChild(th2);
                        th2.appendChild(th2_text)



                    }
                }
            }

        }
        // $('.select2').select2();
    });

</script>
@endpush
