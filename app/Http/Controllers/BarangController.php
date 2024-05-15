<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\barang;
use App\Http\Requests\StorebarangRequest;
use App\Http\Requests\UpdatebarangRequest;
use Illuminate\Database\QueryException;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StorebarangRequest $request)
    {
        $katakunci = $request->katakunci;
    
        if (strlen($katakunci)) {
            $data = barang::where('id_produk', 'like', "%$katakunci%")
                            ->orWhere('nama_produk', 'like', "%$katakunci%")
                            ->orWhere('kategori', 'like', "%$katakunci%")
                            ->orWhere('harga', 'like', "%$katakunci%")
                            ->paginate(5);
        } else {
            $data = barang::orderBy('id_produk', 'desc')->paginate(5);
        }
    
        return view("barang.index")->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view("barang/create");

    }

    /**
     * Store a newly created resource in storage.
     */


        public function store(StorebarangRequest $request)
        {
            Session::flash('id_produk', $request->id_produk);
            Session::flash('nama_produk', $request->nama_produk);
            Session::flash('kategori', $request->kategori);
            Session::flash('harga', $request->harga);

            $request->validate([
                'id_produk' => 'numeric|required|unique:barangs,id_produk',
                'nama_produk' => 'required',
                'kategori' => 'required',
                'harga' => 'required|numeric',
                'gambar_produk' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif',
                    'max:2048',
                ],
            ],
            [
                'id_produk.required' => 'id_produk harus di isi',
                'id_produk.unique' => 'id_produk yang diisi sudah terpakai',
                'id_produk.numeric' => 'id_produk harus berupa angka',
                'nama_produk.required' => 'nama_produk harus di isi',
                'kategori.required' => 'kategori harus di isi',
                'harga.produk' => ' harga harus di isi',
                'harga.numeric' => 'harga produk harus berupa angka',
                'mimes' => 'type file harus jpeg,png,jpg,gif',
                'max' => 'ukuran file tidak lebih dari 2 mb'
            ]);
        
            $data = [
                'id_produk' => $request->id_produk,
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => $request->harga
        
            ];
        
            if ($request->hasFile('gambar_produk')) {
                $image = $request->file('gambar_produk');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $data['foto_produk'] = 'images/' . $imageName;
            }
        
            try {
                barang::create($data);
            } catch (QueryException $e) {
                return redirect()->back()->withInput()->withErrors(['id_produk' => 'ID Produk sudah terpakai.']);
            }
        
            return redirect()->to('barang')->with('success', 'Data berhasil di tambahkan');
        }
        
    /**
     * Display the specified resource.
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_produk)
    {
        $data = barang::where('id_produk', $id_produk)->first();
        return view('barang/edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangRequest $request, barang $barang)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'gambar_produk' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5000',
            ],
        ],
        [
            'nama_produk.required' => 'nama_produk harus di isi',
            'kategori.required' => 'kategori harus di isi',
            'harga.produk' => ' harga harus di isi',
            'harga.numeric' => 'harga produk harus berupa angka',
            'mimes' => 'type file harus jpeg,png,jpg,gif',
            'max' => 'ukuran file tidak lebih dari 5 mb'
        ]);
    
        $data = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga
    
        ];
    
        if ($request->hasFile('gambar_produk')) {
            $image = $request->file('gambar_produk');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['foto_produk'] = 'images/' . $imageName;
        }
    
        barang::where('id_produk', $barang->id_produk)->update($data);
        return redirect()->to('barang')->with('success', 'Data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barang $barang)
    {
        barang::where('id_produk', $barang->id_produk)->first()->delete();
        return redirect()->to('/barang')->with('success', 'Data berhasil di Delete');
    }
}
