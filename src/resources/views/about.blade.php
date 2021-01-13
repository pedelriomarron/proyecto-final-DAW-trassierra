@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="section-title">
                    <h1 style="font-weight:900;font-size:2em">{{ __('Acerca de') }}</h1>
                    <hr>
                </div>

                <p>@lang('Esta pagina web es el proyecto de fin de curso de Pedro Manuel del Río Marrón, estudiante de
                    DAW (Desarrollo de aplicaciones Web) del instituto') <a href="http://www.iestrassierra.com/"
                        target="_blank"> IES Trassierra</a></p>

            </div>
        </div>
        <div class="col-lg-12 text-center">
            <img src="{{ asset('img/acercade.png') }}" class="img-fluid img-thumbnail my-3" alt="IES Trassierra">
        </div>
    </div>
</div>
@endsection
