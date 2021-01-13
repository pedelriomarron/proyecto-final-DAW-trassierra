@extends('layouts.app')
@section('content')

@push('styles')
<style>
</style>
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <main id="evdb">
                <div class="content" id="detail-page">
                    <!-- subheader -->
                    <header class="sub-header">
                        <h1 style="font-size:2em;font-weight:900"><b>{{$car->brand->name}} {{$car->name}}</b></h1>
                        @if(Auth::check())
                        <span><a href="{{route('favorite.save',$car->id)}}">
                                @if($car->isFavorite(Auth::user()->id))
                                <i class="fas fa-heart"></i>
                                @else
                                <i class="far fa-heart"></i>
                                @endif
                            </a>
                        </span>
                        @endif
                    </header>

                    <!-- core content -->

                    <div class="core-content ">

                        <div data-allowfullscreen="true" data-width="100%" data-max-width="100%" data-nav="thumbs"
                            class="fotorama ">
                            @forelse ($images as $image)
                            <img src="{{ asset('uploads/gallery') }}/{{ $image->image }}">


                            @empty
                            <img class="img-fluid" src="{{ asset('uploads/gallery/')."/".$car->getIMG()}}">
                            @endforelse


                        </div>
                        <hr>

                        <!-- icons -->
                        <section class="data-table" id="icons">
                            <a href="#charging">
                                <div class="icon"><i class="fa fa-battery-full"></i>
                                    <p>{{$car->batteryuseable}} kWh<span>@lang('Useable Battery')</span></p>
                                </div>
                            </a>
                            <a href="#range">
                                <div class="icon"><i class="fa fa-road"></i>
                                    <p>{{$car->realrange}} km *<span>@lang('Real Range')</span></p>
                                </div>
                            </a> <a href="#efficiency">
                                <div class="icon"><i class="fa fa-leaf"></i>
                                    <p>{{$car->realconsumption}} Wh/km *<span>@lang('Efficiency')</span></p>
                                </div>
                            </a>
                        </section>

                        <section class="expected-notification">
                            <h1 style="font-weight:900">@lang('Concesionarios asociados'):</h1>
                            @forelse($conses as $conse)
                            <p><a target="_blank" href="{{ $conse->url_show}}">{{ $conse->name_show }}</a></p>
                            @empty
                            <p>@lang('No tenemos concesionarios asociados para esta marca')</p>
                            @endforelse
                        </section>

                        <section class=" data-table-container" id="main-data">
                            <!-- data-table realrange -->
                            <div class="data-table has-legend" id="range">

                                <h2 style="font-weight:900"><ins data-toggle="tooltip"
                                        title="@lang('Rango de Km en diferentes tipos de terreno')">@lang('Real
                                        Range Estimation')
                                        <span>@lang('between')
                                            {{$car->range_highway_cold}} -
                                            {{$car->range_city_mild}} km</span></h2>
                                </ins>
                                <hr>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('range_city_cold') </td>
                                                <td>{{$car->range_city_cold}} km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('range_highway_cold') </td>
                                                <td>{{$car->range_highway_cold}} km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('range_combined_cold') </td>
                                                <td>{{$car->range_combined_cold}} km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('range_city_mild') </td>
                                                <td>{{$car->range_city_mild}} km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('range_highway_mild') </td>
                                                <td>{{$car->range_highway_mild}} km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('range_combined_mild') </td>
                                                <td>{{$car->range_combined_mild}} km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- data-table performance -->
                            <div class="data-table" id="performance">

                                <h2 style="font-weight:900"><ins data-toggle="tooltip"
                                        title="@lang('Caracteristicas de Rendimiento basicas')">@lang('Performance')
                                </h2></ins>
                                <hr>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('acceleration') 0 - 100 km/h </td>
                                                <td>{{$car->acceleration}} sec</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('topspeed')</td>
                                                <td>{{$car->topspeed}} km/h</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('realrange') *</td>
                                                <td>{{$car->realrange}} km</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('totalpower')</td>
                                                <td>{{$car->totalpower}} kW</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('totaltorque')</td>
                                                <td>{{$car->totaltorque}} Nm</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('drive')</td>
                                                <td>{{$car->drive->name}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- ad-slot AOEA -->

                            <!-- data-table battery charging -->
                            <div class="data-table" id="charging">

                                <h2 style="font-weight:900"><ins data-toggle="tooltip"
                                        title="@lang('Capacidad de bataría')">@lang('Battery')</ins></h2>
                                <hr>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('batterycapacity')</td>
                                                <td>{{$car->batterycapacity}} kWh</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('batteryuseable')</td>
                                                <td>{{$car->batteryuseable}} kWh</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                            </div>


                            <!-- ad-slot Eflux -->

                            <!-- data-table efficiency -->
                            <div class="data-table has-legend" id="efficiency">

                                <h2 style="font-weight:900"><ins>@lang('Energy Consumption')</ins></h2>
                                <hr>

                                <h3 data-toggle="tooltip" title="@lang('Consumos oficiales del vehiculo')">
                                    @lang('realrange')</h3>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('realrange')</td>
                                                <td>{{$car->realrange}} km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('realconsumption')</td>
                                                <td>{{$car->realconsumption}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('realco2emissions')</td>
                                                <td>{{$car->realco2emissions}} g/km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('realfuelequivalent') </td>
                                                <td>{{$car->realfuelequivalent}} l/100km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>




                                <h3 class="my-4" data-toggle="tooltip" title="@lang('Consumos segun el estandar WLTP')">
                                    @lang('wltprange')</h3>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('wltprange')</td>
                                                <td>{{$car->wltprange}} km</td>
                                            </tr>

                                            <tr>
                                                <td>@lang('wltpconsumption')</td>
                                                <td>{{$car->wltpconsumption}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('wltpco2emissions')</td>
                                                <td>{{$car->wltpco2emissions}} g/km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('wltpfuelequivalent')</td>
                                                <td>{{$car->wltpfuelequivalent}} l/100km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <!-- data-table real consumption -->
                            <div class="data-table has-legend" id="real-consumption">
                                <h2 style="font-weight:900"><ins>@lang('Real Energy Consumption Estimation')
                                        <span>@lang('between') 107 - 225
                                            Wh/km</span>
                                    </ins></h2>
                                <hr>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('energy_city_cold')</td>
                                                <td>{{$car->energy_city_cold}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('energy_highway_cold')</td>
                                                <td>{{$car->energy_highway_cold}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('energy_combined_cold')</td>
                                                <td>{{$car->energy_combined_cold}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('energy_city_mild')</td>
                                                <td>{{$car->energy_city_mild}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('energy_highway_mild')</td>
                                                <td>{{$car->energy_highway_mild}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('energy_combined_mild')</td>
                                                <td>{{$car->energy_combined_mild}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- data-table fuel consumption -->

                            <!-- data-table size weight -->
                            <div class="data-table">

                                <h2 style="font-weight:900"><ins>@lang('Dimensions and Weight')</ins></h2>
                                <hr>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('length')</td>
                                                <td>{{$car->length}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('width')</td>
                                                <td>{{$car->width}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('height')</td>
                                                <td>{{$car->height}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('wheelbase')</td>
                                                <td>{{$car->wheelbase}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('weightunladen')</td>
                                                <td>{{$car->weightunladen}} kg</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('gvwr')</td>
                                                <td>{{$car->gvwr}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('cargovolume')</td>
                                                <td>{{$car->cargovolume}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('cargovolumemax')</td>
                                                <td>{{$car->cargovolumemax}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('towingweightunbraked')</td>
                                                <td>{{$car->towingweightunbraked}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('towingweightbraked')</td>
                                                <td>{{$car->towingweightbraked}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('roofload')</td>
                                                <td>{{$car->roofload}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('maxpayload')</td>
                                                <td>{{$car->maxpayload}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- data-table misc -->
                            <div class="data-table">

                                <h2 style="font-weight:900"><ins>@lang('Miscellaneous')</ins></h2>
                                <hr>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('seats') </td>
                                                <td>{{$car->seat}} people</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('isofix')</td>
                                                <td>{{$car->isofix}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('turningcircle')</td>
                                                <td>{{$car->turningcircle}} m</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>@lang('bodystyle')</td>
                                                <td>{{$car->bodystyle->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('segment')</td>
                                                <td>{{$car->segment->letter}} - {{$car->segment->name}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- data-table fiscal -->





                        </section>

                        <!-- section similar -->
                        <section class="data-table-container similar-table" id="similar">
                            <h2>@lang('Other electric vehicles')</h2>

                            <div class="info-box space-around">
                                @forelse ($similars as $similar)
                                <div>
                                    <a href="{{route('show_car',$similar->id)}}">
                                        <img width="224" height="126" class="thumb"
                                            src="{{ asset('uploads/gallery/')."/".$similar->getIMG()}}"
                                            alt="Coche similar">
                                        {{ $similar->brand->name}} {{$similar->name}}
                                    </a>
                                    <span
                                        class="{{ $similar->realrange > $car->realrange  ?  'better' : ($similar->realrange < $car->realrange  ? 'worse' : 'same' )}}"><i
                                            class="fa fa{{ $car->realrange < $similar->realrange  ?  '-plus' : ($car->realrange == $similar->realrange ? '' : '-minus') }}-circle"></i>
                                        {{ abs($car->realrange - $similar->realrange)}} km
                                        {{ $car->realrange < $similar->realrange  ?  'more' : ($car->realrange == $similar->realrange ? 'same' : 'less') }}
                                        @lang('range')</span>
                                    <span
                                        class="{{ $car->acceleration < $similar->acceleration  ?  'worse' : ($car->acceleration == $similar->acceleration ? 'same' : 'better' )}}"><i
                                            class="fa fa{{ $car->acceleration > $similar->acceleration  ?  '-plus' : ( $car->acceleration == $similar->acceleration ? '' : '-minus') }}-circle"></i>
                                        {{round(abs(abs(($similar->acceleration/$car->acceleration)*100) -100))   }} %
                                        {{ $car->acceleration < $similar->acceleration  ?  'slower ' :( $car->acceleration == $similar->acceleration ? 'same' : 'faster') }}
                                        @lang('acceleration')</span>
                                    <span
                                        class="{{ $car->realconsumption > $similar->realconsumption  ?  'better' : ($car->realconsumption == $similar->realconsumption ? 'same' : 'worse' )}}"><i
                                            class="fa fa{{ $car->realconsumption > $similar->realconsumption  ?  '-plus' : ($car->realconsumption == $similar->realconsumption ? '' : '-minus' )}}-circle"></i>
                                        {{round(abs(abs(($similar->realconsumption/$car->realconsumption)*100) -100))   }}%
                                        {{ $car->realconsumption < $similar->realconsumption  ?  'less' : ($car->realconsumption == $similar->realconsumption ? 'same' : 'more') }}
                                        @lang('energy efficient')</span>
                                </div>

                                @empty
                                @endforelse




                        </section>



                        <!-- section video -->
                        <section class="data-table-container detail-video" id="detail-video">
                            <div class="videowrapper">
                                {!! $car->yt_iframe !!}
                            </div>
                        </section>


                    </div>

                    <!-- subfooter -->
                    <footer class="sub-footer">

                    </footer>

                </div>
            </main>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();




    });

</script>

@endpush
