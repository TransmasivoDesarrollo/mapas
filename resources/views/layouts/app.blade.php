<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Transmasivo</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{url('/assets')}}/img/mexibus2024.ico" type="image/x-icon"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts and icons -->
    <script src="{{url('/assets')}}/js/plugin/webfont/webfont.min.js"></script>
    <style type="text/css">
    .li_hover:hover{background-color:#2C3E50;}
</style>
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
<link rel="stylesheet" href="{{url('/assets')}}/css/ready.css">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{url('/assets')}}/css/demo.css">

</head>
<body>
    <div class="wrapper">
        <div class="main-header" style='background-color:#D9C3A0'>
            <!-- Logo Header -->
            <div class="logo-header" >
                <!--
                    Tip 1: You can change the background color of the logo header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
                -->
                <a href="{{url('/')}}" class="big-logo">
                    <img src="{{url('/assets')}}/img/mexibus2024.png" alt="logo img" class="logo-img">
                </a>
                <a href="{{url('/')}}" class="logo">
                 <img src="{{url('/assets')}}/img/transmasivo.png" alt="navbar brand"  height="30" width="160" class="navbar-brand">
             </a>
             <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="la la-bars"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" style='background-color:#872637'>
                <!--
                    Tip 1: You can change the background color of the navbar header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
                -->
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button class="btn btn-minimize btn-rounded btn-default">
                            <i class="la la-navicon"></i>
                        </button>
                    </div>
                   
                   <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret  card-round" >
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{url('/assets')}}/img/profile.png" alt="image profile" width="36" class="img-circle" id="profile_dropdown"></a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li>
                                    <a class="dropdown-item"  href="{{ route('perfil') }}">
                                        Cambiar contraseña
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
        </nav>
    <!-- End Navbar -->
</div>

<!-- Sidebar -->
<div class="sidebar">

           
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="photo">
                            <img src="{{url('/assets')}}/img/profile.png" alt="image profile">
                        </div>
                        <div class="info">
                           
                                 <span class="user-leve2" style="color:#000;" ><b>{{ auth()->user()->name }}
