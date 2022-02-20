@extends('template.template')

@section('title', 'Listar Tags')

@section('content')

    <div class="mb-3">
        <a href="{{ route('tag.create') }}" class="btn btn-primary btn-new">
            Nova Tag
        </a>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <form action="{{ route('tag.search') }}" method="POST" class="form-inline my-0 my-lg-0">
                @csrf
                <input class="form-control mr-sm-2" name="filter" type="Buscar" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-radius" type="submit">Buscar</button>
            </form>
        </nav>
        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome da Tag</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('tag.edit', [$tag->id]) }}"><i
                                    class="material-icons">edit</i></i></a>
                            <a class="btn btn-danger" href="{{ route('tag.destroy', [$tag->id]) }}"
                                onclick="return confirm('Deseja realmente excluir?')"><i
                                    class="material-icons">delete</i></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
