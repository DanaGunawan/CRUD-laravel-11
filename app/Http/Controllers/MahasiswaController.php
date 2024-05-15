<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\mahasiswa;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoremahasiswaRequest;
use App\Http\Requests\UpdatemahasiswaRequest;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StoremahasiswaRequest $request)
    {
        $katakunci = $request->katakunci;
    
        if (strlen($katakunci)) {
            $data = mahasiswa::where('nim', 'like', "%$katakunci%")
                            ->orWhere('nama', 'like', "%$katakunci%")
                            ->orWhere('jurusan', 'like', "%$katakunci%")
                            ->paginate(5);
        } else {
            $data = mahasiswa::orderBy('nim', 'desc')->paginate(5);
        }
    
        return view("mahasiswa.index")->with('data', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("mahasiswa/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremahasiswaRequest $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);

        $request->validate(
            [
                'nim' => 'numeric|required|unique:mahasiswas,nim',
                'nama' => 'required',
                'jurusan' => 'required'
            ],
            [
                'nim.required' => 'nim harus di isi',
                'nim.unique' => 'nim yang diisi sudah terpakai',
                'nim.numeric' => 'nim harus berupa angka',
                'nama.required' => 'nama harus di isi',
                'jurusan.required' => 'jurusan harus di isi',
            ]

        );
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'Data berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        $data = mahasiswa::where('nim', $nim)->first();
        return view('mahasiswa/edit')->with('data', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemahasiswaRequest $request, mahasiswa $mahasiswa)
    {
        $request->validate(
            [
                'nama' => 'required',
                'jurusan' => 'required'
            ],
            [
                'nama.required' => 'nama harus di isi',
                'jurusan.required' => 'jurusan harus di isi',
            ]

        );
        $data = [

            'nama' => $request->nama,
            'jurusan' => $request->jurusan
        ];
        mahasiswa::where('nim', $mahasiswa->nim)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'Data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mahasiswa $mahasiswa)
    {
        mahasiswa::where('nim', $mahasiswa->nim)->first()->delete();
        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil di Delete');

    }
}
