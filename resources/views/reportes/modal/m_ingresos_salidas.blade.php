<div class="modal fade" id="m_ingresos_salidas">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Lista de Ingresos y Salidas de Materiales</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.ingresos_salidas', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formingresos_salidas']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select class="form-control" name="filtro" id="filtro">
                                <option value="todos">Todos</option>
                                <option value="obra">Por Obra</option>
                                <option value="fecha">Rango de Fechas</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione Obra:</label>
                            <select class="form-control" name="obra" id="obra">
                                <option value="todos">Todos</option>
                                @foreach ($obras as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha inicio:</label>
                            <input type="date" name="fecha_ini" id="fecha_ini" value="{{date('Y-m-d')}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha fin:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" value="{{date('Y-m-d')}}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnUsuarios">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
