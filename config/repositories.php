<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Repository Bindings
    |--------------------------------------------------------------------------
    |
    | You can define your interface => implementation pairs here.
    | Example:
    | App\Repositories\UserRepositoryInterface::class => App\Repositories\EloquentUserRepository::class
    |
    */
    App\Repositories\Contracts\ProductRepositoryContract::class => App\Repositories\Eloquents\ProductRepositoryEloquent::class,
    /* Your Repos Here 'contract => eloquent' */

];
