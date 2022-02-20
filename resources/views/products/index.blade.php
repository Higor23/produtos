@extends('template.template')

@section('title', 'Criar Produto')

@section('content')

    <div class="mb-3">
        <a href="{{ route('product.create') }}" class="btn btn-primary btn-new">
            Novo Produto
        </a>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <form action="{{ route('product.search') }}" method="POST" class="form-inline my-0 my-lg-0">
                @csrf
                <input class="form-control mr-sm-2" name="filter" type="Buscar" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-radius" type="submit">Buscar</button>
            </form>
        </nav>
        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Preço de custo (R$)</th>
                    <th scope="col">Preço de venda (R$)</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->cost, 2 , ',', '') }}</td>
                        <td>{{ number_format($product->sale, 2 , ',', '') }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('product.edit', [$product->id]) }}"><i
                                    class="material-icons">edit</i></i></a>
                            <a class="btn btn-danger" href="{{ route('product.destroy', [$product->id]) }}"
                                onclick="return confirm('Deseja realmente excluir?')"><i
                                    class="material-icons">delete</i></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="create-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-product">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="productName"
                                    placeholder="Digite o nome do produto">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-send-product" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('submit', '#form-create-product', function(e) {
            e.preventDefault();
            let name = $('#productName').val();
            console.log(name);
            let _token = $("input[name=_token]").val();
            console.log(name);
            $.ajax({
                url: "{{ route('product.store') }}",
                type: "POST",
                data: {
                    name,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $("#form-create-product")[0].reset();
                        $('#create-product').modal('hide');

                        Swal.fire(
                            'Produto cadastrado com sucesso!',
                            'success'
                        ),
                        window.location.reload();
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
