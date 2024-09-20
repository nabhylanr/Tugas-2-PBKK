<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
	public function index()
	{
		$menu = Menu::paginate(5);

		return view('menu.index', ['data' => $menu]);
	}

	public function tambah()
	{
		$kategori = Kategori::get();

		return view('menu.form', ['kategori' => $kategori]);
	}

	public function simpan(Request $request)
	{
		$data = [
			'kode_menu' => $request->kode_menu,
			'nama_menu' => $request->nama_menu,
			'id_kategori' => $request->id_kategori,
			'harga' => $request->harga,
			'jumlah' => $request->jumlah,
		];

		Menu::create($data);

		return redirect()->route('menu');
	}

	public function edit($id)
	{
		$menu = Menu::find($id)->first();
		$kategori = Kategori::get();

		return view('menu.form', ['menu' => $menu, 'kategori' => $kategori]);
	}

	public function update($id, Request $request)
	{
		$data = [
			'kode_menu' => $request->kode_menu,
			'nama_menu' => $request->nama_menu,
			'id_kategori' => $request->id_kategori,
			'harga' => $request->harga,
			'jumlah' => $request->jumlah,
		];

		Menu::find($id)->update($data);

		return redirect()->route('menu');
	}

	public function hapus($id)
	{
		Menu::find($id)->delete();

		return redirect()->route('menu');
	}

	public function search(Request $request)
{
    // Get the search keyword from the request
    $keyword = $request->input('search');

    if ($keyword) {
        // If a keyword is provided, search for matching items
        $menu = Menu::where('nama_menu', 'like', "%" . $keyword . "%")->paginate(5);
    } else {
        // If no keyword is provided, return all items with pagination
        $menu = Menu::paginate(5);
    }

    // Return the results to the same view
    return view('menu.index', ['data' => $menu]);
}

}