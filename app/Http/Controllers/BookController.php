<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('dashboard', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('cover/', $request->file('gambar')->getClientOriginalName());
            $book->gambar = $request->file('gambar')->getClientOriginalName();
            $book->save();
        }
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id); // Ambil data buku dari database berdasarkan id
        return view('edit', compact('book')); // Kirim data buku ke view edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->judul = $request->input('judul');
        $book->pengarang = $request->input('pengarang');
        $book->penerbit = $request->input('penerbit');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('cover'), $filename);
            $book->gambar = $filename;
        }

        $book->save();

        return redirect('/home')->with('success', 'Buku berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}