
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
                        <div>
                            <form action="{{ route('roles.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="texto" type="text" class="form-control" value="{{ $texto }}" placeholder="Ingrese texto a buscar">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Nuevo</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if (Session::has('mensaje'))
                            <div class="alert alert-info alert-dismissible fade-show mt-2">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 150px">Opciones</th>
                                        <th style="width: 20px">ID</th>
                                        <th>Nombre</th>
                                        <th>Permisos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($registros) <= 0)
                                        <tr>
                                            <td colspan="4">No hay registros que coincidan con la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ( $registros as $reg )
                                            <tr class="align-middle">
                                                <td>
                                                    <a href="{{ route('roles.edit', $reg->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-fill"></i></a>&nbsp; {{-- BOTON DEDITAR --}}

                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}"><i class="bi bi-trash-fill"></i>
                                                    </button> {{-- BOTON ELIMINAR --}}

                                                </td>
                                                <td>{{ $reg->id }}</td>
                                                <td>
                                                    {{ $reg->name }}
                                                </td>
                                                <td>
                                                    @if ($reg->permissions->isNotEmpty())
                                                        {!! $reg->permissions->pluck('name')->map(function($name) {
                                                            return "<span class='badge bg-primary me-1'>{$name}</span>";
                                                        })->implode(' ') !!}
                                                    @else
                                                        <span class="badge bg-secondary">Sin permisos</span>
                                                    @endif
                                                </td>

                                                {{-- 
                                                        Verifica si el usuario tiene permisos asignados.

                                                        $reg->permissions->isNotEmpty():
                                                        Comprueba si la colección de permisos no está vacía.
                                                        Es decir, si el usuario tiene al menos un permiso asignado.

                                                        Si tiene permisos:
                                                            - $reg->permissions->pluck('name'):
                                                                Extrae solo los nombres de los permisos en una colección nueva.
                                                                Por ejemplo, si tiene permisos ["crear", "editar"], esto devuelve ["crear", "editar"].

                                                            - ->map(function($name) { ... }):
                                                                Recorre cada nombre de permiso y le da formato HTML.
                                                                En este caso, envuelve cada nombre en un <span> con clases de Bootstrap para que se vea como una etiqueta (badge).
                                                                Por ejemplo: "crear" se convierte en <span class='badge bg-primary me-1'>crear</span>.

                                                            - ->implode(' '):
                                                                Une todos los <span> generados en un solo string, separados por espacio.
                                                                Por ejemplo: <span>crear</span> <span>editar</span>

                                                            - {!! !!}:
                                                                Imprime el resultado sin escapar el HTML.
                                                                Si usaras {{ }}, se mostraría el código HTML como texto.
                                                                Con {!! !!}, se renderizan correctamente los <span>.

                                                        Si NO tiene permisos:
                                                            - Se muestra un <span> gris con el texto "Sin permisos".
                                                --}}
                                            </tr>
                                            @include('role.delete')
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $registros->appends(["texto"=> $texto]) }}
                        {{-- El {{ $registros->appends(["texto"=> $texto]) }} lo que hace es que al paginar los resultados, haciendo que se mantenga el texto de búsqueda en la URL, preservando el filtro en la url --}}
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