
@extends('layouts.app')


@section('content')
<a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Loja</th>
                <th>Total Produtos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->name}}</td>
                    <td>E$ {{number_format($p->price, 2, ',', '.')}}</td>
                    <td>{{$p->store->name}}</td>
                    <td>{{$p->store->products->count()}}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{route('admin.products.edit',$p->id)}}" class="btn btn-sm btn-primary">EDITAR</a>
                        <form action="{{route('admin.products.destroy',$p->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$products->links()}}
@endsection