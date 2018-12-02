<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orders(){
      return $this->hasMany('App\OrdersProduct', 'order_id'); // the order table has many relationship with order_products, based on order_id
    }                                                         // find out where the order's table id and order_products order_id is similar, and                  

                                                            // return it.
    public static function getOrderDetails($order_id){
      $getOrderDetails = Order::where('id', $order_id)->first();
      return $getOrderDetails;
    }
}


// here table Order has many relationship with table OrdersProduct, the primary key acts as order_id in Order table and foreign key in OrdersProduct table. So, data in the id for orders with similar to order_id in OrdersProduct will be fetched