<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Inclua essa configuração para que quando a aplicação estiver usando https em produção os assets sejam carregados com sucesso!
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
