<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ==================2==================
        // - Set timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        // - Buat variabel nama, jam, waktu
        $nama = "Daniel Indra Kusuma";
        $jam = date('H:i:s');
        $waktu = date('H');
        // - Tentukan $salam berdasarkan jam (pagi, siang, sore, malam)
        if ($waktu >= 5 && $waktu < 12) {
            $salam = "Selamat Pagi";
        } elseif ($waktu >= 12 && $waktu < 15) {
            $salam = "Selamat Siang";
        } elseif ($waktu >= 15 && $waktu < 18) {
            $salam = "Selamat Sore";
        } else {
            $salam = "Selamat Malam";
        }
        // - Panggil fungsi getTanggal()
        $tanggal = $this->getTanggal();
        // - Kirim data ke view 'dashboard' 
        return view('dashboard', compact('salam', 'nama', 'jam', 'tanggal'));
    }

    private function getTanggal()
    {
        // ==================3==================
        // - Kembalikan tanggal sekarang dalam format dd-mm-yyyy
        return date('d-m-Y');
    }
}
