<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Slide;
use \App\Products;
use \App\Type_products;

class PagesController extends Controller
{
	// the controller is used to demo. It is not a part of the website
    function getHome(){
        $slide = Slide::all();      
        $newProduct = Products::where('new',1)->paginate(4); 
        $promotionProduct = Products::where('promotion_price','<>',0)->paginate(8);           
        // return view('pages.home',['slide'=>$slide]);
    	return view('pages.home',compact('slide','newProduct','promotionProduct'));
    }

    function getProduct($idType){
        $sp_theo_loai = Products::where('id_type',$idType)->get();
        $sp_khac = Products::where('id_type','<>',$idType)->paginate(3);
        $loai_sp = Type_products::where('id',$idType)->first();
        $loai = Type_products::all();
    	return view('pages.product', compact('sp_theo_loai','sp_khac','loai_sp','loai'));
    }

    function getDetail($id){
    	return view('pages.detail');
    }    
   
    function getAbout(){
    	return view('pages.about');	
    }

     function getContact(){
    	return view('pages.contact');
    }

}
