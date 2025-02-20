<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            // Mahasiswa Data
            $mahasiswa = DB::table('mahasiswa')
                ->join('users', 'mahasiswa.NIM', '=', 'users.NIM')
                ->where('mahasiswa.NIM', '=', auth()->user()->NIM)
                ->get();

            $pengajuan = KRS::latest()->paginate(5);
            return view("pages.{$page}", compact('pengajuan', 'mahasiswa'));
        }

        return abort(404);
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }
}
