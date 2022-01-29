<?php

    namespace App\Providers;


    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register () {
            //
        }

        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot () {

            Blade::if('admin', function () {
                $user = Auth::user();
                if (isset($user)) {
                    return $user->roles()->pluck('name')->contains('Admin');
                }
                return false;

            });


        }
    }
