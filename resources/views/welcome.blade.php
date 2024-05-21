<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Proyecto
          <select >
            <option>Pinos</option>
            <option>Pinos 2</option>
            <option>Pinos 3</option>
            </select>
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
									<div class="card-title">Proyecto Pinos</div>
								</div>
								<div class="card-body">
                                    
                        @if( Auth::user()->tipo_usuario == 1)
								    <table class="default">
									<tr >
									    <td style="border: 1px green solid; background-color:green;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        Financiado y Contado
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px red solid; background-color:red;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        No disponible
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px blue solid; background-color:blue;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
                                            Vendido
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px yellow solid; background-color:yellow;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        Liquidado
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px orange solid; background-color:orange;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        Proceso de rescisión
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px #D733FF solid; background-color:#D733FF;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        Apartado
									    </td>
									</tr>
									</table>
                                    @elseif (Auth::user()->tipo_usuario == 2)
                                    <table class="default">
									<tr >
									    <td style="border: 1px green solid; background-color:green;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        Financiado y Contado
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px red solid; background-color:red;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        No disponible
									    </td>
									</tr>
									
									
									</table>
                        @elseif (Auth::user()->tipo_usuario == 3)
                                    <table class="default">
									<tr >
									    <td style="border: 1px green solid; background-color:green;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        Financiado y Contado
									    </td>
									</tr>
									<tr >
									    <td style="border: 1px red solid; background-color:red;">
									       &nbsp; &nbsp; &nbsp; &nbsp;
									    </td>
									    <td >
									        No disponible
									    </td>
									</tr>
									
									
									</table>
                        @endif
                                <div id="map"></div>
								</div>
								
							</div>
                        </div>
    

    <!-- Modal -->
    <div class="modal" id="ficha_tec" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ficha técnica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"id="llenar">
                
                </div>
                <div class="modal-footer" id="footer">
                  
                    
                    
           
                </div>
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

        function ActivarDesplegable (){
            $(".dropdown-menu").dropdown('toggle')
        }
        var map = L.map('map').setView([19.579009000070574, -99.09454396887394], 15);
    var bounds = new L.LatLngBounds();

    <?php $i=1; ?>
    @foreach($proyectos as $proyecto)
        var latlngs{{$i}} = [
            @if($proyecto->c1 != null)
                [{{$proyecto->c1}}],
            @endif
            @if($proyecto->c2 != null)
                [{{$proyecto->c2}}],
            @endif
            @if($proyecto->c3 != null)
                [{{$proyecto->c3}}],
            @endif
            @if($proyecto->c4 != null)
                [{{$proyecto->c4}}],
            @endif
            @if($proyecto->c5 != null)
                [{{$proyecto->c5}}],
            @endif
        ];
        
        var polygon{{$i}} = L.polygon(latlngs{{$i}}, { color: 
            @if (Auth::user()->tipo_usuario == 1)
                @if($proyecto->estatus=="Vendido")
                'blue'
                @elseif($proyecto->estatus=="Financiado")
                'green'
                @elseif($proyecto->estatus=="Liquidado")
                'yellow'
                @elseif($proyecto->estatus=="Apartado")
                'purple'
                @elseif($proyecto->estatus=="Proceso de rescisión")
                'orange'
                
                @elseif($proyecto->estatus=="No disponible")
                'red'
                
                @else
                
                'yellow'
                @endif
            @elseif(Auth::user()->tipo_usuario == 2)
                @if($proyecto->estatus=="Vendido" || $proyecto->estatus=="Apartado" || $proyecto->estatus=="Liquidado" || $proyecto->estatus=="No disponible" || $proyecto->estatus=="Proceso de rescisión")
                'red'
                @elseif($proyecto->estatus=="Financiado")
                'green'
                @else
                'yellow'
                @endif
           
            @elseif (Auth::user()->tipo_usuario == 3)   
                @if($proyecto->estatus=="Vendido" || $proyecto->estatus=="Apartado" || $proyecto->estatus=="Liquidado" || $proyecto->estatus=="No disponible" || $proyecto->estatus=="Proceso de rescisión")
                'red'
                @elseif($proyecto->estatus=="Financiado")
                'green'
                @else
                'yellow'
                @endif
            @endif
            
         }).addTo(map);
        
        // Agregar evento de clic al polígono
        polygon{{$i}}.on('click', function () {
            $('#ficha_tec').modal('show');
            var html="";
            @if(Auth::user()->tipo_usuario == 1)
                
                html +=  '<div class="form-group form-group-default"><label>Mz</label><input id="Mz" type="text" value="';
                @if($proyecto->mz != null)
                html+='{{$proyecto->mz}}';
                @endif
                html+='"  class="form-control"></div>';
                
                html +=  '<div class="form-group form-group-default"><label>Lote</label><input id="lt" type="text" value="';
                @if($proyecto->lt != null)
                html+='{{$proyecto->lt}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>superficie</label><input id="superficie" type="text" value="';
                @if($proyecto->superficie != null)
                html+='{{$proyecto->superficie}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>Medidas</label><input id="Medidas" type="text" value="';
                @if($proyecto->Medidas != null)
                html+='{{$proyecto->Medidas}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>ValorCompra</label><input id="ValorCompra" type="text" value="';
                @if($proyecto->ValorCompra != null)
                html+='{{$proyecto->ValorCompra}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>enganche</label><input id="enganche" type="text" value="';
                @if($proyecto->enganche != null)
                html+='{{$proyecto->enganche}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>anualidad</label><input id="anualidad" type="text" value="';
                @if($proyecto->anualidad != null)
                html+='{{$proyecto->anualidad}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>plazo</label><input id="plazo" type="text" value="';
                @if($proyecto->plazo != null)
                html+='{{$proyecto->plazo}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>servicioluz</label><input id="servicioluz" type="text" value="';
                @if($proyecto->servicioluz != null)
                html+='{{$proyecto->servicioluz}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>servicioagua</label><input id="servicioagua" type="text" value="';
                @if($proyecto->servicioagua != null)
                html+='{{$proyecto->servicioagua}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>serviciodrenaje</label><input id="serviciodrenaje" type="text" value="';
                @if($proyecto->serviciodrenaje != null)
                html+='{{$proyecto->serviciodrenaje}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>Localización</label><input id="Localización" type="text" value="';
                @if($proyecto->Localización != null)
                html+='{{$proyecto->Localización}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>estatus</label><select id="estatus" class="form-control">';
                @if($proyecto->estatus != null)
                    @foreach($situaciones as $situacion)
                        html+='<option value="{{$situacion->id_situacion}}" ';
                            @if($proyecto->estatus==$situacion->situacion)
                            ' selected '
                            @endif
                        html+='>{{$situacion->situacion}}</option>';
                    
                    @endforeach
                @endif
                html+=' </select> </div>';

                html +=  '<div class="form-group form-group-default"><label>TipoVenta</label><input id="TipoVenta" type="text" value="';
                @if($proyecto->TipoVenta != null)
                html+='{{$proyecto->TipoVenta}}';
                @endif
                html+='"  class="form-control"></div>';
                
                html +=  '<div class="form-group form-group-default"><label>Costo Contado</label><input id="CostoContado" type="text" value="';
                @if($proyecto->CostoContado != null)
                html+='{{$proyecto->CostoContado}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>Costo Contado Total</label><input id="CostoContadoTotal" type="text" value="';
                @if($proyecto->CostoContadoTotal != null)
                html+='{{$proyecto->CostoContadoTotal}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>Costo Financiado</label><input id="CostoFinanciado" type="text" value="';
                @if($proyecto->CostoFinanciado != null)
                html+='{{$proyecto->CostoFinanciado}}';
                @endif
                html+='"  class="form-control"></div>';

                
                html +=  '<div class="form-group form-group-default"><label>Costo Financiado Total</label><input id="CostoFinanciadoTotal" type="text" value="';
                @if($proyecto->CostoFinanciadoTotal != null)
                html+='{{$proyecto->CostoFinanciadoTotal}}';
                @endif
                html+='"  class="form-control"></div>';

                html +=  '<div class="form-group form-group-default"><label>NoAnualidad</label><input id="NoAnualidad" type="text" value="';
                @if($proyecto->NoAnualidad != null)
                html+='{{$proyecto->NoAnualidad}}';
                @endif
                html+='"  class="form-control"></div>';

            @elseif(Auth::user()->tipo_usuario == 2)
            @if($proyecto->mz != null)
                html +=  '<div class="form-group form-group-default"><label>Mz</label><input id="Mz" type="text" value="{{$proyecto->mz}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->lt != null)
                html +=  '<div class="form-group form-group-default"><label>Lote</label><input id="lt" type="text" value="{{$proyecto->lt}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->superficie != null)
                html +=  '<div class="form-group form-group-default"><label>superficie</label><input id="superficie" type="text" value="{{$proyecto->superficie}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->Medidas != null)
                html +=  '<div class="form-group form-group-default"><label>Medidas</label><input id="Medidas" type="text" value="{{$proyecto->Medidas}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->ValorCompra != null)
                html +=  '<div class="form-group form-group-default"><label>ValorCompra</label><input id="ValorCompra" type="text" value="{{$proyecto->ValorCompra}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->enganche != null)
                html +=  '<div class="form-group form-group-default"><label>enganche</label><input id="enganche" type="text" value="{{$proyecto->enganche}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->anualidad != null)
                html +=  '<div class="form-group form-group-default"><label>anualidad</label><input id="anualidad" type="text" value="{{$proyecto->anualidad}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->plazo != null)
                html +=  '<div class="form-group form-group-default"><label>plazo</label><input id="plazo" type="text" value="{{$proyecto->plazo}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->servicioluz != null)
                html +=  '<div class="form-group form-group-default"><label>servicioluz</label><input id="servicioluz" type="text" value="{{$proyecto->servicioluz}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->servicioagua != null)
                html +=  '<div class="form-group form-group-default"><label>servicioagua</label><input id="servicioagua" type="text" value="{{$proyecto->servicioagua}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->serviciodrenaje != null)
                html +=  '<div class="form-group form-group-default"><label>serviciodrenaje</label><input id="serviciodrenaje" type="text" value="{{$proyecto->serviciodrenaje}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->Localización != null)
                html +=  '<div class="form-group form-group-default"><label>Localización</label><input id="Localización" type="text" value="{{$proyecto->Localización}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->estatus != null)
                    @if($proyecto->estatus == "Financiado" || $proyecto->estatus == "Contado")
                    html +=  '<div class="form-group form-group-default"><label>estatus</label><input id="estatus" type="text" value="{{$proyecto->estatus}}" disabled class="form-control"></div>';
                    @else
                    html +=  '<div class="form-group form-group-default"><label>estatus</label><input id="estatus" type="text" value="No disponible" disabled class="form-control"></div>';
                    @endif 
                @endif
                @if($proyecto->TipoVenta != null)
                html +=  '<div class="form-group form-group-default"><label>TipoVenta</label><input id="TipoVenta" type="text" value="{{$proyecto->TipoVenta}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoContado != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Contado</label><input id="CostoContado" type="text" value="{{$proyecto->CostoContado}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoContadoTotal != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Contado Total</label><input id="CostoContadoTotal" type="text" value="{{$proyecto->CostoContadoTotal}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoFinanciado != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Financiado</label><input id="CostoFinanciado" type="text" value="{{$proyecto->CostoFinanciado}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoFinanciadoTotal != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Financiado Total</label><input id="CostoFinanciadoTotal" type="text" value="{{$proyecto->CostoFinanciadoTotal}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->NoAnualidad != null)
                html +=  '<div class="form-group form-group-default"><label>NoAnualidad</label><input id="NoAnualidad" type="text" value="{{$proyecto->NoAnualidad}}" disabled class="form-control"></div>';
                @endif
            @elseif(Auth::user()->tipo_usuario == 3)
            @if($proyecto->mz != null)
                html +=  '<div class="form-group form-group-default"><label>Mz</label><input id="Mz" type="text" value="{{$proyecto->mz}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->lt != null)
                html +=  '<div class="form-group form-group-default"><label>Lote</label><input id="lt" type="text" value="{{$proyecto->lt}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->superficie != null)
                html +=  '<div class="form-group form-group-default"><label>superficie</label><input id="superficie" type="text" value="{{$proyecto->superficie}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->Medidas != null)
                html +=  '<div class="form-group form-group-default"><label>Medidas</label><input id="Medidas" type="text" value="{{$proyecto->Medidas}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->ValorCompra != null)
                html +=  '<div class="form-group form-group-default"><label>ValorCompra</label><input id="ValorCompra" type="text" value="{{$proyecto->ValorCompra}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->enganche != null)
                html +=  '<div class="form-group form-group-default"><label>enganche</label><input id="enganche" type="text" value="{{$proyecto->enganche}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->anualidad != null)
                html +=  '<div class="form-group form-group-default"><label>anualidad</label><input id="anualidad" type="text" value="{{$proyecto->anualidad}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->plazo != null)
                html +=  '<div class="form-group form-group-default"><label>plazo</label><input id="plazo" type="text" value="{{$proyecto->plazo}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->servicioluz != null)
                html +=  '<div class="form-group form-group-default"><label>servicioluz</label><input id="servicioluz" type="text" value="{{$proyecto->servicioluz}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->servicioagua != null)
                html +=  '<div class="form-group form-group-default"><label>servicioagua</label><input id="servicioagua" type="text" value="{{$proyecto->servicioagua}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->serviciodrenaje != null)
                html +=  '<div class="form-group form-group-default"><label>serviciodrenaje</label><input id="serviciodrenaje" type="text" value="{{$proyecto->serviciodrenaje}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->Localización != null)
                html +=  '<div class="form-group form-group-default"><label>Localización</label><input id="Localización" type="text" value="{{$proyecto->Localización}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->estatus != null)
                    @if($proyecto->estatus == "Financiado" || $proyecto->estatus == "Contado")
                    html +=  '<div class="form-group form-group-default"><label>estatus</label><input id="estatus" type="text" value="{{$proyecto->estatus}}" disabled class="form-control"></div>';
                    @else
                    html +=  '<div class="form-group form-group-default"><label>estatus</label><input id="estatus" type="text" value="No disponible" disabled class="form-control"></div>';
                    @endif 
                @endif
                @if($proyecto->TipoVenta != null)
                html +=  '<div class="form-group form-group-default"><label>Tipo de venta</label><input id="TipoVenta" type="text" value="{{$proyecto->TipoVenta}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoContado != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Contado</label><input id="CostoContado" type="text" value="{{$proyecto->CostoContado}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoContadoTotal != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Contado Total</label><input id="CostoContadoTotal" type="text" value="{{$proyecto->CostoContadoTotal}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoFinanciado != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Financiado</label><input id="CostoF inanciado" type="text" value="{{$proyecto->CostoFinanciado}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->CostoFinanciadoTotal != null)
                html +=  '<div class="form-group form-group-default"><label>Costo Financiado Total</label><input id="CostoFinanciadoTotal" type="text" value="{{$proyecto->CostoFinanciadoTotal}}" disabled class="form-control"></div>';
                @endif
                @if($proyecto->NoAnualidad != null)
                html +=  '<div class="form-group form-group-default"><label>NoAnualidad</label><input id="NoAnualidad" type="text" value="{{$proyecto->NoAnualidad}}" disabled class="form-control"></div>';
                @endif
            
            @endif
            $('#llenar').html(html);
            var html2 = '  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>';
            
            @if(Auth::user()->tipo_usuario == 1)
            html2 += ' <input type="submit" class="btn btn-success"  data-dismiss="modal" value="Actualizar" id="Actualizar"  name="Actualizar">';
                    
                    @elseif(Auth::user()->tipo_usuario == 2)
                    
            html2 += ' <button type="button" class="btn btn-success" data-dismiss="modal">Apartar</button>';
                   
                    
                    @elseif(Auth::user()->tipo_usuario == 3)
                    
            html2 += ' <a target="_blank" class="btn btn-success"'+
            'href="https://api.whatsapp.com/send?phone=5582373092&text=Me intereza la Mz:{{$proyecto->mz}}, Lt:{{$proyecto->lt}},del proyecto Pinos"'
            +'>Estoy interesado</a>';
                    
                    @endif 
            $('#footer').html(html2);
            
        });

        // Extender los límites para incluir el polígono actual
        bounds.extend(polygon{{$i}}.getBounds());

        <?php $i++; ?>
    @endforeach

    // Ajustar el límite del mapa para incluir todos los polígonos
    map.fitBounds(bounds);
    </script>
</body>
        </div>
    </div>
   
  
</x-app-layout>
