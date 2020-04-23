@extends('layouts.app')

@section('content')

<h1>Criar loja</h1>

<form action="{{route('admin.stores.update',$store->id)}}" method="post" enctype="multipart/form-data">
 @csrf
 @method('put')
<div class="form-group">
<label for="name">Nome Loja</label>
<input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ $store->name }}">
@error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
 @enderror
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$store->description}}">

    @error('description')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Telefone</label>
    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$store->phone}}">

    @error('phone')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Celular/Whatsapp</label>
    <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">

    @error('mobile_phone')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{$store->slug}}">

    @error('slug')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <p>
    <img src="{{asset('storage/'.$store->logo)}}" class="img-fluid">
    </p>
    <label>Fotos da loja</label>
    <input type="file" name="logo" class="form-control  @error('logo') is-invalid @enderror">

    @error('logo')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div>
    <button type="submit" class="btn btn-lg btn-success">Atualizar Loja</button>
</div>
</form>


@endsection