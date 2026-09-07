<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
   public function products()
   {
     return $this->hasmany(Product::class);
   }
}
