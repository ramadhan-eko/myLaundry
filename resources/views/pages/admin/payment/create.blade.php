@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembayaran</h1>
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
                            <h4 class="bold">Data Cucian</h4>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Kode Kartu</td>
                                    <td>{{ $kode_kartu }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Transaksi</td>
                                    <td>{{ $kode_inv }}</td>
                                </tr>
                                <tr>
                                    <td>Pelanggan</td>
                                    <td>{{ $customer->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td>Level Pelanggan</td>
                                    <td>{{ $level->level }}</td>
                                </tr>
                                <tr>
                                    <td>Diskon Level</td>
                                    <td>{{ $level->diskon }} %</td>
                                </tr>
                            </table>

                            <!-- table cucian -->
                            <h4 class="bold">Item Cucian</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cucianItems as $cucianItem)
                                    <tr>
                                        <td>{{ $cucianItem->produk }}</td>
                                        <td>Rp. {{ $cucianItem->harga_satuan }}</td>
                                        <td>{{ $cucianItem->quantity }}</td>
                                        <td>Rp. {{ $cucianItem->total }}</td>
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
                <!-- card kanan -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class='card card-primary' style="border-radius:3px; padding:12px;">
                        <div style="padding-top:12px;padding-left:10px;">
                            <h4 class="bold">Detail Transaksi</h4>
                            <form action="{{ route('payment.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <input hidden type="text" class="form-control" name="kode_payment" value="{{ $kode_inv }}">
                                    <input hidden type="text" class="form-control" name="kode_kartu" value="{{ $kode_kartu }}">
                                    <input hidden type="text" class="form-control" name="pelanggan" value="{{ $customer->nama_lengkap }}">
                                </div>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Harga Service</td>
                                        <input hidden type="text" class="form-control" name="total_cuci" value="{{ $cucianItems->sum('total') }}">
                                        <td><label>Rp. {{ $cucianItems->sum('total') }}</label></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Promo</td>
                                        <td>
                                            <select class="form-control" name="kode_promo" onchange="pilihPromo()">
                                                <option value="">-- Pilih Kode --</option>
                                                @foreach ($promos as $promo)
                                                <option value="{{ $promo->kd_promo }}">{{ $promo->deskripsi }} - {{ $promo->diskon }}%</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <!-- deskripsi dari promonya -->
                                    <!-- <tr>
                                        <td>Promo</td>
                                        <td><label id="lblpromo"></label></td>
                                    </tr> -->
                                    <tr>
                                        <td>Total Bayar</td>
                                        <input readonly hidden type="text" class="form-control" name="total_bayar" value="{{ $cucianItems->sum('total') }}">
                                        <td>
                                            <label>Rp. {{ $cucianItems->sum('total') }}</label><br>
                                            <span>Harga yang tercantum belum dikurang dengan diskon</span></td>
                                        
                                    </tr>
                                </table>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-lg btn-primary btn-icon icon-left"><i class='fas fa-receipt'></i> Proses Pembayaran</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function pilihPromo() {
    var kd_promo = document.getElementsByName("kode_promo");
    var isinya = kd_promo.value;
    console.log(kd_promo);
    document.getElementById("lblpromo").innerHTML = kd_promo;
    }
</script>
<!-- /.container-fluid -->
@endsection