</b></span>
                                 <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                 <span class="user-leve2">{{--{{ auth()->user()->id }}--}}</span>

                         </a>

                     </div>
                 </div>
                 <ul class="nav">

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="la la-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Menú</h4>
                    </li>
                    <?php //$URL_SECTION_HOME=explode( '/', Session::get('menus')[0]->URL )?>
                    <li class="nav-item">
                        <a href="{{url('/')}}">
                            <i class="flaticon-home"></i>
                            <p style="font-size: 15px"><b>Inicio</b></p>
                        </a>
                    </li>
                    @if(auth()->user()->tipo_usuario=='Recursos humanos')
                    <li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="la flaticon-add-user"></i>
								<p>Recursos Humanos</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
                                    {{--
									<li>
										<a  href="{{url('/Alta_de_personal')}}">
											<span class="sub-item">Alta de personal</span>
										</a>
									</li>
                                    --}}
                                    <li>
										<a  href="{{url('/Contratos')}}">
											<span class="sub-item">Contratos</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Renuncias')}}">
											<span class="sub-item">Renuncias</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Personal')}}">
											<span class="sub-item">Personal</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Encuesta_de_renuncia')}}">
											<span class="sub-item">Encuesta de renuncia </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/estadisticas_renuncias')}}">
											<span class="sub-item">Estadisticas de renuncia </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/subir_biometrico')}}">
											<span class="sub-item">Subir biométrico  </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/consultar_biometrico')}}">
											<span class="sub-item">Consultar biométrico  </span>
										</a>
									</li>
										<a  href="{{url('/Contrato_Dasimo')}}">
											<span class="sub-item">Contrato Dasimo </span>
										</a>
									</li>
								
								</ul>
							</div>
					</li>
                    @endif
					@if(auth()->user()->tipo_usuario=='Inventario')
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Inventario">
								<i class="flaticon-laptop"></i>
								<p>Inventario </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Inventario">
								<ul class="nav nav-collapse">
									<li>
										<a  href="{{url('/Inventario')}}">
											<span class="sub-item">Alta de inventario</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/ModificarInventario')}}">
											<span class="sub-item">Modificar inventario</span>
										</a>
									</li>
								</ul>
							</div>
					</li>
                    @endif
                    
                    @if(auth()->user()->tipo_usuario=='Mantenimiento')
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Mantenimiento">
								<i class="la la-wrench"></i>
								<p>Mantenimiento mecánico </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Mantenimiento">
								<ul class="nav nav-collapse">
                                {{--    
                                    <li>
										<a  href="{{url('/Reporte_de_supervisión')}}">
											<span class="sub-item">Reporte de supervisión </span>
										</a>
									</li>
                                    --}}
									<li>
										<a  href="{{url('/Bitacora_De_Liberacion_De_Unidades')}}">
											<span class="sub-item">Liberación de unidades</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Bitacora_De_Liberacion_De_Unidades_express')}}">
											<span class="sub-item">Liberación de unidades express</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Catalogo_de_fallas')}}">
											<span class="sub-item">Catalogo de fallas</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Bitacora_Liberacion_De_Unidades')}}">
											<span class="sub-item">Bitácora de liberación</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Descarga_reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Desacargas de reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									
								</ul>
							</div>
					</li>
					<li class="nav-item">
							<a data-toggle="collapse" href="#Inventario_caja_herramienta">
								<i class="flaticon-idea"></i>
								<p>Almacen  </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Inventario_caja_herramienta">
								<ul class="nav nav-collapse">
									
									<li>
										<a  href="{{url('/Consultar_caja_herramienta')}}">
											<span class="sub-item">Consultar caja de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Solicitar_herramienta')}}">
											<span class="sub-item">Solicitar herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Historial_herramienta')}}">
											<span class="sub-item">Historial de solicitud herramienta</span>
										</a>
									</li>
								</ul>
							</div>
					</li>
                    @endif
					@if(auth()->user()->tipo_usuario=='Operaciones')
					<li class="nav-item">
							<a data-toggle="collapse" href="#Operaciones">
								<i class="la la-bus"></i>
								<p>Operaciones</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Operaciones">
								<ul class="nav nav-collapse">
                                    <!--
                                    <li>
										<a  href="{{url('/Alta_de_unidades')}}">
											<span class="sub-item">Alta de unidades</span>
										</a>
									</li>-->
									<li>
										<a  href="{{url('/Autorizacion_check_mantenimiento')}}">
											<span class="sub-item">Autorización check mantenimiento</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Bitacora_de_operaciones')}}">
											<span class="sub-item">Bitácora de operaciones</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Alta_de_reporte')}}">
											<span class="sub-item">Alta de reporte</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/bannerModulo200')}}">
											<span class="sub-item">Banner modulo 200</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/modificar_banner_200')}}">
											<span class="sub-item">Modificar banner modulo 200</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/geo')}}">
											<span class="sub-item">Geolocalización</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Descarga_reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Desacargas de reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									
                                   
									
								</ul>
							</div>
					</li>
                    @endif
                    @if(auth()->user()->tipo_usuario=='Almacen')
					<li class="nav-item">
							<a data-toggle="collapse" href="#Inventario_caja_herramienta">
								<i class="flaticon-idea"></i>
								<p>Almacen  </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Inventario_caja_herramienta">
								<ul class="nav nav-collapse">
									<li>
										<a  href="{{url('/Inventario_caja_herramienta')}}">
											<span class="sub-item">Inventario caja de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Consultar_caja_herramienta')}}">
											<span class="sub-item">Consultar caja de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Solicitar_herramienta')}}">
											<span class="sub-item">Solicitar herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Recepcion_herramienta')}}">
											<span class="sub-item">Recepción de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Historial_herramienta')}}">
											<span class="sub-item">Historial de solicitud herramienta</span>
										</a>
									</li>
								</ul>
							</div>
					</li>
                    @endif
                    @if(auth()->user()->tipo_usuario=='Sistemas')
                    <li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="la flaticon-add-user"></i>
								<p>Recursos Humanos</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
                                {{--
									<li>
										<a  href="{{url('/Alta_de_personal')}}">
											<span class="sub-item">Alta de personal</span>
										</a>
									</li>
                                    --}}
                                    <li>
										<a  href="{{url('/Contratos')}}">
											<span class="sub-item">Contratos</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Renuncias')}}">
											<span class="sub-item">Renuncias</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Personal')}}">
											<span class="sub-item">Personal</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Encuesta_de_renuncia')}}">
											<span class="sub-item">Encuesta de renuncia </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/estadisticas_renuncias')}}">
											<span class="sub-item">Estadisticas de renuncia </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/subir_biometrico')}}">
											<span class="sub-item">Subir biometrico </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/consultar_biometrico')}}">
											<span class="sub-item">Consultar biométrico  </span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Contrato_Dasimo')}}">
											<span class="sub-item">Contrato Dasimo </span>
										</a>
									</li>
									
								</ul>
							</div>
					</li>
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Mantenimiento">
								<i class="la la-wrench"></i>
								<p>Mantenimiento mecánico </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Mantenimiento">
								<ul class="nav nav-collapse">
                                    {{--    
                                    <li>
										<a  href="{{url('/Reporte_de_supervisión')}}">
											<span class="sub-item">Reporte de supervisión </span>
										</a>
									</li>
                                    --}}
									<li>
										<a  href="{{url('/Bitacora_De_Liberacion_De_Unidades')}}">
											<span class="sub-item">Liberación de unidades</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Bitacora_De_Liberacion_De_Unidades_express')}}">
											<span class="sub-item">Liberación de unidades express</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Catalogo_de_fallas')}}">
											<span class="sub-item">Catalogo de fallas</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Bitacora_Liberacion_De_Unidades')}}">
											<span class="sub-item">Bitácora de liberación</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Descarga_reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Desacargas de reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									
								</ul>
							</div>
					</li>
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Mantenimientoeléctrico_eléctrico">
								<i class="flaticon-idea"></i>
								<p>Mantenimiento eléctrico  </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Mantenimientoeléctrico_eléctrico">
								<ul class="nav nav-collapse">
                                    
									<li>
										<a  href="{{url('/Liberacion_unidades_electrico')}}">
											<span class="sub-item">Liberación de unidades</span>
										</a>
									</li>
                                    {{--
                                    <li>
										<a  href="{{url('/Catalogo_de_fallas')}}">
											<span class="sub-item">Catalogo de fallas</span>
										</a>
									</li>--}}
                                    <li>
										<a  href="{{url('/Bitacora_Liberacion_De_Unidades_electrico')}}">
											<span class="sub-item">Bitácora de liberación</span>
										</a>
									</li>
									
								</ul>
							</div>
					</li>
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Inventario_caja_herramienta">
								<i class="flaticon-idea"></i>
								<p>Almacen  </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Inventario_caja_herramienta">
								<ul class="nav nav-collapse">
									<li>
										<a  href="{{url('/Inventario_caja_herramienta')}}">
											<span class="sub-item">Inventario caja de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Consultar_caja_herramienta')}}">
											<span class="sub-item">Consultar caja de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Solicitar_herramienta')}}">
											<span class="sub-item">Solicitar herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Recepcion_herramienta')}}">
											<span class="sub-item">Recepción de herramienta</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Historial_herramienta')}}">
											<span class="sub-item">Historial de solicitud herramienta</span>
										</a>
									</li>
								</ul>
							</div>
					</li>
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Operaciones">
								<i class="la la-bus"></i>
								<p>Operaciones</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Operaciones">
								<ul class="nav nav-collapse">
                                    <!--
                                    <li>
										<a  href="{{url('/Alta_de_unidades')}}">
											<span class="sub-item">Alta de unidades</span>
										</a>
									</li>-->
									<li>
										<a  href="{{url('/Autorizacion_check_mantenimiento')}}">
											<span class="sub-item">Autorización check mantenimiento</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Bitacora_de_operaciones')}}">
											<span class="sub-item">Bitácora de operaciones</span>
										</a>
									</li>
                                    <li>
										<a  href="{{url('/Alta_de_reporte')}}">
											<span class="sub-item">Alta de reporte</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/bannerModulo200')}}">
											<span class="sub-item">Banner modulo 200</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/modificar_banner_200')}}">
											<span class="sub-item">Modificar banner modulo 200</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/geo3')}}">
											<span class="sub-item">Geolocalización</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Reporte de estado físico y funcionamiento</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/Descarga_reporte_de_estado_fisico_y_funcionamiento')}}">
											<span class="sub-item">Desacargas de reporte de estado físico y funcionamiento</span>
										</a>
									</li>
                                   
									
								</ul>
							</div>
					</li>
                    <li class="nav-item">
							<a data-toggle="collapse" href="#Sistemas">
								<i class="flaticon-laptop"></i>
								<p>Sistemas </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Sistemas">
								<ul class="nav nav-collapse">
									<li>
										<a  href="{{url('/AltaAccesoAlSistema')}}">
											<span class="sub-item">Acceso al sistema</span>
										</a>
									</li>
									
								</ul>
							</div>
					</li>

					<li class="nav-item">
							<a data-toggle="collapse" href="#Inventario">
								<i class="flaticon-laptop"></i>
								<p>Inventario </p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="Inventario">
								<ul class="nav nav-collapse">
									<li>
										<a  href="{{url('/Inventario')}}">
											<span class="sub-item">Alta de inventario</span>
										</a>
									</li>
									<li>
										<a  href="{{url('/ModificarInventario')}}">
											<span class="sub-item">Modificar inventario</span>
										</a>
									</li>
									
								</ul>
							</div>
					</li>
                    @endif
					<li class="nav-item">
						<a href="{{url('/Permisos')}}">
							<i class="la la-calendar-plus-o"></i>
							<p>Solicitar permiso</p>
						</a>
					</li>
					<li class="nav-item">
							<a href="{{url('/Consultar_permisos')}}">
								<i class="la la-calendar-o"></i>
								<p>Consultar mis permisos</p>
							</a>
					</li>
					<li class="nav-item">
						<a href="{{url('/Gestión_de_permisos')}}">
							<i class="flaticon-list"></i>
							<p>Gestión de permisos</p>
						</a>
					</li>
                    <li class="nav-item">
							<a href="{{url('/Consultar_biometricos_usuario')}}">
								<i class="la la-calendar-o"></i>
								<p>Consultar biometrico</p>
							</a>
					</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->
    <div class="main-panel"><!-- main panel -->
        <div class="content"><!-- content -->

            <div class="container-fluid"><!--container-fluid -->

                <div id="app"><!-- id app -->
                        
                {{ $slot }}
                       



                </div><!-- id app -->






            </div>
        </div><!-- content -->

    </div><!-- main panel -->

