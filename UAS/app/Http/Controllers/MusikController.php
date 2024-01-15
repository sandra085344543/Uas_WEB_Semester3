<?php

namespace App\Http\Controllers;

use App\Models\Musik;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MusikController extends Controller
{

    public function index()
    {

        $query = Musik::latest();
        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('sinopsis', 'like', '%' . request('search') . '%');
        }
        $musiks = $query->paginate(6)->withQueryString();
        return view('homepage', compact('musiks'));
    }

    public function detail($id)
    {
        $musik = Musik::find($id);
        return view('detail', compact('musik'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255', Rule::unique('musik', 'id')],
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'songwriter' => 'required|string',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Jika validasi gagal, kembali ke halaman input dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect('musiks/create')
                ->withErrors($validator)
                ->withInput();
        }

        $randomName = Str::uuid()->toString();
        $fileExtension = $request->file('foto_sampul')->getClientOriginalExtension();
        $fileName = $randomName . '.' . $fileExtension;

        // Simpan file foto ke folder public/images
        $request->file('foto_sampul')->move(public_path('images'), $fileName);
        // Simpan data ke table movies
        Musik::create([
            'id' => $request->id,
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'sinopsis' => $request->sinopsis,
            'tahun' => $request->tahun,
            'songwriter' => $request->songwriter,
            'foto_sampul' => $fileName,
        ]);

        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $musiks = Musik::latest()->paginate(10);
        return view('data-musik', compact('musiks'));
    }

    public function edit($id)
    {
        $musik = Musik::find($id);
        $categories = Category::all();
        return view('form-edit', compact('musik', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'songwriter' => 'required|string',
            'foto_sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika validasi gagal, kembali ke halaman edit dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect("/musik/{id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil data movie yang akan diupdate
        $musik = Musik::findOrFail($id);

        // Jika ada file yang diunggah, simpan file baru
        if ($request->hasFile('foto_sampul')) {
            $randomName = Str::uuid()->toString();
            $fileExtension = $request->file('foto_sampul')->getClientOriginalExtension();
            $fileName = $randomName . '.' . $fileExtension;

            // Simpan file foto ke folder public/images
            $request->file('foto_sampul')->move(public_path('images'), $fileName);

            // Hapus foto lama jika ada
            if (File::exists(public_path('images/' . $musik->foto_sampul))) {
                File::delete(public_path('images/' . $musik->foto_sampul));
            }

            // Update record di database dengan foto yang baru
            $musik->update([
                'judul' => $request->judul,
                'sinopsis' => $request->sinopsis,
                'category_id' => $request->category_id,
                'tahun' => $request->tahun,
                'songwriter' => $request->penemu,
                'foto_sampul' => $fileName,
            ]);
        } else {
            // Jika tidak ada file yang diunggah, update data tanpa mengubah foto
            $musik->update([
                'judul' => $request->judul,
                'sinopsis' => $request->sinopsis,
                'category_id' => $request->category_id,
                'songwriter' => $request->tahun,
                'penemu' => $request->penemu,
            ]);
        }

        return redirect('/musiks/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $musik = Musik::findOrFail($id);

        // Delete the movie's photo if it exists
        if (File::exists(public_path('images/' . $musik->foto_sampul))) {
            if ($musik->foto_sampul != 'default.jpg') {
                File::delete(public_path('images/' . $musik->foto_sampul));
            }
        }

        // Delete the movie record from the database
        $musik->delete();

        return redirect('/musiks/data')->with('success', 'Data berhasil dihapus');
    }
}
