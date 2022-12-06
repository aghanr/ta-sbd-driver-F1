<?php

namespace App\Http\Controllers;
use App\Models\Pembalap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembalapController extends Controller
{
    public function index(Request $request) {
        
        if($request->has('search')){
            $search = $request->search;
            $datas = DB::select("SELECT pembalap.id_pembalap, pembalap.id_mobil, pembalap.id_tim, pembalap.nama_pembalap, pembalap.negara, 
            mobil.id_mobil, mobil.nama_mobil,
            tim.id_tim, tim.nama_tim
            FROM pembalap
            LEFT JOIN mobil
            ON pembalap.id_mobil = mobil.id_mobil
            LEFT JOIN tim
            ON pembalap.id_tim = tim.id_tim WHERE pembalap.nama_pembalap LIKE :search",
            
            [
                "search" => '%'.$search.'%'
            ]
            
        );
    
            return view('pembalap.index', ['datas'=> $datas]);
        }
       else{
             $datas = DB::select('SELECT pembalap.id_pembalap, pembalap.id_mobil, pembalap.id_tim, pembalap.nama_pembalap, pembalap.negara, 
             mobil.id_mobil, mobil.nama_mobil,
             tim.id_tim, tim.nama_tim
             FROM pembalap
             LEFT JOIN mobil
             ON pembalap.id_mobil = mobil.id_mobil
             LEFT JOIN tim
             ON pembalap.id_tim = tim.id_tim');

            return view('pembalap.index')
            ->with('datas', $datas);
       }
    }

    public function create() {
        return view('pembalap.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_pembalap' => 'required',
            'nama_pembalap' => 'required',
            'negara' => 'required',
            'id_mobil' => 'required',
            'id_tim' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pembalap(id_pembalap, nama_pembalap, negara, id_mobil, id_tim) 
        VALUES (:id_pembalap, :nama_pembalap, :negara, :id_mobil, :id_tim)',
        [
            'id_pembalap' => $request->id_pembalap,
            'nama_pembalap' => $request->nama_pembalap,
            'negara' => $request->negara,
            'id_mobil' => $request->id_mobil,
            'id_tim' => $request->id_tim,
        ]
        );

        return redirect()->route('pembalap.index')->with('success', 'Data Pembalap berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pembalap')->where('id_pembalap', $id)->first();

        return view('pembalap.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pembalap' => 'required',
            'nama_pembalap' => 'required',
            'negara' => 'required',
            'id_mobil' => 'required',
            'id_tim' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pembalap SET id_pembalap = :id_pembalap, nama_pembalap = :nama_pembalap, negara = :negara, id_mobil = :id_mobil, id_tim = :id_tim WHERE id_pembalap = :id',
        [
            'id' => $id,
            'id_pembalap' => $request->id_pembalap,
            'nama_pembalap' => $request->nama_pembalap,
            'negara' => $request->negara,
            'id_mobil' => $request->id_mobil,
            'id_tim' => $request->id_tim,
        ]
        );

        return redirect()->route('pembalap.index')->with('success', 'Data Pembalap berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pembalap WHERE id_pembalap = :id_pembalap', ['id_pembalap' => $id]);
        return redirect()->route('pembalap.index')->with('success', 'Data Pembalap dihapus');
    }

}
