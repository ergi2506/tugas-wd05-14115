<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{

    public function index(){
        // ambil semua data dan ditampilkan
        $obat = Obat::all();
        return view('dokter.obat.index', compact('obat'));
    }

    public function store(Request $request){
        // request akan membawa data dari form yang ada di frontend blade
        
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan' => 'required|string',
            'harga' => 'required|integer'
        ]);
        
         $obats = new Obat();
         $obats->nama_obat = $request->nama_obat;
         $obats->kemasan = $request->kemasan;
         $obats->harga = $request->harga;
         $obats->save();

        // Obat::create([
        //     'nama_obat' => $request->nama_obat,
        //     'kemasan' => $request->kemasan,
        //     'harga' => $request->harga
        // ]);

        return redirect()->back();
    }

    // return ke halaman edit berisikan form dan isi datanya
    public function edit($id){
        // find == ambil 1 data dari id nya
        $obat = Obat::find($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan' => 'required|string',
            'harga' => 'required|integer'
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga
        ]);

        return redirect()->route('dokter.obat');
    }

    public function delete($id){
        $obat = Obat::find($id);
        $obat->delete();

        return redirect()->back();
    }
}
