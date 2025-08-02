
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
                        <div>
                            <form action="{{ route('productos.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="texto" type="text" class="form-control" value="{{ $texto }}" placeholder="Ingrese texto a buscar">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>

                                        @can('producto-create')
                                        <a href="{{ route('productos.create') }}" class="btn btn-primary">Nuevo<a>
                                        @endcan
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
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($registros) <= 0)
                                        <tr>
                                            <td colspan="6">No hay registros que coincidan con la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ( $registros as $reg )
                                            <tr class="align-middle">
                                                <td>
                                                    @can('producto-edit')
                                                    <a href="{{ route('productos.edit', $reg->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-fill"></i></a>&nbsp; {{-- BOTON DEDITAR --}}
                                                    @endcan

                                                    @can('producto-delete')
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}"><i class="bi bi-trash-fill"></i>
                                                    </button> {{-- BOTON ELIMINAR --}}
                                                    @endcan

                                                </td>
                                                <td>{{ $reg->id }}</td>
                                                <td>
                                                    {{ $reg->codigo }}
                                                </td>
                                                <td>{{ $reg->nombre }}</td>
                                                <td>
                                                    {{ $reg->precio }}
                                                </td>
                                                <td>
                                                    @if($reg->imagen)
                                                        <img src="{{ asset('uploads/productos/' . $reg->imagen) }}" alt="{{ $reg->nombre }}" style="max-width: 150px; height: auto;">
                                                        {{-- Muestra la imagen del producto si existe --}}
                                                    @else
                                                        <span>Sin Imagen</span>
                                                    @endif
                                                </td>
                                            </tr>

                                            @can('producto-delete')
                                                @include('producto.delete') {{-- Incluye el modal de eliminación --}}
                                            @endcan

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
    document.getElementById('mnuAlmacen').classList.add('menu-open');
    document.getElementById('itemProducto').classList.add('active');
</script>
@endpush