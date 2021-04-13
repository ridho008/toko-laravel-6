<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = ['user_id', 'sku', 'name', 'slug', 'price', 'weight', 'length', 'width', 'height', 'short_description', 'description', 'status'];

   public function user()
   {
      return $this->belongsTo('App\User');
   }

   public function categories()
   {
      return $this->belongsToMany('App\Category', 'product_categories');
   }

   public function productImages()
   {
      // relasi 1 product mempunyai banyak gambar
      return $this->hasMany('App\ProductImage');
   }

   public static function statuses()
   {
      return [
         0 => 'draft',
         1 => 'active',
         2 => 'inactive',
      ];
   }
}
