<div class="form-group row">          
    @php $i = 1; @endphp 
    <div class="form-group form-show-validation row">
    @foreach ($c_reporte as $c_report)
        <label class="col-lg-12 col-md-3 col-sm-4 mt-sm-2 text-left">{{ $c_report->id_c_reporte }}.-{{ $c_report->reporte }} </label>
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex">
            <div class="custom-control custom-radio">
                <input type="radio" id="{{ $c_report->id_c_reporte }}_ok" name="{{ $c_report->id_c_reporte }}" value="ok" class="custom-control-input"
                    {{ (isset($form_data[$c_report->id_c_reporte]) && $form_data[$c_report->id_c_reporte] == 'ok') ? 'checked' : '' }}>
                <label class="custom-control-label" for="{{ $c_report->id_c_reporte }}_ok">Ok </label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="{{ $c_report->id_c_reporte }}_mal" name="{{ $c_report->id_c_reporte }}" value="mal" class="custom-control-input"
                    {{ (isset($form_data[$c_report->id_c_reporte]) && $form_data[$c_report->id_c_reporte] == 'mal') ? 'checked' : '' }}>
                <label class="custom-control-label" for="{{ $c_report->id_c_reporte }}_mal">Mal</label>
            </div>
            <div class="custom-control" style="width:500px;">
                <textarea id="{{ $c_report->id_c_reporte }}_obs" name="{{ $c_report->id_c_reporte }}_obs" style="width:60%;">{{ $form_data[$c_report->id_c_reporte.'_obs'] ?? '' }}</textarea>
            </div>
        </div>         
        <hr>
        @php $i++; @endphp 
    @endforeach
    </div>
    
</div>

<div class="pagination-wrapper">
    {{ $c_reporte->links() }} <!-- Añadir enlaces de paginación -->
</div>