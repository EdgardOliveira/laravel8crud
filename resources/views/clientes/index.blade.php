@extends('padrao')

@section('content')

    @if (Session::has('sucesso'))
        <div class="alert alert-success">
            <p>{{Session::get('sucesso')}}</p>
        </div>
    @endif

    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Clientes</h2>
                    <h5 class="text-white op-7 mb-2">Gerenciamento de clientes</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Lista de clientes</h4>
                            <div class="form-button-action">
                                <a href="{{ route('clientes.create')}}"
                                   data-toggle="tooltip" title=""
                                   class="btn btn-primary btn-round ml-auto"
                                   data-original-title="Editar">
                                    <i class="fa fa-plus">Cadastrar</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Contato</th>
                                    <th>Celular</th>
                                    <th>E-mail</th>
                                    <th class="text-center" style="width: 10%">Ações</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Contato</th>
                                    <th>Celular</th>
                                    <th>E-mail</th>
                                    <th class="text-center" style="width: 10%">Ações</th>
                                </tr>
                                </tfoot>

                                <tbody>

                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{$cliente->id}}</td>
                                        <td>{{$cliente->nome}}</td>
                                        <td>{{$cliente->cpf_cnpj}}</td>
                                        <td>{{$cliente->contato}}</td>
                                        <td>{{$cliente->celular}}</td>
                                        <td>{{$cliente->email}}</td>
                                        <td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('clientes.edit',$cliente->id)}}"
                                                   data-toggle="tooltip" title=""
                                                   class="btn btn-link btn-primary btn-lg"
                                                   data-original-title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('clientes.destroy', $cliente->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link btn-primary btn-lg"
                                                        data-toggle="tooltip">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
