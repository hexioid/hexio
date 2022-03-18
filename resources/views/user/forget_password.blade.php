@extends('user.auth_template')
@section("content")
    <form action="">
        <div class="text-left">
            <h4>Reset Password</h4>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com">
        </div>

        <button type="submit" class="btn btn-dark btn-lg col-12">Send Password Reset Link</button>
    </form>
@endsection