<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\GeneralController;
use App\Models\ShopCountry;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Cart;

class LoginController extends GeneralController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';
    protected function redirectTo()
    {
        if(auth()->user()){
            if(session()->has('cart')){
                foreach(session('cart') as $instance => $items){
                    foreach($items as $value){
                        // $user, $instance, $product_id, $qty, $name, $price, $tax, $options
                        Cart::addDb( auth()->user()->id, 
                            'cart.' . $instance, 
                            $value->id, 
                            $value->qty,
                            $value->name,
                            $value->price,
                            $value->tax,
                            $value->options,
                        );
                    }
                }
                session()->forget('cart');
            }
            $dataCarts = DB::table(SC_DB_PREFIX . 'shop_user_cart')->select()->where('id_user', auth()->user()->id)->get();
            // dd($dataCarts);
            foreach($dataCarts as $cart){
                $dataCart = array(
                    'id' => $cart->product_id,
                    'name' => $cart->name,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'options' => json_decode($cart->options, true),
                );
                Cart::instance(str_replace('cart.', '', $cart->instance))->setInsert(1)->add($dataCart);
            }
        }
        return '/';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $messages = [
            'email.email' => trans('validation.email',['attribute'=> trans('customer.email')]),
            'email.required' => trans('validation.required',['attribute'=> trans('customer.email')]),
            'password.required' => trans('validation.required',['attribute'=> trans('customer.password')]),
            ];
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], $messages);
    }

    public function showLoginForm()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        return view($this->templatePath . '.screen.shop_login',
            array(
                'title' => trans('front.login'),
                'countries' => ShopCountry::getArray(),
                'layout_page' => 'shop_auth',
            )
        );
    }

    public function logout(Request $request)
    {
        if(auth()->user()){
            if(session()->has('cart')){
                session()->forget('cart');
            }
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('login');
    }

}
