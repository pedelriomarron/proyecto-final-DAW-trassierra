@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<div class="card shadow mb-4">
    <!-- Title Card  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">@lang('create-car')</h3>
    </div>
    <!-- Button Add 
    <div>
        <div class=" p-3 pt-4">
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> @lang('create-cars')</button>
        </div>
    </div>
     -->
    <!-- Body Card  -->
    <div class="card-body">
        <div class="">
            <div class="row">
                <div class="col-lg-12 margin-tb ">
                    <div class="pull-left">
                        <h2> @lang('add.car')</h2>
                    </div>
                    <div class="pull-right my-3">
                        <a class="btn btn-primary" href="{{ route('cars.index') }}" title="Go back"> <i
                                class="fas fa-backward "></i> </a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger my-1">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <form action="
            @if (request()->route()->getName() !== 'cars.create')
             {{route('cars.update',['car'=> request()->car->id])}}
                @else
            {{route('cars.store')}}
            @endif" method="POST">
                {{--  @if (request()->route()->parameters != null) route('cars.update') @else route('cars.store') @endif --}}
                @if (request()->route()->getName() !== 'cars.create')
                @method('PUT')
                @else
                @endif
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="form-group col">
                                <strong>@lang('brand'):</strong>
                                {{--   {!! Form::select('brand', $brands, null, ['class' => 'form-control select2 ', ]) !!} --}}
                                <select name="brand_id" class="form-control select2">
                                    @foreach($brands as $val)
                                    <option @if (request()->route()->getName() !== 'cars.create')@if($car->brand->id ==
                                        $val->id) selected="selected" @endif @endif
                                        value="{{ $val->id }}"
                                        data-logo="{{ $val->logo }}">
                                        {{ $val->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col">
                                <strong>@lang('car-name'):</strong>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                    value="{{ old('name', $car->name) }}">
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col">
                                <strong>@lang('bodystyles'):</strong>
                                <select name="bodystyle_id" class="form-control select2">
                                    @foreach($bodystyles as $val)
                                    <option @if (request()->route()->getName() !== 'cars.create')
                                        @if($car->bodystyle->id
                                        ==
                                        $val->id) selected="selected" @endif @endif
                                        value="{{ $val->id }}"
                                        data-logo="{{ $val->logo }}"> {{ $val->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <strong>@lang('segments'):</strong>
                                <select name="segment_id" class="form-control select2">
                                    @foreach($segments as $val)
                                    <option @if (request()->route()->getName() !== 'cars.create') @if($car->segment->id
                                        ==
                                        $val->id) selected="selected" @endif @endif
                                        value="{{ $val->id }}"
                                        data-logo="{{ $val->logo }}"> {{ $val->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>





                        <div class="row">
                            <div class="form-group col-lg-4">
                                <strong>@lang('range_city_cold'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('range_city_cold',  empty($car->range_city_cold) ? 0 : $car->range_city_cold ) }}"
                                    id="range_city_cold" name="range_city_cold">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('range_highway_cold'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('range_highway_cold',  empty($car->range_highway_cold) ? 0 : $car->range_highway_cold ) }}"
                                    id="range_highway_cold" name="range_highway_cold">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('range_combined_cold'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('range_combined_cold',  empty($car->range_combined_cold) ? 0 : $car->range_combined_cold ) }}"
                                    id="range_combined_cold" name="range_combined_cold">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('range_city_mild'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('range_city_mild',  empty($car->range_city_mild) ? 0 : $car->range_city_mild ) }}"
                                    id="range_city_mild" name="range_city_mild">
                            </div>

                            <div class="form-group col-lg-4">
                                <strong>@lang('range_highway_mild'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('range_highway_mild',  empty($car->range_highway_mild) ? 0 : $car->range_highway_mild ) }}"
                                    id="range_highway_mild" name="range_highway_mild">
                            </div>

                            <div class="form-group col-lg-4">
                                <strong>@lang('range_combined_mild'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('range_combined_mild',  empty($car->range_combined_mild) ? 0 : $car->range_combined_mild ) }}"
                                    id="range_combined_mild" name="range_combined_mild">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <strong>@lang('acceleration'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('acceleration',  empty($car->acceleration) ? 0 : $car->acceleration ) }}"
                                    id="acceleration" name="acceleration">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('topspeed'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('topspeed',  empty($car->topspeed) ? 0 : $car->topspeed ) }}"
                                    id="topspeed" name="topspeed">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('electricrange'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('electricrange',  empty($car->electricrange) ? 0 : $car->electricrange ) }}"
                                    id="electricrange" name="electricrange">
                            </div>

                            <div class="form-group col-lg-4">
                                <strong>@lang('totalpower'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('totalpower',  empty($car->totalpower) ? 0 : $car->totalpower ) }}"
                                    id="totalpower" name="totalpower">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('totaltorque'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('totaltorque',  empty($car->totaltorque) ? 0 : $car->totaltorque ) }}"
                                    id="totaltorque" name="totaltorque">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('drive'):</strong>
                                <select name="drive_id" class="form-control select2">
                                    @foreach($drives as $val)
                                    <option @if (request()->route()->getName() !== 'cars.create') @if($car->drive->id ==
                                        $val->id) selected="selected" @endif @endif
                                        value="{{ $val->id }}"
                                        data-logo="{{ $val->logo }}"> {{ $val->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <strong>@lang('batterycapacity'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('batterycapacity',  empty($car->batterycapacity) ? 0 : $car->batterycapacity ) }}"
                                    id="batterycapacity" name="batterycapacity">
                            </div>
                            <div class="form-group col-lg-6">
                                <strong>@lang('batteryuseable'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('batteryuseable',  empty($car->batteryuseable) ? 0 : $car->batteryuseable ) }}"
                                    id="batteryuseable" name="batteryuseable">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3">
                                <strong>@lang('realrange'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('realrange',  empty($car->realrange) ? 0 : $car->realrange ) }}"
                                    id="realrange" name="realrange">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('realco2emissions'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('realco2emissions',  empty($car->realco2emissions) ? 0 : $car->realco2emissions ) }}"
                                    id="realco2emissions" name="realco2emissions">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('realconsumption'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('realconsumption',  empty($car->realconsumption) ? 0 : $car->realconsumption ) }}"
                                    id="realconsumption" name="realconsumption">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('realfuelequivalent'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('realfuelequivalent',  empty($car->realfuelequivalent) ? 0 : $car->realfuelequivalent ) }}"
                                    id="realfuelequivalent" name="realfuelequivalent">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('wltprange'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('wltprange',  empty($car->wltprange) ? 0 : $car->wltprange ) }}"
                                    id="wltprange" name="wltprange">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('wltpco2emissions'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('wltpco2emissions',  empty($car->wltpco2emissions) ? 0 : $car->wltpco2emissions ) }}"
                                    id="wltpco2emissions" name="wltpco2emissions">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('wltpconsumption'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('wltpconsumption',  empty($car->wltpconsumption) ? 0 : $car->wltpconsumption ) }}"
                                    id="wltpconsumption" name="wltpconsumption">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('wltpfuelequivalent'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('wltpfuelequivalent',  empty($car->wltpfuelequivalent) ? 0 : $car->wltpfuelequivalent ) }}"
                                    id="wltpfuelequivalent" name="wltpfuelequivalent">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <strong>@lang('energy_city_cold'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('energy_city_cold',  empty($car->energy_city_cold) ? 0 : $car->energy_city_cold ) }}"
                                    id="energy_city_cold" name="energy_city_cold">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('energy_city_mild'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('energy_city_mild',  empty($car->energy_city_mild) ? 0 : $car->energy_city_mild ) }}"
                                    id="energy_city_mild" name="energy_city_mild">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('energy_highway_cold'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('energy_highway_cold',  empty($car->energy_highway_cold) ? 0 : $car->energy_highway_cold ) }}"
                                    id="energy_highway_cold" name="energy_highway_cold">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('energy_highway_mild'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('energy_highway_mild',  empty($car->energy_highway_mild) ? 0 : $car->energy_highway_mild ) }}"
                                    id="energy_highway_mild" name="energy_highway_mild">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('energy_combined_cold'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('energy_combined_cold',  empty($car->energy_combined_cold) ? 0 : $car->energy_combined_cold ) }}"
                                    id="energy_combined_cold" name="energy_combined_cold">
                            </div>
                            <div class="form-group col-lg-4">
                                <strong>@lang('energy_combined_mild'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('energy_combined_mild',  empty($car->energy_combined_mild) ? 0 : $car->energy_combined_mild ) }}"
                                    id="energy_combined_mild" name="energy_combined_mild">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <strong>@lang('length'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('length',  empty($car->length) ? 0 : $car->length ) }}" id="length"
                                    name="length">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('width'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('width',  empty($car->width) ? 0 : $car->width ) }}" id="width"
                                    name="width">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('height'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('height',  empty($car->height) ? 0 : $car->height ) }}" id="height"
                                    name="height">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('wheelbase'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('wheelbase',  empty($car->wheelbase) ? 0 : $car->wheelbase ) }}"
                                    id="wheelbase" name="wheelbase">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('weightunladen'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('weightunladen',  empty($car->weightunladen) ? 0 : $car->weightunladen ) }}"
                                    id="weightunladen" name="weightunladen">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('gvwr'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('gvwr',  empty($car->gvwr) ? 0 : $car->gvwr ) }}" id="gvwr"
                                    name="gvwr">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('cargovolume'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('cargovolume',  empty($car->cargovolume) ? 0 : $car->cargovolume ) }}"
                                    id="cargovolume" name="cargovolume">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('cargovolumemax'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('cargovolumemax',  empty($car->cargovolumemax) ? 0 : $car->cargovolumemax ) }}"
                                    id="cargovolumemax" name="cargovolumemax">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('towingweightunbraked'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('towingweightunbraked',  empty($car->towingweightunbraked) ? 0 : $car->towingweightunbraked ) }}"
                                    id="towingweightunbraked" name="towingweightunbraked">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('towingweightbraked'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('towingweightbraked',  empty($car->towingweightbraked) ? 0 : $car->towingweightbraked ) }}"
                                    id="towingweightbraked" name="towingweightbraked">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('roofload'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('roofload',  empty($car->roofload) ? 0 : $car->roofload ) }}"
                                    id="roofload" name="roofload">
                            </div>
                            <div class="form-group col-lg-2">
                                <strong>@lang('maxpayload'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('maxpayload',  empty($car->maxpayload) ? 0 : $car->maxpayload ) }}"
                                    id="maxpayload" name="maxpayload">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <strong>@lang('seats'):</strong>
                                <select class="form-control" id="seat" name="seat">
                                    <option @if($car->seat== 2) selected="selected" @endif value="2">2
                                        @lang('seats')</option>
                                    <option @if($car->seat== 4) selected="selected" @endif value="4">4
                                        @lang('seats')</option>
                                    <option @if($car->seat== 5) selected="selected" @endif value="5">5
                                        @lang('seats')</option>
                                    <option @if($car->seat== 7) selected="selected" @endif value="7">+5
                                        @lang('seats')</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('isofix'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('isofix',  empty($car->isofix) ? 0 : $car->isofix ) }}" id="isofix"
                                    name="isofix">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('turningcircle'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('turningcircle',  empty($car->turningcircle) ? 0 : $car->turningcircle ) }}"
                                    id="turningcircle" name="turningcircle">
                            </div>
                            <div class="form-group col-lg-3">
                                <strong>@lang('roofrails'):</strong>
                                <input class="form-control" type="number"
                                    value="{{  old('roofrails',  empty($car->roofrails) ? 0 : $car->roofrails ) }}"
                                    id="roofrails" name="roofrails">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">@lang('submit')</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@if (isset($car->id))
<div class="card shadow mb-4">
    <!-- Title Card  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">@lang('g-car')</h3>
    </div>
    <!-- Button Add 
    <div>
        <div class=" p-3 pt-4">
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> @lang('create-cars')</button>
        </div>
    </div>
     -->
    <!-- Body Card  -->

    <div class="card-body">
        <div class="">
            @include('admin.gallery.index')
        </div>
    </div>

</div>
@endif

@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "{{ asset('uploads/brands/') }}"
            var $state = $(
                '<span><img class="img-fluid" width="20px" src="' + baseUrl + '/' + state.element.dataset
                .logo + '" class="img-flag" /> ' + state.text + '</span>'
            );

            return $state;
        };

        $(".select2").select2({
            templateResult: formatState,
            templateSelection: formatState

        });



        // $('.select2').select2();
    });

</script>
@endpush
