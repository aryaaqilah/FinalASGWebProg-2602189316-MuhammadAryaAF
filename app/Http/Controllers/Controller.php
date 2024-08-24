<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

// public function index()
// {
//     $books = Book::paginate(10);
//     return view('home',['books' => $books]);
// }
// public function detail ($id){
//     $detail = Detail::select('*')->where('book_id', '=', $id)->get();

//     return view('detail',compact('detail'));
// }
// public function category($id)
// {
//     $category = Category::find($id);
//     $books = Book::select('*')->where('category_id', '=', $id)->paginate(10);
//     // $books = Book::paginate(10);
//     return view('category',compact('category', 'books'));
// }
// public function create()
// {

// }
// public function store(Request $request)
// {

// }
// public function show(Book $book)
// {

// }
// public function edit(Book $book)
// {

// }
// public function update(Request $request, Book $book)
// {

// }
// public function destroy(Book $book)
// {

// }
