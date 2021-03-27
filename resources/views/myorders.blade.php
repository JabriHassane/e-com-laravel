@extends('master')
@section('content')

<div class="custom-product">
    <div class="col-sm-10">
        <div class="trending-wrapper">
            <h4>My Orders :</h4>
            
            @foreach ($orders as $item)
                    <div class="row item-searcher cart-list-devider">
                        <div class="col-sm-3">
                            <a href="detail/{{$item->id}}">
                                <img class="img-trend" src="{{$item->gallery}}">
                            </a>
                        </div>
                            <div class="col-sm-4">
                                <h2 class="">Name : {{$item->name}}</h2>
                                <h5 class="">Delivery Statue : {{$item->status}}</h5>
                                <h5 class="">Address : {{$item->address}}</h5>
                                <h5 class="">Payment Status : {{$item->payment_status}}</h5>
                                <h5 class="">Payment Method : {{$item->payment_method}}</h5>
                            </div>
                        
                    </div>
            @endforeach
        </div>
    </div>
</div>


@endsection