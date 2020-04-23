@extends('layouts.app')

@section('content')

@if($store)
<a href="{{route('admin.stores.create')}}" class="btn btn-success btn-lg mb-4">Criar Loja</a>
@endif
<table class="table table-striped">
    <thead>
        <tr>
          <th>#</th>
          <th>lOJA</th>
          <th>ACÇÕES</th>
          
        </tr>
    </thead>
        <tbody>
           
                
            
        <tr>
        <td>{{$store->id}}</td>
        <td>{{$store->name}}</td>
       
        <td>
            <div class="btn-group">
        <a href="{{route('admin.stores.edit',$store->id)}}" class="btn btn-primary btn-sm">Editar</a>
        <form action="{{route('admin.stores.destroy',$store->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit"  class="btn btn-danger btn-sm">Remover</button>
        </form>
        
    </div>
        <td>
        
        </tr>
       
       
    </tbody>
   
</table>


@endsection