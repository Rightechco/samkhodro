<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        Route::bind('CustomerId', function ($value) {
            return User::where('level', 0)->where('contact', 0)->firstOrFail();
        });
        Route::bind('ProductCategorySlug', function ($value) {
            return Category::where('slug', $value)->where('type', 4)->firstOrFail();
        });
        Route::bind('BlogCategorySlug', function ($value) {
            return Category::where('slug', $value)->where('type', 5)->firstOrFail();
        });
        Route::bind('BlogTagSlug', function ($value) {
            return Tag::where('slug', $value)->firstOrFail();
        });
        Route::bind('myProposalProperty', function ($value) {
            return auth()->user()->proposal()->where('property', $value)->firstOrFail();
        });
        Route::bind('ContactId', function ($value) {
            return User::where('contact' , '>=' , 1)->where('id' , $value)->firstOrFail();
        });
        Route::bind('EmployeeId', function ($value) {
            return User::whereIn('level' , [2,3])->where('id' , $value)->firstOrFail();
        });
        Route::bind('myProject', function ($value) {
            return auth()->user()->project()->where('id' , $value)->firstOrFail();
        });
        Route::bind('myContract', function ($value) {
            return auth()->user()->contract()->where('id' , $value)->firstOrFail();
        });
        Route::bind('myTask', function ($value) {
            return auth()->user()->task()->where('id' , $value)->firstOrFail();
        });
        Route::bind('BlogSlug', function ($value) {
            return Blog::where('slug' , $value)->where('status' , 1)->firstOrFail();
        });
        Route::bind('ProductSlug', function ($value) {
            return Product::where('slug' , $value)->firstOrFail();
        });
        Route::bind('PageSlug', function ($value) {
            return Page::where('slug' , $value)->firstOrFail();
        });
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->prefix('profile')
                ->middleware(['web', 'auth'])
                ->group(base_path('routes/profile.php'));

            Route::middleware('web')
                ->group(base_path('routes/home.php'));

            Route::middleware('web')
                ->prefix('admin')
                ->middleware(['web', 'auth','checkAdmin'])
                ->group(base_path('routes/web.php'));
        });
    }
}
