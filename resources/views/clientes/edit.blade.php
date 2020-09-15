@extends('padrao')

@section('content')
    <h1>Cliente</h1>
    <h3>Alteração de cadastro</h3>
    <div class="col-md-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <br/>
            @endif

            <form method="post" action="{{ route('clientes.update', $cliente->id) }}">
                @method('PATCH')
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id">Id: </label>
                        <input type="number" readonly class="form-control" name="id" value={{ $cliente->id }} />
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" required class="form-control" name="nome" value={{ $cliente->nome }} />
                    </div>

                    <div class="form-group">
                        <label for="cpf_cnpj">CPF/CNPJ: </label>
                        <input type="text" required class="form-control" name="cpf_cnpj" value={{ $cliente->cpf_cnpj }} />
                    </div>

                    <div class="form-group">
                        <label for="contato">Contato: </label>
                        <input type="text" required class="form-control" name="contato" value={{ $cliente->contato }} />
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular: </label>
                        <input type="text" required class="form-control" name="celular" value={{ $cliente->celular }} />
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" required class="form-control" name="email" value={{ $cliente->email }} />
                        </br>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection