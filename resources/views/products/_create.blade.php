@extends('template.template')

@section('title', 'Criar Produto')

@section('content')

    <div class="mb-3">
        <form method="post" id="form-create-product">
            <label>Nome</label>
            <input type="text" class="form-control" name="name" placeholder="Digite o nome do produto">
            <button type="submit" id="btn-send-product">Cadastrar</button>
        </form>
    </div>
    {{-- <script src="{{url('js/product.js')}}"></script> --}}
@endsection
