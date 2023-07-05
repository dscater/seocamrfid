<div class="modal fade" id="m_materiales_obras">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Lista de Materiales en Obras</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.materiales_obras', 'method' => 'get', 'target' => '_blank', 'id' => 'formmateriales_obras']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Seleccione:</label>
                            <select name="obra" id="obra" class="form-control" required>
                                <option value="todos">Todos</option>
                                @foreach ($obras as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnmateriales_obras">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
