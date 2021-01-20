<h1>CRUD com Laravel 8</h1> 

<p align="center">
  <img src="https://img.shields.io/static/v1?label=Laravel%208&message=framework&color=green&style=for-the-badge&logo=LARAVEL"/>
  <img src="https://img.shields.io/static/v1?label=Migrations&message=framework&color=yellow&style=for-the-badge&logo=Laravel"/>
  <img src="https://img.shields.io/static/v1?label=Blade&message=framework&color=red&style=for-the-badge&logo=Laravel"/>
  <img src="https://img.shields.io/static/v1?label=Bootstrap%204&message=framework&color=blue&style=for-the-badge&logo=Bootstrap"/>
  <img src="https://img.shields.io/static/v1?label=Atlantis%20Lite&message=Tema&color=orange&style=for-the-badge&logo=Bootstrap"/>
  <img src="https://img.shields.io/static/v1?label=MariaDB%2010&message=Banco%20de%20dados&color=blueviolet&style=for-the-badge&logo=MARIADB"/>
  <img src="http://img.shields.io/static/v1?label=License&message=MIT&color=green&style=for-the-badge"/>
   <img src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=RED&style=for-the-badge"/>
</p>

...

### Tópicos 

:small_blue_diamond: [Descrição do projeto](#descrição-do-projeto)

:small_blue_diamond: [Funcionalidades](#funcionalidades)

:small_blue_diamond: [Imagens do Layout da Aplicação](#imagens-do-layout-da-aplicação)

:small_blue_diamond: [Pré-requisitos](#pré-requisitos)

:small_blue_diamond: [Como rodar a aplicação](#como-rodar-a-aplicação-arrow_forward)

... 

## Descrição do projeto 

<p align="justify">
  Operações de um CRUD com Laravel 8.
</p>
<p align="justify">
  Este projeto, exemplifica as quatro operações sobre uma tabela no banco de dados (Cadastrar, Ler, Atualizar e Excluir).
</p>
<p align="justify">
  O Laravel possui recursos modernos e avançados para ajudar a criar de forma eficiente e rápida as entidades usando Migrações. Além disso, esse projeto aborda o controle da aplicação através de rotas, bem como a utilização de bootstrap 4 com um tema no estilo Dashboard chamado Atlantis Lite da Themekita. Para gerar as páginas (views) é utilizado o Blade para gerar páginas dinâmicas e re-aproveitáveis.
</p>

...

## Funcionalidades

:heavy_check_mark: Cadastrar (insert/create)  

:heavy_check_mark: Consultar (select/read)  

:heavy_check_mark: Atualizar (update)  

:heavy_check_mark: Excluir (delete)

:heavy_check_mark: Criação de entidades no banco de dados através de Migrações (migrations)

:heavy_check_mark: Controle de rotas

:heavy_check_mark: Utilização da Engine Blade para gerar as páginas e fazer re-aproveitamento de código comum

:heavy_check_mark: Feedback visual do resultado das operações

:heavy_check_mark: Utilização do Bootstrap 4

:heavy_check_mark: Aplicação de um tema do tipo Dashboard da Themekita chamada Atlantis Lite

...

## Live demo
https://laravel8crud.herokuapp.com/clientes

...

## Imagens do Layout da Aplicação


<img src="https://github.com/EdgardOliveira/laravel8crud/blob/master/imagens/listar.png" alt="listar"  height="500" width="1600">

<img src="https://github.com/EdgardOliveira/laravel8crud/blob/master/imagens/cadastrar.png" alt="cadastrar"  height="500" width="1600">

<img src="https://github.com/EdgardOliveira/laravel8crud/blob/master/imagens/alterar.png" alt="alterar"  height="500" width="1600">

...
## Pré-requisitos

:warning: [Composer](https://getcomposer.org/download/)
:warning: [Laravel 8](https://laravel.com/docs/8.x/installation)
:warning: [PHP 7.3](https://www.php.net/downloads)
:warning: [MariaDB 10](https://mariadb.org/download/)

...

## Como rodar a aplicação :arrow_forward:

No terminal, clone o projeto: 

```
git clone https://github.com/EdgardOliveira/laravel8crud.git
```

### Atualize seu Laravel para a versão mais recente
```bash 
php composer global require laravel/installer
```

### Crie o novo projeto
```bash
laravel new laravel8crud
```

## Iniciando/Configurando banco de dados

### Crie um banco de dados no MariaDB
```mysql 
create database laravel8crud
```

### Crie um usuário e senha para acessar o banco de dados
```mysql 
CREATE USER 'laravel8crud'@'%' IDENTIFIED VIA mysql_native_password USING '***';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON *.* TO 'laravel8crud'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `laravel8crud`;GRANT ALL PRIVILEGES ON `laravel8crud`.* TO 'laravel8crud'@'%';GRANT ALL PRIVILEGES ON `laravel8crud\_%`.* TO 'laravel8crud'@'%';
```

### Instale as dependências
```bash 
composer install -o --no-dev
```

### Gere uma chave para a aplicação
```bash
php artisan key:generate
```

### Configure o acesso ao banco de dados no arquivo .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel8crud
DB_USERNAME=laravel8crud
DB_PASSWORD=laravel8crud
```
### Crie o modelo, recurso e migration
```bash
php artisan make:model Cliente -mcr
```

### Configure o arquivo de migração de clientes (create_clientes_table.php)
```php 
class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cpf_cnpj', 14);
            $table->string('contato', 30);
            $table->string('celular', 11);
            $table->string('email', 40);
            $table->timestamps();
        });
    }
}
```

### Configure o controller (ClienteController.php)
```php
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'cpf_cnpj'=>'required',
            'contato'=>'required',
            'celular'=>'required',
            'email'=>'required'
        ]);

        $cliente = new Cliente([
            'nome' => $request->get('nome'),
            'cpf_cnpj' => $request->get('cpf_cnpj'),
            'contato' => $request->get('contato'),
            'celular' => $request->get('celular'),
            'email' => $request->get('email')
        ]);

        $cliente->save();
        return redirect('/clientes')->with('sucesso', 'Cliente salvo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'=>'required',
            'cpf_cnpj'=>'required',
            'contato'=>'required',
            'celular'=>'required',
            'email'=>'required'
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('successo', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('successo', 'Cliente excluído com sucesso!');
    }
```

### Configure o recurso da rota cliente (web.php)
```bash
Route::resource('clientes', ClienteController::class);
```

### Descompacte o conteúdo da pasta Asset do Tema Atlantis dentro de public/assets
https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/demo1/


### Utilize os blade templates para gerar as views
https://laravel.com/docs/8.x/blade

### Execute o servidor
```bash
php artisan serve --host 0.0.0.0 --port 8000
```

### Rotas disponíveis


| Domain | Method    | URI                     | Name             | Action                                         | Middleware |
|--------|-----------|-------------------------|------------------|------------------------------------------------|------------|
|        | GET|HEAD  | /                       |                  | Closure                                        | web        |
|        | GET|HEAD  | api/user                |                  | Closure                                        | api        |
|        |           |                         |                  |                                                | auth:api   |
|        | GET|HEAD  | clientes                | clientes.index   | App\Http\Controllers\ClienteController@index   | web        |
|        | POST      | clientes                | clientes.store   | App\Http\Controllers\ClienteController@store   | web        |
|        | GET|HEAD  | clientes/create         | clientes.create  | App\Http\Controllers\ClienteController@create  | web        |
|        | GET|HEAD  | clientes/{cliente}      | clientes.show    | App\Http\Controllers\ClienteController@show    | web        |
|        | PUT|PATCH | clientes/{cliente}      | clientes.update  | App\Http\Controllers\ClienteController@update  | web        |
|        | DELETE    | clientes/{cliente}      | clientes.destroy | App\Http\Controllers\ClienteController@destroy | web        |
|        | GET|HEAD  | clientes/{cliente}/edit | clientes.edit    | App\Http\Controllers\ClienteController@edit    | web        |


## Tarefas em aberto

Ainda temos muitas melhorias a fazer. Segue abaixo uma lista. Qualquer contribuição é bem-vinda

:memo: Autenticação

:memo: Paginação de resultados

:memo: Implementação de cadastro com armazenamento de imagens

## Desenvolvedores/Contribuintes :octocat:

Dev team

[<img src="https://lh3.googleusercontent.com/a-/AOh14GgqWXCBdcuf8dmMMPkwbnWaCHi0P3aCM1U83rxKYWI=s96-c-rg-br100" width=115><br><sub>Edgard Oliveira</sub>](https://github.com/EdgardOliveira) 

## Licença 

The [MIT License]() (MIT)

Copyright :copyright: 2021 - CRUD com Laravel 8
