@extends('master')
@section('content')

<div class="custom-product">
    <div class="col-sm-10">
        <div class="trending-wrapper">
            <h4>Result for Products :</h4>
            <a href="ordernow" class="btn btn-success">Order Now</a><br><br><br>
            @foreach ($products as $item)
                    <div class="row item-searcher cart-list-devider">
                        <div class="col-sm-3">
                            <a href="detail/{{$item->id}}">
                                <img class="img-trend" src="{{$item->gallery}}">
                            </a>
                        </div>
                            <div class="col-sm-4">
                                <h2 class="">{{$item->name}}</h2>
                                <h5 class="">{{$item->description}}</h5>
                            </div>
                        <div class="col-sm-3">
                            <a href="/removecart/{{$item->cart_id}}" class="btn btn-warning">Romove To cart</a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>


@endsection