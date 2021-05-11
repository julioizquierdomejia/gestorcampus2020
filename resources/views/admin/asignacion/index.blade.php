@extends('layouts.app', ['title' => 'Tags'])
@section('content')
	
	<div class="row">
		<div class="col">
			<h3>Asignar Docentes a Curso</h3>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">Id Curso</th>
			      <th scope="col">Id Curso Moodle</th>
			      <th scope="col">Nombre del Curso</th>
			      <th scope="col">Acción</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach($cursos as $curso)
			    	<tr>
				      <th scope="row">{{$curso->id}}</th>
				      <td>{{$curso->course_moodle_id}}</td>
				      <td>{{$curso->shortname}}</td>
				      <td>
				      	<a href="" class="btn btn-success" id="{{$curso->id}}">Asignar</a>
				      </td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
	</div>
	
@endsection

