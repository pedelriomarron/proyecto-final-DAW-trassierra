<!doctype html>
<html lang="en">
<!-- head -->

<head>

</head>

<body>
    <main id="evdb">
        <div class="content jplist">

            <!-- panel-top -->
            <!-- panel-top-header -->
            <div class="jplist-panel panel-header sub-header">
                <div class="subheader-title">
                    <h1>All electric vehicles</h1>
                    <span data-control-type="counter" data-control-action="counter" data-control-name="all-counter"
                        data-format="{count} cars found" data-path=".data-wrapper" data-mode="filter" data-type="path">
                    </span>
                </div>

                <div class="sort-reset">
                    <!-- sort dropdown -->
                    <div class="jplist-drop-down" data-control-type="sort-drop-down" data-control-name="sort"
                        data-control-action="sort">

                        <ul>
                            <li><span data-path=".rank" data-order="desc" data-type="number">Most Viewed</span></li>
                            <li><span data-path=".title" data-order="asc" data-type="text">Alphabetic</span></li>
                            <li><span data-path=".price" data-order="asc" data-type="number">Price Low-High</span></li>
                            <li><span data-path=".price" data-order="desc" data-type="number">Price High-Low</span></li>
                            <li><span data-path=".erange_real" data-order="desc" data-type="number">Range</span></li>
                            <li><span data-path=".efficiency" data-order="asc" data-type="number">Efficiency</span></li>
                            <li><span data-path=".fastcharge_speed" data-order="desc"
                                    data-type="number">Fastcharging</span></li>
                            <li><span data-path=".acceleration" data-order="asc" data-type="number">Acceleration</span>
                            </li>

                            <li><span data-path=".date_from" data-order="desc" data-type="number">Date Available</span>
                            </li>
                        </ul>
                    </div>

                    <!-- reset button -->
                    <button type="button" class="jplist-reset-btn" data-control-type="reset" data-control-name="reset"
                        data-control-action="reset">
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
                            data-no-selected-text="Make" data-one-item-text="{selected}"
                            data-many-items-text="{num} selected">
                            <ul>
                                <li>
                                    <input data-path=".aiways" id="aiways" type="checkbox" />
                                    <label for="aiways">Aiways
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="aiways-counter" data-format="({count})"
                                            data-path=".aiways" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input data-path=".audi" id="audi" type="checkbox" />
                                    <label for="audi">Audi
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="audi-counter" data-format="({count})" data-path=".audi"
                                            data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input data-path=".bmw" id="bmw" type="checkbox" />
                                    <label for="bmw">BMW
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="bmw-counter" data-format="({count})" data-path=".bmw"
                                            data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                                <li>
                                    <input data-path=".volvo" id="volvo" type="checkbox" />
                                    <label for="volvo">Volvo
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="volvo-counter" data-format="({count})" data-path=".volvo"
                                            data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- price dropdown -->
                        <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                            data-control-name="price-checkbox-dropdown" data-control-action="filter"
                            data-no-selected-text="Price" data-one-item-text="{selected}"
                            data-many-items-text="{num} selected">

                            <ul>
                                <li>
                                    <input data-path=".price_filter20-40" id="price_filter20-40" type="checkbox" />
                                    <label for="price_filter20-40">$
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="pf20-40-counter" data-format="({count})"
                                            data-path=".price_filter20-40" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                                <li>
                                    <input data-path=".price_filter40-60" id="price_filter40-60" type="checkbox" />
                                    <label for="price_filter40-60">$$
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="pf40-60-counter" data-format="({count})"
                                            data-path=".price_filter40-60" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                                <li>
                                    <input data-path=".price_filter60-80" id="price_filter60-80" type="checkbox" />
                                    <label for="price_filter60-80">$$$
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="pf60-80-counter" data-format="({count})"
                                            data-path=".price_filter60-80" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>


                            </ul>
                        </div>

                        <!-- vormgeving dropdown -->
                        <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                            data-control-name="bodyshape-checkbox-dropdown" data-control-action="filter"
                            data-no-selected-text="Body Style" data-one-item-text="{selected}"
                            data-many-items-text="{num} selected">

                            <ul>

                                <li>
                                    <input data-path=".shape-hatchback" id="shape-hatchback" type="checkbox" />
                                    <label for="shape-hatchback">Hatchback <span data-control-type="counter"
                                            data-control-action="counter" data-control-name="shape-hatchback-counter"
                                            data-format="({count})" data-path=".shape-hatchback" data-mode="filter"
                                            data-type="path">
                                        </span>
                                    </label>
                                </li>


                                <li>
                                    <input data-path=".shape-pickup" id="shape-pickup" type="checkbox" />
                                    <label for="shape-pickup">Pickup Truck <span data-control-type="counter"
                                            data-control-action="counter" data-control-name="shape-pickup-counter"
                                            data-format="({count})" data-path=".shape-pickup" data-mode="filter"
                                            data-type="path">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- availability dropdown -->
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

                                <li>
                                    <input data-path=".not-current" id="not-current" type="checkbox"> <label
                                        for="not-current">Upcoming
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="not-current-counter" data-format="({count})"
                                            data-path=".not-current" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                                <li>
                                    <input data-path=".is-concept" id="is-concept" type="checkbox"> <label
                                        for="is-concept">Concept
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="is-concept-counter" data-format="({count})"
                                            data-path=".is-concept" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- more options -->
                    <div id="toggle-more-options"><i class="fa fa-angle-double-down fa-fw"></i>More Options</div>

                </div>

                <div id="more-options" class="box">

                    <!-- second row options -->
                    <div class="box second-row-options">

                        <!-- chargeplug dropdown -->
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

                                <li>
                                    <input data-path=".plug-type2-ccs" id="plug-type2-ccs" type="checkbox" />
                                    <label for="plug-type2-ccs">Type 2 CCS
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="plug-type2-ccs-counter" data-format="({count})"
                                            data-path=".plug-type2-ccs" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                            </ul>
                        </div>

                        <!-- size dropdown -->
                        <div class="jplist-checkbox-dropdown" data-control-type="checkbox-dropdown"
                            data-control-name="size-checkbox-dropdown" data-control-action="filter"
                            data-no-selected-text="Segment" data-one-item-text="{selected}"
                            data-many-items-text="{num} selected">
                            <ul>


                                <li>
                                    <input data-path=".size-n" id="size-n" type="checkbox" />
                                    <label for="size-n">N - Commercial
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="size-n-counter" data-format="({count})"
                                            data-path=".size-n" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                                <li>
                                    <input data-path=".size-s" id="size-s" type="checkbox" />
                                    <label for="size-s">S - Sports
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="size-s-counter" data-format="({count})"
                                            data-path=".size-s" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

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

                                <li>
                                    <input data-path=".achter" id="achter" type="checkbox" />
                                    <label for="achter"><i class="fa fa-circle-o"></i><i class="fa fa-circle"></i> -
                                        Rear
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="achter-counter" data-format="({count})"
                                            data-path=".achter" data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>

                                <li>
                                    <input data-path=".awd" id="awd" type="checkbox" />
                                    <label for="awd"><i class="fa fa-circle"></i><i class="fa fa-circle"></i> - AWD
                                        <span data-control-type="counter" data-control-action="counter"
                                            data-control-name="awd-counter" data-format="({count})" data-path=".awd"
                                            data-mode="filter" data-type="path">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!-- first slider row -->
                    <div class="first-slider-row">

                        <div class="jplist-range-slider" data-control-type="range-slider"
                            data-control-name="range-slider-range" data-control-action="filter" data-path=".erange_real"
                            data-slider-func="rangeSlider" data-setvalues-func="rangeValues">
                            <label for="range-slider-range">Range: <span data-type="prev-value"></span> - <span
                                    data-type="next-value"></span></label>
                            <div class="ui-slider" data-type="ui-slider"></div>
                        </div>


                    </div>

                    <!-- second slider row -->
                    <div class="second-slider-row">

                        <div class="jplist-range-slider" data-control-type="range-slider"
                            data-control-name="range-slider-battery" data-control-action="filter" data-path=".battery"
                            data-slider-func="batterySlider" data-setvalues-func="batteryValues">
                            <label for="range-slider-battery">Battery: <span data-type="prev-value"></span> - <span
                                    data-type="next-value"></span></label>
                            <div class="ui-slider" data-type="ui-slider"></div>
                        </div>



                    </div>
                </div>

            </div>
            <!-- list-items -->
            <div class="list">
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=https://ev-database.org/car/1127/Volkswagen-ID3-Pure> <img
                                src="https://ev-database.org/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Volkswagen_ID3/Volkswagen_ID3-01-thumb@2x.jpg"
                                data-src="/img/auto/Volkswagen_ID3/Volkswagen_ID3-01-thumb.jpg"
                                alt="Volkswagen ID.3 Pure" /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1127/Volkswagen-ID3-Pure" class="title"><span
                                        class="volkswagen">Volkswagen </span><span class="model">ID.3 Pure</span></a>
                            </h2><span class="date_from hidden">1606777200</span><span class="rank hidden">7673</span>
                            <span class="not-current">(coming soon)</span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">48</span> kWh *
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Rear Wheel Drive"><span class="achter fa fa-circle-o"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="achter fa fa-circle"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-hatchback hidden">Hatchback</span><span title="Market Segment"
                                class="size-c" style="padding-left: 10px;">C</span><span title="Number of seats"
                                class="seats-5 fa fa-user" style="padding-left: 10px;">5</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100*</span>
                                <span class="acceleration">10.0 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">160 km/h</span>
                            </p>

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
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">* €30,000</span>
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

                            <span class="price price_filter20-40 hidden">0.56</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1273/Volkswagen-ID4-1st> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Volkswagen_ID4/Volkswagen_ID4-01-thumb@2x.jpg"
                                data-src="/img/auto/Volkswagen_ID4/Volkswagen_ID4-01-thumb.jpg"
                                alt="Volkswagen ID.4 1st" /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1273/Volkswagen-ID4-1st" class="title"><span class="volkswagen">Volkswagen
                                    </span><span class="model">ID.4 1st</span></a></h2><span
                                class="date_from hidden">1606777200</span><span class="rank hidden">4663</span> <span
                                class="not-current">(coming soon)</span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">82</span> kWh
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Rear Wheel Drive"><span class="achter fa fa-circle-o"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="achter fa fa-circle"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-suv hidden">SUV</span><span title="Market Segment" class="size-c"
                                style="padding-left: 10px;">C</span><span title="Number of seats"
                                class="seats-5 fa fa-user" style="padding-left: 10px;">5</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">8.5 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">160 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range*</span>
                                <span class="erange_real">400 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency*</span>
                                <span class="efficiency">193 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">460 km/h</span>
                                <span class="fastcharge_speed hidden">460</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">€48,691</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl"
                                    title="Price in The Netherlands before incentives">€47,340</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk" title="Price in the United Kingdom after incentives">*
                                    £42,000</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter60-80 hidden">0.92</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1087/Volkswagen-e-Golf> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Volkswagen_e-Golf-2017/Volkswagen_e-Golf-2017-01-thumb@2x.jpg"
                                data-src="/img/auto/Volkswagen_e-Golf-2017/Volkswagen_e-Golf-2017-01-thumb.jpg"
                                alt="Volkswagen e-Golf " /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1087/Volkswagen-e-Golf" class="title"><span class="volkswagen">Volkswagen
                                    </span><span class="model">e-Golf </span></a></h2><span
                                class="date_from hidden">1493589600</span><span class="rank hidden">4393</span><span
                                class="current"></span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">35.8</span> kWh
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Front Wheel Drive"><span class="voor fa fa-circle"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="voor fa fa-circle-o"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-hatchback hidden">Hatchback</span><span title="Market Segment"
                                class="size-c" style="padding-left: 10px;">C</span><span title="Number of seats"
                                class="seats-5 fa fa-user" style="padding-left: 10px;">5</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">9.6 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">150 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range</span>
                                <span class="erange_real">190 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency</span>
                                <span class="efficiency">168 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">220 km/h</span>
                                <span class="fastcharge_speed hidden">220</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">* €31,900</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl"
                                    title="Price in The Netherlands before incentives">€34,005</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk"
                                    title="Price in the United Kingdom after incentives">£28,075</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter40-60 hidden">0.62</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1171/Honda-e> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Honda_e/Honda_e-01-thumb@2x.jpg"
                                data-src="/img/auto/Honda_e/Honda_e-01-thumb.jpg" alt="Honda e " /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1171/Honda-e" class="title"><span class="honda">Honda </span><span
                                        class="model">e </span></a></h2><span
                                class="date_from hidden">1596232800</span><span class="rank hidden">4132</span><span
                                class="current"></span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">35.5</span> kWh
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Rear Wheel Drive"><span class="achter fa fa-circle-o"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="achter fa fa-circle"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-hatchback hidden">Hatchback</span><span title="Market Segment"
                                class="size-b" style="padding-left: 10px;">B</span><span title="Number of seats"
                                class="seats-4 fa fa-user" style="padding-left: 10px;">4</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">9.5 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">145 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range*</span>
                                <span class="erange_real">170 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency*</span>
                                <span class="efficiency">168 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge*</span>
                                <span class="fastcharge_speed_print">190 km/h</span>
                                <span class="fastcharge_speed hidden">190</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">€32,997</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl"
                                    title="Price in The Netherlands before incentives">€35,330</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk"
                                    title="Price in the United Kingdom after incentives">£26,660</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter40-60 hidden">0.63</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1168/Peugeot-e-208> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Peugeot_e-208_GT/Peugeot_e-208_GT-01-thumb@2x.jpg"
                                data-src="/img/auto/Peugeot_e-208_GT/Peugeot_e-208_GT-01-thumb.jpg"
                                alt="Peugeot e-208 " /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1168/Peugeot-e-208" class="title"><span class="peugeot">Peugeot
                                    </span><span class="model">e-208 </span></a></h2><span
                                class="date_from hidden">1580511600</span><span class="rank hidden">4065</span><span
                                class="current"></span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">50</span> kWh
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Front Wheel Drive"><span class="voor fa fa-circle"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="voor fa fa-circle-o"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-hatchback hidden">Hatchback</span><span title="Market Segment"
                                class="size-b" style="padding-left: 10px;">B</span><span title="Number of seats"
                                class="seats-5 fa fa-user" style="padding-left: 10px;">5</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">8.1 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">150 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range*</span>
                                <span class="erange_real">275 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency*</span>
                                <span class="efficiency">164 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">420 km/h</span>
                                <span class="fastcharge_speed hidden">420</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">€29,682</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl"
                                    title="Price in The Netherlands before incentives">€36,250</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk"
                                    title="Price in the United Kingdom after incentives">£25,550</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter40-60 hidden">0.61</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1319/Dacia-Spring-Electric> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Dacia_Spring_Electric/Dacia_Spring_Electric-01-thumb@2x.jpg"
                                data-src="/img/auto/Dacia_Spring_Electric/Dacia_Spring_Electric-01-thumb.jpg"
                                alt="Dacia Spring Electric" /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1319/Dacia-Spring-Electric" class="title"><span class="dacia">Dacia
                                    </span><span class="model">Spring Electric</span></a></h2><span
                                class="date_from hidden">1617228000</span><span class="rank hidden">3986</span> <span
                                class="not-current">(from 2021)</span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">26.8</span> kWh *
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Front Wheel Drive"><span class="voor fa fa-circle"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="voor fa fa-circle-o"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-hatchback hidden">Hatchback</span><span title="Market Segment"
                                class="size-a" style="padding-left: 10px;">A</span><span title="Number of seats"
                                class="seats-4 fa fa-user" style="padding-left: 10px;">4</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100*</span>
                                <span class="acceleration">15.0 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">125 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range*</span>
                                <span class="erange_real">170 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency*</span>
                                <span class="efficiency">158 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">120 km/h</span>
                                <span class="fastcharge_speed hidden">120</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">* €17,500</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl" title="Price in The Netherlands before incentives">*
                                    €17,500</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk" title="Price in the United Kingdom after incentives">*
                                    £14,000</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter20-40 hidden">0.33</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1153/Audi-e-tron-GT> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Audi_e-tron_GT/Audi_e-tron_GT-01-thumb@2x.jpg"
                                data-src="/img/auto/Audi_e-tron_GT/Audi_e-tron_GT-01-thumb.jpg"
                                alt="Audi e-tron GT " /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1153/Audi-e-tron-GT" class="title"><span class="audi">Audi </span><span
                                        class="model">e-tron GT </span></a></h2><span
                                class="date_from hidden">1612134000</span><span class="rank hidden">3905</span> <span
                                class="is-concept">(concept)</span> <span class="is-concept-soon">(from 2021)</span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">93.4</span> kWh *
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="All Wheel Drive"><span class="awd fa fa-circle"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="awd fa fa-circle"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-sedan hidden">Sedan</span><span title="Market Segment" class="size-f"
                                style="padding-left: 10px;">F</span><span title="Number of seats"
                                class="seats-4 fa fa-user" style="padding-left: 10px;">4</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100*</span>
                                <span class="acceleration">3.5 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">240 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range*</span>
                                <span class="erange_real">425 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency*</span>
                                <span class="efficiency">197 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge*</span>
                                <span class="fastcharge_speed_print">850 km/h</span>
                                <span class="fastcharge_speed hidden">850</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">* €125,000</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl" title="Price in The Netherlands before incentives">*
                                    €125,000</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk" title="Price in the United Kingdom after incentives">*
                                    £103,000</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter100 hidden">2.34</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1135/Mercedes-EQC-400-4MATIC> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Mercedes_EQC/Mercedes_EQC-01-thumb@2x.jpg"
                                data-src="/img/auto/Mercedes_EQC/Mercedes_EQC-01-thumb.jpg"
                                alt="Mercedes EQC 400 4MATIC" /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1135/Mercedes-EQC-400-4MATIC" class="title"><span
                                        class="mercedes">Mercedes </span><span class="model">EQC 400 4MATIC</span></a>
                            </h2><span class="date_from hidden">1561932000</span><span
                                class="rank hidden">3548</span><span class="current"></span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">85</span> kWh *
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="All Wheel Drive"><span class="awd fa fa-circle"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="awd fa fa-circle"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-suv hidden">SUV</span><span title="Market Segment" class="size-d"
                                style="padding-left: 10px;">D</span><span title="Number of seats"
                                class="seats-5 fa fa-user" style="padding-left: 10px;">5</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">5.1 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">180 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range</span>
                                <span class="erange_real">370 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency</span>
                                <span class="efficiency">216 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">440 km/h</span>
                                <span class="fastcharge_speed hidden">440</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">€69,484</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl"
                                    title="Price in The Netherlands before incentives">€77,935</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk"
                                    title="Price in the United Kingdom after incentives">£65,640</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter80-100 hidden">1.42</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1234/Byton-M-Byte-72-kWh-2WD> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Byton_M-Byte/Byton_M-Byte-01-thumb@2x.jpg"
                                data-src="/img/auto/Byton_M-Byte/Byton_M-Byte-01-thumb.jpg"
                                alt="Byton M-Byte 72 kWh 2WD" /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1234/Byton-M-Byte-72-kWh-2WD" class="title"><span class="byton">Byton
                                    </span><span class="model">M-Byte 72 kWh 2WD</span></a></h2><span
                                class="date_from hidden">1635721200</span><span class="rank hidden">217</span> <span
                                class="not-current">(from 2021)</span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">80</span> kWh *
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging possible" class="fastcharge_ja fa fa-bolt"></span><span
                                title="Rear Wheel Drive"><span class="achter fa fa-circle-o"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="achter fa fa-circle"></span></span><span title="plug-type2-ccs"
                                class="plug-type2-ccs hidden">Type 2 CCS</span><span
                                class="shape-suv hidden">SUV</span><span title="Market Segment" class="size-e"
                                style="padding-left: 10px;">E</span><span title="Number of seats"
                                class="seats-5 fa fa-user" style="padding-left: 10px;">5</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">7.5 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">190 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range*</span>
                                <span class="erange_real">325 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency*</span>
                                <span class="efficiency">222 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">420 km/h</span>
                                <span class="fastcharge_speed hidden">420</span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">* €53,500</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl" title="Price in The Netherlands before incentives">*
                                    €55,000</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk" title="Price in the United Kingdom after incentives">*
                                    £47,000</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter60-80 hidden">1.03</span> </div>
                    </div>
                </div>
                <div class="list-item">
                    <div class="data-wrapper">
                        <!-- img -->
                        <div class="img">
                            <a href=/car/1231/Smart-EQ-fortwo-cabrio> <img src="/img/common/ajax-loader.gif"
                                data-src-retina="/img/auto/Smart_cabrio_2020/Smart_cabrio_2020-01-thumb@2x.jpg"
                                data-src="/img/auto/Smart_cabrio_2020/Smart_cabrio_2020-01-thumb.jpg"
                                alt="Smart EQ fortwo cabrio" /></a> </div>

                        <!-- item-data -->
                        <div class="title-wrap">
                            <h2><a href="/car/1231/Smart-EQ-fortwo-cabrio" class="title"><span class="smart">Smart
                                    </span><span class="model">EQ fortwo cabrio</span></a></h2><span
                                class="date_from hidden">1577833200</span><span class="rank hidden">202</span><span
                                class="current"></span>
                            <div class="subtitle">
                                Battery Electric Vehicle - <span class="battery">17.6</span> kWh
                            </div>

                        </div>

                        <div class="icons">
                            <span title="Rapid charging not possible" class="fastcharge_nee fa fa-bolt"
                                style="color: lightgrey;"></span><span title="Rear Wheel Drive"><span
                                    class="achter fa fa-circle-o"
                                    style="padding-left: 10px; margin-right: -3px;"></span>
                                <span class="achter fa fa-circle"></span></span><span title="plug-type2"
                                class="plug-type2 hidden">Type 2</span><span
                                class="shape-cabrio hidden">Cabrio</span><span title="Market Segment" class="size-a"
                                style="padding-left: 10px;">A</span><span title="Number of seats"
                                class="seats-2 fa fa-user" style="padding-left: 10px;">2</span>
                        </div>

                        <div class="specs">
                            <p class="left">
                                <span class="tag">0 - 100</span>
                                <span class="acceleration">11.9 sec</span>
                            </p>

                            <p class="left">
                                <span class="tag">Top Speed</span>
                                <span class="topspeed">130 km/h</span>
                            </p>

                            <p class="left">
                                <span class="tag">Range</span>
                                <span class="erange_real">95 km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Efficiency</span>
                                <span class="efficiency">176 Wh/km</span>
                            </p>

                            <p class="left">
                                <span class="tag">Fastcharge</span>
                                <span class="fastcharge_speed_print">-</span>
                                <span class="fastcharge_speed hidden"></span>
                            </p>
                        </div>

                        <div class="pricing align-right">
                            <span class="price_buy">
                                <span class="country_de" title="Price in Germany before incentives">€24,565</span>
                                <span class="flag-icon flag-icon-de"></span>
                            </span>

                            <span class="price_buy">
                                <span class="country_nl"
                                    title="Price in The Netherlands before incentives">€26,995</span>
                                <span class="flag-icon flag-icon-nl"></span>
                            </span>
                            <span class="price_buy">
                                <span class="country_uk"
                                    title="Price in the United Kingdom after incentives">£20,920</span>
                                <span class="flag-icon flag-icon-gb"></span>
                            </span>

                            <span class="price price_filter20-40 hidden">0.48</span> </div>
                    </div>
                </div>
            </div>

            <!-- no-results -->
            <div class="jplist-no-results align-center">
                <p>No results, adjust the search parameters or click 'Reset'.</p>
                <p>Looking for discontinued vehicles?<br /><a
                        href="/compare/second-hand-used-electric-vehicle-archive">Click here to go to the archive.</a>
                </p>
            </div>



            <!-- panel-bottom -->
            <div class="jplist-panel panel-bottom">

                <div class="pagination-wrapper">
                    <div class="jplist-label" data-type="Page {current} of {pages}" data-control-type="pagination-info"
                        data-control-name="paging" data-control-action="paging">
                    </div>

                    <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging"
                        data-control-action="paging" data-jump-to-start="true" data-mode="google-like" data-range="5"
                        data-control-animate-to-top="true">
                    </div>

                    <div class="jplist-label" data-type="{start} - {end} of {all}" data-control-type="pagination-info"
                        data-control-name="paging" data-control-action="paging">
                    </div>
                </div>

                <div class="pagination-dropdown-wrapper right">
                    <div class="jplist-drop-down" id="paging" data-control-type="items-per-page-drop-down"
                        data-control-name="paging" data-control-action="paging">

                        <ul>
                            <li><span data-number="3">3 per page</span></li>
                            <li><span data-number="6">6 per page</span></li>
                            <li><span data-number="9" data-default="true">9 per page</span></li>
                            <li><span data-number="all">view all</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>



    </main>
    <link href="https://ev-database.org/css/dynamic/style.css?u=si&l=si&p=index&v=4.2.6" rel="stylesheet"
        type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- PAra el select con dropwdonw-->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css"
        rel="stylesheet" type="text/css">
    <!-- Script carga-->
    <script src="https://ev-database.org/js/dynamic/script.js?u=si&l=si&p=index&v=4.2.5"></script>
</body>

</html>
