<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $product;
    protected $tag;

    public function __construct(Product $product, Tag $tag)
    {
        $this->product = $product;
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tag->all();
        return view('products.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->cost = $request->cost;
        $product->sale = $request->sale;
        $product->save();

        foreach($_POST['tags'] as $tag){
            $product->tags()->save(Tag::find($tag));

        }
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $product = $this->product->find($id);
        $tags = $this->tag->all();

        $productsTags = DB::table('product_tag')->where('product_id','=',$id)->get();

        $productsTagsResult = null;
        foreach($productsTags as $key => $productTag){
            $productsTagsResult[] = $productTag->tag_id;
        }

        return view('products.edit', [
            'tags'    => $tags,
            'product' => $product,
            'productsTagsResult' => $productsTagsResult
        ]);
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
        $product = $this->product->find($id);

        $data = $request->all();
        $product->update($data);

        foreach($_POST['tags'] as $tag){
            $product->tags()->save(Tag::find($tag));

        }
        return response()->json($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        $product->delete();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $products = $this->product->search($request->filter);

        return view('products.index', ['products' => $products]);
    }
}
