<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }

    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-title"> Gestión de refacciones </div>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
            <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                {{ session('mensaje') }}.
            </div>
            @endif
            <form method="post" id="exampleValidation" action="{{url('/Bitacora_de_operaciones')}}">
                @csrf
                <div class="form-group row " >
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Codigo de refacción <span class="required-label">*</span></label>
                            <input required type="text" class="form-control input-with-border" id="dia" name="dia"  >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Nombre de la refacción <span class="required-label">*</span></label>
                            <input required type="text" class="form-control input-with-border" id="dia" name="dia"  >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Modelo de refacción <span class="required-label">*</span></label>
                            <input required type="text" class="form-control input-with-border" id="dia" name="dia"  >
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Familia  <span class="required-label">*</span></label>
                            <select required class="form-control input-with-border" id="familia" name="familia">
                                <option value="1">Salida 1</option>
                                <option value="2">Llegada 1 / Salida 2</option>
                                <option value="4">Llegada 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" id="valida_completo">
                        <div class="form-group form-group-default">
                            <label>Descripción  <span class="required-label">*</span></label>
                            <select required class="form-control input-with-border" id="descripcion" name="descripcion">
                                <option value="1">Salida 1</option>
                                <option value="2">Llegada 1 / Salida 2</option>
                                <option value="4">Llegada 2</option>
                            </select>
                        </div> 
                    </div> 
                    <div class="col-md-2" id="valida_mitad_1" hidden >
                        <div class="form-group form-group-default">
                            <label>Marca <span class="required-label">*</span></label>
                            <select required class="form-control input-with-border" id="marca" name="marca">
                                <option value="1">Salida 1</option>
                                <option value="2">Llegada 1 / Salida 2</option>
                                <option value="4">Llegada 2</option>
                            </select>
                        </div> 
                    </div> 
                    <div class="col-md-2" id="valida_mitad_2" hidden>
                        <div class="form-group form-group-default">
                            <label>Proveedor <span class="required-label">*</span></label>
                            <select required class="form-control input-with-border" id="proveedor" name="proveedor">
                                <option value="1">Salida 1</option>
                                <option value="2">Llegada 1 / Salida 2</option>
                                <option value="4">Llegada 2</option>
                            </select>
                        </div> 
                    </div> 
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Costo unitario <span class="required-label">*</span></label>
                            <input required type="text"   class="form-control input-with-border" id="costo_unitario" name="costo_unitario">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Moneda</label>
                            <select required   class="form-control input-with-border" id="moneda" name="moneda">
                             
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Folio de factura</label>
                            <input required type="text"   class="form-control input-with-border" id="costo_unitario" name="costo_unitario">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Empresa</label>
                            <select required   class="form-control input-with-border" id="terminal_c" name="terminal">
                             
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Pasillo</label>
                            <select required   class="form-control input-with-border" id="terminal_c" name="terminal">
                             
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Nivel</label>
                            <select required   class="form-control input-with-border" id="terminal_c" name="terminal">
                             
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Anaquel</label>
                            <select required   class="form-control input-with-border" id="terminal_c" name="terminal">
                             
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Charola</label>
                            <select required   class="form-control input-with-border" id="terminal_c" name="terminal">
                             
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Cantidad de ingreso a almacén</label>
                            <input required type="text"   class="form-control input-with-border" id="cantidad_ingreso" name="cantidad_ingreso">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Notificación de media de refacción</label>
                            <input required type="text"   class="form-control input-with-border" id="media" name="media">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Notificación de reabastecimiento de refacción</label>
                            <input required type="text"   class="form-control input-with-border" id="minimo" name="minimo">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Observación</label>
                            <textarea required   class="form-control input-with-border" id="observacion" name="observacion"></textarea>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>




    @section('jscustom')
    <script type="text/javascript">
        
        
        
    </script>
    @endsection
</x-app-layout>
