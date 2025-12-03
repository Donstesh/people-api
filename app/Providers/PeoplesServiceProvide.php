<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PeoplesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        Route::prefix('api/v1')
            ->middleware(['api'])
            ->group(function () {
                Route::get('peoples', [\App\Http\Controllers\PeopleController::class, 'index'])
                    ->name('peoples.index');
                
                Route::get('peoples/{id}', [\App\Http\Controllers\PeopleController::class, 'show'])
                    ->name('peoples.show')
                    ->where('id', '[0-9]+');
                
                Route::post('peoples', [\App\Http\Controllers\PeopleController::class, 'store'])
                    ->name('peoples.store');
                    
                Route::put('peoples/{id}', [\App\Http\Controllers\PeopleController::class, 'update'])
                    ->name('peoples.update')
                    ->where('id', '[0-9]+');
                    
                Route::delete('peoples/{id}', [\App\Http\Controllers\PeopleController::class, 'destroy'])
                    ->name('peoples.destroy')
                    ->where('id', '[0-9]+');
            });
    }

    public function register(): void
    {
        //
    }
}