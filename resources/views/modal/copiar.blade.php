<div class="modal fade" id="modal-copiar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="txtTituloCopiar">Copiar registro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="w-100 text-center"id="mensajeCopiar"></p>
                <form action="" method="POST" id="formCopiar">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Ingresar un nombre:</label>
                            <input type="text" class="form-control" id="txtNombre" name="nombre" required>
                        </div>
                    </div>
                </form>
                <p class="mb-0"><strong>Nota:</strong><br>La copia a realizarse sera de:</p>
                <ol>
                    <li>La Obra</li>
                    <li>Solicitud de Materiales</li>
                    <li>Solicitud de Herramientas (Tomar en cuenta si una herramienta esta asignada en una obra no se
                        copiara el registro) </li>
                    <li>Solicitud de Personal</li>
                    <li>Notas</li>
                </ol>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, cancelar</button>
                <button type="button" class="btn btn-primary" id="btnCopiar">Si, copiar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
