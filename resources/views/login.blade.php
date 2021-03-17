@extends('master')
@section('content')

<div class="container custom-login">
    <div class="row">
        <div class="d-flex justify-content-center">
            <form action="login" method="post">
                <div class="form-group">
                    @csrf
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
    
@endsection