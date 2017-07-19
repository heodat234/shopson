<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\product;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['header','page.product','section.newArrivals'],function($view){
              $typeParent =  Category::TypeParent_product()->get();
              $typeChild =  Category::TypeChild_product()->get();
              $view->with(['typeParent'=>$typeParent,'typeChild'=>$typeChild]);
          });
        view()->composer('section.newArrivals',function($view){
              $product =  product::New_Product()->get();
              $view->with('product',$product);
          });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
