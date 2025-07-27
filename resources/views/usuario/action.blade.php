
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
                        <h3 class="card-title">Usuarios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {{--  Si el registro no esta vacio (enviado un registro por el controlador), la ruta sera de editar, si no, sera de crear --}}
                        <form action="{{ isset($registro) ? route('usuarios.update', $registro->id) : route('usuarios.store')}}" method="POST" id="formRegistroUsuario">
                            @csrf
                            @if (isset($registro))
                                @method('PUT') {{-- Si el registro existe, se usara PUT para actualizarlo --}}
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ingrese su nombre" required value="{{ old('name', $registro->name??'') }}">
                                    {{-- 
                                        Dame el valor viejo del campo name si existe (old('name')).
                                        Si no hay valor viejo, usa $registro->name.
                                        Y si tampoco existe $registro->name, usa '' (vacío).

                                        El operador ?? se llama null coalescing en PHP, y se usa para decir:
                                        “Si la variable a la izquierda existe y no es null, úsala; si no, usa la de la derecha.”
                                        Por eso, $registro->name ?? '' significa:
                                        “Si $registro->name existe, úsalo; si no, usa cadena vacía.”
                                    --}}

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Ingrese su email" required value="{{ old('email', $registro->email??'') }}">

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Ingrese su contraseña" required value="{{ old('password') }}">

                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" id="activo" name="activo" required>
                                        <option value="" disabled selected>Seleccione un estado</option>

                                        <option value="1" {{ old('activo', $registro->activo ?? '1') == '1' ? 'selected' : ''}}>Activo</option>
                                        <option value="0" {{ old('activo', $registro->activo ?? '1') == '0' ? 'selected' : ''}}>Inactivo</option>
                                        {{-- 
                                            Dame el valor viejo del campo activo si existe (old('activo')).
                                            Si no hay valor viejo, usa $registro->activo.
                                            Y si tampoco existe $registro->activo, usa '1' (por defecto).
                                            Si el resultado es igual a '1', marca esta opción como selected.
                                            Si no, no pongas nada.
                                        --}}
                                        
                                    </select>

                                    @error('activo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary me-md-2" onclick="window.location.href='{{ route('usuarios.index') }}'">Cancelar</button>
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
    document.getElementById('mnuSeguridad').classList.add('menu-open');
    document.getElementById('itemUsuario').classList.add('active');
</script>
@endpush