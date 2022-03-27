@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Asignaturas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('new-subject')
                        <a class="btn btn-warning" href="{{ route('subject.create') }}">Nuevo</a>                        
                        @endcan
        
                
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Asignatura</th>
                                    <th style="color:#fff;">Docente</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($subjects as $subject)
                                <tr>                           
                                    <td>{{ $subject->title}}</td>
                                    <td>{{ $subject->name}}</td>
                                    <td>                                
                                        @can('edit-subject')
                                            <a class="btn btn-primary" href="{{ route('subject.edit',$subject->id) }}">Editar</a>
                                        @endcan
                                        
                                        @can('delete-subject')
                                            {!! Form::open(['method' => 'DELETE','route' => ['subject.destroy', $subject->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $subjects->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
