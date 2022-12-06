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

        <h5 class="card-title fw-bolder mb-3">Isi Mobil</h5>

		<form method="post" action="{{ route('mobil.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_mobil" class="form-label">ID Mobil</label>
                <input type="text" class="form-control" id="id_mobil" name="id_mobil">
            </div>
			<div class="mb-3">
                <label for="nama_mobil" class="form-label">Nama mobil</label>
                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil">
            </div>
            <div class="mb-3">
                <label for="harga_mobil" class="form-label">Mesin</label>
                <input type="text" class="form-control" id="mesin" name="mesin">
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop