@extends('layouts.admin')
@section('contenido')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Habitación {{ $habitacion->numero }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('habitacion.update', $habitacion->id) }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <input type="text" class="form-control" name="tipo" id="tipo" value="{{ $habitacion->tipo }}" placeholder="Ingresa el tipo de habitación">
                        </div>
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" name="numero" id="numero" value="{{ $habitacion->numero }}" placeholder="Ingresa el número de la habitación">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" name="precio" id="precio" value="{{ $habitacion->precio }}" placeholder="Ingresa el precio de la habitación">
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="fotografia">Fotografía</label>
                                <input type="file" class="form-control" name="fotografia" id="fotografia">
                                @if (($habitacion->fotografia)!="")
                                <img src="{{ asset('imagenes/habitaciones/'.$habitacion->fotografia) }}" alt="{{ $habitacion->numero }}" height="100" width="100px" class="img-thumbnail">
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                            <button onclick="window.location.href='{{ route('habitacion.index') }}'" type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                        </div>
                    </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->
@endsection
