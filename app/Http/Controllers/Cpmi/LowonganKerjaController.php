<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LowonganKerja;
use App\Models\Negara;
use Illuminate\Http\Request;

class LowonganKerjaController extends Controller
{
    public function index(Request $request)
    {
        $cpmi  = auth('cpmi')->user();
        $query = LowonganKerja::with('negara', 'kategori', 'lamaranKerja')->where('status', 'Publish');

        if ($request->has('search')) {
            $query = $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != "Semua") {
            $query = $query->where('kategori_id', $request->kategori);
        }

        if ($request->has('negara') && $request->negara != "Semua") {
            $query = $query->where('negara_id', $request->negara);
        }

        $lowonganKerja = $query->paginate(12);

        if ($request->ajax()) {
            return view('cpmi.lowongan_kerja.data', compact('lowonganKerja'))->render();
        }

        $negara   = Negara::all();
        $kategori = Kategori::all();
        $jsFile   = 'resources/js/cpmi/lowongan_kerja/index.js';
        return view('cpmi.lowongan_kerja.index', compact('negara', 'kategori', 'jsFile', 'cpmi'));
    }

    public function show($slug) 
    {
        $lowonganKerja = LowonganKerja::with('negara', 'kategori', 'lamaranKerja')->where('slug', $slug)->first();
        $cpmi  = auth('cpmi')->user();
        $jsFile   = 'resources/js/cpmi/lowongan_kerja/show.js';
        return view('cpmi.lowongan_kerja.show', compact('lowonganKerja', 'cpmi', 'jsFile'));
    }
}
