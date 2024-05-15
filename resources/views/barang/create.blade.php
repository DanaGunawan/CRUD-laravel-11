@extends('layout.app')

@section('content')


<form action='{{ url('barang')}}' method='post' enctype="multipart/form-data">
@csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="id_produk" class="col-sm-2 col-form-label">id_produk</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="id_produk"  value="{{ Session::has('id_produk') ? Session::get('id_produk') : '' }}" 
       id="id_produk" maxlength="20" pattern="[0-9]*">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_produk" class="col-sm-2 col-form-label">nama_produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_produk' value="{{ Session::has('nama_produk') ? Session::get('nama_produk') : '' }}"> </div>
            </div>
            <div class="mb-3 row">
                <label for="kategori" class="col-sm-2 col-form-label">kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='kategori' value="{{Session::has('kategori') ? Session::get('kategori') : ''}}" id="kategori">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='harga' value="{{Session::has('harga') ? Session::get('harga') : ''}}" id="harga">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="gambar_produk" class="col-sm-2 col-form-label">Gambar Produk</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name='gambar_produk' id="gambar_produk">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="kategori" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
          </form>
        </div>
@endsection

