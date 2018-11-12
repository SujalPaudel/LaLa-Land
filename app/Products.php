<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  public function attributes(){
    return $this->hasMany('App\ProductAttribute', 'product_id'); // one product has many attributes
                                                                  // the foreign_key
  }

}