</div>
<!--   Core JS Files   -->


<script src="{{url('/assets')}}/js/core/jquery.3.2.1.min.js"></script>
<script src="{{url('/assets')}}/js/core/popper.min.js"></script>
<script src="{{url('/assets')}}/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="{{url('/assets')}}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{url('/assets')}}/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{url('/assets')}}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="{{url('/assets')}}/js/plugin/moment/moment.min.js"></script>

<!-- Chart JS -->
<script src="{{url('/assets')}}/js/plugin/chart.js/chart.min.js"></script>

<!-- Chart Circle -->
<script src="{{url('/assets')}}/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{url('/assets')}}/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{url('/assets')}}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="{{url('/assets')}}/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{url('/assets')}}/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('/assets')}}/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="{{url('/assets')}}/js/plugin/gmaps/gmaps.js"></script>

<!-- Dropzone -->
<script src="{{url('/assets')}}/js/plugin/dropzone/dropzone.min.js"></script>

<!-- Fullcalendar -->
<script src="{{url('/assets')}}/js/plugin/fullcalendar/fullcalendar.min.js"></script>

<script src="{{url('/assets')}}/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

<!-- Bootstrap Tagsinput -->
<script src="{{url('/assets')}}/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Bootstrap Wizard -->
<script src="{{url('/assets')}}/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

