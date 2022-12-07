@extends('pembalap.layout')

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

        <h5 class="card-title fw-bolder mb-3">Edit Data Pembalap</h5>

		<form method="post" action="{{ route('pembalap.update', $data->id_pembalap) }}">
			@csrf
            <div class="mb-3">
                <label for="id_pembalap" class="form-label">ID Pembalap</label>
                <input type="text" class="form-control" id="id_pembalap" name="id_pembalap" value="{{ $data->id_pembalap }}">
            </div>
            <div class="mb-3">
                <label for="nama_pembalap" class="form-label">Nama Pembalap</label>
                <input type="text" class="form-control" id="nama_pembalap" name="nama_pembalap" value="{{ $data->nama_pembalap }}">
            </div>
            <div class="mb-3">
                <label for="negara" class="form-label">Negara</label>
                <input type="text" class="form-control" id="negara" name="negara" value="{{ $data->negara }}">
            </div>
            <div class="mb-3">
                <label for="id_mobil" class="form-label">ID Mobil</label>
                <input type="text" class="form-control" id="id_mobil" name="id_mobil" value="{{ $data->id_mobil }}">
            </div>
            <div class="mb-3">
                <label for="id_tim" class="form-label">ID Tim</label>
                <input type="text" class="form-control" id="id_tim" name="id_tim" value="{{ $data->id_tim }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop