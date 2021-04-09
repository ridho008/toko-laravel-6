<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'categories';
   protected $fillable = ['name', 'slug', 'parent_id'];

   public function childs()
   {
      // kategori yang memiliki banyak parent_id
      // rumusnya one to many
      return $this->hasMany('App\Category', 'parent_id');
   }

   public function parent()
   {
      return $this->belongsTo('App\Category', 'parent_id');
   }
}
