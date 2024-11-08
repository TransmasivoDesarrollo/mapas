<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }
		.modal-xl {
			max-width: 90% !important;
		}
		.modal-body-custom {
			max-height: 80vh;
			overflow-y: auto;
		}
        

    </style>
    <div class="card">
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
            <div class="card-title"> <i class="flaticon-list custom-icon"></i>  Gestión del personal</div>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
            <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                {{ session('mensaje') }}.
            </div>
            @endif
            <div class="form-group row " >
                
                <div class="col-md-2">
                    <div class="form-group form-group-default">
                        <label>Nombre(s)<span class="required-label"></span></label>
                        <input id="nombre" name="nombre"  type="text" class="form-control" required >
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="form-group form-group-default">
                        <label>Departamento<span class="required-label">*</span></label>
                        <select required class="form-control input-with-border" id="departamento" name="departamento">
                            <option value="">Seleccione una opción</option>
                            @foreach($c_departamento as $depar)
                            <option value="{{$depar->id_departamento}}">{{$depar->departamento}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-md-2">
                    <div class="form-group form-group-default">
                        <label>Sexo<span class="required-label">*</span></label>
                        <select required class="form-control input-with-border" id="Sexo" name="Sexo">
                            <option value="">Seleccione una opción</option>
                            <option value="MASCULINO">Masculino</option>
                            <option value="FEMENINO">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group form-group-default">
                        <label>Estado Civil<span class="required-label">*</span></label>
                        <select required class="form-control" id="Civil" name="Civil">
                            <option value="">Seleccione una opción</option>
                            <option value="SOLTERO">Soltero</option>
                            <option value="CASADO">Casado</option>
                            <option value="DIVORCIADO">Divorciado</option>
                            <option value="VIUDO">Viudo</option>
                            <option value="UNIÓN LIBRE">Unión libre</option>
                            <option value="SEPARADO">Separado</option>
                            <option value="COMPROMETIDO">Comprometido</option>
                        </select>
                    </div>
                </div>
                     
                
                <div class="col-md-12">
                    <center>
                        <input type="submit" class="btn btn-success" value="Consultar" id="Consultar" name="Consultar">
                    </center>
                </div>     
                
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12">
					<center class="card-title">
						Resultados encontrados {{count($consulta)}}
					</center><br>
				</div>
				@foreach($consulta as $consul)
                <div class="col-md-4" >
                    <div class="card card-profile card-secondary" style="border:1px #cccccc solid;">
                        <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                            <div class="profile-picture">
                                <img src="{{url('')}}/assets/img/profile.png" alt="Profile Picture">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{{$consul->Nombre}} {{$consul->apellido_p}} {{$consul->apellido_m}}</div>
                                <div class="job">ID {{$consul->id_empleado}}, {{$consul->Puesto}}</div>
                                <div class="desc">{{$consul->Puesto}}</div>
                                
                                <div class="view-profile">
                                    <button  class="btn btn-secondary btn-block" onclick="modal_informacion('{{$consul->Estatus}}','{{$consul->id_empleado}}','{{$consul->id_personal}}','{{$consul->Nombre}}','{{$consul->apellido_p}}','{{$consul->apellido_m}}','{{$consul->Fecha_nacimiento}}','{{$consul->Edad}}','{{$consul->Puesto}}','{{$consul->Nacionalidad}}',
                                            '{{$consul->Sexo}}','{{$consul->Estado_civil}}','{{$consul->Calle}}','{{$consul->Numero}}','{{$consul->Colonia}}','{{$consul->Alcaldia_municipio}}','{{$consul->Estado}}','{{$consul->Codigo_postal}}',
                                            '{{$consul->RFC}}','{{$consul->NSS}}','{{$consul->CURP}}','{{$consul->Correo}}','{{$consul->Salario_diario}}','{{$consul->Fecha_contrato}}','{{$consul->Fecha_contrato_date}}','{{$consul->id_personal}}'
                                        )" >Ver información</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row user-stats text-center">
                                <div class="col">
                                    <div class="number">15/20</div>
                                    <div class="title">Información</div>
                                </div>
                                
                                    <div class="col">
                                        <div class="number">
                                        <form method="post" id="exampleValidation" action="{{url('/Gestion_del_personal')}}">
                                        @csrf
                                            <button  class="btn btn-danger btn-block" id="baja" name="baja">Dar de baja</button>
                                            <input type="hidden" id="id_personal" name="id_personal" value="{{$consul->id_personal}}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="number">
                                            <button  class="btn btn-primary btn-block" id="Reimprimir" name="Reimprimir">Reimprimir contrato</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
				@endforeach


				<div class="modal fade" tabindex="-1" id="modal_informacion" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Datos de <b id="titulo_m"></b></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body modal-body-custom">
                                <div class="form-group row ">
                                    <div class="col-md-12">
                                        <center><b>Datos personales                                        </b></center>
                                    </div>
                                </div>
								<div class="form-group row">
                                    
									
									<div class="col-md-3">
										<div  id="nombre_m_v" class="form-group form-group-default">
											<label>Nombre(s)<span class="required-label">*</span></label>
											<input id="nombre_m" name="nombre_m"  type="text" class="form-control" required >
										</div>
									</div>
									<div class="col-md-2">
										<div   id="apellido_p_v" class="form-group form-group-default">
											<label>Apellido paterno<span class="required-label">*</span></label>
											<input id="apellido_p_m" name="apellido_p_m"  type="text" class="form-control" required >
										</div>
									</div>
									<div class="col-md-2">
										<div   id="apellido_m_v" class="form-group form-group-default">
											<label>Apellido materno<span class="required-label">*</span></label>
											<input id="apellido_m_m" name="apellido_m_m"  type="text" class="form-control" required >
										</div>
									</div>
									<div class="col-md-2">
										<div   id="nacimiento_v" class="form-group form-group-default">
											<label>Fecha de nacimiento<span class="required-label">*</span></label>
											<input id="nacimiento" name="nacimiento"  type="date" class="form-control" required>
										</div>
									</div>
									
									<div class="col-md-1">
										<div   id="Edad_v" class="form-group form-group-default">
											<label>Edad<span class="required-label">*</span></label>
											<input id="Edad" name="Edad"  type="text" class="form-control" required>
										</div>
									</div>
                                    <div class="col-md-3">
                                        <div   id="CURP_v" class="form-group form-group-default">
                                            <label>CURP<span class="required-label">*</span></label>
                                            <input id="CURP" name="CURP"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div   id="ine_v" class="form-group form-group-default">
                                            <label>INE<span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="ine_m" name="ine_m" >
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3">
                                        <div   id="IMSS_v" class="form-group form-group-default">
                                            <label>Número de Seguridad Social<span class="required-label">*</span></label>
                                            <input id="IMSS" name="IMSS"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div   id="Civil_v" class="form-group form-group-default">
                                            <label>Estado Civil<span class="required-label">*</span></label>
                                            <select required class="form-control" id="Civil_m" name="Civil_m">
                                                <option value="">Seleccione una opción</option>
                                                <option value="SOLTERO">Soltero</option>
                                                <option value="CASADO">Casado</option>
                                                <option value="DIVORCIADO">Divorciado</option>
                                                <option value="VIUDO">Viudo</option>
                                                <option value="UNIÓN LIBRE">Unión libre</option>
                                                <option value="SEPARADO">Separado</option>
                                                <option value="COMPROMETIDO">Comprometido</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div   id="n_hijos_v" class="form-group form-group-default">
                                            <label>Numero de hijos<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="n_hijos_m" name="n_hijos_m" onchange="valida_hijos()"> 
                                                <option value=null>-Sin hijos-</option>    
                                                <option value="1">1</option>    
                                                <option value="2">2</option>    
                                                <option value="3">3</option>    
                                                <option value="4">4</option>    
                                                <option value="5">5</option>    
                                                <option value="6">6</option>    
                                                <option value="7">7</option>    
                                                <option value="8">8</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo1_1">
                                        <div   id="genero_h_1_v" class="form-group form-group-default">
                                            <label>Genero hij@ 1<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_1_m" name="genero_h_1_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo1_2">
                                        <div   id="fecha_h_1_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 1<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_1_m" name="fecha_h_1_m" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="hijo2_1">
                                        <div   id="genero_h_2_v" class="form-group form-group-default">
                                            <label>Genero hij@ 2<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_2_m" name="genero_h_2_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo2_2">
                                        <div   id="fecha_h_2_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 2<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_2_m" name="fecha_h_2_m" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="hijo3_1">
                                        <div   id="genero_h_3_v" class="form-group form-group-default">
                                            <label>Genero hij@ 3<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_3_m" name="genero_h_3_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo3_2">
                                        <div   id="fecha_h_3_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 3<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_3_m" name="fecha_h_3_m" >
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="hijo4_1">
                                        <div   id="genero_h_4_v" class="form-group form-group-default">
                                            <label>Genero hij@ 4<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_4_m" name="genero_h_4_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo4_2">
                                        <div   id="fecha_h_4_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 4<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_4_m" name="fecha_h_4_m" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="hijo5_1">
                                        <div   id="genero_h_5_v" class="form-group form-group-default">
                                            <label>Genero hij@ 5<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_5_m" name="genero_h_5_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo5_2">
                                        <div   id="fecha_h_5_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 5<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_5_m" name="fecha_h_5_m" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="hijo6_1">
                                        <div   id="genero_h_6_v" class="form-group form-group-default">
                                            <label>Genero hij@ 6<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_6_m" name="genero_h_6_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo6_2">
                                        <div   id="fecha_h_6_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 6<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_6_m" name="fecha_h_6_m" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="hijo7_1">
                                        <div   id="genero_h_7_v" class="form-group form-group-default">
                                            <label>Genero hij@ 7<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_7_m" name="genero_h_7_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo7_2">
                                        <div   id="fecha_h_7_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 7<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_7_m" name="fecha_h_7_m" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="hijo8_1">
                                        <div   id="genero_h_8_v" class="form-group form-group-default">
                                            <label>Genero hij@ 8<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="genero_h_8_m" name="genero_h_8_m" > 
                                                <option value='Masculino'>Masculino</option>    
                                                <option value='Femenino'>Femenino</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo8_2">
                                        <div   id="fecha_h_8_v" class="form-group form-group-default">
                                            <label>Fecha de nacimiento hij@ 8<span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_h_8_m" name="fecha_h_8_m" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div   id="Nacionalidad_v" class="form-group form-group-default">
                                            <label>Nacionalidad<span class="required-label">*</span></label>
                                            <input id="Nacionalidad" name="Nacionalidad"  type="text" class="form-control" required value="Mexicana">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div   id="Sexo_v" class="form-group form-group-default">
                                            <label>Sexo<span class="required-label">*</span></label>
                                            <select required class="form-control input-with-border" id="Sexo_m" name="Sexo_m">
                                                <option value="MASCULINO">Masculino</option>
                                                <option value="FEMENINO">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>	
                                <div class="form-group row " >
                                    <div class="col-md-12">
                                        <center><b>Datos de Contacto</b></center>
                                    </div>
                                </div>	
                                <div class="form-group row " >
                                    <div class="col-md-3">
                                        <div  id="m_celular_v" class="form-group form-group-default">
                                            <label>Numero Celular<span class="required-label">*</span></label>
                                            <input required type="text" max="10" class="form-control input-with-border" id="m_celular_m" name="m_celular_m" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="Correo_v" class="form-group form-group-default">
                                            <label>Correo<span class="required-label">*</span></label>
                                            <input id="Correo" name="Correo"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="Calle_v" class="form-group form-group-default">
                                            <label>Calle<span class="required-label">*</span></label>
                                            <input id="Calle" name="Calle"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="Numero_v" class="form-group form-group-default">
                                            <label>Numero<span class="required-label">*</span></label>
                                            <input id="Numero" name="Numero"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="Colonia_v" class="form-group form-group-default">
                                            <label>Colonia<span class="required-label">*</span></label>
                                            <input id="Colonia" name="Colonia"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="Alcaldia_v" class="form-group form-group-default">
                                            <label>Alcaldía/Municipio<span class="required-label">*</span></label>
                                            <input id="Alcaldia" name="Alcaldia"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div  id="Estado_v"class="form-group form-group-default">
                                            <label>Estado<span class="required-label">*</span></label>
                                            <select required class="form-control" id="Estado" name="Estado">
                                                <option value="">SELECCIONE UN ESTADO</option>
                                                <option value="AGUASCALIENTES">Aguascalientes</option>
                                                <option value="BAJA CALIFORNIA">Baja California</option>
                                                <option value="BAJA CALIFORNIA SUR">Baja California Sur</option>
                                                <option value="CAMPECHE">Campeche</option>
                                                <option value="CHIAPAS">Chiapas</option>
                                                <option value="CHIHUAHUA">Chihuahua</option>
                                                <option value="CIUDAD DE MEXICO">Ciudad de México</option>
                                                <option value="COAHUILA">Coahuila</option>
                                                <option value="COLIMA">Colima</option>
                                                <option value="DURANGO">Durango</option>
                                                <option value="GUANAJUATO">Guanajuato</option>
                                                <option value="GUERRERO">Guerrero</option>
                                                <option value="HIDALGO">Hidalgo</option>
                                                <option value="JALISCO">Jalisco</option>
                                                <option value="ESTADO DE MEXICO" selected>Estado de México</option>
                                                <option value="MICHOACAN">Michoacán</option>
                                                <option value="MORELOS">Morelos</option>
                                                <option value="NAYARIT">Nayarit</option>
                                                <option value="NUEVO LEON">Nuevo León</option>
                                                <option value="OAXACA">Oaxaca</option>
                                                <option value="PUEBLA">Puebla</option>
                                                <option value="QUERÉTARO">Querétaro</option>
                                                <option value="QUINTANA ROO">Quintana Roo</option>
                                                <option value="SAN LUIS POTOSÍ">San Luis Potosí</option>
                                                <option value="SINALOA">Sinaloa</option>
                                                <option value="SONORA">Sonora</option>
                                                <option value="TABASCO">Tabasco</option>
                                                <option value="TAMAULIPAS">Tamaulipas</option>
                                                <option value="TLAXCALA">Tlaxcala</option>
                                                <option value="VERACRUZ">Veracruz</option>
                                                <option value="YUCATÁN">Yucatán</option>
                                                <option value="ZACATECAS">Zacatecas</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div id="postal_v" class="form-group form-group-default">
                                            <label>Código postal<span class="required-label">*</span></label>
                                            <input id="postal" name="postal"  type="text" class="form-control" required >
                                        </div>
                                    </div>
                                
                                </div>
                                <hr>	
                                <div class="form-group row " >
                                    <div class="col-md-12">
                                        <center><b>Datos Laborales</b></center>
                                    </div>
                                </div>	
                                <div class="form-group row " >
                                    <div class="col-md-2">
                                        <div  id="estatus_v" class="form-group form-group-default">
                                            <label>Estatus <span class="required-label">*</span></label>
                                            <input id="estatus_m" name="estatus_m"  type="text" class="form-control" disabled  >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
										<div id="empleado_m_v" class="form-group form-group-default ">
											<label>Credencial<span class="required-label">*</span></label>
											<input id="empleado_m" name="empleado_m"  type="number" class="form-control" required >
										</div>
									</div>
                                    <div class="col-md-3">
                                        <div  id="departamento_v" class="form-group form-group-default">
                                            <label>Departamento<span class="required-label">*</span></label>
                                            <select id="departamento_m" name="departamento_m"  class="form-control" required  onchange="valida_formulario()">
                                                <option value=null>-Sin departamento-</option>    
                                                @foreach($c_departamento as $c_depa)
                                                <option value="{{$c_depa->id_departamento}}">{{$c_depa->departamento}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="Puesto_v" class="form-group form-group-default">
                                            <label>Puesto<span class="required-label">*</span></label>
                                            <input id="Puesto" name="Puesto"  type="text" class="form-control" required  onkeyup="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div  id="RFC_v" class="form-group form-group-default">
                                            <label>RFC<span class="required-label">*</span></label>
                                            <input id="RFC" name="RFC"  type="text" class="form-control" required  onkeyup="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="horario_v" class="form-group form-group-default">
                                            <label>Horario<span class="required-label">*</span></label>
                                            <select id="horario_m" name="horario_m"  class="form-control" required   onchange="valida_formulario()">
                                                <option value=null>-Sin horario-</option>    
                                                @foreach($t_horarios_personal as $t_horario)
                                                <option value="{{$t_horario->id_t_horarios_personal}}">{{$t_horario->nombre_horario}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div  id="fecha_contrato_v" class="form-group form-group-default">
                                            <label>Fecha de contrato <span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_contrato" name="fecha_contrato" disabled  onchange="valida_formulario()">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div  id="fecha_baja_v" class="form-group form-group-default">
                                            <label>Fecha de baja <span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_baja_m" name="fecha_baja_m" disabled  onchange="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div  id="reingreso_v" class="form-group form-group-default">
                                            <label>Reingreso <span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="reingreso_m" name="reingreso_m" disabled  onchange="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="c_estudio_v" class="form-group form-group-default">
                                            <label>Nivel de estudios<span class="required-label">*</span></label> 
                                            <select required  class="form-control input-with-border" id="c_estudio" name="c_estudio"  onchange="valida_formulario()" > 
                                                <option value=null>-Sin estudios asignados-</option>    
                                                @foreach($c_nivel_estudio as $c_estudio)
                                                <option value="{{$c_estudio->id_nivel}}">{{$c_estudio->nivel_estudio}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="c_banco_v" class="form-group form-group-default">
                                            <label>Bancos<span class="required-label">*</span></label> 
                                            <select required  class="form-control input-with-border" id="c_banco" name="c_banco"  onchange="valida_formulario()" > 
                                                
                                                <option value=null>-Sin banco asignado-</option>    
                                                @foreach($c_banco as $c_ban)
                                                <option value="{{$c_ban->id_banco}}">{{$c_ban->banco}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="clabe_v" class="form-group form-group-default">
                                            <label>CLABE Inter Bancaria<span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="clabe" name="clabe" onkeyup="valida_formulario()" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div  id="Salario_diario_v" class="form-group form-group-default">
                                            <label>Salario diario <span class="required-label">*</span></label>
                                            <input id="Salario_diario" name="Salario_diario"  type="text" class="form-control" required  oninput="convertSalary()"  onkeyup="valida_formulario()" >
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div  id="Salario_diario_letras_v" class="form-group form-group-default">
                                            <label>Salario en letras  <span class="required-label">*</span></label>
                                            <input id="Salario_diario_letras" name="Salario_diario_letras"  type="text" class="form-control" required   onkeyup="valida_formulario()" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="n_infonavit_v" class="form-group form-group-default">
                                            <label>Crédito Infonavit <span class="required-label">*</span></label> 
                                            Si tiene<input required type="radio" class="form-control input-with-border" id="credito_m" name="credito_m" value="Si" >
                                            <input required type="text" class="form-control input-with-border" id="n_infonavit" name="n_infonavit" placeholder="Sin crédito infonavit"  onkeyup="valida_formulario()">
                                            <hr>
                                            No tiene<input required type="radio" class="form-control input-with-border" id="credito_m" name="credito_m" Value="No">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="licencia_v"  class="form-group form-group-default">
                                            <label>Licencia Tipo B No.<span class="required-label">*</span></label>
                                            <input required type="text" max="12" class="form-control input-with-border" id="licencia_m" name="licencia_m" onkeyup="valida_formulario()" >
                                        </div>
                                    </div>
                                    </div>
                                <hr>	
                                <div class="form-group row " >
                                    <div class="col-md-12">
                                        <center><b>Documentación</b></center>
                                    </div>
                                </div>
                                
                                <div class="form-group row " >
                                    <div class="col-md-3">
                                        <div id="acta_n_v"  class="form-group form-group-default">
                                            <label>Acta de nacimiento<span class="required-label">*</span></label>
                                            Si tiene<input required type="radio" class="form-control input-with-border" id="acta_n_m" name="acta_n_m" value="Si" onclick="valida_formulario()" ><hr>
                                            No tiene<input required type="radio" class="form-control input-with-border" id="acta_n_m" name="acta_n_m" Value="No" onclick="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="carta_1_v"  class="form-group form-group-default">
                                            <label>Carta de recomendación 1<span class="required-label">*</span></label>
                                            Si tiene<input required type="radio" class="form-control input-with-border" id="carta_1_m" name="carta_1_m" value="Si" onclick="valida_formulario()" ><hr>
                                            No tiene<input required type="radio" class="form-control input-with-border" id="carta_1_m" name="carta_1_m" Value="No" onclick="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="carta_2_v"  class="form-group form-group-default">
                                            <label>Carta de recomendación 2<span class="required-label">*</span></label>
                                            Si tiene<input required type="radio" class="form-control input-with-border" id="carta_2_m" name="carta_2_m" value="Si"  onclick="valida_formulario()"><hr>
                                            No tiene<input required type="radio" class="form-control input-with-border" id="carta_2_m" name="carta_2_m" Value="No"  onclick="valida_formulario()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="penales_v"  class="form-group form-group-default">
                                            <label>Antecedentes No Penales<span class="required-label">*</span></label> 
                                            Si tiene<input required type="radio" class="form-control input-with-border" id="penales_m" name="penales_m" value="Si"  onclick="valida_formulario()"><hr>
                                            No tiene<input required type="radio" class="form-control input-with-border" id="penales_m" name="penales_m" Value="No"  onclick="valida_formulario()">
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="fotos_v"  class="form-group form-group-default">
                                            <label>Fotos <span class="required-label">*</span></label> 
                                            1 foto <input required type="radio" class="form-control input-with-border" id="fotos_m" name="fotos_m" value="1"  onclick="valida_formulario()"  >
                                            <hr>
                                            2 fotos<input required type="radio" class="form-control input-with-border" id="fotos_m" name="fotos_m" Value="2" onclick="valida_formulario()">
                                            <hr>
                                            3 fotos<input required type="radio" class="form-control input-with-border" id="fotos_m" name="fotos_m" Value="3" onclick="valida_formulario()">
                                            <hr>
                                            4 fotos<input required type="radio" class="form-control input-with-border" id="fotos_m" name="fotos_m" Value="4" onclick="valida_formulario()">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div id="comprobante_dom_v"  class="form-group form-group-default">
                                            <label>Comprobante de Domicilio<span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="comprobante_dom_m" name="comprobante_dom_m"  onkeyup="valida_formulario()" >
                                        </div>
                                    </div>
                                </div>
                                <hr>	
                                <div class="form-group row " >
                                    <div class="col-md-12">
                                        <center><b>Información Médica</b></center>
                                    </div>
                                </div>
                                
                                <div class="form-group row " >
                                    
                                    
                                    <div class="col-md-3">
                                        <div  id="padecimiento_v" class="form-group form-group-default">
                                            <label>Padecimiento<span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="padecimiento_m" name="padecimiento_m"  onkeyup="valida_formulario()"  >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div  id="alergias_v" class="form-group form-group-default">
                                            <label>Alergias<span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="alergias_m" name="alergias_m"  onkeyup="valida_formulario()" >
                                        </div>
                                    </div>
                                   
                                </div>
                                <hr>	
                                <div class="form-group row " >
                                    <div class="col-md-12">
                                        <center><b>Otros Datos</b></center>
                                    </div>
                                </div>
                                
                                <div class="form-group row " >
                                <div class="col-md-3" id="hijo8_2">
                                        <div  id="t_zapatos_v" class="form-group form-group-default">
                                            <label>Talla de zapatos<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="t_zapatos_m"  onchange="valida_formulario()" name="t_zapatos_m" > 
                                                <option value=null>-Sin talla asignada-</option>    
                                                <option value='22'>22</option>    
                                                <option value='23'>23</option>    
                                                <option value='24'>24</option>    
                                                <option value='25'>25</option>    
                                                <option value='26'>26</option>    
                                                <option value='27'>27</option>    
                                                <option value='28'>28</option>    
                                                <option value='29'>29</option>    
                                                <option value='30'>30</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo8_2">
                                        <div id="t_camisola_v"  class="form-group form-group-default">
                                            <label>Talla de camisola<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="t_camisola_m"  onchange="valida_formulario()" name="t_camisola_m" > 
                                                <option value=null>-Sin talla asignada-</option>    
                                                <option value='32'>32</option>    
                                                <option value='34'>34</option>    
                                                <option value='36'>36</option>    
                                                <option value='38'>38</option>    
                                                <option value='40'>40</option>    
                                                <option value='42'>42</option>    
                                                <option value='44'>44</option>    
                                                <option value='46'>46</option>     
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="hijo8_2">
                                        <div id="t_pantalon_v"  class="form-group form-group-default">
                                            <label>Talla de pantalon<span class="required-label">*</span></label>
                                            <select required  class="form-control input-with-border" id="t_pantalon_m" onchange="valida_formulario()" name="t_pantalon_m" > 
                                                <option value=null>-Sin talla asignada-</option>    
                                                <option value='28'>28</option>    
                                                <option value='30'>30</option>    
                                                <option value='32'>32</option>    
                                                <option value='34'>34</option>    
                                                <option value='36'>36</option>    
                                                <option value='38'>38</option>    
                                                <option value='40'>40</option>  
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-primary">Actualizar</button>
							</div>
						</div>
					</div>
				</div>

            </div>
        </div>    
    </div>

    @section('jscustom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Incluye moment.js con locales -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

    <script type="text/javascript">
        function valida_formulario()
        {
            var id_empleado =$('#empleado_m').val();
            if(id_empleado != 0)
            {
                $('#empleado_m_v').removeClass('has-error');
                $('#empleado_m_v').addClass('has-success');
            }
            else
            {
                $('#empleado_m_v').removeClass('has-success');
                $('#empleado_m_v').addClass('has-error');
            }
            var Nombre = $('#nombre_m').val();
            if(Nombre == null || Nombre == '')
            {
                $('#nombre_m_v').removeClass('has-success');
                $('#nombre_m_v').addClass('has-error');
            }
            else
            {
                $('#nombre_m_v').removeClass('has-error');
                $('#nombre_m_v').addClass('has-success');
            }

            var apellido_p = $('#apellido_p_m').val();
            if(apellido_p == null || apellido_p == '')
            {
                $('#apellido_p_v').removeClass('has-success');
                $('#apellido_p_v').addClass('has-error');
            }
            else
            {
                $('#apellido_p_v').removeClass('has-error');
                $('#apellido_p_v').addClass('has-success');
            }

            var apellido_m = $('#apellido_m_m').val();
            if(apellido_m == null || apellido_m == '')
            {
                $('#apellido_m_v').removeClass('has-success');
                $('#apellido_m_v').addClass('has-error');
            }
            else
            {
                $('#apellido_m_v').removeClass('has-error');
                $('#apellido_m_v').addClass('has-success');
            }

            var Fecha_nacimiento = $('#nacimiento').val();
            if(Fecha_nacimiento == null || Fecha_nacimiento == '')
            {
                $('#nacimiento_v').removeClass('has-success');
                $('#nacimiento_v').addClass('has-error');
            }
            else
            {
                $('#nacimiento_v').removeClass('has-error');
                $('#nacimiento_v').addClass('has-success');
            }

            var Edad = $('#Edad').val();
            if(Edad == null || Edad == '')
            {
                $('#Edad_v').removeClass('has-success');
                $('#Edad_v').addClass('has-error');
            }
            else
            {
                $('#Edad_v').removeClass('has-error');
                $('#Edad_v').addClass('has-success');
            }
            
            var CURP = $('#CURP').val();
            if(CURP == '' || CURP == null)
            {
                $('#CURP_v').removeClass('has-success');
                $('#CURP_v').addClass('has-error');
            }
            else
            {
                $('#CURP_v').removeClass('has-error');
                $('#CURP_v').addClass('has-success');
            }

            var ine = $('#ine_m').val();
            if(ine == '' || ine == null)
            {
                $('#ine_v').removeClass('has-success');
                $('#ine_v').addClass('has-error');
            }
            else
            {
                $('#ine_v').removeClass('has-error');
                $('#ine_v').addClass('has-success');
            }

            var NSS = $('#IMSS').val();
            if(NSS == '' || NSS == null)
            {
                $('#IMSS_v').removeClass('has-success');
                $('#IMSS_v').addClass('has-error');
            }
            else
            {
                $('#IMSS_v').removeClass('has-error');
                $('#IMSS_v').addClass('has-success');
            }
            var Estado_civil = $('#Civil_m').val();
            if(Estado_civil == null || Estado_civil == '')
            {
                $('#Civil_v').removeClass('has-success');
                $('#Civil_v').addClass('has-error');
            }
            else
            {
                $('#Civil_v').removeClass('has-error');
                $('#Civil_v').addClass('has-success');
            }

            var Nacionalidad = $('#Nacionalidad').val();
            if(Nacionalidad == null || Nacionalidad == '')
            {
                $('#Nacionalidad_v').removeClass('has-success');
                $('#Nacionalidad_v').addClass('has-error');
            }
            else
            {
                $('#Nacionalidad_v').removeClass('has-error');
                $('#Nacionalidad_v').addClass('has-success');
            }

            var Sexo = $('#Sexo_m').val();
            if(Sexo == null || Sexo == '')
            {
                $('#Sexo_v').removeClass('has-success');
                $('#Sexo_v').addClass('has-error');
            }
            else
            {
                $('#Sexo_v').removeClass('has-error');
                $('#Sexo_v').addClass('has-success');
            }

            var m_celular_m = $('#m_celular_m').val();
            if (m_celular_m == null || m_celular_m == '') {
                
                $('#m_celular_v').removeClass('has-success');
                $('#m_celular_v').addClass('has-error');
            } else {
                $('#m_celular_v').removeClass('has-error');
                $('#m_celular_v').addClass('has-success');
            }


            var Calle = $('#Calle').val();
            if(Calle == '' || Calle == null)
            {
                $('#Calle_v').removeClass('has-success');
                $('#Calle_v').addClass('has-error');
            }
            else
            {
                $('#Calle_v').removeClass('has-error');
                $('#Calle_v').addClass('has-success');
            }

            var Numero = $('#Numero').val();
            if(Numero == '' || Numero == null)
            {
                $('#Numero_v').removeClass('has-success');
                $('#Numero_v').addClass('has-error');
            }
            else
            {
                $('#Numero_v').removeClass('has-error');
                $('#Numero_v').addClass('has-success');
            }

            var Colonia = $('#Colonia').val();
            if(Colonia == '' || Colonia == null)
            {
                $('#Colonia_v').removeClass('has-success');
                $('#Colonia_v').addClass('has-error');
            }
            else
            {
                $('#Colonia_v').removeClass('has-error');
                $('#Colonia_v').addClass('has-success');
            }

            var Alcaldia_municipio = $('#Alcaldia').val();
            if(Alcaldia_municipio == '' || Alcaldia_municipio == null)
            {
                $('#Alcaldia_v').removeClass('has-success');
                $('#Alcaldia_v').addClass('has-error');
            }
            else
            {
                $('#Alcaldia_v').removeClass('has-error');
                $('#Alcaldia_v').addClass('has-success');
            }

            var Estado = $('#Estado').val();
            if(Estado == '' || Estado == null)
            {
                $('#Estado_v').removeClass('has-success');
                $('#Estado_v').addClass('has-error');
            }
            else
            {
                $('#Estado_v').removeClass('has-error');
                $('#Estado_v').addClass('has-success');
            }

            var Codigo_postal = $('#postal').val();
            if(Codigo_postal == '' || Codigo_postal == null)
            {
                $('#postal_v').removeClass('has-success');
                $('#postal_v').addClass('has-error');
            }
            else
            {
                $('#postal_v').removeClass('has-error');
                $('#postal_v').addClass('has-success');
            }

            var empleado_m = $('#empleado_m').val();
            if(empleado_m == '' || empleado_m == null || empleado_m == 0)
            {
                $('#empleado_m_v').removeClass('has-success');
                $('#empleado_m_v').addClass('has-error');
            }
            else
            {
                $('#empleado_m_v').removeClass('has-error');
                $('#empleado_m_v').addClass('has-success');
            }

            var departamento_m = $('#departamento_m').val();
            if(departamento_m == '' || departamento_m == null || departamento_m == 'null')
            {
                $('#departamento_v').removeClass('has-success');
                $('#departamento_v').addClass('has-error');
            }
            else
            {
                $('#departamento_v').removeClass('has-error');
                $('#departamento_v').addClass('has-success');
            }

            var Puesto = $('#Puesto').val();
            if(Puesto == '' || Puesto == null)
            {
                $('#Puesto_v').removeClass('has-success');
                $('#Puesto_v').addClass('has-error');
            }
            else
            {
                $('#Puesto_v').removeClass('has-error');
                $('#Puesto_v').addClass('has-success');
            }
            
            var RFC = $('#RFC').val();
            if(RFC == '' || RFC == null)
            {
                $('#RFC_v').removeClass('has-success');
                $('#RFC_v').addClass('has-error');
            }
            else
            {
                $('#RFC_v').removeClass('has-error');
                $('#RFC_v').addClass('has-success');
            }
            
            var horario_m = $('#horario_m').val();
            if(horario_m == '' || horario_m == null|| horario_m == 'null')
            {
                $('#horario_v').removeClass('has-success');
                $('#horario_v').addClass('has-error');
            }
            else
            {
                $('#horario_v').removeClass('has-error');
                $('#horario_v').addClass('has-success');
            }
            
            var fecha_contrato = $('#fecha_contrato').val();
            if(fecha_contrato == '' || fecha_contrato == null || fecha_contrato == 'null')
            {
                $('#fecha_contrato_v').removeClass('has-success');
                $('#fecha_contrato_v').addClass('has-error');
            }
            else
            {
                $('#fecha_contrato_v').removeClass('has-error');
                $('#fecha_contrato_v').addClass('has-success');
            }
            
            var fecha_baja_m = $('#fecha_baja_m').val();
            if(fecha_baja_m == '' || fecha_baja_m == null || fecha_baja_m == 'null')
            {
                $('#fecha_baja_v').removeClass('has-success');
                $('#fecha_baja_v').addClass('has-error');
            }
            else
            {
                $('#fecha_baja_v').removeClass('has-error');
                $('#fecha_baja_v').addClass('has-success');
            }
            
            var reingreso_m = $('#reingreso_m').val();
            if(reingreso_m == '' || reingreso_m == null || reingreso_m == 'null')
            {
                $('#reingreso_v').removeClass('has-success');
                $('#reingreso_v').addClass('has-error');
            }
            else
            {
                $('#reingreso_v').removeClass('has-error');
                $('#reingreso_v').addClass('has-success');
            }

            var c_estudio = $('#c_estudio').val();
            if(c_estudio == '' || c_estudio == null || c_estudio == 'null')
            {
                $('#c_estudio_v').removeClass('has-success');
                $('#c_estudio_v').addClass('has-error');
            }
            else
            {
                $('#c_estudio_v').removeClass('has-error');
                $('#c_estudio_v').addClass('has-success');
            }

            var c_banco = $('#c_banco').val();
            if(c_banco == '' || c_banco == null || c_banco == 'null')
            {
                $('#c_banco_v').removeClass('has-success');
                $('#c_banco_v').addClass('has-error');
            }
            else
            {
                $('#c_banco_v').removeClass('has-error');
                $('#c_banco_v').addClass('has-success');
            }

            var clabe = $('#clabe').val();
            if(clabe == '' || clabe == null)
            {
                $('#clabe_v').removeClass('has-success');
                $('#clabe_v').addClass('has-error');
            }
            else
            {
                $('#clabe_v').removeClass('has-error');
                $('#clabe_v').addClass('has-success');
            }

            var Salario_diario = $('#Salario_diario').val();
            if(Salario_diario == '' || Salario_diario == null)
            {
                $('#Salario_diario_v').removeClass('has-success');
                $('#Salario_diario_v').addClass('has-error');
            }
            else
            {
                $('#Salario_diario_v').removeClass('has-error');
                $('#Salario_diario_v').addClass('has-success');
            }

            var Salario_diario_letras = $('#Salario_diario_letras').val();
            if(Salario_diario_letras == '' || Salario_diario_letras == null)
            {
                $('#Salario_diario_letras_v').removeClass('has-success');
                $('#Salario_diario_letras_v').addClass('has-error');
            }
            else
            {
                $('#Salario_diario_letras_v').removeClass('has-error');
                $('#Salario_diario_letras_v').addClass('has-success');
            }

            var n_infonavit = $('#n_infonavit').val();
            if(n_infonavit == '' || n_infonavit == null)
            {
                $('#n_infonavit_v').removeClass('has-success');
                $('#n_infonavit_v').addClass('has-error');
            }
            else
            {
                $('#n_infonavit_v').removeClass('has-error');
                $('#n_infonavit_v').addClass('has-success');
            }
            
            var acta_n_m = $('input[name="acta_n_m"]:checked').val() || ''; // Verifica el valor seleccionado
            if (acta_n_m === 'No' || acta_n_m === '') {
                $('#acta_n_v').removeClass('has-success');
                $('#acta_n_v').addClass('has-error');
            } else {
                $('#acta_n_v').removeClass('has-error');
                $('#acta_n_v').addClass('has-success');
            }

            
            var carta_1_m = $('input[name="carta_1_m"]:checked').val() || ''; // Verifica el valor seleccionado
            console.log(carta_1_m);
            if(carta_1_m == 'No' || carta_1_m == '')
            {
                $('#carta_1_v').removeClass('has-success');
                $('#carta_1_v').addClass('has-error');
            }
            else
            {
                $('#carta_1_v').removeClass('has-error');
                $('#carta_1_v').addClass('has-success');
            }
            
            var carta_2_m = $('input[name="carta_2_m"]:checked').val() || ''; // Verifica el valor seleccionado
            if(carta_2_m == '' || carta_2_m == null)
            {
                $('#carta_2_v').removeClass('has-success');
                $('#carta_2_v').addClass('has-error');
            }
            else
            {
                $('#carta_2_v').removeClass('has-error');
                $('#carta_2_v').addClass('has-success');
            }
            
            var penales_m = $('input[name="penales_m"]:checked').val() || ''; // Verifica el valor seleccionado
            if(penales_m == '' || penales_m == null)
            {
                $('#penales_v').removeClass('has-success');
                $('#penales_v').addClass('has-error');
            }
            else
            {
                $('#penales_v').removeClass('has-error');
                $('#penales_v').addClass('has-success');
            }

            var fotos_m = $('input[name="fotos_m"]:checked').val() || ''; // Verifica el valor seleccionado
            if(fotos_m == '' || fotos_m == null)
            {
                $('#fotos_v').removeClass('has-success');
                $('#fotos_v').addClass('has-error');
            }
            else
            {
                $('#fotos_v').removeClass('has-error');
                $('#fotos_v').addClass('has-success');
            }
            
            var comprobante_dom_m = $('#comprobante_dom_m').val();
            if(comprobante_dom_m == '' || comprobante_dom_m == null)
            {
                $('#comprobante_dom_v').removeClass('has-success');
                $('#comprobante_dom_v').addClass('has-error');
            }
            else
            {
                $('#comprobante_dom_v').removeClass('has-error');
                $('#comprobante_dom_v').addClass('has-success');
            }

            var padecimiento_m = $('#padecimiento_m').val();
            if(padecimiento_m == '' || padecimiento_m == null)
            {
                $('#padecimiento_v').removeClass('has-success');
                $('#padecimiento_v').addClass('has-error');
            }
            else
            {
                $('#padecimiento_v').removeClass('has-error');
                $('#padecimiento_v').addClass('has-success');
            }

            var alergias_m = $('#alergias_m').val();
            if(alergias_m == '' || alergias_m == null)
            {
                $('#alergias_v').removeClass('has-success');
                $('#alergias_v').addClass('has-error');
            }
            else
            {
                $('#alergias_v').removeClass('has-error');
                $('#alergias_v').addClass('has-success');
            }

            var t_zapatos_m = $('#t_zapatos_m').val();
            if(t_zapatos_m == '' || t_zapatos_m == 'null')
            {
                $('#t_zapatos_v').removeClass('has-success');
                $('#t_zapatos_v').addClass('has-error');
            }
            else
            {
                $('#t_zapatos_v').removeClass('has-error');
                $('#t_zapatos_v').addClass('has-success');
            }

            var t_camisola_m = $('#t_camisola_m').val();
            if(t_camisola_m == '' || t_camisola_m == 'null')
            {
                $('#t_camisola_v').removeClass('has-success');
                $('#t_camisola_v').addClass('has-error');
            }
            else
            {
                $('#t_camisola_v').removeClass('has-error');
                $('#t_camisola_v').addClass('has-success');
            }

            var t_pantalon_m = $('#t_pantalon_m').val();
            console.log(t_pantalon_m);
            if(t_pantalon_m == '' || t_pantalon_m == 'null')
            {
                $('#t_pantalon_v').removeClass('has-success');
                $('#t_pantalon_v').addClass('has-error');
            }
            else
            {
                $('#t_pantalon_v').removeClass('has-error');
                $('#t_pantalon_v').addClass('has-success');
            }

        }
		function modal_informacion(Estatus,id_empleado,id,Nombre,apellido_p,apellido_m,Fecha_nacimiento,Edad,Puesto,Nacionalidad,Sexo,Estado_civil,Calle,Numero,Colonia,Alcaldia_municipio,Estado,Codigo_postal,RFC,NSS,CURP,Correo,Salario_diario,Fecha_contrato,Fecha_contrato_date,id_personal)
        {
            $('#titulo_m').html(Nombre+' '+apellido_p+' '+apellido_m);

            $('#empleado_m').val(id_empleado);
            if(id_empleado != 0)
            {
                $('#empleado_m_v').addClass('has-success');
            }
            else
            {
                $('#empleado_m_v').addClass('has-error');
            }

            $('#nombre_m').val(Nombre);
            if(Nombre != null || Nombre != '')
            {
                $('#nombre_m_v').addClass('has-success');
            }
            else
            {
                $('#nombre_m_v').addClass('has-error');
            }

            $('#apellido_p_m').val(apellido_p);
            if(apellido_p != null || apellido_p != '')
            {
                $('#apellido_p_v').addClass('has-success');
            }
            else
            {
                $('#apellido_p_v').addClass('has-error');
            }

            $('#apellido_m_m').val(apellido_m);
            if(apellido_m != null || apellido_m != '')
            {
                $('#apellido_m_v').addClass('has-success');
            }
            else
            {
                $('#apellido_m_v').addClass('has-error');
            }

            $('#nacimiento').val(Fecha_nacimiento);
            if(Fecha_nacimiento != null || Fecha_nacimiento != '')
            {
                $('#nacimiento_v').addClass('has-success');
            }
            else
            {
                $('#nacimiento_v').addClass('has-error');
            }

            $('#estatus_m').val(Estatus);
            if(Estatus =='Activo' )
            {
                $('#estatus_v').addClass('has-success');
            }
            else
            {
                $('#estatus_v').addClass('has-error');
            }

            $('#Edad').val(Edad);
            if(Edad != null || Edad != '')
            {
                $('#Edad_v').addClass('has-success');
            }
            else
            {
                $('#Edad_v').addClass('has-error');
            }

            $('#Puesto').val(Puesto);
            if(Puesto != null || Puesto != '')
            {
                $('#Puesto_v').addClass('has-success');
            }
            else
            {
                $('#Puesto_v').addClass('has-error');
            }

            $('#Nacionalidad').val(Nacionalidad);
            
            if(Nacionalidad != null || Nacionalidad != '')
            {
                $('#Nacionalidad_v').addClass('has-success');
            }
            else
            {
                $('#Nacionalidad_v').addClass('has-error');
            }

            $('#Sexo_m').val(Sexo);
            
            if(Sexo != null || Sexo != '')
            {
                $('#Sexo_v').addClass('has-success');
            }
            else
            {
                $('#Sexo_v').addClass('has-error');
            }

            const sexo = Sexo;
            const estadoCivilSelect = document.getElementById('Civil');
            estadoCivilSelect.innerHTML = ''; // Limpiar opciones anteriores

            // Agregar opciones según el sexo seleccionado
            if (sexo === 'MASCULINO') {
                estadoCivilSelect.innerHTML = `
                <option value="">Seleccione una opción</option>
                                            <option value="SOLTERO">Soltero</option>
                                            <option value="CASADO">Casado</option>
                                            <option value="DIVORCIADO">Divorciado</option>
                                            <option value="VIUDO">Viudo</option>
                                            <option value="UNIÓN LIBRE">Unión libre</option>
                                            <option value="SEPARADO">Separado</option>
                                            <option value="COMPROMETIDO">Comprometido</option>
                `;
            } else if (sexo === 'FEMENINO') {
                estadoCivilSelect.innerHTML = `
                <option value="">Seleccione una opción</option>
                                            <option value="SOLTERA">Soltera</option>
                                            <option value="CASADA">Casada</option>
                                            <option value="DIVORCIADA">Divorciada</option>
                                            <option value="VIUDA">Viuda</option>
                                            <option value="UNIÓN LIBRE">Unión libre</option>
                                            <option value="SEPARADA">Separada</option>
                                            <option value="COMPROMETIDA">Comprometida</option>
                `;
            }
            $('#Civil_m').val(Estado_civil);
            if($('#Civil_m').val() != '')
            {
                $('#Civil_v').addClass('has-success');
            }
            else
            {
                $('#Civil_v').addClass('has-error');
            }

            $('#Calle').val(Calle);
            if(Calle != '' || Calle != null)
            {
                $('#Calle_v').addClass('has-success');
            }
            else
            {
                $('#Calle_v').addClass('has-error');
            }

            $('#Numero').val(Numero);
            if(Numero != '' || Numero != null)
            {
                $('#Numero_v').addClass('has-success');
            }
            else
            {
                $('#Numero_v').addClass('has-error');
            }

            $('#Colonia').val(Colonia);
            if(Colonia != '' || Colonia != null)
            {
                $('#Colonia_v').addClass('has-success');
            }
            else
            {
                $('#Colonia_v').addClass('has-error');
            }

            $('#Alcaldia').val(Alcaldia_municipio);
            if(Alcaldia_municipio != '' || Alcaldia_municipio != null)
            {
                $('#Alcaldia_v').addClass('has-success');
            }
            else
            {
                $('#Alcaldia_v').addClass('has-error');
            }

            $('#Estado').val(Estado);
            if(Estado != '' || Estado != null)
            {
                $('#Estado_v').addClass('has-success');
            }
            else
            {
                $('#Estado_v').addClass('has-error');
            }

            $('#postal').val(Codigo_postal);
            if(Codigo_postal != '' || Codigo_postal != null)
            {
                $('#postal_v').addClass('has-success');
            }
            else
            {
                $('#postal_v').addClass('has-error');
            }

            $('#RFC').val(RFC);
            if(RFC != '' || RFC != null)
            {
                $('#RFC_v').addClass('has-success');
            }
            else
            {
                $('#RFC_v').addClass('has-error');
            }

            $('#IMSS').val(NSS);
            if(NSS != '' || NSS != null)
            {
                $('#IMSS_v').addClass('has-success');
            }
            else
            {
                $('#IMSS_v').addClass('has-error');
            }

            $('#CURP').val(CURP);
            if(CURP != '' || CURP != null)
            {
                $('#CURP_v').addClass('has-success');
            }
            else
            {
                $('#CURP_v').addClass('has-error');
            }

            $('#Correo').val(Correo);
            if(Correo != '' || Correo != null)
            {
                $('#Correo_v').addClass('has-success');
            }
            else
            {
                $('#Correo_v').addClass('has-error');
            }

            $('#Salario_diario').val(Salario_diario);
            if(Salario_diario != '' || Salario_diario != null)
            {
                $('#Salario_diario_v').addClass('has-success');
            }
            else
            {
                $('#Salario_diario_v').addClass('has-error');
            }

            $('#id_personal_modal').val(id_personal);
        
            convertSalary();

            $('#fecha_contrato').val(Fecha_contrato_date);
            if(Fecha_contrato_date != '' || Fecha_contrato_date != null)
            {
                $('#fecha_contrato_v').addClass('has-success');
            }
            else
            {
                $('#fecha_contrato_v').addClass('has-error');
            }



            const fecha = new Date(Fecha_contrato_date);
            const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

            const diaSemana = dias[fecha.getUTCDay()];
            const dia = fecha.getUTCDate();
            const mes = meses[fecha.getUTCMonth()];
            const año = fecha.getUTCFullYear();

            const fechaTexto = `${diaSemana}, ${dia} de ${mes} de ${año}`;
                $('#fecha_contrato_hidden').val(fechaTexto);
                valida_formulario();
            $('#modal_informacion').modal('show');
		}
        function convertSalary() {
            const salaryInput = document.getElementById('Salario_diario');
            const salaryInWords = document.getElementById('Salario_diario_letras');
            const salary = parseInt(salaryInput.value);

            if (!isNaN(salary)) {
                salaryInWords.value = numberToWords(salary);
            } else {
                salaryInWords.value = '';
            }
            
            var Salario_diario_letras = $('#Salario_diario_letras').val();
            if(Salario_diario_letras != '' || Salario_diario_letras != null)
            {
                $('#Salario_diario_letras_v').addClass('has-success');
            }
            else
            {
                $('#Salario_diario_letras_v').addClass('has-error');
            }
        }

        $(function() {
            valida_hijos();
        });

        function valida_hijos()
        {
            var n_hijos_m = $('#n_hijos_m').val();
            console.log(n_hijos_m);
            if(n_hijos_m == 1)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').hide();
                $('#hijo2_2').hide();
                $('#hijo3_1').hide();
                $('#hijo3_2').hide();
                $('#hijo4_1').hide();
                $('#hijo4_2').hide();
                $('#hijo5_1').hide();
                $('#hijo5_2').hide();
                $('#hijo6_1').hide();
                $('#hijo6_2').hide();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 2)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').hide();
                $('#hijo3_2').hide();
                $('#hijo4_1').hide();
                $('#hijo4_2').hide();
                $('#hijo5_1').hide();
                $('#hijo5_2').hide();
                $('#hijo6_1').hide();
                $('#hijo6_2').hide();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 3)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').show();
                $('#hijo3_2').show();
                $('#hijo4_1').hide();
                $('#hijo4_2').hide();
                $('#hijo5_1').hide();
                $('#hijo5_2').hide();
                $('#hijo6_1').hide();
                $('#hijo6_2').hide();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 4)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').show();
                $('#hijo3_2').show();
                $('#hijo4_1').show();
                $('#hijo4_2').show();
                $('#hijo5_1').hide();
                $('#hijo5_2').hide();
                $('#hijo6_1').hide();
                $('#hijo6_2').hide();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 5)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').show();
                $('#hijo3_2').show();
                $('#hijo4_1').show();
                $('#hijo4_2').show();
                $('#hijo5_1').show();
                $('#hijo5_2').show();
                $('#hijo6_1').hide();
                $('#hijo6_2').hide();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 6)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').show();
                $('#hijo3_2').show();
                $('#hijo4_1').show();
                $('#hijo4_2').show();
                $('#hijo5_1').show();
                $('#hijo5_2').show();
                $('#hijo6_1').show();
                $('#hijo6_2').show();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 7)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').show();
                $('#hijo3_2').show();
                $('#hijo4_1').show();
                $('#hijo4_2').show();
                $('#hijo5_1').show();
                $('#hijo5_2').show();
                $('#hijo6_1').show();
                $('#hijo6_2').show();
                $('#hijo7_1').show();
                $('#hijo7_2').show();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }else if(n_hijos_m == 8)
            {
                $('#hijo1_1').show();
                $('#hijo1_2').show();
                $('#hijo2_1').show();
                $('#hijo2_2').show();
                $('#hijo3_1').show();
                $('#hijo3_2').show();
                $('#hijo4_1').show();
                $('#hijo4_2').show();
                $('#hijo5_1').show();
                $('#hijo5_2').show();
                $('#hijo6_1').show();
                $('#hijo6_2').show();
                $('#hijo7_1').show();
                $('#hijo7_2').show();
                $('#hijo8_1').show();
                $('#hijo8_2').show();
            }else{
                $('#hijo1_1').hide();
                $('#hijo1_2').hide();
                $('#hijo2_1').hide();
                $('#hijo2_2').hide();
                $('#hijo3_1').hide();
                $('#hijo3_2').hide();
                $('#hijo4_1').hide();
                $('#hijo4_2').hide();
                $('#hijo5_1').hide();
                $('#hijo5_2').hide();
                $('#hijo6_1').hide();
                $('#hijo6_2').hide();
                $('#hijo7_1').hide();
                $('#hijo7_2').hide();
                $('#hijo8_1').hide();
                $('#hijo8_2').hide();
            }

        }

        function numberToWords(num) {
            const units = ["", "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve"];
            const teens = ["Diez", "Once", "Doce", "Trece", "Catorce", "Quince", "Dieciséis", "Diecisiete", "Dieciocho", "Diecinueve"];
            const tens = ["", "", "Veinte", "Treinta", "Cuarenta", "Cincuenta", "Sesenta", "Setenta", "Ochenta", "Noventa"];
            const hundreds = ["", "Cien", "Doscientos", "Trescientos", "Cuatrocientos", "Quinientos", "Seiscientos", "Setecientos", "Ochocientos", "Novecientos"];

            if (num === 0) return "Cero";

            let words = '';

            if (num >= 1000) {
                words += "Mil ";
                num %= 1000;
            }

            if (num >= 100) {
                words += hundreds[Math.floor(num / 100)] + " ";
                num %= 100;
            }

            if (num >= 20) {
                words += tens[Math.floor(num / 10)] + " ";
                num %= 10;
            } else if (num >= 10) {
                words += teens[num - 10] + " ";
                num = 0;
            }

            if (num > 0) {
                words += units[num] + " ";
            }

            return words.trim().toUpperCase();
        }
        $('#nacimiento').on('change', function() {
            var nacimiento = $(this).val();
            if (nacimiento) {
                var hoy = new Date();
                var cumpleanos = new Date(nacimiento);
                var edad = hoy.getFullYear() - cumpleanos.getFullYear();
                var mes = hoy.getMonth() - cumpleanos.getMonth();
                if (mes < 0 || (mes === 0 && hoy.getDate() < cumpleanos.getDate())) {
                    edad--;
                }
                $('#Edad').val(edad);
            } else {
                $('#Edad').val('');
            }
        });
    </script>
    @endsection
</x-app-layout>
