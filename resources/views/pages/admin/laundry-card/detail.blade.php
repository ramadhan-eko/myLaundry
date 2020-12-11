@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kartu Laundry {{ $item->kode_kartu }}</h1>
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
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class='card card-primary' style="border-radius:3px; padding:12px;">
                        <div style="padding-top:12px;padding-left:10px;">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Pelanggan</td>
                                    <td>{{ $customer->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Registrasi</td>
                                    <td>{{ $item->waktu_masuk }}</td>
                                </tr>
                                <tr>
                                    <td>Status Cucian</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>{{ $item->pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Sudah di ambil</td>
                                    <td>
                                        @if($item->waktu_diambil)
                                        Sudah
                                        @else
                                        Belum
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <div style="text-align: center;padding-top:12px;">
                                <a href='#' class="btn btn-lg btn-primary btn-icon icon-left"><i class='fas fa-receipt'></i> Bayar</a>&nbsp;&nbsp;
                                @if(!$item->waktu_selesai || $item->waktu_diambil)
                                <a href="{{ route('laundry-card.edit',$item->id) }}" class="btn disabled btn-lg btn-primary btn-icon icon-left"><i class='fas fa-check-circle'></i> Set sudah diambil</a>
                                @else
                                <a href="{{ route('laundry-card.edit',$item->id) }}" class="btn btn-lg btn-primary btn-icon icon-left"><i class='fas fa-check-circle'></i> Set sudah diambil</a>
                                @endif
                                &nbsp;&nbsp;
                                <a href="{{ route('cucian-item.show', [$item->id]) }}" class="btn btn-lg btn-primary btn-icon icon-left"><i class='fas fa-tshirt'></i> Tambah Cucian</a>&nbsp;&nbsp;
                                <div style='margin-top:12px;'>
                                    <form action="{{ route('laundry-card.destroy', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning">
                                            <i class='fas fa-trash-alt'></i> Batalkan Cucian
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='card card-primary mt-4' style="border-radius:3px; padding:12px;">
                        <div class="card-header">
                            <h4><b>List Item Cucian</b></h4>
                        </div>
                        <div style="padding-top:12px;padding-left:10px;">
                            <!-- Table Item Cucian -->
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Items</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($CucianItems as $CucianItem)
                                    <tr>
                                        <td>{{ $CucianItem->produk }}</td>
                                        <td>{{ $CucianItem->quantity }}</td>
                                        <td class="">Rp. {{ $CucianItem->total }}</td>
                                        <td>
                                            <a href="{{ route('cucian-item.edit', $CucianItem->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                                            <form action="{{ route('cucian-item.destroy',$CucianItem->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Data Kosong
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class='card card-primary' style="border-radius:3px; padding:12px;">
                        <div class="card-header">
                            <h5>Timeline cucian</h5>
                        </div>
                        <div class="card-body">
                            <div class="activities">
                                <h3 class='text-center'>Sedang dalam pengerjaan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection