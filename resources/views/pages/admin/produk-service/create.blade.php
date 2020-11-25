@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
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
                <form action="{{ route('produk-service.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <input type="text" class="form-control" name="produk" placeholder="produk" value="{{old('produk')}}">
                    </div>
                     <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="deskripsi" value="{{old('deskripsi')}}">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Satuan</label>
                        <input type="number" class="form-control" name="harga" placeholder="harga" value="{{old('harga')}}">
                    </div>
                    <div class="form-group">
                        <label for="total_transaksi">Total Transaksi</label>
                        <input type="number" class="form-control" name="total_transaksi" placeholder="total_transaksi" value="{{old('total_transaksi')}}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </form>
              </div>
          </div>
        </div>
        <!-- /.container-fluid -->
@endsection