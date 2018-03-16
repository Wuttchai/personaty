<?php

namespace App\Providers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      URL::forceSchema('https');
      
      Validator::extend('image64', function ($attribute, $value, $parameters, $validator) {
     $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
     if (in_array($type, $parameters)) {
         return true;
     }
     return false;
 });

 Validator::replacer('image64', function($message, $attribute, $rule, $parameters) {
     return str_replace(':values',join(",",$parameters),$message);
 });

 Validator::extend('img_min_size', function($attribute, $value, $parameters)
     	{
             $file = $value;
             $image_info = getimagesize($file);
             $image_width = $image_info[0];
             $image_height = $image_info[1];
             if( (isset($parameters[0]) && $parameters[0] != 0) && $image_width < $parameters[0]) return false;
             if( (isset($parameters[1]) && $parameters[1] != 0) && $image_height < $parameters[1] ) return false;
             return true;
     });

     Validator::replacer('img_min_size', function($message, $attribute, $rule, $parameters) {
     return "รูปภาพต้องมี! ความยาว:".$parameters[0]."px ความกว่าง:".$parameters[1]."px";
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
