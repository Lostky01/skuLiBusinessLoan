<?php

// kalo jelek, download aja terus benerin sendiri terus fuck off, jangan ngedm gm gw, emang gw gabisa ngoding.

namespace App\Http\Controllers;

use App\Models\DataPinjam;
use App\Models\DataBarang;
use App\Models\UserDB;
use Illuminate\Http\Request;
use App\Models\Role;
use DB;
use Illuminate\Support\Facades\Log;

class DataPinjamController extends Controller
{
    // do i have to explain myself
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

    // fungsi tolol disentuh dikit rusak, babi emang
    // sialadadandajidowoodwqijoeqejqeojqioejqioejqio
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
            } else {
                $roleName = 'Gatau'; //dumbass code
            }

            session([
                'username' => $user->username,
                'role' => $roleName,
            ]);


            return redirect()->route('datapinjam.index');
        } else {
            \Log::info('User not found'); // gue ngasih log setiap 30detik sekali cuman buat nyadar tiap ada session baru gabakal nongol lognya lmao
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

    private function RandNumberinitialize()
    {
        return 1000;
    }
    public function barangstore(Request $request)
    {
        $request->validate([
            'namabarang' => 'required',
        ]);

        $pinjam = new DataBarang();

        // Get the latest kode_barang
        $latestBarang = DataBarang::orderBy('kode_barang', 'desc')->first();
        if ($latestBarang) {
            $pinjam->kode_barang = $latestBarang->kode_barang + 1;
        } else {
            $pinjam->kode_barang = $this->RandNumberinitialize() + 1;
        }
        $baseName = $request->namabarang;
        $similarNames = DataBarang::where('nama', 'like', "$baseName%")->get();

        if ($similarNames->isNotEmpty()) {
            $maxNumber = 0;
            foreach ($similarNames as $similarName) {
                if ($similarName->nama === $baseName) {
                    $maxNumber = max($maxNumber, 1);
                } elseif (preg_match('/^' . preg_quote($baseName, '/') . ' (\d+)$/', $similarName->nama, $matches)) {
                    $maxNumber = max($maxNumber, (int)$matches[1] + 1);
                }
            }
            $pinjam->nama = $maxNumber > 0 ? "$baseName $maxNumber" : $baseName;
        } else {
            $pinjam->nama = $baseName;
        }
        $pinjam->jumlah = 1;
        $pinjam->save();

        return redirect()->route('databarang.index')->with('success', 'Data Barang berhasil disimpan.');
    }

    // 15-5-24 masih rusak nih kode
    // 17-5-24 emang rusak semua sih kodenya
    public function EditDataBarang($id)
    {
        $data = DataBarang::findOrFail($id);
        $databarang = DataBarang::pluck('nama', 'id');
        return view('form-edit-barang', compact('data', 'databarang'));
    }


    // hari sial, tapi gapapalah semangat diriku sendiri
    public function updatebarang(Request $request, $id)
    {
        $barang = DataBarang::findOrFail($id);

        $request->validate([
            'namabarang' => 'required',
        ]);

        /* $barang->kode_barang = $request->input('kodebarang'); */
        $barang->nama = $request->input('namabarang');

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
            'kodebarang' => 'required',
            'namabarang' => 'required',
            'mapel' => 'required',
            'namaguru' => 'required',
        ]);

        $pinjam = new DataPinjam();
        $pinjam->kelas = $request->kelas;
        $pinjam->kode_barang = $request->kodebarang;
        $pinjam->nama_barang = $request->namabarang;
        $pinjam->pelajaran = $request->mapel;
        $pinjam->nama_guru = $request->namaguru;
        $pinjam->status = 'Belum Dikembalikan';

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
        $pinjam->kode_barang = $request->input('kodebarang'); //input gamasalah ya anjeng
        $pinjam->pelajaran = $request->input('mapel');
        $pinjam->nama_guru = $request->input('namaguru');
        $pinjam->status =  $request->input('status');
        $pinjam->save();


        return redirect()->route('datapinjam.index')->with('success', 'Data Pinjam berhasil disimpan.');
    }

    public function destroy($id)
    {
        $dataPinjam = DataPinjam::find($id);
        if(!$dataPinjam) {
            return redirect()->route('datapinjam.index')->with('error', 'Data Pinjam not found.');
        }
        //gila pusing bikin nih method
        $barang = DataBarang::find($dataPinjam->nama_barang);
        if($barang) {
            $barang->jumlah += 1;
            $barang->save();
        }

        $dataPinjam->delete();

        return redirect()->route('datapinjam.index')->with('success', 'Information deleted successfully.');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('datapinjam.login');
    }

    public function getName(Request $request)
    {
        $id = $request->id;
        $barang = DataBarang::where('kode_barang', $id)->pluck('nama', 'id');

        $options = '';
        foreach ($barang as $key => $item) {
            $options .= '<option value="' . $key . '">' . $item . '</option>';
        }
        return response()->json(['msg' => 'berhasil', 'data' => $options]);
    }

}
// dia adalah orang yang selalu tertarik mendengarkan ceritaku
// meski kadang ceritaku aneh dan gajelas, dan di pikiran orang lain mungkin gw udah dibilang orang halu/gila
// entahlah, semoga dia baik baik saja ☆*: .｡. o(≧▽≦)o .｡.:*☆
// aku mencintaimu, nurfalah maulina!<3
