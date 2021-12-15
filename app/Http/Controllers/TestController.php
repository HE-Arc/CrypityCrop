<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $folder = array(
            "credentials"=> [
                ["id"=> 1, "name"=> "test1", "username"=> "username 1", "email"=> "email 1", "password"=> "password 1"],
                ["id"=> 2, "name"=> "test2", "username"=> "username 2", "email"=> "email 2", "password"=> "password 2"],
                ["id"=> 3, "name"=> "test3", "username"=> "username 3", "email"=> "email 3", "password"=> "password 3"],
                ["id"=> 4, "name"=> "test4", "username"=> "username 4", "email"=> "email 4", "password"=> "password 4"],
                ["id"=> 5, "name"=> "test5", "username"=> "username 5", "email"=> "email 5", "password"=> "password 5"],
                ["id"=> 6, "name"=> "test6", "username"=> "username 6", "email"=> "email 6", "password"=> "password 6"],
                ["id"=> 7, "name"=> "test7", "username"=> "username 7", "email"=> "email 7", "password"=> "password 7"]
            ]
        );

        return inertia('Test/Index', compact('folder'));
        /*return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/
    }

    public function order()
    {
        $books = Book::with('author')->latest()->where('quantity', '<=', 0)->paginate(5);

        return inertia('Books/Order', compact('books'));
            //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return inertia('Books/Create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|min:5|max:25',
           'pages' => 'required|integer|gt:0|lt:1000',
           'quantity' => 'required|integer|gte:0|lt:100',
           'author_id' => 'nullable|integer|exists:authors,id'
        ]);

        // $book = new Book();
        // $book->title = $request->title;
        // $book->pages = $request->pages;
        // $book->quantity = $request->quantity;
        // $book->save();
        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success','Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book = Book::with('author')->where('id', $book->id)->firstOrFail();
        return inertia('Books/Show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::all();
        $book = Book::where('id', $id)->firstOrFail();
        return inertia('Books/Edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
           'title' => 'required|min:5|max:25',
           'pages' => 'required|integer|gt:0|lt:1000',
           'quantity' => 'required|integer|gte:0|lt:100',
           'author_id' => 'nullable|integer|exists:authors,id'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }
}