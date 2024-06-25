<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;

class AtasanController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel disposisis
        $disposisis = Disposisi::all();

        // Mengelompokkan data berdasarkan kolom `Tanggal Surat`, `Nomor Surat Masuk`, `Perihal`, dan `Pengirim`
        $grouped = $disposisis->groupBy(function ($item) {
            return $item['tanggal_surat'] . '-' . $item['nomor_surat_masuk'] . '-' . $item['perihal'] . '-' . $item['pengirim'] ;
        });

        // Menyiapkan hasil akhir
        $result = $grouped->map(function ($group) {
            $first = $group->first();
            $first->keterangan_disposisi = $group->map(function ($item) {
                return [
                    'tgl' => $item->created_at,
                    'oleh' => $item->user->name,
                    'disposisi' => $item->disposisi
                ];
            });
            return $first;
        })->values(); // Convert the collection back to array

        return view('coba', ['disposisis' => $result]);
    }
}
