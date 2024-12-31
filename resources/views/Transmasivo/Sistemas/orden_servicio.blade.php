<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Orden de servicio</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
                <div class="form-group row " >
                    <div class="col-md-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del solicitante" required>
                    </div>
                    <div class="col-md-3">
                        <label for="credencial" class="form-label">Credencial</label>
                        <input type="text" class="form-control" id="credencial" name="credencial" placeholder="Número de credencial" required>
                    </div>
                    <div class="col-md-3">
                        <label for="area" class="form-label">Área</label>
                        <input type="text" class="form-control" id="area" name="area" placeholder="Área solicitante" required>
                    </div>
                    <div class="col-md-3">
                        <label for="descripcion" class="form-label">Descripción del servicio</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Describe el servicio solicitado" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <center>
                            <label for="signature" class="form-label"><br>Firma del solicitante</label><br>
                            <canvas id="signature-pad" width="300" height="200" style="border: 1px solid #000;"></canvas>
                            <button type="button" id="clear" class="btn btn-warning btn-sm mt-2">Limpiar</button>
                        </center>
                    </div>
				</div>
		</div>
        <div class="card-footer">
            <center>
                    <input type="submit" id="generar" name="generar" value="Generar" class="btn btn-primary">
            </center>
		</div>
	</div>




@section('jscustom')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script type="text/javascript">
	const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas);

    document.getElementById('clear').addEventListener('click', () => {
        signaturePad.clear();
    });

    document.getElementById('serviceOrderForm').addEventListener('submit', (e) => {
        e.preventDefault();

        if (signaturePad.isEmpty()) {
            alert('Por favor, firma la orden antes de guardar.');
            return;
        }

        const formData = new FormData(e.target);
        formData.append('signature', signaturePad.toDataURL());

        fetch('/orden-servicio', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Orden de servicio guardada correctamente.');
                location.reload();
            } else {
                alert('Error al guardar la orden.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al procesar la solicitud.');
        });
    });
	
</script>
@endsection
</x-app-layout>
