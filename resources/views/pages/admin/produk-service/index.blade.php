@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk & Services</h1>
                <a href="{{ route('produk-service.create') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white"></i> Tambah
                </a>
          </div>

          {{-- <div class="card shadow mb-4">
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produk</th>
                                <th>Deskripsi</th>
                                <th>harga</th>
                                <th>Total Transaksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->produk}}</td>
                                <td>{{ $item->deskripsi}}</td>
                                <td>{{ $item->harga}}</td>
                                <td>{{ $item->total_transaksi}}</td>
                                <td>
                                    <a href="{{ route('produk-service.edit', $item->id)}}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('produk-service.destroy', $item->id)}}" class="d-line" method="POST">
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
          </div> --}}

           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produk</th>
                            <th>Deskripsi</th>
                            <th>harga</th>
                            <th>Total Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Deskripsi</th>
                        <th>harga</th>
                        <th>Total Transaksi</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->produk}}</td>
                                <td>{{ $item->deskripsi}}</td>
                                <td>{{ $item->harga}}</td>
                                <td>{{ $item->total_transaksi}}</td>
                                <td>
                                    <a href="{{ route('produk-service.edit', $item->id)}}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i> Ubah
                                    </a>
                                    <form action="{{ route('produk-service.destroy', $item->id)}}" class="d-line" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Hapus
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
            </>
          </div>
        </div>
       
        <!-- /.container-fluid -->
@endsection