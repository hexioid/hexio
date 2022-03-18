@extends("user.user_home_template")

@section("content")
    <div class="row mt-4 col-12">
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
        <div class="shadow p-3 mb-5 bg-white rounded col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="card-body">
                <form action="{{url('/vcard')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{old('name', $data->name ?? '')}}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="business" class="form-label">Business</label>
                        <input type="text" value="{{old('business', $data->business ?? '')}}" name="business" class="form-control" placeholder="Business">
                    </div>
                    <div class="form-group">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="number" value="{{old('telephone', $data->phone ?? '')}}" name="telephone" class="form-control" placeholder="Telephone">
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" value="{{old('address', $data->address ?? '')}}" name="address" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="site_1" class="form-label">Site</label>
                        <input type="text" value="{{old('site_1', $data->site_1 ?? '')}}" name="site_1" class="form-control" placeholder="Site">
                    </div>
                    <div class="form-group">
                        <label for="site_2" class="form-label">Site</label>
                        <input type="text" value="{{old('site_2', $data->site_2 ?? '')}}" name="site_2" class="form-control" placeholder="Site">
                    </div>
                    <div class="form-group">
                        <label for="site_3" class="form-label">Site</label>
                        <input type="text" value="{{old('site_3', $data->site_3 ?? '')}}" name="site_3" class="form-control" placeholder="Site">
                    </div>

                    <br>

                    <button type="submit" class="btn btn-dark btn-md col-3 float-right">SAVE</button>
                </form>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
    </div>
@endsection