
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
                        <h3 class="card-title">Roles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {{--  Si el registro no esta vacio (enviado un registro por el controlador), la ruta sera de editar, si no, sera de crear --}}
                        <form action="{{ isset($registro) ? route('roles.update', $registro->id) : route('roles.store')}}" method="POST" id="formRegistroUsuario">
                            @csrf
                            @if (isset($registro))
                                @method('PUT') {{-- Si el registro existe, se usara PUT para actualizarlo --}}
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ingrese un rol" required value="{{ old('name', $registro->name??'') }}">
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

                                    <label class="form-label">Permisos:</label><br>
                                    @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" id="permiso_{{ $permission->id }}" value="{{ $permission->name }}" 
                                            {{ isset($registro) && $registro->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permiso_{{ $permission->id }}">
                                            {{-- Si el registro existe y tiene el permiso, lo marca como checked, Si no, lo deja sin marcar --}}
                                            {{ ucfirst($permission->name) }}
                                            {{-- Capitaliza el primer carácter del nombre del permiso para mostrarlo más amigable --}}
                                        </label>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary me-md-2" onclick="window.location.href='{{ route('roles.index') }}'">Cancelar</button>
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
    document.getElementById('itemRole').classList.add('active');
</script>
@endpush