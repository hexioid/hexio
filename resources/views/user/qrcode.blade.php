@extends("user.user_home_template")

@section("content")
    <div class="row mx-2 px-2 mt-4">
        <div class="px-0 col-lg-1 col-md-0 col-sm-0 col-0"></div>
        <div class="shadow p-3 mb-5 bg-white rounded col-lg-10 col-md-12 col-sm-12 col-12">
            <div class="card-body">
                <div class="form-group">
                    <input type="text" name="username" readonly class="form-control" value="{{env('APP_URL').'/'.$data->username}}" placeholder="username">
                </div>
                <br>
                <div class="text-center">
                    <img class="img-fluid"  src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->generate(env('APP_URL').'/'.$data->username)) !!} ">
                </div>
                <br>
                <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->generate(env('APP_URL').'/'.$data->username)) !!} " class="btn btn-dark btn-md float-right" download>DOWNLOAD</a>
            </div>
        </div>
        <div class="px-0 col-lg-1 col-md-0 col-sm-0 col-0"></div>
    </div>
@endsection
