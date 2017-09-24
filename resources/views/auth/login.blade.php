@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="card col-4">
            <div class="card-header">
                Login
            </div>
            <div class="card-block">
                <form action="#">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success" type="button" id="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection