@extends('user.auth_template')
@section("content")
    <form action="{{url('page/login')}}" method="POST">
        @csrf
        <div class="text-center">
            <h2>LOGIN</h2>
                <p>Login and create your Link now!</p>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email or Username</label>
            <input type="text" value="{{old('email')}}" name="email" class="form-control" placeholder="Email or Username">
        </div>
        
        <label for="password" class="form-label">Password</label>
        <div class="input-group mb-3">
            <input id="password" type="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <button  onclick="myFunction(this)" class="btn btn-outline-secondary" type="button"><i id="toogle-password" data-is_show="false" class="fa-solid fa-eye"></i></button>
            </div>
        </div>

        <div class="row col-12 m-0 p-0 mb-3">
            <div class="form-check col-6">
                <input style="cursor: pointer;" type="checkbox" value="{{old('remember')}}" type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                <label style="cursor: pointer;" class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
            <div class="col-6 text-right pr-0">
                <a href="{{url('page/forget-password')}}" style="color: black">Forget Password</a>
            </div>
        </div>

        <button type="submit" class="btn btn-dark btn-lg col-12">LOGIN</button>
        <a href="{{url('page/register')}}" class="btn btn-dark btn-lg col-12 mt-3">SIGN UP</a>
    </form>
@endsection

@section("script")

    <script>
        function myFunction(e) {
            let password = document.getElementById("password");
            let toogle = document.getElementById("toogle-password")
            if($(toogle).attr("data-is_show") == "false"){
                password.type = "text";
                $(toogle).attr("data-is_show", "true");
                $(toogle).attr("class", "fa-solid fa-eye-slash");
            }else{
                password.type = "password";
                $(toogle).attr("data-is_show", "false");
                $(toogle).attr("class", "fa-solid fa-eye");
            }
        }
    </script>
@endsection