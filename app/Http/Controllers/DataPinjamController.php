<?php

namespace App\Http\Controllers;

use App\Models\DataPinjam;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use DB;

class DataPinjamController extends Controller
{
    public function index()
    {
        $data = DataPinjam::orderBy('data_pinjam.created_at', 'desc')->get();
        return view('dashboard_pinjam', compact('data'));
    }

    public function pinjamform()
    {
        $databarang = DataBarang::pluck('nama', 'id');
        return view('form-pinjam', compact('databarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'namabarang' => 'required',
            'mapel' => 'required',
            'namaguru' => 'required',
        ]);

        $pinjam = new DataPinjam();
        $pinjam->kelas = $request->kelas;
        $pinjam->nama_barang = $request->namabarang;
        $pinjam->pelajaran = $request->mapel;
        $pinjam->nama_guru = $request->namaguru;
        $pinjam->status =  'Belum Dikembalikan';
        $pinjam->save();
        return redirect()->route('datapinjam.index')->with('success', 'Data Pinjam berhasil disimpan.');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'kelas' => 'required',
            'namabarang' => 'required',
            'mapel' => 'required',
            'namaguru' => 'required',
        ]);

        $pinjam = DataPinjam::findOrFail($id);
        $pinjam->kelas = $request->input('kelas');
        $pinjam->nama_barang = $request->input('namabarang');
        $pinjam->pelajaran = $request->input('mapel');
        $pinjam->nama_guru = $request->input('namaguru');
        $pinjam->status =  'Belum Dikembalikan';
    }

}
