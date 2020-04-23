@extends('layouts.app')


@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$product->body}}</textarea>

            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">

            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Categorias</label>
            <select class="form-control" name="categories[]" multiple>
                @foreach ($categories as $category)
            <option value="{{$category->id}}" 
            @if($product->categories->contains($category))
                selected
            @endif>
            {{$category->name}}

            </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos da Loja</label>
            <input type="file" name="photos[]" class="form-control" multiple>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" id="price" class="form-control @error('slug') is-invalid @enderror" value="{{$product->slug}}">

            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

     

        <div>
            <button type="submit" class="btn btn-lg btn-success">Editar Produto</button>
        </div>
    </form>
    <hr>
    <div class="row">
        @foreach ($product->photos as $photo)
            
        <div class="col-4 text-center">
        <img src="{{asset('storage/'.$photo->image)}}" class="img-fluid">
        <form action="{{route('admin.remove.photo')}}" method="POST">
        <input type="hidden" name="photoname" value="{{$photo->image}}">
            @csrf
         <button type="submit" class="btn btn-danger btn-lg">REMOVER</button>
        </form>

        </div>
        @endforeach
    </div>
@endsection