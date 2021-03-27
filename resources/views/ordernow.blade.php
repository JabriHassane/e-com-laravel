@extends('master')
@section('content')

<div class="custom-product">
    <div class="col-sm-10">
        <table class="table table-hover">
            <tbody>
              <tr>
                <th scope="row"></th>
                <td>Amount</td>
                <td>{{$total}}</td>
                
              </tr>
              <tr>
                <th scope="row"></th>
                <td>Tax</td>
                <td>0 $</td>
                
              </tr>
              <tr>
                <th scope="row"></th>
                <td>delivry</td>
                <td>10 $</td>
              </tr>
              <tr>
                <th scope="row"></th>
                <td>Total amount</td>
                <td>{{$total+10}}</td>
              </tr>
            </tbody>
          </table>

          <form action="/orderplace" method="post">
            @csrf
            <div class="form-group">
              <label for="">Address :</label>
              <textarea class="form-control" name="address" rows="3"></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="cache">
                <label class="form-check-label" for="payment1">
                  enligne payment
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="cache">
                <label class="form-check-label" for="payment2">
                  Eli payment
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="cache">
                <label class="form-check-label" for="payment2">
                 Payment on Delivery
                </label>
              </div>
              <br>
              <button  class="form-group btn btn-success">Order Now</button>
          </form>
    </div>
</div>


@endsection