@extends('template.template')

@section('title', 'Editar Tag')

@section('content')

    <div class="mb-3">
        <h3>Editar Tag</h3>
        <div class="btn-cad">
            <a class="btn btn-primary btn-back" href="{{ route('tag.index') }}">Voltar</a>
        </div>
        <div>
            <form method="POST" id="form-edit-tag" enctype="multipart/form-data">
                @csrf
                <div class="col-md-5 div-input">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ $tag->name ?? old('tag') }}" placeholder="Digite o nome da tag">
                </div>
         
                <div>
                    <button type="submit" id="btn-send-product" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on('submit', '#form-edit-tag', function(e) {
            e.preventDefault();

            dataForm = $('#form-edit-tag').serialize();
            console.log(dataForm);
            $.ajax({
                url: "{{ route('tag.update', [$tag->id]) }}",
                type: "POST",
                data: dataForm,
                success: function(response) {
                    if (response) {
                        Swal.fire(
                                'Tag atualizada com sucesso!',
                            )
                    }
                },
                error: function(data) {
                    $("#form-edit-product")[0].reset();
                    $('#edit-product').modal('hide');
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
