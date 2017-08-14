<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Product;
use App\Banner;
use App\News;
use App\Bill;
use App\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['header','page.product','section.newArrivals','section.bestView','admin.menu','admin.Modify_Product','admin.Category_Admin','admin.Modify_Category'],function($view){
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
        view()->composer(['section.slide','section.banner','section.newArrivals','page.about','page.checkout','page.contact','page.product','page.single', 'page.profile','page.checkout','page.newsSingle'],function($view){
              $banner =  Banner::All_Banner()->get();
              // dd($banner);
              $view->with('banner',$banner);
          });
        view()->composer('admin.Product_Admin',function($view){
                $type_product=Category::TypeChild_product()->get();
                $view->with('type_product',$type_product);
        });
         view()->composer(['admin.Modify_BillDetail','admin.Modify_Kho'],function($view){
                $products=Product::Select_Product()->get();
                $view->with('products',$products);
        });

        view()->composer('page.newsSingle',function($view){
                $newsType=News::Load_News()->get();
                
                $view->with('newsType',$newsType);
        });
        view()->composer('admin.header',function($view){
                $countBill=Bill::Count_Bill();
                
                $view->with('count_bill',$countBill);
        });

        view()->composer('admin.kho',function($view){
                $count_All_Bill=Bill::Count_All_Bill();
                $count_All_User=User::Count_All_User();
                $count_All_Pro=Product::Count_All_Product();
                $count_View = Product::Count_View_Product();
                $view->with(['count_bill'=>$count_All_Bill,'count_user'=>$count_All_User,'count_pro'=>$count_All_Pro,'count_view'=>$count_View]);
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
