<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function index(){
        $data = User::first()->simplePaginate(10);
        return view('dataUser', compact('data'));
    }

    function promote($id){
        $data = User::find($id);
        if ($data) {
            $data->role = 'atasan'; 
            $data->save();
            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }
    function demote($id){
        $data = User::find($id);
        if ($data) {
            $data->role = 'normal'; 
            $data->save();
            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    function delete($id){
        $data = User::find($id);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus!');;
        }
    }
}
