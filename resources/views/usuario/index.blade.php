
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
                        <div>
                            <form action="{{ route('usuarios.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="texto" type="text" class="form-control" value="{{ $texto }}" placeholder="Ingrese texto a buscar">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo</a>
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
                                        <th>Email</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($registros) <= 0)
                                        <tr>
                                            <td colspan="5">No hay registros que coincidan con la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ( $registros as $reg )
                                            <tr class="align-middle">
                                                <td>
                                                    <a href="{{ route('usuarios.edit', $reg->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-fill"></i></a>&nbsp; {{-- BOTON DEDITAR --}}

                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}"><i class="bi bi-trash-fill"></i>
                                                    </button> {{-- BOTON ELIMINAR --}}

                                                    <button class="btn {{ $reg->activo ? 'btn-warning' : 'btn-success' }} btn-sm" data-bs-toggle="modal" data-bs-target="#modal-toggle-{{ $reg->id }}"><i class="bi {{ $reg->activo ? 'bi-ban' : 'bi-check-circle' }}"></i>
                                                    </button> {{-- BOTON PARA SOFT DELETE --}}

                                                </td>
                                                <td>{{ $reg->id }}</td>
                                                <td>
                                                    {{ $reg->name }}
                                                </td>
                                                <td>{{ $reg->email }}</td>
                                                <td>
                                                    <span class="badge {{ $reg->activo ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $reg->activo ? 'Activo' : 'Inactivo' }}
                                                    </span>
                                                </td>
                                            </tr>

                                            @include('usuario.delete') {{-- Incluye el modal de eliminación --}}
                                            @include('usuario.activate') {{-- Incluye el modal de activación/desactivación --}}
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
    document.getElementById('itemUsuario').classList.add('active');
</script>
@endpush