@extends("user.user_home_template")

@section("content")
    <div class="row mt-4 col-12">
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
        <div class="shadow p-3 mb-5 bg-white rounded col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="card-body">
                <div class="form-group">
                    <input type="text" name="username" readonly class="form-control" value="{{env('APP_URL').'/u/'.$data->username}}" placeholder="username">
                </div>
                <div class="text-center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(env('APP_URL').'/u/'.$data->username)) !!} ">
                </div>

                <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(env('APP_URL').'/u/'.$data->username)) !!} " class="btn btn-dark btn-md float-right" download>DOWNLOAD</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
    </div>
@endsection