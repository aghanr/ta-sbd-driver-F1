<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TimController extends Controller
{
    public function index(Request $request) {

        $datas = DB::select('SELECT * FROM tim WHERE tim.is_deleted = 0');

        return view('tim.index')
            ->with('datas', $datas);

        if($request->has('search')){
            $search = $request->search;
            $datas = DB::select("SELECT * FROM tim WHERE tim.nama_tim LIKE :search",
            
            [
                "search" => '%'.$search.'%'
            ]
            
        );
    
            return view('tim.index', ['datas'=> $datas]);
        }
       else{
             $datas = DB::select('SELECT * FROM tim');

            return view('tim.index')
            ->with('datas', $datas);
       }
    }

    public function create() {
        return view('tim.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_tim' => 'required',
            'nama_tim' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO tim(id_tim, nama_tim) 
        VALUES (:id_tim, :nama_tim)',
        [
            'id_tim' => $request->id_tim,
            'nama_tim' => $request->nama_tim,
        ]
        );

        return redirect()->route('tim.index')->with('success', 'Data Tim berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('tim')->where('id_tim', $id)->first();

        return view('tim.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_tim' => 'required',
            'nama_tim' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE tim SET id_tim = :id_tim, nama_tim = :nama_tim WHERE id_tim = :id',
        [
            'id' => $id,
            'id_tim' => $request->id_tim,
            'nama_tim' => $request->nama_tim,
        ]
        );

        return redirect()->route('tim.index')->with('success', 'Data Tim berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM tim WHERE id_tim = :id_tim', ['id_tim' => $id]);
        return redirect()->route('tim.index')->with('success', 'Data Tim dihapus');
    }

    public function softdelete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE tim SET is_deleted = 1 WHERE id_tim = :id_tim', ['id_tim' =>$id]);
        return redirect()->route('tim.index')->with('success', 'Data Tim berhasil disembunyikan');
    }
}
