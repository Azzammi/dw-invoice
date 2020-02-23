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
    public function create() {
        return view('products.create');
    }
    public function save(Request $request){
        //Melakukan validasi data yang dikirim dari form inputan
        $this->validate($request,[
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        try{ 
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);

            //Redirect ke halaman parent /product
            return redirect('/product')->with(['success' => '<strong>'.$product->title . '</strong> Telah disimpan']);
        }catch(\Exception $e){
            //Eksekusi saat terjadi error
            return redirect('/product/new')->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id){
        $product = Product::find($id); //Mengambil data berdasarkan id
        return view('products.edit',compact('product'));
    }
    public function update(Request $request, $id){
        $product = Product::find($id); //Query untuk mengambil data berdasarkan id
        //Kemudian di update datanya
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect('/product')->with(['success' => '<strong>' . $product->title . '</strong> Diperbaharui']);
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/product')->with(['success' => '<strong>' . $product->title . '</strong> Dihapus']);
    }
}
