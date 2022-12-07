@extends('tim.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Edit Data Tim</h5>

		<form method="post" action="{{ route('tim.update', $data->id_tim) }}">
			@csrf
            <div class="mb-3">
                <label for="id_tim" class="form-label">ID Tim</label>
                <input type="text" class="form-control" id="id_tim" name="id_tim" value="{{ $data->id_tim }}">
            </div>
            <div class="mb-3">
                <label for="nama_tim" class="form-label">Nama Tim</label>
                <input type="text" class="form-control" id="nama_tim" name="nama_tim" value="{{ $data->nama_tim }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop