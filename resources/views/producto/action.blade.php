
@extends('plantilla.app') {{-- Extiende de la plantilla base app.blade.php --}}
@section('contenido') {{-- Se agrega contenido a la sección 'contenido' de la plantilla base --}}

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {{--  Si el registro no esta vacio (enviado un registro por el controlador), la ruta sera de editar, si no, sera de crear --}}
                        <form action="{{ isset($registro) ? route('productos.update', $registro->id) : route('productos.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($registro))
                                @method('PUT') {{-- Si el registro existe, se usara PUT para actualizarlo --}}
                            @endif
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="codigo" class="form-label">Codigo</label>
                                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" required value="{{ old('codigo', $registro->codigo??'') }}">
                                    {{-- 
                                        Dame el valor viejo del campo name si existe (old('name')).
                                        Si no hay valor viejo, usa $registro->name.
                                        Y si tampoco existe $registro->name, usa '' (vacío).

                                        El operador ?? se llama null coalescing en PHP, y se usa para decir:
                                        “Si la variable a la izquierda existe y no es null, úsala; si no, usa la de la derecha.”
                                        Por eso, $registro->name ?? '' significa:
                                        “Si $registro->name existe, úsalo; si no, usa cadena vacía.”
                                    --}}

                                    @error('codigo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required value="{{ old('nombre', $registro->nombre??'') }}">

                                    @error('nombre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" required value="{{ old('precio', $registro->precio??'') }}">

                                    @error('precio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-8 mb-3">
                                    <label for="descripcion" class="form-label">Descripcion</label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $registro->descripcion ?? '') }}</textarea>

                                    @error('descripcion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="imagen" class="form-label">Imagen</label>
                                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" value="{{ old('imagen') }}">

                                    @error('imagen')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if(isset($registro) && $registro->imagen)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/productos/' . $registro->imagen) }}" alt="Imagen actual" style="max-width: 150px; height: auto; border-radius:8px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary me-md-2" onclick="window.location.href='{{ route('productos.index') }}'">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->

                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('mnuAlmacen').classList.add('menu-open');
    document.getElementById('itemProducto').classList.add('active');
</script>
@endpush