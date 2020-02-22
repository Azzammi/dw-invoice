<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; //1

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at','DESC')->get();//2
        //Code di atas sama dengan > SELECT * FROM products order by created_at desc    
        return view('products.index',compact('products'));//3
    }   
}
