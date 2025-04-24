<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // ==================2==================
        // - Buat object mahasiswa dengan data dummy (nama, nim, email, jurusan, fakultas, foto)
        // - Kirim object tersebut ke view 'profil'
        $mahasiswa = (object) [
            'nama' => 'Amonali',
            'nim' =>  '11111111111',
            'email' => "Amonali@gmail.com",
            'jurusan' => "SISTEM INFORMASI",
            'fakultas' => "FRI",
            'foto' => asset('images/download.png')];

        return view('profil', ['mahasiswa' => $mahasiswa]);
    }
}
