@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Item Cucian</h1>
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
            <form action="{{ route('cucian-item.update', $item->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode Kartu</label>
                            <h3>{{ $laundrycard->kode_kartu }}</h3>
                            <input hidden readonly type="text" class="form-control" name="id_kartu" value="{{ $laundrycard->id }}">
                        </div>
                        <div class="form-group">
                            <label for="produk">Produk</label>
                            <input readonly type="text" class="form-control" name="produk" value="{{ $item->produk }}">
                            <input hidden readonly type="text" class="form-control" name="id_service" value="{{ $item->id_service }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="{{ $item->quantity }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary btn-icon icon-left"><i class='fas fa-save'></i> Simpan</button>&nbsp;&nbsp;
                    <button type="reset" class="btn btn-md btn-warning btn-icon icon-left"><i class='fas fa-clipboard-check'></i> Clear Form</button>&nbsp;&nbsp;
                    <a class="btn btn-md btn-success btn-icon icon-left" href="{{ route('laundry-card.index') }}"><i class='fas fa-reply'></i> Kembali</a>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection