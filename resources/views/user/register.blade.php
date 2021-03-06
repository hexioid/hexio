@extends('user.auth_template')
@section('head')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection
@section("content")
    <form action="{{'/page/register'}}" method="POST">
        @csrf
        <div class="text-center">
            <h2>SIGN UP</h2>
                <p>Create account!</p>
        </div>
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" value="{{old('username')}}" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="telephone" class="form-label">Telephone</label>
            <input type="number" value="{{old('telephone')}}" name="telephone" class="form-control" placeholder="Telephone" required>
        </div>
        {!! htmlFormSnippet() !!}
        <button type="submit" class="btn btn-dark btn-lg col-12 mt-3">SIGN UP</button>
    </form>
@endsection
@section("script")

<script>
    $(function(){
        function rescaleCaptcha(){
            var width = $('.g-recaptcha').parent().width();
            var scale;
            if (width < 302) {
            scale = width / 302;
            } else{
            scale = 1.0; 
            }

            $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
            $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
            $('.g-recaptcha').css('transform-origin', '0 0');
            $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
        }

        rescaleCaptcha();
        $( window ).resize(function() { rescaleCaptcha(); });

    });
</script>
@endsection