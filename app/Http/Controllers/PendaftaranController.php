<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan form pendaftaran
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('pendaftar.create', compact('jurusan'));
    }

    /**
     * Simpan data pendaftaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'nisn'            => 'required|string|max:15|unique:pendaftar,nisn',
            'tempat_lahir'    => 'required|string',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required',
            'no_hp'           => 'required',
            'email'           => 'required|email',
            'sekolah_asal'    => 'required',
            'nilai'           => 'required|numeric|min:0|max:100',
            'jurusan_id'      => 'required|exists:jurusan,id',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto
        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_siswa', 'public');
        }

        Pendaftar::create([
            'user_id'        => auth()->id(),
            'no_pendaftaran' => 'PPDB-' . strtoupper(Str::random(8)),
            'nama_lengkap'   => $request->nama_lengkap,
            'nisn'           => $request->nisn,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'no_hp'          => $request->no_hp,
            'email'          => $request->email,
            'sekolah_asal'   => $request->sekolah_asal,
            'nilai'          => $request->nilai,
            'jurusan_id'     => $request->jurusan_id,
            'foto'           => $foto,
        ]);

        return redirect()->route('pendaftaran.create')
            ->with('success', 'Pendaftaran berhasil dikirim');
    }
}
