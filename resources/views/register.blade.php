@extends('master')
@section('content')

<div class="container custom-login">
    <div class="row">
        <div class="d-flex justify-content-center">
            <form action="register" method="post">
                @csrf
                <div class="form-group">
                    <label for="user" class="form-label">User Name</label>
                    <input type="text" name="username" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
    
@endsection