<!-- jQuery Validation -->
<script src="{{url('/assets')}}/js/plugin/jquery.validate/jquery.validate.min.js"></script>

<!-- Summernote -->
<script src="{{url('/assets')}}/js/plugin/summernote/summernote-bs4.min.js"></script>

<!-- Select2 -->
<script src="{{url('/assets')}}/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="{{url('/assets')}}/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Ready Pro JS -->
<script src="{{url('/assets')}}/js/ready.min.js"></script>






<script>

    $('#BotonProfile').click(function(e){
      $(".dropdown-menu").dropdown('toggle')
    });
    $('#list_user').DataTable({
    scrollX: false,
    scrollCollapse: true,
    filter: true,
    lengthMenu: [[12, 24, 36, 48, 60, -1], [12, 24, 36, 48, 60, "Todos"]],
    iDisplayLength: 12,
    "language": {
        "lengthMenu": "Mostrar _MENU_ datos",
        "zeroRecords": "No existe el dato introducido",
        "info": "Página _PAGE_ de _PAGES_ ",
        "infoEmpty": "Sin datos disponibles",
        "infoFiltered": "(mostrando los datos filtrados: _MAX_)",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "search": "Buscar",
        "processing": "Buscando...",
        "loadingRecords": "Cargando..."
    }
});

		

   
    

</script>


@yield('jscustom')

</body>
</html>
