<?php

namespace App\Http\Controllers;

use App\Models\DataPinjam;
use App\Models\DataBarang;
use App\Models\UserDB;
use Illuminate\Http\Request;
Use App\Models\Role;
use DB;
use Illuminate\Support\Facades\Log;

class DataPinjamController extends Controller
{
    public function login()
    {
        return view('login-form');
    }
    public function registerindex()
    {
        $role = Role::pluck('role', 'id');
        return view('register-form', compact('role'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $user = new UserDB();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role = $request->role;
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
            $role = DB::table('role-user')->where('id', $user->role)->first();
            if($role) {
                $roleName = $role->role;
            }
            else {
                $roleName = 'kotnol';
            }
    
            session([
                'username' => $user->username,
                'role' => $roleName,
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
        foreach($data as $item) {
            $getBarangName = DB::table('data_barang')->where('id', $item->nama_barang)->first();
            if ($getBarangName) {
                $item->nama_barang = $getBarangName->nama;
            }
        }
        return view('dashboard_pinjam', compact('data'));
    }

    public function indexbarang()
    {
        $data = DataBarang::orderBy('data_barang.created_at', 'desc')->get();
        return view('form-barang', compact('data'));
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
            'jumlahbarang' => 'required',
        ]);

        $pinjam = new DataBarang();
        $pinjam->nama = $request->namabarang;
        $pinjam->jumlah = $request->jumlahbarang;
        $pinjam->jumlah_default = $request->jumlahbarang;
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
        $barang = DataBarang::findOrFail($id);

        $request->validate([
            'namabarang' => 'required',
            'jumlahbarang' => 'required|integer|min:0',
        ]);

        $newJumlahDefault = $request->input('jumlahbarang');
        $oldJumlahDefault = $barang->jumlah_default;
        $difference = $newJumlahDefault - $oldJumlahDefault;
        $barang->nama = $request->input('namabarang');
        $barang->jumlah_default = $newJumlahDefault;
        $barang->jumlah += $difference;
        $barang->save();
        return redirect()->route('databarang.index')->with('success', 'Data Barang berhasil diperbarui.');
    }


    public function destroybarang($id)
    {
        $data = DataBarang::find($id);
        $data->delete();

        return redirect()->route('databarang.index')->with('success', 'Information deleted successfully.');
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
            'kodebarang' => 'required',
            'mapel' => 'required',
            'namaguru' => 'required',
        ]);
        $barang = DataBarang::where('id', $request->namabarang)->first();
        if ($barang) {
            if ($barang->jumlah > 0) {
                $barang->jumlah -= 1;
                $barang->save();
                $pinjam = new DataPinjam();
                $pinjam->kelas = $request->kelas;
                $pinjam->nama_barang = $request->namabarang;
                $pinjam->kode_barang = $request->kodebarang;
                $pinjam->pelajaran = $request->mapel;
                $pinjam->nama_guru = $request->namaguru;
                $pinjam->status = 'Belum Dikembalikan';
                $pinjam->save();
                return redirect()->route('datapinjam.index')->with('success', 'Data Pinjam berhasil disimpan.');
            } else {
                return redirect()->route('datapinjam.index')->with('error', 'Jumlah barang tidak mencukupi.');
            }
        } else {
            return redirect()->route('datapinjam.index')->with('error', 'Barang tidak ditemukan.');
        }
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
            'kodebarang' => 'required',
            'mapel' => 'required',
            'namaguru' => 'required',
            'status' => 'required',
        ]);

        $pinjam->kelas = $request->input('kelas');
        $pinjam->nama_barang = $request->input('namabarang');
        $pinjam->kode_barang = $request->input('kodebarang');
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

    public function logout()
    {
        session()->flush();

        return redirect()->route('datapinjam.login');
    }

}
