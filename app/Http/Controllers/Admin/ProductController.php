<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductImageRequest;
use App\Product;
use App\ProductImage;
use App\Category;
use App\Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->data['statuses'] = Product::statuses();
        $this->data['types'] = Product::types();
    }

    public function index()
    {
        $this->data['products'] = Product::orderBy('name', 'asc')->paginate(10);
        return view('admin.products.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $configurableAttributes = $this->getCongurableAttributes();

        $this->data['configurableAttributes'] = $configurableAttributes;
        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = null;
        $this->data['categoryIDs'] = [];
        $this->data['productID'] = 0;
        return view('admin.products.form', $this->data);
    }

    public function getCongurableAttributes()
    {
        return Attribute::where('is_configurable', '1')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // params = mengambil semua inputan user kecuali input token
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['user_id'] = Auth::user()->id;

        $saved = false;
        $saved = DB::transaction(function() use ($params) {
            $product = Product::create($params);
            $product->categories()->sync($params['category_ids']);
            return true;
        });

        if($saved) {
            session()->flash('success', 'Product has been saved.');
        } else {
            session()->flash('error', 'Product could no be saved.');
        }

        return redirect()->route('products.index');
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
        if(empty($id)) {
            return redirect()->route('products.create');
        }

        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = $product;
        $this->data['productID'] = $product->id;
        $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();

        return view('admin.products.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        $product = Product::findOrFail($id);

        $saved = false;
        $saved = DB::transaction(function() use ($product, $params) {
            $product->update($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if($saved) {
            session()->flash('success', 'Product has been updated.');
        } else {
            session()->flash('error', 'Product could no be updated.');
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->delete()) {
            session()->flash('success', 'Product has been deleted');
            return redirect()->route('products.index');
        }
    }

    public function images($id)
    {
        if(empty($id)) {
            return redirect()->route('products.create');
        }

        $product = Product::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['productImages'] = $product->productImages;

        return view('admin.products.images', $this->data);
    }

    public function add_image($id)
    {
        if(empty($id)) {
            return redirect()->route('products.create');
        }

        $product = Product::findOrFail($id);
        $this->data['productID'] = $product->id;
        $this->data['product'] = $product;

        return view('admin.products.image_form', $this->data);
    }

    public function upload_image(ProductImageRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        if($request->has('image')) {
            $image = $request->file('image');
            $name = $product->slug.'_'.time();
            $fileName = $name. '.' .$image->getClientOriginalExtension();

            $folder = '/uploads/images';
            $filePath = $image->storeAs($folder, $fileName, 'public');

            $params = [
                'product_id' => $product->id,
                'path' => $filePath,
            ];

            if(ProductImage::create($params)) {
                session()->flash('success', 'Image has been uploaded.');
            } else {
                session()->flash('error', 'Image could be uploaded.');
            }

            return redirect()->to('admin/products/' . $id . '/images');
        }
    }

    public function remove_image($id)
    {
        $image = ProductImage::findOrFail($id);
        if($image->delete()) {
            Storage::disk('public')->delete($image->path);
            session()->flash('success', 'Image has been deleted.');
        }
        // admin/products/5/images
        return redirect()->to('admin/products/' . $image->product_id . '/images');
    }
}
