<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrukturController extends Controller
{
    public function index(Request $request)
    {
        $instruktur = DB::table('instruktur')->get();
        return view('instruktur.index', [
            'data' => $instruktur
        ]);
    }

    public function tambah(Request $request)
    {
        $maxdb = DB::table('instruktur')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        DB::table('instruktur')->insert([
            'id' => $newid,
            'instrukturid' => 'INS-' . $newid,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect('/instruktur');
    }

    public function update(Request $request, $id)
    {
        DB::table('instruktur')->where('id', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect('/instruktur');
    }

    public function hapus($id)
    {
        DB::table('instruktur')->where('id', $id)->delete();

        return redirect('/instruktur');
    }
}
