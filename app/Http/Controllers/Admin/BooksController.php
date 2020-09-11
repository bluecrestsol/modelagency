<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Model;
use App\Models\BooksItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'model_id' => 'required',
            'name' => 'required'
        ]);
        
        $data = $request->except(['_token', '_method']);

        $data['uuid'] = Book::generateUuid();
        
        $data = Book::create($data);

        return redirect()->route('models.books', $data->model_id)->with('message', 'Book successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find model id = uuid
        $uuid = $id;
        $data = Book::where('uuid', $uuid)->first();
        return view('admin.books.show', compact('data'));
        //return amdin.books.show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //find model id = uuid
         $uuid = $id;
         $data = Book::where('uuid', $uuid)->first();
         //get existing ids of photos
         $photos = BooksItem::where('book_id', $data->id)->whereNotNull('models_photo_id')->get();
         $existing_photos = [];
         foreach ($photos as $a) {
            $existing_photos[] = $a->models_photo_id;
         }
         //get ecisting ids of clips
         $clips = BooksItem::where('book_id', $data->id)->whereNotNull('models_clip_id')->get();
         $existing_clips = [];
         foreach ($clips as $a) {
            $existing_clips[] = $a->models_clip_id;
         }
         return view('admin.books.edit', compact('data', 'existing_clips', 'existing_photos'));
         //return amdin.books.show
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $update = Book::find($id);
        $data = $request->except(['_token', '_method']);
        $update->update($data);

        // return redirect()->route('models.books', $update->model_id)->with('message', 'Book successfully updated');
        session()->flash('message', 'Book successfully updated');
        return response()->json(['success' => 1, 'message' => 'Book successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find book
        $book = Book::find($id);
        //delete all items
        BooksItem::where('book_id', $book->id)->delete();
        //delete book
        $book->delete();
        //return json
        session()->flash('message', 'Book Successfully deleted');

        return response()->json(['success' => 1, 'redirect' => route('models.books', $book->model->id)]);
    }


    public function updateItems(Request $request, $uuid) {
        $book = Book::where('uuid', $uuid)->first();
        
        //remove all items to sync
        BooksItem::where('book_id', $book->id)->delete();

        if ($request->photos !== null) {
            foreach ($request->photos as $d) {
                $save = BooksItem::create([
                    'book_id' => $book->id,
                    'models_photo_id' => $d
                ]);
            }
        }
        
        if ($request->clips !== null) {
            foreach ($request->clips as $d) {
                $save = BooksItem::create([
                    'book_id' => $book->id,
                    'models_clip_id' => $d
                ]);
            }
        }
        

        return redirect()->route('models.books', $book->model->id)->with('message', 'Items updated');
    }

    public function full($model_uuid)
    {
        $data = Model::where('uuid', $model_uuid)->first();
        
        return view('admin.books.show_full', compact('data'));
    }
}
