<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use App\Models\Disposisi;
use App\Models\Kesimpulan;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Exception;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    
    public function addSurat(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:2048',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string',
        ]);

        try{
            $filename = $request->input('nomor') . '.pdf';
            // Simpan file ke direktori 'uploads'
            $path = $request->file('file')->move(public_path('uploads/surat/masuk'), $filename);
            // Simpan data ke database
            Surat::create([
                'nomor_surat' => $request->input('nomor'),
                'pengirim' => $request->input('pengirim'),
                'perihal' => $request->input('perihal'),
                'keterangan' => $request->input('keterangan'),
                'user_id' => Auth::id(),
            ]);
            Alert::success('Success!', 'Data berhasil ditambahakan!');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);

        } 
    }

    public function showSurat(){
        $data = Surat::latest()->simplePaginate(10);
        $disposisi = Disposisi::latest();
        return view('surat', compact('data', 'disposisi'));
    }
    public function deleteSurat($id){
        
        $data = Surat::find($id);
        if ($data) {
            // Hapus file dari sistem file
            $filePath = 'uploads/surat/masuk/'. $data->nomor_surat. '.pdf';

            if (file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }
            // Hapus data dari database
            $data->delete();
            Alert::success('Success!', 'Data berhasil dihapus!');
            return redirect()->back()->with('success', 'Data surat berhasil dihapus');
        }
    }

    public function viewFile($kondisi, $filename)
    {
        $filePath = 'uploads/surat/'. $kondisi. '/' . $filename. '.pdf';
        return response()->file(public_path($filePath));
    }
    public function blank()
    {
        return view('layouts.blank-page');
    }
    
    // Surat Keluar 
    public function showSuratKeluar(){
        $data = SuratKeluar::latest()->simplePaginate(10);
        return view('surat_keluar', compact('data'));
    }

    public function addSuratKeluar(Request $request)
    {
        
        $request->validate([
            'nomor' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:2048',
            'ditujukan' => 'required|string|max:255',
            'perihal' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        // Dapatkan nama file dari input form
        $filename = $request->input('nomor') . '.pdf';

        // Simpan file ke direktori 'uploads'
        $path = $request->file('file')->move(public_path('uploads/surat/keluar'), $filename);

        // Simpan data ke database
        SuratKeluar::create([
            'nomor_surat'   => $request->nomor,
            'ditujukan'     => $request->ditujukan,
            'perihal'       => $request->perihal,
            'keterangan'    => $request->keterangan,
            'user_id'       => Auth::id(),
        ]);
        Alert::success('Success!', 'Data berhasil ditambahkan');
        return back();
    }
    public function deleteSuratKeluar($id){
        
        $data = SuratKeluar::find($id);
        if ($data) {
            // Hapus file dari sistem file
            $filePath = 'uploads/surat/keluar/'. $data->nomor_surat. '.pdf';

            if (file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }
            // Hapus data dari database
            $data->delete();
            Alert::success('Success!', 'Data berhasil dihapus');
            return redirect()->back();
        }
    }

    public function addDisposisi(Request $request){
        $disposisi_id = Disposisi::create([
                    'surat_id'  => $request->surat_id,
                    'user_id'   => Auth::id(),
                    'disposisi' => $request->disposisi,
                ]);
        return redirect('/disposisi')->with('success', 'Disposisi berhasil ditambahkan ' );
    }

    public function disposisi(){
        // $result = Surat::with('disposisi')->get();
        $result = Surat::with('disposisi')->latest()->simplePaginate(10);
        return view('disposisi', compact('result'));
    }

    function updateDisposisi(Request $request, $id) {
        Surat::where('id', $id)
        ->where('id', $id)
            ->update([
                'keputusan' => $request->keputusan,
                'hasil'     => $request->hasil,
                'tindakan'  => $request->tindakan,
                'keterangan'=> $request->keterangan,
            ]);
        return redirect()->back()->with('success', 'Data berhasil diperbaharui ' );
    }

}
