<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

// TODO: Import model Mahasiswa, import resource MahasiswaResource
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;

class MahasiswaController extends Controller
{
    public function index()
    {
        // TODO: Ambil semua data Mahasiswa
        $mahasiswa = Mahasiswa::latest()->paginate();

        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswa);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswa,nim',
            'jurusan' => 'required|string',
            'fakultas' => 'required|string',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto_profil = $request->file('foto_profil');
        $foto_profil->storeAs('foto_profil', $foto_profil->hashName());

        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
            'foto_profil' => $foto_profil->hashName(),
        ]);

        // TODO: Return object MahasiswaResource dengan argument (true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa)
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa);
    }

    public function show($id)
    {
        // TODO: Lakukan pencarian data Mahasiswa berdasarkan id 
        $mahasiswa = Mahasiswa::find(id: $id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return new MahasiswaResource(true, 'Detail Data Mahasiswa!', $mahasiswa);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string',
            'nim' => 'sometimes|required|string|unique:mahasiswa,nim,' . $id,
            'jurusan' => 'sometimes|required|string',
            'fakultas' => 'sometimes|required|string',
            'foto_profil' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['nama', 'nim', 'jurusan', 'fakultas']);

        if ($request->hasFile('foto_profil')) {
            if ($mahasiswa->foto_profil && Storage::exists('foto_profil/' . $mahasiswa->foto_profil)) {
                Storage::delete('foto_profil/' . $mahasiswa->foto_profil);
            }

            $foto_profil = $request->file('foto_profil');
            $foto_profil->storeAs('foto_profil', $foto_profil->hashName());
            $data['foto_profil'] = $foto_profil->hashName();
        }

        $mahasiswa->update($data);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        // TODO: Hapus data gambar
        if ($mahasiswa->foto_profil && Storage::exists('foto_profil/' . $mahasiswa->foto_profil)) {
            Storage::delete('foto_profil/' . $mahasiswa->foto_profil);
        }

        // TODO: Hapus data mahasiswa
        $mahasiswa->delete();

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }
}

