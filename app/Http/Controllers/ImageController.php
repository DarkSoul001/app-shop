<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductImage;
use App\Product;
use File;
class ImageController extends Controller
{
    //
	public function index($id){
		$product=Product::find($id);
		$images=ProductImage::where('product_id',$id)->orderBy('featured','desc')->get();
		return view('admin.products.images.index')->with(compact('product','images'));
	}
	public function store(Request $request,$id){
    	//guardar imagen en el proyecto
		$file=$request->file('photo');
		$path=public_path().'/images/products';
		$fileName=uniqid().$file->getClientOriginalName();
		$moved=$file->move($path,$fileName);
    	//guardar ruta de imagen en la base
		if ($moved) {
			$productImage= new ProductImage();
			$productImage->image='/images/products/'.$fileName;
			$productImage->product_id=$id;
			$productImage->save();
		}
		return back();
	}

	public function destroy(Request $request){
		//elimiar archiovo
		$productImage=ProductImage::find($request->image_id);
		if (substr($productImage->image, 0,4) === "http") {
			$deleted=true;
		}else{
			$fullPath=public_path().$productImage->image;
			$deleted=file::delete($fullPath);
		}
		//elimiar registro en db
		if ($deleted) {
			$productImage->delete();
		}
		return back();
	}

	public function featured($id,$image){
		$images=ProductImage::where('product_id',$id)->update(['featured' => false]);

		$image=ProductImage::find($image);
		$image->featured=true;
		$image->save();
		return back();
	}
}
