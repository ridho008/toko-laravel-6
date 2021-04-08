<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $keyword = '';
    public $paginate = 8;

    public function index(Request $request)
    {
      // $categories = $request->keyword === null ? 
      // Category::latest()->paginate($this->paginate) : 
      // Category::where('name', 'like', '%'.$request->keyword.'%')->paginate($this->paginate);
      $this->data['categories'] = Category::orderBy('name', 'desc')->paginate($this->paginate);
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // this->data undifined, artinya tidak ada variabel data yang didefenisikan di halaman create. maka dari itu akan di defenisikan di halaman Controller.php sehingga bisa digunakan dimana saja.
        return view('admin.category.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // $request->validate([
        //     'name' => 'required'
        // ]);

        // Category::create([
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        //     'parent_id' => 1
        // ]);

        // session()->flash('success', 'Success add new category');
        // return redirect()->back();

        // menangkan semua inputan field
        $params = $request->except('_token');
        // dd($params);
        $params['slug'] = Str::slug($params['name']);
        $params['parent_id'] = 0;
        if(Category::create($params)) {
            session()->flash('success', 'Category has been saved');
            return redirect()->route('categories.index');
        }
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
        $category = Category::findOrFail($id);
        $this->data['category'] = $category;
        return view('admin.category.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // mengambil inputan field = except
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        $category = Category::findOrFail($id);
        if($category->update($params)) {
            session()->flash('success', 'Category has been updated');
            return redirect()->route('categories.index');
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
        $category = Category::findOrFail($id);
        if($category->delete()) {
            session()->flash('success', 'Category has been deleted');
            return redirect()->route('categories.index');
        }
    }
}
