<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <title>Hexio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        @yield("head")
    </head>
    <body >
        <div class="m-5 h-100">
            <div class="d-flex justify-content-center">
                <img src="{{asset('images/logo.png')}}" style=" width:160px" alt="">
            </div>
            <div class="row mt-4">
                <div class="col-lg-3 col-md-3 col-sm-0"></div>
                <div class="shadow p-3 mb-5 bg-white rounded col-lg-6 col-md-6 col-sm-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
				        @yield('content')
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-0"></div>
            </div>
        </div>

        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/jquery-3.2.1.slim.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
        @yield("script")
    </body>
</html>