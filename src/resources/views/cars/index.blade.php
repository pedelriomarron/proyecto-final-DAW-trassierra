@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <div class="row">      
@foreach ($cars as $car)
<div class="col">
      <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('uploads/gallery/')."/".$car->getIMG()}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->name }}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
        </div>
        </div>
@endforeach
  </div>

      


        </div>
    </div>
</div>
@endsection
