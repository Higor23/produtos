@extends('template.template')

@section('title', 'Criar Tag')

@section('content')

    <div class="mb-3">
        <h3>Cadastra Tag</h3>
        <div class="btn-cad">
            <a class="btn btn-primary btn-back" href="{{ route('tag.index') }}">Voltar</a>
        </div>
        <div>
            <form method="POST" id="form-create-tag" enctype="multipart/form-data">
                @csrf
                <div class="col-md-5 div-input">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite o nome da tag">
                </div>

                <div>
                    <button type="submit" id="btn-send-product" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on('submit', '#form-create-tag', function(e) {
            e.preventDefault();

            dataForm = $('#form-create-tag').serialize();
            console.log(dataForm);
            $.ajax({
                url: "{{ route('tag.store') }}",
                type: "POST",
                data: dataForm,
                success: function(response) {
                    if (response) {
                        Swal.fire(
                            'Tag cadastrada com sucesso!',
                        )

                    }
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Não foi possível cadastrar a tag!',
                    })
                }
            });
        });
    </script>
@endsection
