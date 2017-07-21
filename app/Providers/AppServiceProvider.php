<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Product;
use App\Banner;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['header','page.product','section.newArrivals','section.bestView'],function($view){
              $typeParent =  Category::TypeParent_product()->get();
              $typeChild =  Category::TypeChild_product()->get();
              $view->with(['typeParent'=>$typeParent,'typeChild'=>$typeChild]);
          });
        view()->composer('section.newArrivals',function($view){
              $product =  Product::New_Product()->get();
              $view->with('product',$product);
          });
        view()->composer('section.bestView',function($view){
              $product =  Product::Best_View_Product()->paginate(8);
              $view->with('product',$product);
          });
        view()->composer(['section.slide','section.banner','section.newArrivals','page.about','page.checkout','page.contact','page.product','page.single'],function($view){
              $banner =  Banner::All_Banner()->get();
              // dd($banner);
              $view->with('banner',$banner);
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
