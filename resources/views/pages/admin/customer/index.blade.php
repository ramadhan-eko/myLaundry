@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelanggan
            </a>
            <!-- <h6 class="m-0 font-weight-bold text-primary">Kartu Laundry</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Sedang Laundry</th>
                            <th>Total Cuci</th>
                            <th>Point</th>
                            <th>Level User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>
                            <!-- <img class="mr-3 rounded-circle" width="50" src="{{ url('backend/img/avatar-1.png') }}" alt="avatar"> -->
                                <b>{{ $item->nama_lengkap }}</b><br>
                                {{ $item->username }}<br>
                                {{ $item->email }}
                            </td>
                            <!-- kondisi sedang laundry/tidak -->
                            <td>
                                @if($item->sedangCuci->count() > 0)
                                    Ya
                                @else
                                    Tidak
                                @endif
                            </td>
                            <!-- total cuci -->
                            <td>{{ $item->datacuci->count() }}</td>
                            <td>{{ $item->point }}</td>
                            <td>{{ $item->level_user->level}}</td>
                            <td>
                                <a href="{{ route('customer.edit', $item->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                                <form action="{{ route('customer.destroy', $item->id) }}" method="post" class="d-inline">
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
</div>
<!-- /.container-fluid -->
@endsection