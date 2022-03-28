@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Calificaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">      
                
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Estudiante</th>
                                    <th style="color:#fff;">Asignatura</th>
                                    <th style="color:#fff;">Calificación</th>
                                    <th style="color:#fff;">Estado</th>
                                    @can('edit-scores')
                                        <th style="color:#fff;">Acciones</th>
                                    @endcan
                                </thead>  
                                <tbody>
                                @foreach ($scores as $user)
                                <tr>                           
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->title}}</td>
                                    <td>{{ $user->score}}</td>
                                    @if($user->score >= 3.0)
                                        <td>Aprobada</td>
                                    @else
                                        <td>Reprobando</td>
                                    @endif
                                    @can('edit-scores')
                                        @if(Auth::user()->id == $user->exponent_id)
                                        <td>                                
                                            <a class="btn btn-primary" href="{{ route('scores.edit',$user->id) }}">Editar</a>
                                        </td>
                                        @else
                                            @role('Admin')
                                            <td>                                
                                                <a class="btn btn-primary" href="{{ route('scores.edit',$user->id) }}">Editar</a>
                                            </td>
                                            @else
                                                <td><a></a></td>
                                            @endrole
                                        @endif
                                    @endcan
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $scores->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
