<?php

namespace App\Http\Controllers\library;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookTag;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\Reader;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('home',compact('books'));
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
        //
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
        $item = Book::findOrFail($id);
        $itemList = Book::all();
        $shelves = Shelf::all();
        $categories = Category::all();
        $tags = Tag::all();
        $readers = Reader::all();
        return view('edit',compact('item', 'itemList','shelves','categories','tags','readers'));
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
        $rules = [
            'name' => 'required|min:5|max:200',
            'author' => 'max:200',
            'category_id' => 'required|integer|exist:categories,id',
        ];

        $validatedData = $this-> validate($request,$rules);

        $item = Book::find($id);
        $BC = DB::table('book_category')->where('book_id', $id)->value('id');
        $BT = DB::table('book_tag')->where('book_id', $id)->value('id');
        $BookCategory = BookCategory::find($BC);
        $BookTag = BookTag::find($BT);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);
        }
        $data = $request->only('name','author','date_take','shelf_id','reader_id');
        $result = $item
            ->fill($data)
            ->save();
        $data_category = $request->only('category_id');
        $result_category = $BookCategory
            ->fill($data_category)
            ->save();
        $data_tag = $request->only('tag_id');
        $result_tag = $BookTag
            ->fill($data_tag)
            ->save();

        $request->validate([

            // файл должен быть картинкой (jpeg, png, bmp, gif, svg или webp)
            'image' => 'image',

            // поддерживаемые MIME файла (image/jpeg, image/png)
            'image' => 'mimetypes:image/jpeg,image/png',

        ]);


        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_path = $request->file('image')->store('public') ;
            $array = [
                'picture' => $file_path
            ];
            $result_path = $item
                ->fill($array)
                ->save();
        }
        if ($result) {
            return redirect()
                ->route('books.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg'=> 'Ошибка сохранения']);
        }
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