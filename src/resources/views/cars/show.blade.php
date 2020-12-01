@extends('layouts.app')

@section('content')
@push('scripts')

<script>

</script>

@endpush
@push('styles')
   <!-- image main -->
                        <style>
                            .fotorama1606820982197 .fotorama__nav--thumbs .fotorama__nav__frame {
                                padding: 10px;
                                height: 64px
                            }

                            .fotorama1606820982197 .fotorama__thumb-border {
                                height: 62px;
                                border-width: 1px;
                                margin-top: 10px
                            }

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
                    <div class="core-content">

                     <div  data-allowfullscreen="true"  data-width="100%"  data-max-width="100%" data-nav="thumbs" class="fotorama">
                     @forelse ($images as $image)
                        <img  src="{{ asset('uploads/gallery') }}/{{ $image->image }}">
                    @empty
                            <img class="img-fluid" src="https://s.fotorama.io/2.jpg">
                    @endforelse

                            
                    </div>
                     
                        <!-- icons -->
                        <section class="data-table" id="icons">
                            <a href="#charging">
                                <div class="icon"><i class="fa fa-battery-full"></i>
                                    <p>45.0 kWh<span>Useable Battery</span></p>
                                </div>
                            </a>
                            <a href="#range">
                                <div class="icon"><i class="fa fa-road"></i>
                                    <p>280 km *<span>Real Range</span></p>
                                </div>
                            </a> <a href="#efficiency">
                                <div class="icon"><i class="fa fa-leaf"></i>
                                    <p>161 Wh/km *<span>Efficiency</span></p>
                                </div>
                            </a>
                        </section>

                        <!-- concept or expected -->
                        <section class="expected-notification">
                            <h2>This electric vehicle is not available yet</h2>
                            Specifications with an * are estimates.
                        </section>

                        <!-- tesla referral -->


                        <!-- ver onderzoek -->


                        <!-- event -->


                        <!-- outdated -->


                        <!-- uncertain -->


                        <section class="data-table-container" id="main-data">

                            <!-- data-table pricing -->
                            <div class="data-table has-legend" id="pricing">

                                <div class="inline-block">
                                    <h2>Price</h2>

                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><a href="https://ev-database.uk/car/1127/Volkswagen-ID3-Pure"><span
                                                            class="flag-icon flag-icon-gb"></span> United Kingdom *</a>
                                                </td>
                                                <td>£25,000</td>
                                            </tr>
                                            <tr>
                                                <td><a href="https://ev-database.nl/auto/1127/Volkswagen-ID3-Pure"><span
                                                            class="flag-icon flag-icon-nl"></span> The Netherlands *</a>
                                                </td>
                                                <td>€30,000</td>
                                            </tr>
                                            <tr>
                                                <td><a href="https://ev-database.de/pkw/1127/Volkswagen-ID3-Pure"><span
                                                            class="flag-icon flag-icon-de"></span> Germany *</a></td>
                                                <td>€30,000</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <h2>Availability</h2>

                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><a href="https://ev-database.uk/car/1127/Volkswagen-ID3-Pure"><span
                                                            class="flag-icon flag-icon-gb"></span> United Kingdom</a>
                                                </td>
                                                <td>Expected</td>
                                            </tr>
                                            <tr>
                                                <td><a href="https://ev-database.nl/auto/1127/Volkswagen-ID3-Pure"><span
                                                            class="flag-icon flag-icon-nl"></span> The Netherlands</a>
                                                </td>
                                                <td>Expected</td>
                                            </tr>
                                            <tr>
                                                <td><a href="https://ev-database.de/pkw/1127/Volkswagen-ID3-Pure"><span
                                                            class="flag-icon flag-icon-de"></span> Germany</a></td>
                                                <td>Expected</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="data-table-legend">
                                Prices shown are recommended retail prices for the specified countries and do not
                                include any indirect incentives. Pricing for the UK includes the direct incentive of the
                                "Plug-In Car Grant (PICG)". Pricing and included options can differ by region and do not
                                include any indirect incentives. Click on a country for more details. </div>
                            <!-- data-table realrange -->
                            <div class="data-table has-legend" id="range">

                                <h2>Real Range Estimation <span>between 200 - 420 km</span></h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Cold Weather *</td>
                                                <td>275 km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Cold Weather *</td>
                                                <td>200 km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Cold Weather *</td>
                                                <td>235 km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Mild Weather *</td>
                                                <td>420 km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Mild Weather *</td>
                                                <td>260 km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Mild Weather *</td>
                                                <td>325 km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="data-table-legend">
                                Indication of real-world range in several situations. Cold weather: 'worst-case' based
                                on -10°C and use of heating. Mild weather: 'best-case' based on 23°C and no use of A/C.
                                The actual range will depend on speed, style of driving, weather and route conditions.
                            </div>


                           

                 


                            <!-- data-table performance -->
                            <div class="data-table" id="performance">

                                <h2>Performance</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Acceleration 0 - 100 km/h *</td>
                                                <td>10.0 sec</td>
                                            </tr>
                                            <tr>
                                                <td>Top Speed</td>
                                                <td>160 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>Electric Range *</td>
                                                <td>280 km</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Total Power</td>
                                                <td>93 kW (126 PS)</td>
                                            </tr>
                                            <tr>
                                                <td>Total Torque *</td>
                                                <td>225 Nm</td>
                                            </tr>
                                            <tr>
                                                <td>Drive</td>
                                                <td>Rear</td>
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
                                                <td>48.0 kWh</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Battery Useable</td>
                                                <td>45.0 kWh</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <h3>Europe</h3>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Charge Port</td>
                                                <td>Type 2</td>
                                            </tr>
                                            <tr>
                                                <td>Port Location</td>
                                                <td>Right Side - Rear</td>
                                            </tr>
                                            <tr>
                                                <td>Charge Power *</td>
                                                <td>7.2 kW AC</td>
                                            </tr>
                                            <tr>
                                                <td>Charge Time (0-&gt;280 km) *</td>
                                                <td>7h30m</td>
                                            </tr>
                                            <tr>
                                                <td>Charge Speed *</td>
                                                <td>38 km/h</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Fastcharge Port</td>
                                                <td>CCS</td>
                                            </tr>
                                            <tr>
                                                <td>FC Port Location</td>
                                                <td>Right Side - Rear</td>
                                            </tr>

                                            <tr>
                                                <td>Fastcharge Power (max) *</td>
                                                <td>50 kW DC</td>
                                            </tr>
                                            <tr>
                                                <td>Fastcharge Time (28-&gt;224 km) *</td>
                                                <td>44 min</td>
                                            </tr>
                                            <tr>
                                                <td>Fastcharge Speed *</td>
                                                <td>260 km/h</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="data-table-to-charge-table"><a href="#charge-table">Click here for all
                                        charging options</a></div>

                            </div>


                            <!-- ad-slot Eflux -->

                            <!-- data-table efficiency -->
                            <div class="data-table has-legend" id="efficiency">

                                <h2>Energy Consumption</h2>

                                <h3>EVDB Real Range</h3>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Range *</td>
                                                <td>280 km</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Consumption *</td>
                                                <td>161 Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>CO2 Emissions</td>
                                                <td>0 g/km</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Fuel Equivalent * </td>
                                                <td>1.8 l/100km</td>
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
                                                <td>330 km</td>
                                            </tr>
                                            <tr>
                                                <td>Rated Consumption</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Consumption</td>
                                                <td>136 Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>CO2 Emissions</td>
                                                <td>0 g/km</td>
                                            </tr>
                                            <tr>
                                                <td>Rated Fuel Equivalent</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Vehicle Fuel Equivalent</td>
                                                <td>1.5 l/100km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="data-table-legend">
                                Rated = official figures as published by manufacturer. Rated consumption and fuel
                                equivalency figures include charging losses.<br>Vehicle = calculated battery energy
                                consumption used by the vehicle for propulsion and on-board systems. </div>

                            <!-- data-table real consumption -->
                            <div class="data-table has-legend" id="real-consumption">
                                <h2>Real Energy Consumption Estimation <span>between 107 - 225 Wh/km</span></h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Cold Weather *</td>
                                                <td>164 Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Cold Weather *</td>
                                                <td>225 Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Cold Weather *</td>
                                                <td>191 Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>City - Mild Weather *</td>
                                                <td>107 Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Highway - Mild Weather *</td>
                                                <td>173 Wh/km</td>
                                            </tr>
                                            <tr>
                                                <td>Combined - Mild Weather *</td>
                                                <td>138 Wh/km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="data-table-legend">
                                Indication of real-world energy use in several situations. Cold weather: 'worst-case'
                                based on -10°C and use of heating. Mild weather: 'best-case' based on 23°C and no use of
                                A/C. The energy use will depend on speed, style of driving, climate and route
                                conditions. </div>
                            <!-- data-table fuel consumption -->


                            <!-- data-table safety -->

                            <div class="data-table has-legend">

                                <h2>Safety (Euro NCAP)</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Safety Rating</td>
                                                <td><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                                        aria-hidden="true"></i><i class="fa fa-star"
                                                        aria-hidden="true"></i><i class="fa fa-star"
                                                        aria-hidden="true"></i><i class="fa fa-star"
                                                        aria-hidden="true"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Adult Occupant</td>
                                                <td>87%</td>
                                            </tr>
                                            <tr>
                                                <td>Child Occupant</td>
                                                <td>89%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Rating Year</td>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <td>Vulnerable Road Users</td>
                                                <td>71%</td>
                                            </tr>
                                            <tr>
                                                <td>Safety Assist</td>
                                                <td>88%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="data-table-legend">
                                For more details on the safety rating of this vehicle, visit <a
                                    href="https://www.euroncap.com/en/results/vw/id.3/41119" target="new"
                                    onclick="trackOutboundLink('https://www.euroncap.com/en/results/vw/id.3/41119')">euroncap.com</a>
                                <i class="fa fa-external-link"></i>
                            </div>

                            <!-- data-table size weight -->
                            <div class="data-table">

                                <h2>Dimensions and Weight</h2>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Length</td>
                                                <td>4261 mm</td>
                                            </tr>
                                            <tr>
                                                <td>Width</td>
                                                <td>1809 mm</td>
                                            </tr>
                                            <tr>
                                                <td>Height</td>
                                                <td>1568 mm</td>
                                            </tr>
                                            <tr>
                                                <td>Wheelbase</td>
                                                <td>2770 mm</td>
                                            </tr>
                                            <tr>
                                                <td>Weight Unladen (EU) *</td>
                                                <td>1625 kg</td>
                                            </tr>
                                            <tr>
                                                <td>Gross Vehicle Weight (GVWR)</td>
                                                <td>No Data</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Cargo Volume</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Cargo Volume Max</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Towing Weight Unbraked</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Towing Weight Braked</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Roof Load</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Max. Payload</td>
                                                <td>No Data</td>
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
                                                <td>5 people</td>
                                            </tr>
                                            <tr>
                                                <td>Isofix</td>
                                                <td>No Data</td>
                                            </tr>
                                            <tr>
                                                <td>Turning Circle</td>
                                                <td>10.2 m</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="inline-block">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Car Body</td>
                                                <td>Hatchback</td>
                                            </tr>
                                            <tr>
                                                <td>Segment</td>
                                                <td>C - Medium</td>
                                            </tr>
                                            <tr>
                                                <td>Roof Rails</td>
                                                <td>No</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- data-table fiscal -->




                            <!-- linkout -->


                            <!-- data-table-legend main-legend -->
                            <div class="data-table-legend" id="main-legend">
                                * = estimated value. Average energy consumption and range based on moderate drive style
                                and climate. Real-life values may differ significantly. Pricing information might not be
                                actual for some regions. No rights can be derived from the information on this site.
                            </div>

                        </section>

                        <!-- section similar -->
                        <section class="data-table-container similar-table" id="similar">
                            <h2>Similar electric vehicles</h2>

                            <div class="info-box space-around">
                                <div>
                                    <a href="/car/1202/Volkswagen-ID3-Pro">
                                        <img class="thumb" src="https://ev-database.org/img/auto/Volkswagen_ID3/Volkswagen_ID3-01-thumb.jpg"
                                            srcset="https://ev-database.org/img/auto/Volkswagen_ID3/Volkswagen_ID3-01-thumb@2x.jpg 2x"
                                            alt="Volkswagen ID.3 Pro">Volkswagen ID.3 Pro</a><span class="better"><i
                                            class="fa fa-plus-circle"></i> 70 km more range</span><span
                                        class="better"><i class="fa fa-plus-circle"></i> 10% faster
                                        acceleration</span><span class="worse"><i class="fa fa-minus-circle"></i> 3%
                                        less energy efficient</span><span class="better"><i
                                            class="fa fa-plus-circle"></i> 69% faster fastcharging</span></div>
                                <div>
                                    <a href="/car/1106/Nissan-Leaf">
                                        <img class="thumb"
                                            src="https://ev-database.org/img/auto/Nissan_Leaf_2018/Nissan_Leaf_2018-01-thumb.jpg"
                                            srcset="https://ev-database.org/img/auto/Nissan_Leaf_2018/Nissan_Leaf_2018-01-thumb@2x.jpg 2x"
                                            alt="Nissan Leaf">Nissan Leaf</a><span class="worse"><i
                                            class="fa fa-minus-circle"></i> 60 km less range</span><span
                                        class="better"><i class="fa fa-plus-circle"></i> 21% faster
                                        acceleration</span><span class="same"><i class="fa fa-circle"></i> Similar
                                        energy consumption</span><span class="worse"><i class="fa fa-minus-circle"></i>
                                        12% slower fastcharging</span></div>
                                <div>
                                    <a href="/car/1087/Volkswagen-e-Golf">
                                        <img class="thumb"
                                            src="https://ev-database.org/img/auto/Volkswagen_e-Golf-2017/Volkswagen_e-Golf-2017-01-thumb.jpg"
                                            srcset="https://ev-database.org/img/auto/Volkswagen_e-Golf-2017/Volkswagen_e-Golf-2017-01-thumb@2x.jpg 2x"
                                            alt="Volkswagen e-Golf">Volkswagen e-Golf</a><span class="worse"><i
                                            class="fa fa-minus-circle"></i> 90 km less range</span><span
                                        class="better"><i class="fa fa-plus-circle"></i> 4% faster
                                        acceleration</span><span class="worse"><i class="fa fa-minus-circle"></i> 4%
                                        less energy efficient</span><span class="worse"><i
                                            class="fa fa-minus-circle"></i> 15% slower fastcharging</span></div>
                            </div>
                            <div class="data-table-legend">Range comparision based on electric range only. Rapid
                                charging comparison based on rapid charge rate. Comparisons can be based on estimates.
                            </div>
                        </section>




                        <!-- section video -->
                        <section class="data-table-container detail-video" id="detail-video">
                            <div class="videowrapper">
                                <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/4UBCVF2Nz54?rel=0&amp;showinfo=0" frameborder="0"
                                    allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
                            </div>
                        </section>

                        <!-- section charging -->
                        <section class="data-table-container charge-table" id="charge-table">
                            <h2>Home and Destination Charging (0 -&gt; 100%)</h2>
                            <div class="info-box ">
                                <p>Charging is possible by using a regular wall plug or a charging station. Public
                                    charging is always done through a charging station. How fast the EV can charge
                                    depends on the charging station (EVSE) used and the maximum charging capacity of the
                                    EV. The table below shows all possible options for charging the Volkswagen ID.3
                                    Pure. Each option shows how fast the battery can be charged from empty to full.</p>
                                <p>NOTE: Volkswagen has not released details about the on-board charger of the ID.3. The
                                    information below is based on estimatation of the most likely on-board charger.</p>
                                <h3>Europe</h3>
                                <p>Charging an EV in Europe differs by country. Some European countries primarily use
                                    1-phase connections to the grid, while other countries are almost exclusively using
                                    a 3-phase connection. The table below shows all possible ways the Volkswagen ID.3
                                    Pure can be charged, but some modes of charging might not be widely available in
                                    certain countries.</p>
                                <div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Type 2 (Mennekes - IEC 62196)</th>
                                            </tr>
                                            <tr>
                                                <td><img src="https://ev-database.org/img/informatie/Type-2-Mennekes-IEC-62196.jpg"
                                                        srcset="https://ev-database.org/img/informatie/Type-2-Mennekes-IEC-62196@2x.jpg 2x">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="charging-table-standard">
                                        <tbody>
                                            <tr>
                                                <th>Charging Point</th>
                                                <th>Max. <span class="mobile-break">Power</span></th>
                                                <th>Power</th>
                                                <th>Time</th>
                                                <th>Rate</th>
                                            </tr>
                                            <tr>
                                                <td>Wall Plug <span class="mobile-break">(2.3 kW)</span></td>
                                                <td>230V /<span class="mobile-break"> 1x10A</span></td>
                                                <td>2.3 kW</td>
                                                <td>23h15m</td>
                                                <td>12 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>1-phase 16A <span class="mobile-break">(3.7 kW)</span></td>
                                                <td>230V /<span class="mobile-break"> 1x16A</span></td>
                                                <td>3.7 kW</td>
                                                <td>14h30m</td>
                                                <td>19 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>1-phase 32A <span class="mobile-break">(7.4 kW)</span></td>
                                                <td>230V /<span class="mobile-break"> 1x31A</span></td>
                                                <td>7.2 kW †</td>
                                                <td>7h30m</td>
                                                <td>37 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>3-phase 16A <span class="mobile-break">(11 kW)</span></td>
                                                <td>230V /<span class="mobile-break"> 2x16A</span></td>
                                                <td>7.2 kW †</td>
                                                <td>7h30m</td>
                                                <td>37 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>3-phase 32A <span class="mobile-break">(22 kW)</span></td>
                                                <td>230V /<span class="mobile-break"> 2x16A</span></td>
                                                <td>7.2 kW †</td>
                                                <td>7h30m</td>
                                                <td>37 km/h</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="f-12">† = Limited by on-board charger, vehicle cannot charge faster.</p>

                            </div>


                            <h2>Fast Charging (10 -&gt; 80%)</h2>
                            <div class="info-box">
                                <p>Rapid charging enables longer journeys by adding as much range as possible in the
                                    shortest amount of time. Charging power will decrease significantly after 80%
                                    state-of-charge has been reached. A typical rapid charge therefore rarely exceeds
                                    80% SoC. The rapid charge rate of an EV depends on the charger used and the maximum
                                    charging power the EV can handle. The table below shows all details for rapid
                                    charging the Volkswagen ID.3 Pure.</p>
                                <p>Volkswagen has not released details about rapid charging the ID.3. The information
                                    below is based on estimated values of the most likely rapid charging capabilities.
                                </p>
                                <ul>
                                    <li>Max. Power: maximum power provided by charge point</li>
                                    <li>Avg. Power: average power provided by charge point over a session from 10% to
                                        80%</li>
                                    <li>Time: time needed to charge from 10% to 80%</li>
                                    <li>Rate: average charging speed over a session from 10% to 80%</li>
                                </ul>
                                <h3>Europe</h3>

                                <div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Combined Charging System (CCS Combo 2)</th>
                                            </tr>
                                            <tr>
                                                <td><img src="https://ev-database.org/img/informatie/Combined-Charging-System-CCS-Combo-2.jpg"
                                                        srcset="https://ev-database.org/img/informatie/Combined-Charging-System-CCS-Combo-2@2x.jpg 2x">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="charging-table-fast">
                                        <tbody>
                                            <tr>
                                                <th>Charging Point</th>
                                                <th>Max. <span class="mobile-break">Power</span></th>
                                                <th>Avg. <span class="mobile-break">Power</span></th>
                                                <th>Time</th>
                                                <th>Rate</th>
                                            </tr>

                                            <tr>
                                                <td>CCS <span class="mobile-break">(50 kW DC)</span></td>
                                                <td>50 kW</td>
                                                <td>45 kW †</td>
                                                <td>44 min</td>
                                                <td>260 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>CCS <span class="mobile-break">(100 kW DC)</span></td>
                                                <td>50 kW †</td>
                                                <td>45 kW †</td>
                                                <td>44 min</td>
                                                <td>260 km/h</td>
                                            </tr>
                                            <tr>
                                                <td>CCS <span class="mobile-break">(150 kW DC)</span></td>
                                                <td>50 kW †</td>
                                                <td>45 kW †</td>
                                                <td>44 min</td>
                                                <td>260 km/h</td>
                                            </tr>
                                        </tbody>
                                    </table>




                                    <p class="f-12">† = Limited by charging capabilities of vehicle</p>
                                    <p class="f-12">Actual charging rates may differ from data shown due to factors like
                                        outside temperature, state of the battery and driving style.</p>
                                </div>






                            </div>
                        </section>

                
                        <!-- section news -->

                        <section class="info-box-container">
                        </section>

                    </div>

                    <!-- subfooter -->
                    <footer class="sub-footer">
                        <h1>Volkswagen ID.3 Pure</h1>
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
