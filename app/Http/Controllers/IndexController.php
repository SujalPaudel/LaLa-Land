<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class IndexController extends Controller
{
    public function index(){

      // In ascending order
      // $productsAll = Products::get();

      // In descending order
      $productsAll = Products::orderBy('id', 'DESC')->get();

      // In random order
      // $productsAll = Products::inRandomOrder()->get();
      
      return view('index')->with(compact('productsAll'));
    }
}
