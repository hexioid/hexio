@extends("user.user_home_template")

@section("content")
    <div class="row mx-2 px-2 mt-4">
        <div class="px-0 col-lg-3 col-md-2 col-sm-1 col-0"></div>
        <div class="shadow p-3 mb-5 bg-white rounded col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="card-body px-0 px-lg-2 px-md-2 px-sm-1">
                <div class="col-12 row mx-0 pr-0">
                    <div class="col-4 pl-0">
                        <i class="fa-regular fa-envelope"></i> Email
                    </div>
                    <div class="col-8 text-right pr-0">
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
        <div class="px-0 col-lg-3 col-md-2 col-sm-1 col-0"></div>
    </div>
@endsection