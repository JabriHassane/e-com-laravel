@extends('master')
@section('content')
<div class="custom-product">
    <div class="wrapper-tend">
        <h3>result for Products</h3>
        
        <div class="col-sm-4" style="margin-bottom:50px ">
            <a href="#">Filter</a>
        </div>
        @foreach ($products as $item)
            <div class="col-sm-4">
                <div class="item-searcher">
                    <a href="detail/{{$item['id']}}">
                        <img class="img-trend" src="{{$item['gallery']}}">
                        <div class="">
                            <h2 class="">{{$item['name']}}</h2>
                            <h5 class="">{{$item['description']}}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
    
@endsection