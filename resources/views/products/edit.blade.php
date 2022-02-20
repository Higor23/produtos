@extends('template.template')

@section('title', 'Editar Produto')

@section('content')

    <div class="mb-3">
        <h3>Editar Produto</h3>
        <div class="btn-cad">
            <a class="btn btn-primary" href="{{ route('product.index') }}">Voltar</a>
        </div>
        <div>
            <form method="POST" id="form-edit-product" enctype="multipart/form-data">
                @csrf
  
                <div class="col-md-5 div-input">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name ?? old('product') }}" placeholder="Digite o nome do produto">
                </div>
                <div class="col-md-2 div-input">
                    <label>Preço de custo (R$)</label>
                    <input type="float" class="form-control" name="cost" value="{{ $product->cost ?? old('product') }}" placeholder="ex.: 10,00">
                </div>
                <div class="col-md-2 div-input">
                    <label>Preço de venda (R$)</label>
                    <input type="float" class="form-control" name="sale" value="{{ $product->sale ?? old('product') }}" placeholder="ex.: 20,00">
                </div>

                <div id="div-checkbox" class="div-input">
                    <p><label for="">Tags</label></p>
                    @foreach ($tags as $tag)
                        <input type="checkbox" id="{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]" {{ ((!empty($productsTagsResult)) and in_array($tag->id, $productsTagsResult)) ? ' checked' : ''}}>
                        <label for="{{ $tag->id }}" class="checkbox-label">{{ $tag->name }}</label>
                    @endforeach
                </div>
        
                <div>
                    <button type="submit" id="btn-send-product" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on('submit', '#form-edit-product', function(e) {
            e.preventDefault();

            dataForm = $('#form-edit-product').serialize();
            console.log(dataForm);
            $.ajax({
                url: "{{ route('product.update', [$product->id]) }}",
                type: "POST",
                data: dataForm,
                success: function(response) {
                    if (response) {
                        Swal.fire(
                                'Produto editado com sucesso!',
                            )
                            
                    }
                },
                error: function(data) {
                    $("#form-edit-product")[0].reset();
                    $('#edit-product').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Não foi possível cadastrar o produto!',
                    })
                }
            });
        });
    </script>
@endsection
