@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')
    
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
			<h2 class="fs-4 text-secondary mt-4">
        {{ __('Technology List') }}
    	</h2>
			<a href="{{route('admin.technology.create')}}" class="btn btn-primary mt-4">Create new technology</a>
		</div>
    <div class="row justify-content-center">
			<table class="table  table-striped">
				<thead>
					<tr>
						<th scope="col"><a href="{{ route('admin.technology.index') }}?sort=id&order=@if ($sort == 'id' && $order != 'DESC') DESC @else ASC @endif ">
							ID
							@if($sort == 'id')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th scope="col"><a href="{{ route('admin.technology.index') }}?sort=title&order=@if ($sort == 'title' && $order != 'DESC') DESC @else ASC @endif ">
							TITOLI
							@if($sort == 'title')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th scope="col"><a href="{{ route('admin.technology.index') }}?sort=color @if ($sort == 'color' && $order != 'DESC') DESC @else ASC @endif ">
							COLORE
							@if($sort == 'color')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th>
							ANTEPRIMA
						</th>
						<th scope="col">actions</th>
					</tr>
				</thead>
				<tbody>
						@foreach ($technologies as $technology)
						<tr>
							<th scope="row">{{$technology->id}}</th>
							<td>{{$technology->title}}</td>
							<td>{{$technology->color}}</td>
							<td><span class="badge rounded-pill" style="background-color: {{$technology->color}}">{{$technology->title}}</span></td>
							<td>
								<a href="{{route('admin.technology.edit', $technology)}}" class="btn btn-primary my-2"><i class="bi bi-pencil-square"></i></a>
								<button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$technology->id}}"><i class="bi bi-trash3"></i></button>	
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

    </div>
		<div class="my-2">
			{{$technologies->links()}}
		</div>
	</div>
	
@endsection

@section('modals')
	@foreach ($technologies as $technology)
	<div class="modal fade" id="destroyModal-{{$technology->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Vuoi eliminare {{$technology->title}}? </h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Vuoi eliminare la tecnologia? <br>
					Questa operazione è irreversibile.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<form action="{{route('admin.technology.destroy', $technology)}}" method="POST">
            @method('delete')
            @csrf

            <button type="submit" class="btn btn-danger">Delete</button>

        </form>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endsection