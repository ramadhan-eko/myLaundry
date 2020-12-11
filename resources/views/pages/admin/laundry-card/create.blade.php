@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registrasi Cucian Baru</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card-shadow">
        <div class="card-body">
            <form action="{{ route('laundry-card.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="kode_kartu">Kode Registrasi</label>
                            <h3>{{ $kode_kartu }}</h3>
                            <input hidden readonly type="text" class="form-control" name="kode_kartu" value="{{ $kode_kartu }}">
                        </div>
                        <div class="form-group">
                            <label for="id_pelanggan">Pelanggan</label>
                            <select class="form-control" name="id_pelanggan" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->nama_lengkap }} - {{ $customer->hp }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="waktu_masuk">Waktu Masuk</label>
                            <h3>{{ $waktu_masuk }}</h3>
                            <input hidden readonly type="text" class="form-control" name="waktu_masuk" value="{{ $waktu_masuk }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary btn-icon icon-left"><i class='fas fa-save'></i> Simpan</button>&nbsp;&nbsp;
                        <a class="btn btn-md btn-success btn-icon icon-left" href="{{ route('laundry-card.index') }}"><i class='fas fa-reply'></i> Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection