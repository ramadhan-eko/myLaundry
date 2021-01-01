@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Invoice</th>
                            <th>Kode Kartu</th>
                            <th>Waktu Bayar</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Promo</th>
                            <th>Harga Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td><a href="{{ route('payment.show', $item->id) }}">{{ $item->kode_payment }}</a></td>
                            <td>{{ $item->kode_kartu }}</td>
                            <td>{{ $item->waktu_bayar }}</td>
                            <td>{{ $item->pelanggan }}</td>
                            <td>Rp. {{ $item->total_cuci }}</td>
                            <td>{{ $item->kode_promo }}</td>
                            <td>Rp. {{ $item->total_bayar }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada catatan transaksi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection