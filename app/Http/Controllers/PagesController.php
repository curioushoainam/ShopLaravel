<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Slide;
use \App\Products;
use \App\Type_products;
use Session;
use \App\Cart;
use \App\Customer;
use \App\Bills;
use \App\Bill_detail;

class PagesController extends Controller
{
	// the controller is used to demo. It is not a part of the website
    function getHome(){
        $slide = Slide::all();      
        $newProduct = Products::where('best_seller',1)->paginate(4); 
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

    function getDetail(Request $req){
        $sanpham = Products::where('id',$req->id)->first();
        $sp_lien_quan = Products::where('id_type',$sanpham->typeProduct->id)->paginate(6);
        $sp_moi = Products::orderByDesc('id')->take(6)->get();
        $sp_bs = Products::where('best_seller',1)->take(6)->get();
    	return view('pages.detail',['sanpham'=>$sanpham, 'sp_lien_quan'=>$sp_lien_quan, 'sp_moi'=>$sp_moi,'sp_bs'=>$sp_bs]);
    }    
   
    function getAbout(){
    	return view('pages.about');	
    }

     function getContact(){
    	return view('pages.contact');
    }

    function getAddToCart(Request $req, $id){
        $sanpham = Products::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($sanpham, $id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    function getRemoveFromCart(Request $req, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0)
            $req->session()->put('cart',$cart);
        else
            $req->session()->forget('cart');

        return redirect()->back();
    }

    function getCheckout(){
        if(Session::has('cart')){
            $cart = Session::get('cart'); 
            // viewArr($cart); eixt();
            return view('pages.checkout',['cart'=>$cart]);           
        }

        return view('pages.checkout');
    }

    function postCheckout(Request $req){
        $this->validate($req,[
                'name'=>'required|min:5',
                'email'=>'required|email',
                'address'=>'required|min:10',
                'phone'=>'required|min:10',
                'payment_method'=>'required'                
            ],[
                'name.required'=>'Bạn chưa nhập tên',
                'name.min:5'=>'Tên phải có tối thiểu 5 ký tự',

                'email.required'=>'Bạn chưa nhập Email',
                'email.email'=>'Địa chỉ email không hợp lệ',
                
                'address.required'=>'Bạn chưa nhập Địa chỉ',
                'address.min:10'=>'Địa chỉ phải có tối thiểu 10 ký tự',
                
                'phone.required'=>'Bạn chưa nhập Số điện thoại',
                'phone.min:10'=>'Số điện thoại phải có tối thiểu 10 ký tự',
                
                'payment_method.required'=>'Phương thức thanh toán chưa được chọn'
            ]
        );

        $cart = Session::get('cart');
        if(!count($cart->items))
            return redirect('pages/dat-hang')->with('error','Giỏ hàng đang bị rỗng');

        $cust = new Customer();
        $cust->name = $req->name;
        $cust->gender = $req->gender;
        $cust->email = $req->email;
        $cust->address = $req->address;
        $cust->phone_number = $req->phone;
        $cust->note = $req->note;
        $cust->save();

        $bill = new Bills();
        $bill->id_customer = $cust->id;
        $bill->date_order = date('Y-m-d H:i:s');
        $bill->total = $cart->amount;
        $bill->payment = $req->payment_method;
        $bill->note = $req->note;
        $bill->save();

        foreach($cart['items'] as $id => $prod){
            $bill_detail = new Bill_detail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $id;
            $bill_detail->quantity = $prod['qty'];
            $bill_detail->unit_price = ($prod['subamount']/$prod['qty']);
            $bill_detail->save();
        }

        Session::forget('cart');

        return redirect()->back()->with('msg','Đặt hàng thành công');
    }

}
