@extends('layouts.app')

@section('content')

<h1>Criar loja</h1>

<form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">
 @csrf
<div class="form-group">
<label for="name">Nome Loja</label>
<input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{old('name')}}">
@error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
 @enderror
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

    @error('description')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Telefone</label>
    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">

    @error('phone')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Celular/Whatsapp</label>
    <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{old('mobile_phone')}}">

    @error('mobile_phone')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{old('slug')}}">

    @error('slug')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Fotos da Loja</label>
    <input type="file" name="logo" class="form-control  @error('logo') is-invalid @enderror">

    @error('logo')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div>
    <button type="submit" class="btn btn-lg btn-success">Criar Loja</button>
</div>
</form>


@endsection