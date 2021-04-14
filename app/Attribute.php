<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
   protected $fillable = ['code', 'name', 'type', 'validation', 'is_required', 'is_unique', 'filterable', 'is_configurable'];

   public static function types()
   {
      return [
         'text' => 'Text',
         'textarea' => 'Textarea',
         'price' => 'Price',
         'boolean' => 'Boolean',
         'select' => 'Select',
         'datetime' => 'Datetime',
         'date' => 'Date',
      ];
   }

   public static function booleanOptions()
   {
      return [
         1 => 'Yes',
         2 => 'No',
      ];
   }

   public static function validations()
   {
      return [
         'number' => 'Number',
         'decimal' => 'Decimal',
         'email' => 'Email',
         'url' => 'URL',
      ];
   }

   public function attributeOptions()
   {
      return $this->hasMany('App\AttributeOption');
   }
}
