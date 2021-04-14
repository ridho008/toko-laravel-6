<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
   protected $fillable = ['attribute_id', 'name'];

   public function attribute()
   {
      return $this->belongsTo('App\Attribute');
   }
}
