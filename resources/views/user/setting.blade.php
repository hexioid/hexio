@extends("user.user_home_template")

@section("content")
    <div class="row mt-4 col-12">
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
        <div class="shadow p-3 mb-5 bg-white rounded col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="card-body">
                <div class="col-12 row">
                    <div class="col-4">
                        <i class="fa-regular fa-envelope"></i> Email
                    </div>
                    <div class="col-8 text-right">
                        {{$data->email}}
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <i class="fa-solid fa-lock"></i> <a href="{{url('page/change-password')}}" style="color: black">Change Password</a>
                </div>
                <hr>
                <div class="col-12">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i><a href="{{url('page/logout')}}"  style="color: black"> Logout</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
    </div>
@endsection