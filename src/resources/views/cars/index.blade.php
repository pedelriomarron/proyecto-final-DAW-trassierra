@extends('layouts.app')

@section('content')
@push('scripts')
<!-- ESTILOS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- PAra el select con dropwdonw-->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css" rel="stylesheet"
    type="text/css">
<!-- Script carga-->
<script src="https://ev-database.org/js/dynamic/script.js?u=si&l=si&p=index&v=4.2.5"></script>
<!-- FIN ESTILOS -->
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <main id="evdb">
                <div class="content jplist">
                    <!-- panel-top -->
                    <!-- panel-top-header -->
                    <div class="jplist-panel panel-header sub-header">
                        <div class="subheader-title">
                            <h1>All electric vehicles</h1>
                            <span data-control-type="counter" data-control-action="counter"
                                data-control-name="all-counter" data-format="{count} cars found"
                                data-path=".data-wrapper" data-mode="filter" data-type="path">
                            </span>
                        </div>

                        <div class="sort-reset">

                            <div class="jplist-drop-down" data-control-type="sort-drop-down" data-control-name="sort"
                                data-control-action="sort">

                                <ul>
                                    <!-- sort dropdown 
                                    <li><span data-path=".rank" data-order="desc" data-type="number">Most Viewed</span>
                                    </li>
                                    -->
                                    <li><span data-path=".title" data-order="asc" data-type="text">Alphabetic
                                            (a-z)</span>
                                    </li>
                                    <li><span data-path=".title" data-order="desc" data-type="text">Alphabetic
                                            (z-a)</span>
                                    </li>
                                    <!--
                                    <li><span data-path=".price" data-order="asc" data-type="number">Price
                                            Low-High</span></li>
                                    <li><span data-path=".price" data-order="desc" data-type="number">Price
                                            High-Low</span></li>
                                    <li><span data-path=".erange_real" data-order="desc" data-type="number">Range</span>
                                    </li>
                                    <li><span data-path=".efficiency" data-order="asc"
                                            data-type="number">Efficiency</span></li>
                                    <li><span data-path=".fastcharge_speed" data-order="desc"
                                            data-type="number">Fastcharging</span></li>
                                            -->
                                    <li><span data-path=".acceleration" data-order="asc"
                                            data-type="number">Acceleration</span>
                                    </li>
                                    <!--
                                    <li><span data-path=".date_from" data-order="desc" data-type="number">Date
                                            Available</span>
                                    </li> -->
                                </ul>
                            </div>

                            <!-- reset button -->
                            <button type="button" class="jplist-reset-btn" data-control-type="reset"
                                data-control-name="reset" data-control-action="reset">
                                Reset &nbsp;<i class="fa fa-share"></i>
                            </button>
                        </div>

                    </div>

                    <!-- panel-top-main -->
                    <div class="jplist-panel panel-top">

                        <div id="default-options">

                            <!-- first row options -->
                            <div class="first-row-options">
                                <!-- make dropdown -->
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="make-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Brand" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">
                                    <ul>
                                        @foreach ( $brands as $brand )
                                        <li>
                                            <input data-path=".brand-{{$brand->id}}" id="brand-{{$brand->id}}"
                                                type="checkbox" />
                                            <label for="brand-{{$brand->id}}">{{$brand->name}}
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="brand-{{$brand->id}}-counter"
                                                    data-format="({count})" data-path=".brand-{{$brand->id}}"
                                                    data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- price dropdown 
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="price-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Price" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">

                                    <ul>
                                        <li>
                                            <input data-path=".price_filter20-40" id="price_filter20-40"
                                                type="checkbox" />
                                            <label for="price_filter20-40">$
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="pf20-40-counter" data-format="({count})"
                                                    data-path=".price_filter20-40" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <input data-path=".price_filter40-60" id="price_filter40-60"
                                                type="checkbox" />
                                            <label for="price_filter40-60">$$
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="pf40-60-counter" data-format="({count})"
                                                    data-path=".price_filter40-60" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <input data-path=".price_filter60-80" id="price_filter60-80"
                                                type="checkbox" />
                                            <label for="price_filter60-80">$$$
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="pf60-80-counter" data-format="({count})"
                                                    data-path=".price_filter60-80" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>


                                    </ul>
                                </div>
                                -->
                                <!-- vormgeving dropdown -->
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="bodyshape-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Body Style" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">

                                    <ul>
                                        @foreach ( $bodystyles as $bodystyle )
                                        <li>
                                            <input data-path=".bodystyle-{{$bodystyle->id}}"
                                                id="bodystyle-{{$bodystyle->id}}" type="checkbox" />
                                            <label for="bodystyle-{{$bodystyle->id}}">{{$bodystyle->name}} <span
                                                    data-control-type="counter" data-control-action="counter"
                                                    data-control-name="bodystyle-{{$bodystyle->id}}-counter"
                                                    data-format="({count})" data-path=".bodystyle-{{$bodystyle->id}}"
                                                    data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>

                                <!-- availability dropdown 
                                <div class="jplist-checkbox-dropdown availability" data-control-type="checkbox-dropdown"
                                    data-control-name="availability-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Availability" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">
                                    <ul>
                                        <li>
                                            <input data-path=".current" id="current" type="checkbox"> <label
                                                for="current">Available
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="current-counter" data-format="({count})"
                                                    data-path=".current" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                -->
                            </div>

                            <!-- more options -->
                            <div id="toggle-more-options"><i class="fa fa-angle-double-down fa-fw"></i>More Options
                            </div>

                        </div>

                        <div id="more-options" class="box">

                            <!-- second row options -->
                            <div class="box second-row-options">

                                <!-- chargeplug dropdown
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="plug-cb-dd" data-control-action="filter"
                                    data-no-selected-text="Charge Plug" data-one-item-text="{selected}"
                                    data-many-items-text="{num} geselecteerd">

                                    <ul>


                                        <li>
                                            <input data-path=".plug-type2" id="plug-type2" type="checkbox" />
                                            <label for="plug-type2">Type 2
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="plug-type2-counter" data-format="({count})"
                                                    data-path=".plug-type2" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                       
                                    </ul>
                                </div>
 -->
                                <!-- size dropdown -->
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="size-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Segment" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">
                                    <ul>

                                        @foreach ( $segments as $segment )
                                        <li>
                                            <input data-path=".segment-{{$segment->id}}" id="segment-{{$segment->id}}"
                                                type="checkbox" />
                                            <label for="segment-{{$segment->id}}">{{$segment->letter}} -
                                                {{$segment->name}}
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="segment-{{$segment->id}}-counter"
                                                    data-format="({count})" data-path=".segment-{{$segment->id}}"
                                                    data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                        @endforeach



                                    </ul>
                                </div>

                                <!-- seats dropdown -->
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="seats-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Seats" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">
                                    <ul>
                                        <li>
                                            <input data-path=".seats-2" id="seats-2" type="checkbox" />
                                            <label for="seats-2">2 Seats
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="seats-2-counter" data-format="({count})"
                                                    data-path=".seats-2" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <input data-path=".seats-4" id="seats-4" type="checkbox" />
                                            <label for="seats-4">4 Seats
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="seats-4-counter" data-format="({count})"
                                                    data-path=".seats-4" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <input data-path=".seats-5" id="seats-5" type="checkbox" />
                                            <label for="seats-5">5 Seats
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="seats-5-counter" data-format="({count})"
                                                    data-path=".seats-5" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <input data-path=".seats-7" id="seats-7" type="checkbox" />
                                            <label for="seats-7">5+ Seats
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="seats-7-counter" data-format="({count})"
                                                    data-path=".seats-7" data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <!-- drive dropdown -->
                                <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                                    data-control-name="propulsion-checkbox-dropdown" data-control-action="filter"
                                    data-no-selected-text="Drive" data-one-item-text="{selected}"
                                    data-many-items-text="{num} selected">

                                    <ul>
                                        @foreach ( $drives as $drive )
                                        <li>
                                            <input data-path=".drive-{{$drive->id}}" id="drive-{{$drive->id}}"
                                                type="checkbox" />
                                            <label for="drive-{{$drive->id}}"><i class="fa fa-circle-o"></i><i
                                                    class="fa fa-circle"></i> -
                                                {{$drive->name}}
                                                <span data-control-type="counter" data-control-action="counter"
                                                    data-control-name="drive-{{$drive->id}}-counter"
                                                    data-format="({count})" data-path=".drive-{{$drive->id}}"
                                                    data-mode="filter" data-type="path">
                                                </span>
                                            </label>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>


                            <div class="first-slider-row">

                                <div class="jplist-range-slider" data-control-type="range-slider"
                                    data-control-name="range-slider-acceleration" data-control-action="filter"
                                    data-path=".acceleration" data-slider-func="accelerationSlider"
                                    data-setvalues-func="accelerationValues">
                                    <label for="range-slider-acceleration">Acceleration: <span
                                            data-type="prev-value"></span> - <span
                                            data-type="next-value"></span></label>
                                    <div class="ui-slider" data-type="ui-slider"></div>
                                </div>
                                <div class="jplist-range-slider" data-control-type="range-slider"
                                    data-control-name="range-slider-topspeed" data-control-action="filter"
                                    data-path=".topspeed" data-slider-func="topspeedSlider"
                                    data-setvalues-func="topspeedValues">
                                    <label for="range-slider-topspeed">Top Speed: <span data-type="prev-value"></span> -
                                        <span data-type="next-value"></span></label>
                                    <div class="ui-slider" data-type="ui-slider"></div>
                                </div>

                            </div>
                            <!-- first slider row 
                            
                            <div class="second-slider-row">

                                <div class="jplist-range-slider" data-control-type="range-slider"
                                    data-control-name="range-slider-battery" data-control-action="filter"
                                    data-path=".battery" data-slider-func="batterySlider"
                                    data-setvalues-func="batteryValues">
                                    <label for="range-slider-battery">Battery: <span data-type="prev-value"></span> -
                                        <span data-type="next-value"></span></label>
                                    <div class="ui-slider" data-type="ui-slider"></div>
                                </div>

                            </div>

                            -->
                        </div>

                    </div>
                    <!-- list-items -->
                    <div class="list">
                        @foreach ($cars as $car)

                        <div class="list-item">
                            <div class="data-wrapper">
                                <!-- img -->
                                <div class="img">
                                    <a href=""> <img width="224" height="126"
                                            src="{{ asset('uploads/gallery/')."/".$car->getIMG()}}"
                                            data-src-retina="{{ asset('uploads/gallery/')."/".$car->getIMG()}}"
                                            data-src="{{ asset('uploads/gallery/')."/".$car->getIMG()}}"
                                            alt="{{$car->name}}" /></a>
                                </div>

                                <!-- item-data -->
                                <div class="title-wrap">
                                    <h2><a href="" class="title"><span
                                                class="brand-{{$car->brand->id}}">{{$car->brand->name}}
                                            </span><span class="model">{{$car->name}}</span></a>
                                    </h2><span class="date_from hidden">1606777200</span><span
                                        class="rank hidden">7673</span>
                                    <!--<span class="not-current">(coming soon)</span>-->
                                    <div class="subtitle">
                                        <!--    Battery Electric Vehicle - <span class="battery">48</span> kWh *-->
                                    </div>

                                </div>

                                <div class="icons">
                                    <!-- 
                                    <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                        title="Rear Wheel Drive">
                                        <span class="drive-{{$car->drive->id}} fa fa-circle-o"
                                            style="padding-left: 10px; margin-right: -3px;"></span>
                                        <span class="drive-{{$car->drive->id}} fa fa-circle"></span>
                                    </span>-->
                                    <!-- 
                                    <span title="plug-type2-ccs" class="plug-type2-ccs hidden">Type 2 CCS</span>-->
                                    <span class="bodystyle-{{$car->bodystyle->id}}
                                        hidden">{{$car->bodystyle->name}}</span>
                                    <span title="Market Segment" class="segment-{{$car->segment->id}}"
                                        style="padding-left: 10px;">{{$car->segment->letter}}
                                    </span>
                                    <span style="padding-left: 10px;" title="Number of seats"
                                        class="seats-{{$car->seat}} fa fa-user"> {{$car->seat}}
                                    </span>
                                </div>

                                <div class="specs">

                                    <p class="left">
                                        <span class="tag">0 - 100*</span>
                                        <span class="acceleration">{{$car->acceleration}} sec</span>
                                    </p>

                                    <p class="left">
                                        <span class="tag">Top Speed</span>
                                        <span class="topspeed">{{$car->topspeed}} km/h</span>
                                    </p>
                                    <!-- 
                                    <p class="left">
                                        <span class="tag">Range*</span>
                                        <span class="erange_real">280 km</span>
                                    </p>

                                    <p class="left">
                                        <span class="tag">Efficiency*</span>
                                        <span class="efficiency">161 Wh/km</span>
                                    </p>

                                    <p class="left">
                                        <span class="tag">Fastcharge*</span>
                                        <span class="fastcharge_speed_print">260 km/h</span>
                                        <span class="fastcharge_speed hidden">260</span>
                                    </p>
                                    -->
                                </div>
                                <!-- 


                                <div class="pricing align-right">
                                    <span class="price_buy">
                                        <span class="country_de" title="Price in Germany before incentives">*
                                            €30,000</span>
                                        <span class="flag-icon flag-icon-de"></span>
                                    </span>

                                    <span class="price_buy">
                                        <span class="country_nl" title="Price in The Netherlands before incentives">*
                                            €30,000</span>
                                        <span class="flag-icon flag-icon-nl"></span>
                                    </span>
                                    <span class="price_buy">
                                        <span class="country_uk" title="Price in the United Kingdom after incentives">*
                                            £25,000</span>
                                        <span class="flag-icon flag-icon-gb"></span>
                                    </span>

                                    <span class="price price_filter20-40 hidden">0.56</span>
                                </div>
                                -->
                            </div>
                        </div>

                        @endforeach


                    </div>

                    <!-- no-results -->
                    <div class="jplist-no-results align-center">
                        <p>No results</p>
                        <p><br /><a href="">
                                .</a>
                        </p>
                    </div>



                    <!-- panel-bottom -->
                    <div class="jplist-panel panel-bottom">

                        <div class="pagination-wrapper">
                            <div class="jplist-label" data-type="Pagina {current} de {pages}"
                                data-control-type="pagination-info" data-control-name="paging"
                                data-control-action="paging">
                            </div>

                            <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging"
                                data-control-action="paging" data-jump-to-start="true" data-mode="google-like"
                                data-range="5" data-control-animate-to-top="true">
                            </div>

                            <div class="jplist-label" data-type="{start} - {end} de {all}"
                                data-control-type="pagination-info" data-control-name="paging"
                                data-control-action="paging">
                            </div>
                        </div>

                        <div class="pagination-dropdown-wrapper right">
                            <div class="jplist-drop-down" id="paging" data-control-type="items-per-page-drop-down"
                                data-control-name="paging" data-control-action="paging">

                                <ul>
                                    <li><span data-number="3">3 por pagina</span></li>
                                    <li><span data-number="6">6 por pagina</span></li>
                                    <li><span data-number="9" data-default="true">9 por pagina</span></li>
                                    <li><span data-number="all">ver todo</span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>



            </main>




        </div>
    </div>
</div>
@endsection


@push('scripts')


@endpush
