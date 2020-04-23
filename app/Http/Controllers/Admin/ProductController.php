<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         private $product;
     public function __construct(Product $product )
     {
         $this->product=$product;
     }
    public function index()
    {
        $store =Auth::user()->store;
        $products = $store->products()->paginate(10);

       return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all(['id','name']);
    return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $dados =$request->all();
        $imagens =$request->photos;
       
        $store = Auth::user()->store;

     

       $products = $store->products()->create($dados);

       $products->categories()->sync($dados['categories']);
       if($request->hasFile('photos'))
       {
         $fotos = $this->uploadImages($imagens,'image');

         $products->photos()->createMany($fotos);
       }

       
        flash('Produtos inseridos com sucesso!')->success();
        return redirect()->route('admin.products.index');
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
        $product =$this->product->find($id);
        $categories =Category::all(['id','name']);
        return view('admin.products.edit',compact('product','categories'));
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
        $dados =$request->all();
        $product =$this->product->find($id);
        $product->update($dados);
        $product->categories()->sync($dados['categories']);

         $imagens =$request->photos;
        if($request->hasFile('photos'))
        {
          $fotos = $this->uploadImages($imagens,'image');
 
          $product->photos()->createMany($fotos);
        }

        flash('Produtos atualizados com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =$this->product->find($id);
        $product->delete();
        flash('Produtos apagados com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }
    private function uploadImages($imagens,$coluna)
    {
        
        $upimagem =[];
        foreach($imagens as $imagem)
        {
           $upimagem[] =[$coluna => $imagem->store('products','public')];
        }
        return $upimagem;

    }
}
