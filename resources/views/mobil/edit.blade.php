@extends('mobil.layout')

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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Mobil</h5>

		<form method="post" action="{{ route('mobil.update', $data->id_mobil) }}">
			@csrf
            <div class="mb-3">
                <label for="id_mobil" class="form-label">ID Mobil</label>
                <input type="text" class="form-control" id="id_mobil" name="id_mobil" value="{{ $data->id_mobil }}">
            </div>
			<div class="mb-3">
                <label for="nama_mobil" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="{{ $data->nama_mobil }}">
            </div>
            <div class="mb-3">
                <label for="mesin" class="form-label">Mesin</label>
                <input type="text" class="form-control" id="mesin" name="mesin" value="{{ $data->mesin }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop