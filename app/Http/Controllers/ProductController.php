<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
class ProductController extends Controller
{
    //
	public function index(){
		$products=Product::paginate(10);
    	return view('admin.products.index')->with(compact('products'));//listado
    }

    public function create(){
    	return view('admin.products.create');//formulario
    }

    public function store(Request $request){
    	//registrar el nuevo prducto en la db
    	//dd($request->all());
        $rules=[
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El producto debe tener almenos 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripción para el producto',
            'description.max' => 'La descripción no puede superar los 200 caracteres',
            'price.required' => 'Se debe establecer un precio para el producto',
            'price.numeric' => 'El precio deben ser números',
            'price.min' => 'El precio debe ser mayor o igual a 0'
        ];
        $this->validate($request,$rules,$messages);
    	$product=new Product();
    	$product->name=$request->input('name');
    	$product->description=$request->input('description');
    	$product->price=$request->input('price');
    	$product->long_description=$request->input('long_description');
    	$product->save(); // insert db

    	return redirect('/admin/products');
    }

    public function edit($id){
    	$product=Product::find($id);
    	//return "Mostrar aqui el formulario para edicion del producto con id $id";
    	return view('admin.products.edit')->with(compact('product'));//formulario
    }

    public function update(Request $request,$id){
    	//buscamos el producto
         $rules=[
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El producto debe tener almenos 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripción para el producto',
            'description.max' => 'La descripción no puede superar los 200 caracteres',
            'price.required' => 'Se debe establecer un precio para el producto',
            'price.numeric' => 'El precio deben ser números',
            'price.min' => 'El precio debe ser mayor o igual a 0'
        ];
        $this->validate($request,$rules,$messages);
    	$product=Product::find($id);
    	$product->name=$request->input('name');
    	$product->description=$request->input('description');
    	$product->price=$request->input('price');
    	$product->long_description=$request->input('long_description');
    	$product->save(); // update db 

    	return redirect('/admin/products');
    }

    public function destroy($id){
        $images=ProductImage::where("product_id",$id)->get();
        $num=count($images);
        for ($i=0; $i < $num; $i++) { 
            $images[$i]->delete();
        }
        $product=Product::find($id);
        $product->delete();//sql delete

        //return redirect('/admin/products');
        return back();
    }
}
