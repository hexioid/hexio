<!DOCTYPE html>
<html>
    <head>
        <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <title>Hexio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body >
        <nav class="navbar navbar-dark navbar-expand-md bg-dark justify-content-md-center justify-content-start">
            <button class="navbar-toggler ml-1" type="button" data-toggle="collapse" data-target="#collapsingNavbar2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="nav-link" href="#_"><img src="{{asset('images/logo_white.png')}}" width="100" alt=""></i></a> 
            <div class="navbar-collapse collapse justify-content-between align-items-center w-100" id="collapsingNavbar2">
                <ul class="navbar-nav mx-auto text-md-center text-left">
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{url('/vcard')}}">
                            <div class=" row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-1 col-2">
                                    <i class="fa-solid fa-address-book fa-2xl"></i>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-11 col-10" >
                                    Vcard
                                </div>
                            </div>
                        </a> 
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{url('link')}}">
                            <div class=" row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-1 col-2">
                                    <i class="fa-solid fa-link fa-2xl"></i>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-11 col-10" >
                                    Link
                                </div>
                            </div>
                        </a> 
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{url('/profile')}}">
                            <div class=" row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-1 col-2">
                                    <i class="fa-regular fa-user fa-2xl"></i>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-11 col-10" >
                                    Profile
                                </div>
                            </div>
                        </a> 
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{url('/qrcode')}}">
                            <div class=" row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-1 col-2">
                                    <i class="fa-solid fa-qrcode fa-2xl"></i>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-11 col-10" >
                                    Qr Code
                                </div>
                            </div>
                        </a> 
                    </li>
                </ul>
                <ul class="nav navbar-nav flex-row justify-content-md-center justify-content-left flex-nowrap">
                    <li class="nav-item">
                        <div class="dropdown">
                            <span class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-gear"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url('setting')}}">Setting</a>
                                <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="mt-2">
            <div class="d-flex justify-content-center">
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
            </div>
            @yield("content")
        </div>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- <script src="{{asset('bootstrap/js/jquery-3.2.1.slim.min.js')}}"></script> -->
        <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    </body>
</html>