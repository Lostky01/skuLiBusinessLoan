<?php

namespace App\Http\Controllers;

use App\Models\DataPinjam;
use App\Models\DataBarang;
use App\Models\UserDB;
use Illuminate\Http\Request;
use DB;

class DataPinjamController extends Controller
{
    public function login()
    {
        return view('login-form');
    }
    public function registerindex()
    {
        return view('register-form');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = new UserDB();
        $user->username = $request->username;
        $user->password = $request->password;
        if($user->save()) {
            return redirect()->route('datapinjam.login')->with('success');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function Authuser(Request $request)
    {
        \Log::info('Authuser method is being executed');
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = UserDB::where('username', $request->username)
                       ->where('password', $request->password)
                       ->first();

        if ($user) {
            \Log::info('User found: ' . $user->username);

            session([
                'username' => $user->username,
            ]);

            return redirect()->route('datapinjam.index');
        } else {
            \Log::info('User not found');
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function index()
    {
        $data = DataPinjam::orderBy('data_pinjam.created_at', 'desc')->get();
        return view('dashboard_pinjam', compact('data'));
    }

    public function indexbarang()
    {
        $data = DataBarang::orderBy('data_barang.created_at', 'desc')->get();
        return view('form-barang', compact('data'));
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
    public function EditDataPinjam($id)
    {
        $data = DataPinjam::findOrFail($id);
        $databarang = DataBarang::pluck('nama', 'id');
        return view('form-edit-pinjam', compact('data', 'databarang'));
    }

    public function update(Request $request, $id)
    {
        $pinjam = DataPinjam::findOrFail($id);
        $request->validate([
            'kelas' => 'required',
            'namabarang' => 'required',
            'mapel' => 'required',
            'namaguru' => 'required',
            'status' => 'required',
        ]);

        $pinjam->kelas = $request->input('kelas');
        $pinjam->nama_barang = $request->input('namabarang');
        $pinjam->pelajaran = $request->input('mapel');
        $pinjam->nama_guru = $request->input('namaguru');
        $pinjam->status =  $request->input('status');
        $pinjam->save();
        return redirect()->route('datapinjam.index')->with('success', 'Data Pinjam berhasil disimpan.');
    }

    public function destroy($id)
    {
        $data = DataPinjam::find($id);
        $data->delete();

        return redirect()->route('datapinjam.index')->with('success', 'Information deleted successfully.');
    }

    public function formbarang()
    {
        $databarang = DataBarang::pluck('nama', 'id');
        return view('form-create-barang', compact('databarang'));
    }

    public function barangstore(Request $request)
    {
        $request->validate([
            'namabarang' => 'required',
        ]);

        $pinjam = new DataBarang();
        $pinjam->nama = $request->namabarang;
        $pinjam->save();
        return redirect()->route('databarang.index')->with('success', 'Data Barang berhasil disimpan.');
    }

    public function EditDataBarang($id)
    {
        $data = DataBarang::findOrFail($id);
        $databarang = DataBarang::pluck('nama', 'id');
        return view('form-edit-barang', compact('data', 'databarang'));
    }

    public function updatebarang(Request $request, $id)
    {
        $pinjam = DataBarang::findOrFail($id);
        $request->validate([
            'namabarang' => 'required',
        ]);

        $pinjam->nama = $request->input('namabarang');
        $pinjam->save();
        return redirect()->route('databarang.index')->with('success', 'Data Pinjam berhasil disimpan.');
    }


    public function destroybarang($id)
    {
        $data = DataBarang::find($id);
        $data->delete();

        return redirect()->route('databarang.index')->with('success', 'Information deleted successfully.');
    }

    public function logout() {
        session()->flush();

        return redirect()->route('datapinjam.login');
    }

}
