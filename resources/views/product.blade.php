@extends('master')
@section('content')


<div class="custom-product">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        {{-- Indecators --}}
        <ol class="carousel-indicators">
            @foreach ($products as $item)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$item['id']}}" class="{{ $item['id']==1?'active':'' }}"></li>
            @endforeach
        </ol>

        {{-- Wrapper for slides --}}
        <div class="carousel-inner">
            @foreach ($products as $item)
                <div class="carousel-item {{ $item['id']==1?'active':'' }}">
                    <a href="detail/{{$item['id']}}">
                        <div class="d-flex justify-content-center">
                            <img class="d-block w-10 slider-img justify-center" src="{{$item['gallery']}}" alt="First slide">
                        </div>
                        <div class="carousel-caption slider-text">
                            <h3>{{$item['name']}}</h3>
                            <p>{{$item['description']}}.</p>
                        </div>
                    </a>
                </div> 
            @endforeach
            
        </div>
        {{-- lefet and right controls --}}
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="wrapper-tend">
        <h2>Trending Products</h2>
        @foreach ($products as $item)
            <div class="item-trend  d-flex justify-content-center">
                <a href="detail/{{$item['id']}}">
                    <img class="img-trend" src="{{$item['gallery']}}">
                    <div class=" d-flex justify-content-center">
                        <h3 class="">{{$item['name']}}</h3>
                    </div>
                </a>
            </div> 
        @endforeach
    </div>
</div>
    
@endsection