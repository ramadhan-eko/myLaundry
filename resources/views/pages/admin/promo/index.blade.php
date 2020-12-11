@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Promo</h1>
          </div>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                 <a href="{{ route('promo.create') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white"></i> Tambah
                </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Promo</th>
                            <th>Deskripsi</th>
                            <th>Diskon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->kd_promo}}</td>
                                <td>{{ $item->deskripsi}}</td>
                                <td>{{ $item->diskon}}</td>
                                <td>
                                    <a href="{{ route('promo.edit', $item->id)}}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i> Ubah
                                    </a>
                                    <form action="{{ route('promo.destroy', $item->id)}}" class="d-line" method="POST">
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