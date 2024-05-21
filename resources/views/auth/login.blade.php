<!DOCTYPE html>
<style type="text/css">
    .img-responsive {
      display: block;
      max-width: 100%;
      height: auto;
    }
</style>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Transmasivo | Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{url('/assets')}}/img/favicon.ico" type="image/x-icon"/>
    <!-- Fonts and icons -->
    <script src="{{url('/assets')}}/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Montserrat:100,200,300,400,500,600,700,800,900"]},
            custom: {"families":["Flaticon", "LineAwesome"], urls: ['{{url('/assets')}}/css/fonts.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{url('/assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/assets')}}/css/ready.min.css">
</head>
<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <div align="center"><img class="img-responsive " src="{{url('/assets/img/transmasivo.png')}}"></div>
            <h5 class="text-center"> Transmasivo </h5>
            <h6 class="text-center">Sistema Integral </h6>
            <div class="login-form">

                @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('color') }}" role="alert">
                   {{ Session::get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                
                 <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if($errors->any())
                        <div class="alert alert-danger">
                            
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                        </div>
                    @endif
                <div class="form-group form-floating-label">
                    <input id="email" name="email" type="text" class="form-control input-border-bottom" value="{{ old('email') }}"required>
                    <label for="email" class="placeholder">Usuario</label>

                   

                </div>

              
                  


                    
                <div class="form-group form-floating-label">
                    <input  id="password" name="password" type="password" class="form-control input-border-bottom" required>
                    <label for="password" class="placeholder">Password</label>
                    <div class="show-password">
                        <i class="flaticon-interface"></i>
                    </div>
                </div>
                <div class="row form-sub m-0">
     
                </div>
                <div class="form-action">
                    <button type="submit"  class="btn btn-primary btn-rounded btn-login">
                        Acceder
                    </button>

                </div>
            
            </form>
            </div>
        </div>


    </div>
    <script src="{{url('/assets')}}/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{url('/assets')}}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="{{url('/assets')}}/js/core/popper.min.js"></script>
    <script src="{{url('/assets')}}/js/core/bootstrap.min.js"></script>
    <script src="{{url('/assets')}}/js/ready.js"></script>
</body>
</html>

<script type="text/javascript">
    
    $("#register_form").on('submit', function(e){

         e.preventDefault();

      });


</script>

