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
            <!-- <a href="{{ route('laundry-card.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Registrasi Cucian Pelanggan
            </a> -->
            <!-- <h6 class="m-0 font-weight-bold text-primary">Kartu Laundry</h6> -->
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