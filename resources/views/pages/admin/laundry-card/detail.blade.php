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
                                    <td>Total Harga</td>
                                    <td>Rp. {{ $CucianItems->sum('total') }}</td>
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
                                <!-- button bayar -->
                                @if(!$CucianItems->count() == 0 && $item->pembayaran !== 'Sudah Bayar')
                                <a href="{{ route('payment.create',$item->kode_kartu) }}" class="btn btn-primary btn-icon icon-left"><i class='fas fa-receipt'></i> Bayar</a>&nbsp;&nbsp;
                                @else
                                <a href="{{ route('payment.create',$item->kode_kartu) }}" class="btn disabled btn-primary btn-icon icon-left"><i class='fas fa-receipt'></i> Bayar</a>&nbsp;&nbsp;
                                @endif
                                <!-- akhir button bayar -->

                                <!-- button selesai cuci -->
                                @if(!$item->waktu_selesai && !$CucianItems->count() == 0)
                                <a href="{{ route('laundry-card.selesai',$item->id) }}" class="btn btn-primary btn-icon icon-left"><i class='fas fa-check-circle'></i> Set selesai</a>&nbsp;&nbsp;
                                @else
                                <a href="{{ route('laundry-card.selesai',$item->id) }}" class="btn disabled btn-primary btn-icon icon-left"><i class='fas fa-check-circle'></i> Set selesai</a>&nbsp;&nbsp;
                                @endif
                                <!-- akhir button selesai cuci -->

                                <!-- button diambil -->
                                @if(!$item->waktu_selesai || $item->waktu_diambil || $item->pembayaran === 'Belum Bayar')
                                <a href="{{ route('laundry-card.diambil',$item->id) }}" class="btn disabled btn-primary btn-icon icon-left"><i class='fas fa-check-circle'></i> Set sudah diambil</a>
                                @else
                                <a href="{{ route('laundry-card.diambil',$item->id) }}" class="btn btn-primary btn-icon icon-left"><i class='fas fa-check-circle'></i> Set sudah diambil</a>
                                @endif
                                &nbsp;&nbsp;
                                <!-- akhir button diambil -->

                                @if(!$item->waktu_diambil)
                                <a href="{{ route('cucian-item.create', [$item->id]) }}" class="btn btn-primary btn-icon icon-left"><i class='fas fa-tshirt'></i> Tambah Cucian</a>&nbsp;&nbsp;
                                @endif

                                <div style='text-align: center;margin-top:12px;'>
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
                                        <th>Harga Satuan</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        @if(!$item->waktu_diambil || $item->pembayaran !== 'Sudah Bayar')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($CucianItems as $CucianItem)
                                    <tr>
                                        <td>{{ $CucianItem->produk }}</td>
                                        <td>Rp. {{ $CucianItem->harga_satuan }}</td>
                                        <td>{{ $CucianItem->quantity }}</td>
                                        <td class="">Rp. {{ $CucianItem->total }}</td>
                                        @if(!$item->waktu_diambil || $item->pembayaran !== 'Sudah Bayar')
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
                                        @endif
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