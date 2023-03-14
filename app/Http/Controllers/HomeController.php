<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books= Book::all();
        return view('home', ['books' => $books]);
    }
    public function search(Request $request)
    {
    $query = $request->input('query');

    $books = Book::where('judul', 'LIKE', "%$query%")
                 ->orWhere('pengarang', 'LIKE', "%$query%")
                 ->orWhere('penerbit', 'LIKE', "%$query%")
                 ->get();

    return view('home', ['books' => $books]);
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('home', ['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->judul = $request->input('judul');
        $book->pengarang = $request->input('pengarang');
        $book->penerbit = $request->input('penerbit');
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('cover/', $request->file('gambar')->getClientOriginalName());
            $book->gambar = $request->file('gambar')->getClientOriginalName();
            $book->save();
        }
        $book->save();
        return redirect('/home');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/home');
    }
}
