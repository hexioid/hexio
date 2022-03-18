@extends("user.user_home_template")

@section("content")
    <div class="row mt-4 col-12">
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
        <div class="shadow p-3 mb-5 bg-white rounded col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="card-body">
                <form action="{{url('change-password')}}" method="POST">
                    @csrf
                    <div class="text-left">
                        <h4>Change Password</h4>
                    </div>
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Current Passowrd">
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm New Password">
                    </div>

                    <br>

                    <button type="submit" class="btn btn-dark btn-md col-3 float-right">SAVE</button>
                </form>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-1 col-0"></div>
    </div>
@endsection