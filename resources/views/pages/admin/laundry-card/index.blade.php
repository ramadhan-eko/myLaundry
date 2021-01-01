@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kartu Laundry</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('laundry-card.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Registrasi Cucian Pelanggan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Kartu</th>
                            <th>Pelanggan</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>Total Harga</th>
                            <th>Status Pembayaran & Pick Up</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td><a href="{{ route('laundry-card.show', $item->id) }}">{{ $item->kode_kartu }}</a></td>
                            <td>{{ $item->datacuci->nama_lengkap }}</td>
                            <!-- kondisi status -->
                            @if ($item->status === 'Hold')
                            <td class="bg-secondary text-white">Hold</td>
                            @elseif ($item->status === 'Cuci')
                            <td class="bg-info text-white">Laundry Room</td>
                            @else
                            <td class="bg-success text-white">Selesai Cuci</td>
                            @endif
                            <td>
                                Masuk: <b>{{ $item->waktu_masuk }}</b><br>
                                Selesai: <b>{{ $item->waktu_selesai ? $item->waktu_selesai : '-' }}</b><br>
                                Diambil: <b>{{ $item->waktu_diambil ? $item->waktu_diambil : '-' }}</b>
                            </td>
                            @if($item->item_cucian === null)
                            <td>0</td>
                            @else
                            <td>Rp. {{ $item_cucian->produk }}</td>
                            @endif
                            <td>
                                <!-- kondisi pembayaran -->
                                @if($item->pembayaran === 'Belum Bayar')
                                <span class="badge badge-pill badge-warning">Belum Bayar</span>
                                @else
                                <span class="badge badge-pill badge-success">Sudah Bayar</span>
                                @endif
                                @if(!$item->waktu_diambil)
                                <span class="badge badge-pill badge-warning">Belum Diambil</span>
                                @else
                                <span class="badge badge-pill badge-success">Sudah Diambil</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada kartu laundry silahkan buat kartu laundry baru
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                Keterangan status kartu <br />
                <ul>
                    <li><span class="badge badge-secondary">Hold</span> : Kartu laundry sudah dibuat, pelanggan belum membuat daftar cucian, cucian dapat ditambahkan di menu laundry room</li>
                    <li><span class="badge badge-info">Laundry Room</span> : Kartu laundry sudah memiliki antrian di laundry yang memiliki minimal 1 cucian, cucian dapat ditambahkan di menu laundry room</li>
                    <li><span class="badge badge-success">Selesai</span> : Cucian telah selesai</li>
                    <li><span class="badge badge-primary">Diambil</span> : Cucian telah di ambil/diantarkan</li>
                </ul>
                <hr />
                Catatan tambahan <br />
                <ul>
                    <li>Untuk pembayaran, pengambilan, serta pembatalan cucian dapat dilakukan dengan mengklik kode kartu dari cucian</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection