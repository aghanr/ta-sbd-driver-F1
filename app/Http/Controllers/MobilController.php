<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MobilController extends Controller
{
    public function index(Request $request) {
        $datas = DB::select('SELECT * FROM mobil WHERE mobil.is_deleted = 0');

        return view('mobil.index')
            ->with('datas', $datas);

        if($request->has('search')){
            $search = $request->search;
            $datas = DB::select("SELECT * FROM mobil WHERE mobil.nama_mobil LIKE :search",
            
            [
                "search" => '%'.$search.'%'
            ]
            
        );
    
            return view('mobil.index', ['datas'=> $datas]);
        }
       else{
             $datas = DB::select('SELECT * FROM mobil');

            return view('mobil.index')
            ->with('datas', $datas);
       }
    }

    public function create() {
        return view('mobil.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_mobil' => 'required',
            'nama_mobil' => 'required',
            'mesin'=> 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO mobil(id_mobil, nama_mobil, mesin) 
        VALUES (:id_mobil, :nama_mobil, :mesin)',
        [
            'id_mobil' => $request->id_mobil,
            'nama_mobil' => $request->nama_mobil,
            'mesin' => $request->mesin,
        ]
        );

        return redirect()->route('mobil.index')->with('success', 'Data Mobil berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('mobil')->where('id_mobil', $id)->first();

        return view('mobil.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_mobil' => 'required',
            'nama_mobil' => 'required',
            'mesin' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE mobil SET id_mobil = :id_mobil, nama_mobil = :nama_mobil, mesin = :mesin WHERE id_mobil = :id',
        [
            'id' => $id,
            'id_mobil' => $request->id_mobil,
            'nama_mobil' => $request->nama_mobil,
            'mesin' => $request->mesin,
        ]
        );

        return redirect()->route('mobil.index')->with('success', 'Data Mobil berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM mobil WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobil.index')->with('success', 'Data Mobil dihapus');
    }

    public function softdelete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE mobil SET is_deleted = 1 WHERE id_mobil = :id_mobil', ['id_mobil' =>$id]);
        return redirect()->route('mobil.index')->with('success', 'Data Mobil berhasil disembunyikan');
    }

}
