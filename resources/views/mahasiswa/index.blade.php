@extends('layout.app')

@section('content')

<div class="my-3 p-3 bg-body rounded shadow-sm">       
                <div class="pb-3">
                  <form class="d-flex" action="" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan keyword pencarian" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='/mahasiswa/create' class="btn btn-primary">+ Tambah Data</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">no</th>
                            <th class="col-md-3">NIM</th>
                            <th class="col-md-4">Nama</th>
                            <th class="col-md-2">Jurusan</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php   $i = $data->firstItem() ?>
                         @foreach ($data as $d)
                         <tr>
                        <td>{{ $i }}</td>
                         <td>{{$d['nim']}}</td>
                         <td>{{$d['nama']}}</td>
                         <td>{{$d['jurusan']}}</td>
                         <td> 
                         <a href='{{ url("mahasiswa/{$d->nim}/edit") }}' class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{url('mahasiswa/'.$d->nim)}}" method="post" onsubmit="return confirm('apakah anda yakin ingin menghapus data?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                        </td>

                        <?php $i++ ?>
                         @endforeach
                       
                              
                        </tr>
                    </tbody>
                </table>
               {{ $data->links() }}
          </div>
      
@endsection


  