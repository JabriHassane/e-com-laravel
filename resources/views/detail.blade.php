@extends('master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="img-detail" src="{{ $product['gallery'] }}" alt="">
        </div>
        <div class="col-sm-6">
            <a href="/">Go Back</a>
            <h2>{{$product['name']}}</h2>
            <h3>Price : {{$product['price']}}</h3>
            <h3>Details :</h3>
            <p>{{$product['description']}}</p>
            <br><br>
            <form action="/add_to_cart" method="post">
                @csrf
                <input type="hidden" name="test" value="{{$product['id']}}">
                <button type="submit" class="btn btn-primary">Add to Carte</button>
            </form>
            
            <br>
            <button class="btn btn-success">Buy Now</button>
        </div>
    </div>
</div>

@endsection