<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Usuarios
         
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <body>
	<div class="wrapper">
		
		<!-- Sidebar -->
		
		<div class="main">
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
		                <div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Gestion de usuarios</div>
								</div>
								<div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="estatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
                        <form method="post" id="exampleValidation" action="{{url('/Usuarios')}}">
					@csrf
							<div class="modal-body">
                            ¿Esta seguro de cambiar el estatus del usuario?
							</div>
							<input type="hidden" id="id_user" name="id_user">
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<input type="submit" class="btn btn-primary" name="elimina" value="Aceptar"> 
							</div>
						</form>
					</div>
				</div>
			</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí debes poner el formulario con los campos para modificar -->
                <form method="post" id="exampleValidation" action="{{url('/Usuarios')}}">
					@csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div> 
                    <div class="form-group">
                        <label for="email">Tipo de usuario:</label>
                        <select class="form-control" id="tipo_u" name="tipo_u" >
                            <option value="1">Administrador</option>
                            <option value="2">Vendedor</option>
                            <option value="3">Cliente</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Correo:</label>
                        <input type="text" class="form-control" id="email" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="email">Nueva contraseña:</label>
                        <input type="text" class="form-control" id="password" name="password" >
                        <input type="hidden" class="form-control" id="id" name="id" >
                    </div>
                    <!-- Otros campos del formulario -->
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
			@if(Session::has('message'))
			<div class="alert alert-{{ Session::get('color') }}" role="alert">
			   {{ Session::get('message') }}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			@endif
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Tipo de usuario</th>
                                        <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($users as $user)
                                        <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                       
                                        <td> @if($user->tipo_usuario==1)
                                        Administrador
                                        @elseif($user->tipo_usuario==2)
                                        Vendedor
                                        @elseif($user->tipo_usuario==3)
                                        Cliente
                                        @endif</td>
                                        <td> 
                                            <button class="btn btn-success btn-modificar" onclick=" $('#name').val('{{$user->name}}');$('#id').val('{{$user->id}}'); $('#email').val('{{$user->email}}'); 
                                            $('#tipo_u option[value={{$user->tipo_usuario}}]').prop('selected', true);  "
                                            data-toggle="modal" data-target="#myModal" data-userid="{{$user->id}}">
                                                Modificar
                                            </button>
                                            <a data-toggle="modal" style="color:white;" onclick="$('#id_user').val('{{$user->id}}')" data-id="{{$user->id}}" data-estatus="" data-target="#estatusModal" class="btn btn-danger edit_estatus">Estatus</a>
						
                                        </td>
                                     
                                        </tr>

                                        @php
                                        $i++;
                                        @endphp

                                        @endforeach
                                    </tbody>
                                </table>
                                    
                               
								</div>
								
							</div>
                        </div>
    


</div>
                        </div>
					</div>
				</div>
			</div>
			
		</div>
		
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
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

    <!-- DateTimePicker -->
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

        
     
    </script>
</body>
        </div>
    </div>
   
  
</x-app-layout>
