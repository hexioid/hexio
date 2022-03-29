@extends('user.auth_template')
@section("content")
    <form action="{{url('/page/forget')}}" method="POST">
        @csrf
        <div class="text-left">
            <h4>Reset Password</h4>
        </div>
        <br>
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com">
        </div>

        <button type="submit" class="btn btn-dark btn-lg col-12">Send Password Reset Link</button>
    </form>
@endsection