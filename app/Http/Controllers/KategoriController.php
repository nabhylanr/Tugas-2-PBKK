<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
	public function index()
	{
    	$kategori = Kategori::with('menu')->paginate(5); // Fetching kategori with related menus
    	return view('kategori.index', compact('kategori')); // Passing 'kategori' to the view
	}

	

	public function tambah()
	{
		return view('kategori.form');
	}

	public function simpan(Request $request)
	{
		Kategori::create(['nama' => $request->nama]);

		return redirect()->route('kategori');
	}

	public function edit($id)
	{
		$kategori = Kategori::find($id)->first();

		return view('kategori.form', ['kategori' => $kategori]);
	}

	public function update($id, Request $request)
	{
		Kategori::find($id)->update(['nama' => $request->nama]);

		return redirect()->route('kategori');
	}

	public function hapus($id)
{
    // Find the category by its ID and delete it
    Kategori::find($id)->delete();

    // Redirect to the category list after deletion
    return redirect()->route('kategori');
}


	public function search(Request $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $kategori = Kategori::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        } else {
            $kategori = Kategori::paginate(5);
        }

        return view('kategori.index', ['kategori' => $kategori]);
    }
}