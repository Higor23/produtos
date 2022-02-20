@extends('template.template')

@section('title', 'Criar Produto')

@section('content')

    <div class="mb-3">
        <h3>Cadastrar Produto</h3>
        <div class="btn-cad">
            <a class="btn btn-primary btn-voltar" href="{{ route('product.index') }}">Voltar</a>
        </div>
        <div>
            <form method="POST" id="form-create-product" enctype="multipart/form-data">
                @csrf
                <div class="col-md-5 div-input">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite o nome do produto">
                </div>
                <div class="col-md-2 div-input">
                    <label>Preço de custo (R$)</label>
                    <input type="float" class="form-control" name="cost" placeholder="ex.: 10.00">
                </div>
                <div class="col-md-2 div-input">
                    <label>Preço de venda (R$)</label>
                    <input type="float" class="form-control" name="sale" placeholder="ex.: 20.00">
                </div>

                <div id="div-checkbox" class="div-input">
                    <p><label for="">Tags</label></p>
                    @foreach ($tags as $tag)
                        <input type="checkbox" id="{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]">
                                <label for="{{ $tag->id }}" class="checkbox-label">{{ $tag->name }}</label>
                    @endforeach
                </div>
                <div>
                    <button type="submit" id="btn-send-product" class="btn btn-success">Cadastrar</button>
                </div>
            </form>


        </div>
    </div>

    <script>
        $(document).on('submit', '#form-create-product', function(e) {
            e.preventDefault();

            dataForm = $('#form-create-product').serialize();
            console.log(dataForm);
            $.ajax({
                url: "{{ route('product.store') }}",
                type: "POST",
                data: dataForm,
                success: function(response) {
                    if (response) {
                        Swal.fire(
                                'Produto cadastrado com sucesso!',
                            )
                            
                    }
                },
                error: function(data) {
                    $("#form-create-product")[0].reset();
                    $('#create-product').modal('hide');
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
