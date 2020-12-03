@extends('layouts.app')
@section('content')

@push('styles')
   <!-- image main -->
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
                        <h1>{{$car->brand->name}} {{$car->name}}</h1>
                        <span>Battery Electric Vehicle</span>
                    </header>

                    <!-- core content -->
                   
                    <div class="core-content ">

                     <div  data-allowfullscreen="true"  data-width="100%"  data-max-width="100%" data-nav="thumbs" class="fotorama ">
                     @forelse ($images as $image)
                        <img  src="{{ asset('uploads/gallery') }}/{{ $image->image }}">
                   
                   
                    @empty
                            <img class="img-fluid" src="https://s.fotorama.io/2.jpg">
                    @endforelse

                            
                    </div>
                    <hr>
                     
                        <!-- icons -->
                        <section class="data-table" id="icons">
                            <a href="#charging">
                                <div class="icon"><i class="fa fa-battery-full"></i>
                                    <p>{{$car->batteryuseable}} kWh<span>Useable Battery</span></p>
                                </div>
                            </a>
                            <a href="#range">
                                <div class="icon"><i class="fa fa-road"></i>
                                    <p>{{$car->realrange}} km *<span>Real Range</span></p>
                                </div>
                            </a> <a href="#efficiency">
                                <div class="icon"><i class="fa fa-leaf"></i>
                                    <p>{{$car->realconsumption}} Wh/km *<span>Efficiency</span></p>
                                </div>
                            </a>
                        </section>

                   
                        <section class="data-table-container" id="main-data">
                         <!-- data-table realrange -->
                            <div class="data-table has-legend" id="range">

                                <h2>Real Range Estimation <span>between {{$car->range_highway_cold}} - {{$car->range_city_mild}} km</span></h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Cold Weather *</td>
                                                <td>{{$car->range_city_cold}} km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Cold Weather *</td>
                                                <td>{{$car->range_highway_cold}} km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Cold Weather *</td>
                                                <td>{{$car->range_combined_cold}} km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Mild Weather *</td>
                                                <td>{{$car->range_city_mild}}  km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Mild Weather *</td>
                                                <td>{{$car->range_highway_mild}}  km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Mild Weather *</td>
                                                <td>{{$car->range_combined_mild}}  km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- data-table performance -->
                            <div class="data-table" id="performance">

                                <h2>Performance</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Acceleration 0 - 100 km/h *</td>
                                                <td>{{$car->acceleration}} sec</td>
                                            </tr>
                                            <tr>
                                                <td>Top Speed</td>
                                                <td>{{$car->topspeed}} km/h</td>
                                            </tr>
                                            <tr>
                                                <td>Electric Range *</td>
                                                <td>{{$car->electricrange}} km</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Total Power</td>
                                                <td>{{$car->totalpower}} kW</td>
                                            </tr>
                                            <tr>
                                                <td>Total Torque *</td>
                                                <td>{{$car->totaltorque}} Nm</td>
                                            </tr>
                                            <tr>
                                                <td>Drive</td>
                                                <td>{{$car->drive->name}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- ad-slot AOEA -->

                            <!-- data-table battery charging -->
                            <div class="data-table" id="charging">

                                <h2>Battery and Charging</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Battery Capacity *</td>
                                                <td>{{$car->batterycapacity}} kWh</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Battery Useable</td>
                                                <td>{{$car->batteryuseable}} kWh</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                            </div>


                            <!-- ad-slot Eflux -->

                            <!-- data-table efficiency -->
                            <div class="data-table has-legend" id="efficiency">

                                <h2>Energy Consumption</h2>

                                <h3>Real Range</h3>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Range *</td>
                                                <td>{{$car->realrange}} km</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Consumption *</td>
                                                <td>{{$car->realconsumption}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>CO2 Emissions</td>
                                                <td>{{$car->realco2emissions}} g/km</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Fuel Equivalent * </td>
                                                <td>{{$car->realfuelequivalent}} l/100km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>




                                <h3>WLTP Ratings</h3>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Range</td>
                                                <td>{{$car->wltprange}} km</td>
                                            </tr>
                                           
                                            <tr>
                                                <td>Vehicle Consumption</td>
                                                <td>{{$car->wltpconsumption}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>CO2 Emissions</td>
                                                <td>{{$car->wltpco2emissions}} g/km</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Fuel Equivalent</td>
                                                <td>{{$car->wltpfuelequivalent}} l/100km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                    
                            <!-- data-table real consumption -->
                            <div class="data-table has-legend" id="real-consumption">
                                <h2>Real Energy Consumption Estimation <span>between 107 - 225 Wh/km</span></h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Cold Weather *</td>
                                                <td>{{$car->energy_city_cold}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Cold Weather *</td>
                                                <td>{{$car->energy_highway_cold}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Cold Weather *</td>
                                                <td>{{$car->energy_combined_cold}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Mild Weather *</td>
                                                <td>{{$car->energy_city_mild}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Mild Weather *</td>
                                                <td>{{$car->energy_highway_mild}} Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Mild Weather *</td>
                                                <td>{{$car->energy_combined_mild}} Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                          
                            <!-- data-table fuel consumption -->
                       
                            <!-- data-table size weight -->
                            <div class="data-table">

                                <h2>Dimensions and Weight</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Length</td>
                                                <td>{{$car->length}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>Width</td>
                                                <td>{{$car->width}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>Height</td>
                                                <td>{{$car->height}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>Wheelbase</td>
                                                <td>{{$car->wheelbase}} mm</td>
                                            </tr>
                                            <tr>
                                                <td>Weight Unladen (EU) *</td>
                                                <td>{{$car->weightunladen}} kg</td>
                                            </tr>
                                            <tr>
                                                <td>Gross Vehicle Weight (GVWR)</td>
                                                <td>{{$car->gvwr}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Cargo Volume</td>
                                                <td>{{$car->cargovolume}}</td>
                                            </tr>
                                            <tr>
                                                <td>Cargo Volume Max</td>
                                                <td>{{$car->cargovolumemax}}</td>
                                            </tr>
                                            <tr>
                                                <td>Towing Weight Unbraked</td>
                                                <td>{{$car->towingweightunbraked}}</td>
                                            </tr>
                                            <tr>
                                                <td>Towing Weight Braked</td>
                                                <td>{{$car->towingweightbraked}}</td>
                                            </tr>
                                            <tr>
                                                <td>Roof Load</td>
                                                <td>{{$car->roofload}}</td>
                                            </tr>
                                            <tr>
                                                <td>Max. Payload</td>
                                                <td>{{$car->maxpayload}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- data-table misc -->
                            <div class="data-table">

                                <h2>Miscellaneous</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Seats </td>
                                                <td>{{$car->seat}} people</td>
                                            </tr>
                                            <tr>
                                                <td>Isofix</td>
                                                <td>{{$car->isofix}}</td>
                                            </tr>
                                            <tr>
                                                <td>Turning Circle</td>
                                                <td>{{$car->turningcircle}} m</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Car Body</td>
                                                <td>{{$car->bodystyle->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Segment</td>
                                                <td>{{$car->segment->letter}} - {{$car->segment->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Roof Rails</td>
                                                <td>{{$car->roofrails}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- data-table fiscal -->



                         

                        </section>

                        <!-- section similar -->
                        <section class="data-table-container similar-table" id="similar">
                            <h2>Similar electric vehicles</h2>

                            <div class="info-box space-around">
                                @forelse ($similars as $similar)
                                <div>
                                    <a href="{{route('show_car',$similar->id)}}">
                                        <img class="thumb" src="{{ asset('uploads/gallery/')."/".$similar->getIMG()}}"
                                            alt="Coche similar">
                                            {{ $similar->brand->name}} {{$similar->name}}
                                    </a>
                                    <span class="{{ $similar->realrange > $car->realrange  ?  'better' : ($similar->realrange < $car->realrange  ? 'worse' : 'same' )}}"><i class="fa fa{{ $car->realrange < $similar->realrange  ?  '-plus' : ($car->realrange == $similar->realrange ? '' : '-minus') }}-circle"></i> {{ abs($car->realrange - $similar->realrange)}} km {{ $car->realrange < $similar->realrange  ?  'more' : ($car->realrange == $similar->realrange ? 'same' : 'less') }} range</span>
                                    <span class="{{ $car->acceleration < $similar->acceleration  ?  'worse' : ($car->acceleration == $similar->acceleration ? 'same' : 'better' )}}"><i class="fa fa{{ $car->acceleration > $similar->acceleration  ?  '-plus' : ( $car->acceleration == $similar->acceleration ? '' : '-minus') }}-circle"></i> {{round(abs(abs(($similar->acceleration/$car->acceleration)*100) -100))   }} % {{ $car->acceleration < $similar->acceleration  ?  'slower ' :( $car->acceleration == $similar->acceleration ? 'same' : 'faster') }} acceleration</span>
                                    <span class="{{ $car->realconsumption > $similar->realconsumption  ?  'better' : ($car->realconsumption == $similar->realconsumption ? 'same' : 'worse' )}}"><i class="fa fa{{ $car->realconsumption > $similar->realconsumption  ?  '-plus' : ($car->realconsumption == $similar->realconsumption ? '' : '-minus' )}}-circle"></i> {{round(abs(abs(($similar->realconsumption/$car->realconsumption)*100) -100))   }}% {{ $car->realconsumption < $similar->realconsumption  ?  'less' : ($car->realconsumption == $similar->realconsumption ? 'same' : 'more') }} energy efficient</span>
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
                        <h1>{{$car->brand->name}} {{$car->name}}</h1>
                        <span>Battery Electric Vehicle</span>
                    </footer>

                </div>
            </main>
        </div>
    </div>
</div>
@endsection


@push('scripts')


@endpush
