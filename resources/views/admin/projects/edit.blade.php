@extends('layouts.app')

@section('content')

            <div class="panel panel-primary">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                    @if (session('notification'))
                        <div class="alert alert-success">
                          {{ session('notification') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                 <form action="" method="POST">
                     {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $project->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="description" name="description" class="form-control" value="{{ old('description', $project->description) }}">
                    </div>

                    <div class="form-group">
                        <label for="start">Fecha de Inicio</label>
                        <input type="date" name="start" class="form-control" value="{{ old('start', $project->start)}}">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Guardar Ciclo</button>
                    </div>
                   </form>

                   <div class="row">
                    <div class="col-md-6">
                    <p>Categorías</p>
                    <form action="/categorias" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group">
                        <input style="margin-bottom: 8px" type="text" name="name" placeholder="Ingrese nombre" class="form-control">
                        </div>
                        <button style="margin-bottom: 8px" class="btn btn-primary">Añadir</button>
                    </form>

                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 <th>Nombre</th>
                                 <th>Opciones</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($categories as $category)
                             <tr>
                                 <td>{{ $category->name }}</td>
                                 <td>
                                     <a href="" class="btn btn-sm btn-primary" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>

                                     <a href="" class="btn btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
                                 </td>
                             </tr>
                            @endforeach
                         </tbody>
                     </table>
                    </div>

                    <div class="col-md-6">
                    <p>Niveles</p>

                    <form action="/niveles" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group">
                        <input style="margin-bottom: 8px" type="text" name="name" placeholder="Ingrese nombre" class="form-control">
                        </div>
                        <button style="margin-bottom: 8px" class="btn btn-primary">Añadir</button>
                    </form>

                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Nivel</th>
                                 <th>Opciones</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($levels as $key => $level)
                             <tr>
                                 <td>N{{ $key+1 }}</td>
                                 <td>{{ $level->name }}</td>
                                 <td>
                                     <a href="" class="btn btn-sm btn-primary" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>

                                     <a href="" class="btn btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
                                 </td>
                             </tr>
                            @endforeach
                         </tbody>
                     </table>
                    </div>                     

                   </div>

               
                </div>
            </div>
@endsection