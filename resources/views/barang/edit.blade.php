@extends('layout.app')

@section('content')

<div class="my-3 p-3 bg-body rounded shadow-sm">       
    <div class="pb-3">
        <a href='{{ url('barang') }}' class="btn btn-secondary"><< Kembali</a>
    </div>
    
    <form action='{{ url('barang/'.$data->id_produk) }}' method='post' enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <table class="table table-striped">
            <tr>
                <th class="col-md-1">ID Produk</th>
                <td>{{ $data->id_produk }}</td>
                <input type="hidden" name="id_produk" value="{{ $data->id_produk }}">
            </tr>
            <tr>
                <th class="col-md-1">Nama Produk</th>
                <td><input type="text" class="form-control" name='nama_produk' value="{{ $data->nama_produk }}" id="nama_produk"></td>
            </tr>
            <tr>
                <th class="col-md-1">Kategori</th>
                <td><input type="text" class="form-control" name='kategori' value="{{ $data->kategori }}" id="kategori"></td>
            </tr>
            <tr>
                <th class="col-md-1">Harga</th>
                <td><input type="text" class="form-control" name='harga' value="{{ $data->harga }}" id="harga"></td>
            </tr>
            <tr>
                <th class="col-md-1">Gambar Produk</th>
                <td>
           
                    <input type="file" class="form-control" name='gambar_produk' id="gambar_produk">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><button type="submit" class="btn btn-primary" name="submit">Update</button></td>
            </tr>
        </table>
    </form>
</div>

@endsection
