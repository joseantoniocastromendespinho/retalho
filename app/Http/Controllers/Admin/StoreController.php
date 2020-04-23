<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
private $store;
     public function __construct(Store  $store)
     {
         $this->store = $store;
   //      $this->middleware( 'user.has.store')->only(['create','store']);
     }
    public function index()
    {
     $store =Auth::user()->store;
     if(is_null($store))
     return redirect()->route('admin.stores.create');
     return view('admin.stores.index',compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(!Auth::user()->store()->count())
        {
            flash('Voce ja possui uma loja!')->warning();
            return redirect()->route('admin.stores.index');
        }

        
        $user = User::all(['id','name']);
        return view('admin.stores.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
      $dados = $request->all();

      $user = auth()->user();

      if($request->hasFile('logo'))
      {
        $dados['logo'] = $this->uploadImages($request->logo);
      }
    
    
     $user->store()->create($dados);

      flash('Dados gravados com sucesso')->success();
      return redirect()->route('admin.stores.index');
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
        $store =Store::find($id);
        return view('admin.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $store =Store::find($id);
        $dados = $request->all();
        if($request->hasFile('logo'))
        {
            if(Storage::disk('public')->exists($store->logo))
            {
                Storage::disk('public')->delete($store->logo);
            }
          $dados['logo'] = $this->uploadImages($request->logo);
        }

        $store->update($dados);



        flash('Dados atualizados com secesso!')->success();
        return redirect()->route('admin.stores.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store =Store::find($id);
        $store->delete();

        
        flash('Dados Apagados com sucesso')->success();
        
        return redirect()->route('admin.stores.index');
    }
    private function uploadImages($imagem)
    {

           return $imagem->store('stories','public');  

    }
}
