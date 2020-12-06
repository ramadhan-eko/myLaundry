@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pelanggan</h1>
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
            <form action="{{ route('customer.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="hp">No Handphone</label>
                            <input type="text" class="form-control" name="hp" value="{{ old('hp') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="id_level">Level User</label>
                            <select class="form-control" name="id_level" value="{{ old('id_level') }}" required>
                                <option value="">-- Pilih Level --</option>
                                @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div style='font-size:12px;'>
                            <ul>
                                <li><i>Username tidak boleh mengandung spasi</i></li>
                                <li><i>Email &amp; disarankan valid, agar service notifikasi berjalan ke pelanggan</i></li>
                                <li><i>Level user dapat diubah kembali setelah user dibuat</i></li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary btn-icon icon-left"><i class='fas fa-save'></i> Simpan</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-md btn-warning btn-icon icon-left"><i class='fas fa-clipboard-check'></i> Clear Form</button>&nbsp;&nbsp;
                        <a class="btn btn-md btn-success btn-icon icon-left" href="{{ route('customer.index') }}"><i class='fas fa-reply'></i> Kembali</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection