@extends('Pagina/baseOnlyHtml')

@section('container')
<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-alt-bg color-top"></div>
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div> 
        <div class="my-3"></div>
        <!-- end page title -->          
        <div class="row">
            <div class="col-xl-12 justify-content-center"> 
                <div class="card-box">
                    <div class="card-body p-4">
                                
                        <div class="text-center mb-4">
                            <a href="#">
                                <span><li class=" mdi mdi-shield-lock mdi-46px"></li></span>
                            </a>
                        </div>

                        <form action="#" class="pt-2">

                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>

                            <div class="form-group mb-3">
                                <a href="pages-recoverpassword.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block" type="submit"> Log In </button>
                            </div>

                        </form>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted mb-0">Don't have an account? <a href="pages-register.html" class="text-dark ml-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                </div>
            </div>
        </div>
        
    </div> <!-- end container -->
</div> 
@endsection