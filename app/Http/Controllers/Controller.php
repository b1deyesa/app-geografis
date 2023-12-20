<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $marker = [];
        $umkms = Umkm::where('status', 'accepted')->get();

        foreach ($umkms as $umkm) {
            $marker[] = [
                'position' => [
                    'lat' => $umkm->latitude,
                    'lng' => $umkm->longitude
                ],
                'draggable' => false,
                'umkm' => [
                    'nama' => $umkm->nama_umkm,
                    'pemilik' => $umkm->pemilik_umkm,
                    'telp' => $umkm->no_telp,
                    'gambar' => $umkm->gambar
                ]
            ];
        }

        return view('index', compact('marker'));
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function loginRegist()
    {
        return view('login-regist');
    }

    public function regist(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'regist_username' => 'required|unique:users,username',
            'regist_telp' => 'required',
            'regist_password' => 'required'
        ], [
            'regist_username.required' => 'Username harus diisi',
            'regist_username.unique' => 'Username telah terdaftar',
            'regist_telp.required' => 'No Telp. harus diisi',
            'regist_password.required' => 'Password harus diisi'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('regist-fails', '')->withErrors($validate)->withInput();
        }

        User::create([
            'username' => $request->regist_username,
            'telp' => $request->regist_telp,
            'password' => $request->regist_password,
            'role' => 'user'
        ]);

        return redirect()->back()->with('regist-success', '');
    }

    public function login(Request $request)
    {
        $credenitials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi'
        ]);

        $credenitials = $request->only('username', 'password');
        if (Auth::attempt($credenitials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('index');
            }
        }

        return redirect()->back()->with('login-fails', '');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'user') {
            return redirect()->back();
        }

        return view('dashboard', [
            'umkms' => Umkm::orderBy('status', 'asc')->get(),
            'users' => User::where('role', 'user')->get()
        ]);
    }

    public function umkm()
    {
        if (Auth::user()->role == 'user') {
            return redirect()->back();
        }

        return view('umkm', [
            'umkms' => Umkm::orderBy('id', 'desc')->get(),
            'users' => User::where('role', 'user')->get()
        ]);
    }

    public function umkm_tambah()
    {
        return view('tambah-umkm');
    }

    public function umkm_store(Request $request)
    {
        $request->validate([
            'nama_umkm' => 'required',
            'pemilik_umkm' => 'required',
            'no_telp' => 'required',
            'alamat_umkm' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong'
        ]);

        $nama_gambar = null;
        if ($request->gambar != null) {
            $nama_gambar = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('img/umkm'), $nama_gambar);
        }

        Umkm::create([
            'user_id' => Auth::id(),
            'nama_umkm' => $request->nama_umkm,
            'pemilik_umkm' => $request->pemilik_umkm,
            'no_telp' => $request->no_telp,
            'alamat_umkm' => $request->alamat_umkm,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'gambar' => $nama_gambar,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambah UMKM');
    }

    public function umkm_accepted(Umkm $umkm)
    {
        $umkm->update([
            'status' => 'accepted'
        ]);

        return redirect()->back();
    }

    public function umkm_pending(Umkm $umkm)
    {
        $umkm->update([
            'status' => 'pending'
        ]);

        return redirect()->back();
    }

    public function umkm_delete(Umkm $umkm)
    {
        $umkm->delete();

        return redirect()->back();
    }

    public function umkm_edit(Umkm $umkm)
    {
        return view('edit-umkm', [
            'umkm' => $umkm
        ]);
    }

    public function umkm_update(Request $request, Umkm $umkm)
    {
        $request->validate([
            'nama_umkm' => 'required',
            'pemilik_umkm' => 'required',
            'no_telp' => 'required',
            'alamat_umkm' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong'
        ]);

        if ($request->gambar != null) {
            $nama_gambar = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('img/umkm'), $nama_gambar);
        } else {
            $nama_gambar = $umkm->gambar;
        }

        $umkm->update([
            'nama_umkm' => $request->nama_umkm,
            'pemilik_umkm' => $request->pemilik_umkm,
            'no_telp' => $request->no_telp,
            'alamat_umkm' => $request->alamat_umkm,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'gambar' => $nama_gambar,
        ]);

        return redirect()->back()->with('success', 'Berhasil Ubah UMKM');
    }
}
