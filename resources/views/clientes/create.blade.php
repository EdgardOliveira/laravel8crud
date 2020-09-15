@extends('padrao')

@section('content')
    <h1>Cliente</h1>
    <h3>Cadastro de cliente</h3>
    <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form method="post" action="{{ route('clientes.store') }}">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Id: </label>
                            <input type="number" readonly class="form-control" name="id"/>
                        </div>

                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="text" required class="form-control" name="nome"/>
                        </div>

                        <div class="form-group">
                            <label for="cpf_cnpj">CPF/CNPJ: </label>
                            <input type="text" required class="form-control" name="cpf_cnpj"/>
                        </div>

                        <div class="form-group">
                            <label for="contato">Contato: </label>
                            <input type="text" required class="form-control" name="contato"/>
                        </div>

                        <div class="form-group">
                            <label for="celular">Celular: </label>
                            <input type="text" required class="form-control" name="celular"/>
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" required class="form-control" name="email"/>
                            </br>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
