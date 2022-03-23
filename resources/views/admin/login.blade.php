@extends('user.auth_template')
@section("content")
    <form action="{{route('admin.login.post')}}" method="POST">
        @csrf
        <div class="text-center">
            <h2>ADMIN LOGIN</h2>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email">
        </div>
        
        <label for="password" class="form-label">Password</label>
        <div class="input-group mb-3">
            <input id="password" type="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <button  onclick="myFunction(this)" class="btn btn-outline-secondary" type="button"><i id="toogle-password" data-is_show="false" class="fa-solid fa-eye"></i></button>
            </div>
        </div>

        <div class="row col-12 m-0 p-0">
            <div class="form-check col-6">
                <input type="checkbox" value="{{old('remember')}}" type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remeber Me</label>
            </div>
        </div>
        <br>

        <button type="submit" class="btn btn-dark btn-lg col-12">LOGIN</button>
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