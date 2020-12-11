@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Level User</h1>
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
            <form action="{{ route('user-level.update', $item->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="level">Level</label>
                    <input type="text" class="form-control" name="level" value="{{ $item->level }}" required>
                </div>
                <div class="form-group">
                    <label for="point_cuci">Point Cuci</label>
                    <input type="number" class="form-control" name="point_cuci" value="{{ $item->point_cuci }}" required>
                </div>
                <div class="form-group">
                    <label for="diskon">Diskon</label>
                    <input type="number" class="form-control" name="diskon" value="{{ $item->diskon }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary btn-icon icon-left"><i class='fas fa-save'></i> Simpan</button>&nbsp;&nbsp;
                    <button type="reset" class="btn btn-md btn-warning btn-icon icon-left"><i class='fas fa-clipboard-check'></i> Clear Form</button>&nbsp;&nbsp;
                    <a class="btn btn-md btn-success btn-icon icon-left" href="{{ route('user-level.index') }}"><i class='fas fa-reply'></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection