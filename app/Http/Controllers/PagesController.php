<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Slide;
use \App\Products;
use \App\Type_products;
use Session;
use \App\Cart;
use \App\Customer;
use \App\Bills;
use \App\Bill_detail;
use \App\User;

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

    public function getSignup(){
        return view('pages.signup');
    }

    public function postSignup(Request $req){
        $this->validate($req, [
                'email'=>'required|email|unique:users,email',
                'full_name'=>'required|min:4|max:255',                
                'phone'=>'required',
                'password'=>'required|min:6|max:25',
                'repassword'=>'required|same:password',
                
            ],[
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Địa chỉ email không hợp lệ',
                'email.unique'=>'email đã được sử dụng',

                'full_name.required'=>'Bạn chưa nhập tên',
                'full_name.min'=>'Tên phải có từ 3 đến 255 ký tự',
                'full_name.max'=>'Tên phải có từ 3 đến 255 ký tự',                

                'password.required'=>'Bạn chưa nhập passowrd',
                'password.min'=>'Password phải có từ 6 đến 25 ký tự',
                'password.max'=>'Password phải có từ 6 đến 25 ký tự',

                'repassword.required'=>'Bạn chưa nhập lại passowrd',
                'repassword.same'=>'Bạn nhập lại password không khớp'
            ]
        );

        $user = new User();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->phone = $req->phone;        
        $user->address = $req->address;
        $user->password = bcrypt($req->password);
        $user->save();

        return redirect()->back()->with('msg','Chúc mừng bạn đã đăng ký thành công');

    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin(Request $req){
        $this->validate($req, [
                'email'=>'required|email',                
                'password'=>'required|min:6|max:25'
            ],[
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Địa chỉ email không hợp lệ',
                
                'password.required'=>'Bạn chưa nhập passowrd',
                'password.min'=>'Password phải có từ 6 đến 25 ký tự',
                'password.max'=>'Password phải có từ 6 đến 25 ký tự'
            ]
        );

        if(Auth::attempt(['email'=>$req->email, 'password'=>$req->password]))
            return redirect('trang-chu');
        else
            return redirect()->back()->with('error','Email hoặc Password không đúng O-O');
        
    }

    public function getLogout(){
        Auth::logout();

        return redirect('trang-chu');
    }

    public function getUserInfo(){        
        return view('pages.userInfo');
    }

    public function postUserInfo(Request $req){
         $this->validate($req, [
                'email'=>'required|email',
                'full_name'=>'required|min:4|max:255',                
                'phone'=>'required'
                
            ],[
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Địa chỉ email không hợp lệ',                

                'full_name.required'=>'Bạn chưa nhập tên',
                'full_name.min'=>'Tên phải có từ 3 đến 255 ký tự',
                'full_name.max'=>'Tên phải có từ 3 đến 255 ký tự' 
            ]
        );

        $user = Auth::user();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->phone = $req->phone; 
        $user->address = $req->address;
        if($req->changePassword == 'on'){
            $this->validate($req,[
                    'password'=>'required|min:6|max:25',
                    'repassword'=>'required|same:password',
                ],[
                    'password.required'=>'Bạn chưa nhập passowrd',
                    'password.min'=>'Password phải có từ 6 đến 25 ký tự',
                    'password.max'=>'Password phải có từ 6 đến 25 ký tự',

                    'repassword.required'=>'Bạn chưa nhập lại passowrd',
                    'repassword.same'=>'Bạn nhập lại password không khớp'
                ]
            );
            $user->password = bcrypt($req->password);
        } 
        
        $user->save();
        return redirect()->back()->with('msg','Thông tin đã được cập nhật thành công');
    }

    function getSearch(Request $req){
        $this->validate($req,[
                'keyword'=>'required'
            ],[
                'keyword.required'=>'Bạn vui lòng nhập ký muốn tìm'
            ]
        );

        $keyword = $req->keyword;
        $products = Products::where('name','like','%'.$keyword.'%')
                                ->orWhere('unit_price',$keyword)                               
                                ->paginate(16)->appends(['keyword' => $keyword]);;

        $count = Products::where('name','like','%'.$keyword.'%')
                                ->orWhere('unit_price',$keyword)                                
                                ->count();

        return view('pages.search', compact('products', 'count', 'keyword'));
    }


}
// end of class