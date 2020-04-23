<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removerPhoto(Request $request)
    {
        $photoName =$request->photoname; 
        if(Storage::disk('public')->exists($photoName))
        {
            Storage::disk('public')->delete($photoName);
        }

        //Remover do banco
        $remover =ProductPhoto::where('image',$photoName);
        $id =$remover->first()->product_id;
        $remover->delete();
        flash('Imagem removida com sucesso')->success();
        return redirect()->route('admin.products.edit',$id);
    }
}
