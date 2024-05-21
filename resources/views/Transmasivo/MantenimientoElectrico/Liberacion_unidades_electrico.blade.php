<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }

    </style>
    <div class="card">
        <div class="card-header">
           <div class="card-title">Bitacora De Liberacion De Unidades </div>
           
       </div>
       
       
       <form method="post" id="exampleValidation" action="{{url('/Liberacion_unidades_electrico')}}">
           <div class="card-body">
            @if (session('mensaje'))
            
            <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                
                {{ session('mensaje') }}.
                
            </div>
            @endif

            @csrf
            {{-- inicio del row --}}

            <div class="form-group row " >
                {{-- <div class="col-md-2">
                    <label>Numero de economico <span class="required-label">*</span></label>
                    <input  required type="text" class="form-control  input-with-border" style="width:100%; height:100%; border:black 1px solid;" id="n_economico" name="n_economico">
                </div>--}}
                <div class="col-md-2">
                    <label>Numero de economico <span class="required-label">*</span></label>
                    <select  required type="text" class="form-control  input-with-border" id="n_economico" name="n_economico">
                        @foreach($unidades as $unidad)
                        <option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
                        @endforeach
                    </select>
                </div>
                {{--
                <div class="col-md-4">
                    <label>Nombre del mecanico<span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="n_mecanico" name="n_mecanico">
                </div>
                --}}
                <div class="col-md-4">
                    <label>Nombre del  mecanico</label>
                    <select   class="form-control input-with-border"  id="n_mecanico" name="n_mecanico">
                        @foreach($mecanicos as $mecanico)
                        <option>{{$mecanico->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Nombre del supervisor <span class="required-label">*</span></label>
                    <select   class="form-control input-with-border"  id="n_supervisor" name="n_supervisor">
                        @foreach($mecanicos as $mecanico)
                        <option>{{$mecanico->nombre}}</option>
                        @endforeach
                    </select>
                    {{--
                    <input required type="text" class="form-control input-with-border" id="n_supervisor" name="nom_supervisor">
                    --}}
                </div>
                <div class="col-md-2">
                    <label>Fecha <span class="required-label">*</span></label>
                    <input required type="date" class="form-control input-with-border" id="Fecha" name="Fecha" value="{{ now()->format('Y-m-d') }}">
                </div>
            </div>
            <div class="form-group row " >
                <div class="col-md-2">
                    <label>Km <span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="km" name="km" >
                </div>
            </div>
            
            
        </div>
       
       

        

</div>
<div class="form-group row " >
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#luces_exteriores" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>LUCES EXTERIORES - ILUMINACIÓN FRONTAL</h5>
							</center>
						</div>
					</div>
					<div id="luces_exteriores" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							<div class="form-group row " >
								<div class="col-md-6" style="border-right: 1px #575962 solid;">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>FAROS IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_far_izq" name="luc_ext_ilu_fron_far_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_far_izq" name="luc_ext_ilu_fron_far_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_far_izq_o" name="luc_ext_ilu_fron_far_izq_o"></td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>LUCES BAJAS IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_baj_izq" name="luc_ext_ilu_fron_luc_baj_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_baj_izq" name="luc_ext_ilu_fron_luc_baj_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_luc_baj_izq_o" name="luc_ext_ilu_fron_luc_baj_izq_o"></td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>LUCES ALTAS IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_alt_izq" name="luc_ext_ilu_fron_luc_alt_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_alt_izq" name="luc_ext_ilu_fron_luc_alt_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_luc_alt_izq_o" name="luc_ext_ilu_fron_luc_alt_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>INTERMITENTES IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_inter_izq" name="luc_ext_ilu_fron_inter_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_inter_izq" name="luc_ext_ilu_fron_inter_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_inter_izq_o" name="luc_ext_ilu_fron_inter_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>TORRETA IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_torr_izq" name="luc_ext_ilu_fron_torr_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_torr_izq" name="luc_ext_ilu_fron_torr_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_torr_izq_o" name="luc_ext_ilu_fron_torr_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>ESTROBOS IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_estro_izq" name="luc_ext_ilu_fron_estro_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_estro_izq" name="luc_ext_ilu_fron_estro_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_estro_izq_o" name="luc_ext_ilu_fron_estro_izq_o"></td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>NEBLINEROS IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_nebl_izq" name="luc_ext_ilu_fron_nebl_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_nebl_izq" name="luc_ext_ilu_fron_nebl_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_nebl_izq_o" name="luc_ext_ilu_fron_nebl_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>PLAFONES IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_plaf_izq" name="luc_ext_ilu_fron_plaf_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_plaf_izq" name="luc_ext_ilu_fron_plaf_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_plaf_izq_o" name="luc_ext_ilu_fron_plaf_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>SOPORTES DE FAROS IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_sopor_faro_izq" name="luc_ext_ilu_fron_sopor_faro_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_sopor_faro_izq" name="luc_ext_ilu_fron_sopor_faro_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_sopor_faro_izq_o" name="luc_ext_ilu_fron_sopor_faro_izq_o"></td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										
										
									</table>
									
									<br>
								</div>
                                <div class="col-md-6">
									
									<table width="100%;">
										
                                        <tr>
											<td align="center" colspan="4"><b>FAROS DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_far_der" name="luc_ext_ilu_fron_far_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_far_der" name="luc_ext_ilu_fron_far_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_far_der_o" name="luc_ext_ilu_fron_far_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                       
                                        <tr>
											<td align="center" colspan="4"><b>LUCES BAJAS DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_baj_der" name="luc_ext_ilu_fron_luc_baj_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_baj_der" name="luc_ext_ilu_fron_luc_baj_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_luc_baj_der_o" name="luc_ext_ilu_fron_luc_baj_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        
                                        <tr>
											<td align="center" colspan="4"><b>LUCES ALTAS DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_alt_der" name="luc_ext_ilu_fron_luc_alt_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_luc_alt_der" name="luc_ext_ilu_fron_luc_alt_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_luc_alt_der_o" name="luc_ext_ilu_fron_luc_alt_der_o"></td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>INTERMITENTES DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_inter_der" name="luc_ext_ilu_fron_inter_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_inter_der" name="luc_ext_ilu_fron_inter_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_inter_der_o" name="luc_ext_ilu_fron_inter_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>TORRETA DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_torr_der" name="luc_ext_ilu_fron_torr_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_torr_der" name="luc_ext_ilu_fron_torr_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_torr_der_o" name="luc_ext_ilu_fron_torr_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><b>ESTROBOS DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_estro_der" name="luc_ext_ilu_fron_estro_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_estro_der" name="luc_ext_ilu_fron_estro_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_estro_der_o" name="luc_ext_ilu_fron_estro_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        
                                        <tr>
											<td align="center" colspan="4"><b>NEBLINEROS DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_nebl_der" name="luc_ext_ilu_fron_nebl_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_nebl_der" name="luc_ext_ilu_fron_nebl_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_nebl_der_o" name="luc_ext_ilu_fron_nebl_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        
                                        <tr>
											<td align="center" colspan="4"><b>PLAFONES DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_plaf_der" name="luc_ext_ilu_fron_plaf_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_plaf_der" name="luc_ext_ilu_fron_plaf_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_plaf_der_o" name="luc_ext_ilu_fron_plaf_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
                                        
                                        <tr>
											<td align="center" colspan="4"><b>SOPORTES DE FAROS DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_sopor_faro_der" name="luc_ext_ilu_fron_sopor_faro_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_ext_ilu_fron_sopor_faro_der" name="luc_ext_ilu_fron_sopor_faro_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_ext_ilu_fron_sopor_faro_der_o" name="luc_ext_ilu_fron_sopor_faro_der_o"></td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#LATERALES_PRIMER_CARRO" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>LATERALES PRIMER CARRO</h5>
							</center>
						</div>
					</div>
					<div id="LATERALES_PRIMER_CARRO" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO INFERIOR IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_inf_izq" name="lat_pri_carr_plaf_inf_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_inf_izq" name="lat_pri_carr_plaf_inf_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_pri_carr_plaf_inf_izq_o" name="lat_pri_carr_plaf_inf_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO INFERIOR DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_inf_der" name="lat_pri_carr_plaf_inf_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_inf_der" name="lat_pri_carr_plaf_inf_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_pri_carr_plaf_inf_der_o" name="lat_pri_carr_plaf_inf_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO SUPERIOR IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_sup_izq" name="lat_pri_carr_plaf_sup_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_sup_izq" name="lat_pri_carr_plaf_sup_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_pri_carr_plaf_sup_izq_o" name="lat_pri_carr_plaf_sup_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO SUPERIOR DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_sup_der" name="lat_pri_carr_plaf_sup_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_pri_carr_plaf_sup_der" name="lat_pri_carr_plaf_sup_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_pri_carr_plaf_sup_der_o" name="lat_pri_carr_plaf_sup_der_o"></td>
										</tr>
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#LATERALES_SEGUNDO_CARRO" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>LATERALES SEGUNDO CARRO</h5>
							</center>
						</div>
					</div>
					<div id="LATERALES_SEGUNDO_CARRO" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO INFERIOR IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_inf_izq" name="lat_seg_carr_plaf_inf_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_inf_izq" name="lat_seg_carr_plaf_inf_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_seg_carr_plaf_inf_izq_o" name="lat_seg_carr_plaf_inf_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO INFERIOR DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_inf_der" name="lat_seg_carr_plaf_inf_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_inf_der" name="lat_seg_carr_plaf_inf_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_seg_carr_plaf_inf_der_o" name="lat_seg_carr_plaf_inf_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO SUPERIOR IZQUIERDOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_sup_izq" name="lat_seg_carr_plaf_sup_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_sup_izq" name="lat_seg_carr_plaf_sup_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_seg_carr_plaf_sup_izq_o" name="lat_seg_carr_plaf_sup_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PLAFONES LADO SUPERIOR DERECHOS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_sup_der" name="lat_seg_carr_plaf_sup_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="lat_seg_carr_plaf_sup_der" name="lat_seg_carr_plaf_sup_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="lat_seg_carr_plaf_sup_der_o" name="lat_seg_carr_plaf_sup_der_o"></td>
										</tr>
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#ILUMINACION_TRASERA" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>ILUMINACIÓN TRASERA</h5>
							</center>
						</div>
					</div>
					<div id="ILUMINACION_TRASERA" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>CALAVERAS IZQUIERDAS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_cala_izq" name="ilu_tras_cala_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_cala_izq" name="ilu_tras_cala_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_cala_izq_o" name="ilu_tras_cala_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>CALAVERAS DERECHAS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_cala_der" name="ilu_tras_cala_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_cala_der" name="ilu_tras_cala_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_cala_der_o" name="ilu_tras_cala_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>STOP IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_stop_izq" name="ilu_tras_stop_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_stop_izq" name="ilu_tras_stop_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_stop_izq_o" name="ilu_tras_stop_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>STOP DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_stop_der" name="ilu_tras_stop_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_stop_der" name="ilu_tras_stop_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_stop_der_o" name="ilu_tras_stop_der_o"></td>
										</tr>

                                        <tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>REVERSA IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_rever_izq" name="ilu_tras_rever_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_rever_izq" name="ilu_tras_rever_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_rever_izq_o" name="ilu_tras_rever_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>REVERSA DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_rever_der" name="ilu_tras_rever_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_rever_der" name="ilu_tras_rever_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_rever_der_o" name="ilu_tras_rever_der_o"></td>
										</tr><tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTERMITENTES IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_inter_izq" name="ilu_tras_inter_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_inter_izq" name="ilu_tras_inter_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_inter_izq_o" name="ilu_tras_inter_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTERMITENTES DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_inter_der" name="ilu_tras_inter_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_inter_der" name="ilu_tras_inter_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_inter_der_o" name="ilu_tras_inter_der_o"></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>SOPORTES DE CALAVERA IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_sop_cala_izq" name="ilu_tras_sop_cala_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_sop_cala_izq" name="ilu_tras_sop_cala_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_sop_cala_izq_o" name="ilu_tras_sop_cala_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>SOPORTES DE CALAVERA DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_sop_cala_der" name="ilu_tras_sop_cala_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="ilu_tras_sop_cala_der" name="ilu_tras_sop_cala_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="ilu_tras_sop_cala_der_o" name="ilu_tras_sop_cala_der_o"></td>
										</tr>
                                        
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#LUCES_INTERIORES" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>LUCES INTERIORES</h5>
							</center>
						</div>
					</div>
					<div id="LUCES_INTERIORES" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>LUCES DE CONDUCTOR</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_luc_cond" name="luc_int_luc_cond" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_luc_cond" name="luc_int_luc_cond" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_int_luc_cond_o" name="luc_int_luc_cond_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>LETREROS DE RUTA</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_letr_rut" name="luc_int_letr_rut" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_letr_rut" name="luc_int_letr_rut" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_int_letr_rut_o" name="luc_int_letr_rut_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>LETREROS DE 5 SEG.</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_letr_5_seg" name="luc_int_letr_5_seg" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_letr_5_seg" name="luc_int_letr_5_seg" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_int_letr_5_seg_o" name="luc_int_letr_5_seg_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>LUCES DE PUERTAS</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_luc_puer" name="luc_int_luc_puer" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_int_luc_puer" name="luc_int_luc_puer" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_int_luc_puer_o" name="luc_int_luc_puer_o"></td>
										</tr>

                                       
                                        
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>

            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#LUCES_PASILLO_PRIMER_CARRO" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>LUCES DE PASILLOS PRIMER CARRO</h5>
							</center>
						</div>
					</div>
					<div id="LUCES_PASILLO_PRIMER_CARRO" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>PRIMER PASO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_pri_paso_izq" name="luc_pasi_pri_carr_pri_paso_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_pri_paso_izq" name="luc_pasi_pri_carr_pri_paso_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_pri_carr_pri_paso_izq_o" name="luc_pasi_pri_carr_pri_paso_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PRIMER PASO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_pri_paso_der" name="luc_pasi_pri_carr_pri_paso_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_pri_paso_der" name="luc_pasi_pri_carr_pri_paso_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_pri_carr_pri_paso_der_o" name="luc_pasi_pri_carr_pri_paso_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>SEGUNDO PASO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_seg_paso_izq" name="luc_pasi_pri_carr_seg_paso_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_seg_paso_izq" name="luc_pasi_pri_carr_seg_paso_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_pri_carr_seg_paso_izq_o" name="luc_pasi_pri_carr_seg_paso_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>SEGUNDO PASO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_seg_paso_der" name="luc_pasi_pri_carr_seg_paso_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_pri_carr_seg_paso_der" name="luc_pasi_pri_carr_seg_paso_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_pri_carr_seg_paso_der_o" name="luc_pasi_pri_carr_seg_paso_der_o"></td>
										</tr>

                                       
                                        
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#LUCES_PASILLO_SEGUNDO_CARRO" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>LUCES DE PASILLOS SEGUNDO CARRO</h5>
							</center>
						</div>
					</div>
					<div id="LUCES_PASILLO_SEGUNDO_CARRO" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>PRIMER PASO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_pri_paso_izq" name="luc_pasi_seg_carr_pri_paso_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_pri_paso_izq" name="luc_pasi_seg_carr_pri_paso_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_seg_carr_pri_paso_izq_o" name="luc_pasi_seg_carr_pri_paso_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>PRIMER PASO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_pri_paso_der" name="luc_pasi_seg_carr_pri_paso_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_pri_paso_der" name="luc_pasi_seg_carr_pri_paso_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_seg_carr_pri_paso_der_o" name="luc_pasi_seg_carr_pri_paso_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>SEGUNDO PASO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_seg_paso_izq" name="luc_pasi_seg_carr_seg_paso_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_seg_paso_izq" name="luc_pasi_seg_carr_seg_paso_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_seg_carr_seg_paso_izq_o" name="luc_pasi_seg_carr_seg_paso_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>SEGUNDO PASO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_seg_paso_der" name="luc_pasi_seg_carr_seg_paso_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="luc_pasi_seg_carr_seg_paso_der" name="luc_pasi_seg_carr_seg_paso_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="luc_pasi_seg_carr_seg_paso_der_o" name="luc_pasi_seg_carr_seg_paso_der_o"></td>
										</tr>

                                       
                                        
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#ALINEACION" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>ALINEACIÓN</h5>
							</center>
						</div>
					</div>
					<div id="ALINEACION" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>ALINEACIÓN LUCES BAJAS IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_baj_izq" name="alin_alin_luc_baj_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_baj_izq" name="alin_alin_luc_baj_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="alin_alin_luc_baj_izq_o" name="alin_alin_luc_baj_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>ALINEACIÓN LUCES BAJAS DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_baj_der" name="alin_alin_luc_baj_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_baj_der" name="alin_alin_luc_baj_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="alin_alin_luc_baj_der_o" name="alin_alin_luc_baj_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>ALINEACIÓN LUCES ALTAS IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_alt_izq" name="alin_alin_luc_alt_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_alt_izq" name="alin_alin_luc_alt_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="alin_alin_luc_alt_izq_o" name="alin_alin_luc_alt_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>ALINEACIÓN LUCES ALTAS DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_alt_der" name="alin_alin_luc_alt_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_alt_der" name="alin_alin_luc_alt_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="alin_alin_luc_alt_der_o" name="alin_alin_luc_alt_der_o"></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>ALINEACIÓN NEBLINEROS IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_neb_izq" name="alin_alin_luc_neb_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_neb_izq" name="alin_alin_luc_neb_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="alin_alin_luc_neb_izq_o" name="alin_alin_luc_neb_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>ALINEACIÓN NEBLINEROS DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_neb_der" name="alin_alin_luc_neb_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="alin_alin_luc_neb_der" name="alin_alin_luc_neb_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="alin_alin_luc_neb_der_o" name="alin_alin_luc_neb_der_o"></td>
										</tr>

                                       
                                        
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
            <div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#INTENSIDAD_DE_ILUMINACION" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>INTENSIDAD DE ILUMINACIÓN</h5>
							</center>
						</div>
					</div>
					<div id="INTENSIDAD_DE_ILUMINACION" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>INTENSIDAD DE LUCES BAJAS IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_baj_izq" name="inte_inte_luc_baj_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_baj_izq" name="inte_inte_luc_baj_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="inte_inte_luc_baj_izq_o" name="inte_inte_luc_baj_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTENSIDAD DE LUCES BAJAS DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_baj_der" name="inte_inte_luc_baj_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_baj_der" name="inte_inte_luc_baj_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="inte_inte_luc_baj_der_o" name="inte_inte_luc_baj_der_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTENSIDAD DE LUCES ALTAS IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_alt_izq" name="inte_inte_luc_alt_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_alt_izq" name="inte_inte_luc_alt_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="inte_inte_luc_alt_izq_o" name="inte_inte_luc_alt_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTENSIDAD DE LUCES ALTAS DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_alt_der" name="inte_inte_luc_alt_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_luc_alt_der" name="inte_inte_luc_alt_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="inte_inte_luc_alt_der_o" name="inte_inte_luc_alt_der_o"></td>
										</tr>
                                        <tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTENSIDAD DE NEBLINEROS IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_nebl_izq" name="inte_inte_nebl_izq" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_nebl_izq" name="inte_inte_nebl_izq" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="inte_inte_nebl_izq_o" name="inte_inte_nebl_izq_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>INTENSIDAD DE NEBLINEROS DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Cambio</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_nebl_der" name="inte_inte_nebl_der" value="ok" ></td>
											<td align="center"><input type="radio" required class="form-control" id="inte_inte_nebl_der" name="inte_inte_nebl_der" value="cambio"></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="inte_inte_nebl_der_o" name="inte_inte_nebl_der_o"></td>
										</tr>
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>

        <div class="card">
            <div class="row">
                <div class="col-md-12"><br>
                    <center>
                        <input  type="submit" id="Registrar" name="Registrar" class="btn btn-success" value="Registrar" >
                    </center><br>
                </div>
            </div>

        </div>

        </form>
@section('jscustom')
<script type="text/javascript">
    
	$('#n_economico').select2();
	$('#n_supervisor').select2();
	$('#n_mecanico').select2();
	
	$('#n_economico').change(cambioEARTBUS);
	$(document).ready(function() {
		$('#km').on('input', function () {
			var inputValue = $(this).val().replace(/,/g, ''); 
			var intValue = parseInt(inputValue); 
			if (!isNaN(intValue)) {
				var formattedValue = intValue.toLocaleString();
				$(this).val(formattedValue);
			}
		});
		setTimeout(function() {
			cambioEARTBUS();
		}, 1000);
	});

	function cambioEARTBUS(){
		var economico=$('#n_economico').val();
		
		consultakm();
		if (economico == 89 || economico == 90 || economico == 91|| economico == 92|| economico == 93|| economico == 94|| economico == 95|| economico == 96|| economico == 97) {
			
			$('#ocultarhidro').hide();
			$('#balatas_eje_intermedio').hide();
			$('#neumaticos_eje_intermedio').hide();
			$('#aire_eje_intermedio').hide();
			$('#asi_carro_2').hide();
			$('#pasa_carro_2').hide();
			$('#articu').hide();
			$('#eje2').hide();
			$('#eje_int').hide();
			
		}else{
			$('#ocultarhidro').show();
			$('#balatas_eje_intermedio').show();
			$('#neumaticos_eje_intermedio').show();
			$('#aire_eje_intermedio').show();
			$('#asi_carro_2').show();
			$('#pasa_carro_2').show();
			$('#articu').show();
			$('#eje2').show();
			$('#eje_int').show();
		}

	}
	function consultakm()
	{
		var economico=$('#n_economico').val();
		$.ajax({
			url: '{{url("/Bitacora_De_Liberacion_De_Unidades/km")}}',
                method: 'get', // o 'GET' según corresponda
                data: {'economico': economico},
                success: function(response){
                	
                	if(response.length){
                		var kmEntradaFloat = parseFloat(response[0]['KmEntrada'].replace(/,/g, ''));

                		var kmEntradaInt = parseInt(kmEntradaFloat);

                		var formattedKmEntrada = kmEntradaInt.toLocaleString();

                		$('#km').val(formattedKmEntrada);
						$('#km').on('blur', function() {
							var inputValue = $('#km').val();
							var inputValues = parseFloat(inputValue.replace(/,/g, ''));
							console.log(inputValues);
							var minAllowedValue = kmEntradaFloat;
{{--
							if (parseInt(inputValues) < minAllowedValue) {
								$(this).val(formattedKmEntrada);
								alert('El valor mínimo permitido es '+kmEntradaFloat+'.');
							}
							--}}
						});
                	}
                	else
                	{
                		$('#km').val('');
                	}
                	
                },
                error: function(xhr, status, error){
                    console.error(error); // Manejar errores
                    $('#km').val('0');
                }
            });
	}

</script>
@endsection
</x-app-layout>
