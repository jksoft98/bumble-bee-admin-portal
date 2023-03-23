<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use DateTime;
use Validator;
use view;
use Response;

class ApiController extends Controller
{
    //


    /*
    |--------------------------------------------------------------------------
    | Public function / Customer Register
    |--------------------------------------------------------------------------
    */ 
    public function customerRegister(Request $request)
    {

        try {
 
            $validation_array =[
                "phone"         => 'required|min:11|numeric',
                'full_name'     => 'required|string|between:2,100',
                'email'         => 'required|email',
                'address'       => 'required|string|between:2,100',
                'dob'           => 'required|date',
                'nic'           => 'required|string',
                'password'      => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d@$!^%*#?&]{5,}$/',
            ];

            $customMessages = [
                'regex' => 'Password should be minimum 5 characters, at least one uppercase letter and one lowercase letter'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     
           
            $data = array(
                "phone"                 => $validator->valid()['phone'],
                "full_name"             => $validator->valid()['full_name'],
                "address"               => $validator->valid()['address'],
                "email"                 => $validator->valid()['email'], 
                "dob"                   => $validator->valid()['dob'],  
                "nic"                   => $validator->valid()['nic'],   
                'password'              => $validator->valid()['password'],   
                'password_confirmation' => $validator->valid()['password_confirmation'],        
            );

            $response = Http::post(config('site-specific.api_url').'customer-register', $data);
            $response_data =json_decode($response); 

            //return response()->json($response_data);

            if($response_data->success == true){  
                return redirect()->route('customer-register')->with('success', $response_data->message);           
            }else{
                return redirect()->route('customer-register')->with('error', $response_data->message);
            }
          
        } catch (\Throwable $e) {  
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Public function / Admin Login
    |--------------------------------------------------------------------------
    */ 
    public function adminLogin(Request $request){
        
        try {
 
            $validation_array = [
                "email"             => 'required|email', 
                'password'          => 'required',           
            ];

            $validator = Validator::make($request->all(), $validation_array);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }  

            $data = array(
                "email"             => $validator->valid()['email'],
                'password'          => $validator->valid()['password'],      
            );

            $response = Http::post(config('site-specific.api_url').'admin-login', $data);
            $response_data =json_decode($response);  
           
            if($response_data->success == true){   
                $request->session()->put('member', $response_data->data->user);
                $request->session()->put('access_token', $response_data->data->access_token);
                $request->session()->put('user_role', $response_data->data->user->user_role);
                $request->session()->put('username',$response_data->data->user->first_name.' '.$response_data->data->user->last_name);
                $request->session()->put('user_id',$response_data->data->user->id);
                $request->session()->put('user_permissions',$response_data->data->permissions);
                return redirect()->route('dashboard-view')->with('success', $response_data->message);
            }else{  
                return redirect()->route('admin-login')->with('error', $response_data->message);
            }
        } catch (\Exception $e) { 
            return response()->json($e->getMessage());  
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later');
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Public function / Logout
    |--------------------------------------------------------------------------
    */ 
    public function logout(Request $request){

        $response = Http::withHeaders([
            'authorization' =>  'Bearer '.$request->session()->get('access_token')
        ])->post(config('site-specific.api_url').'admin-logout');
        $response_data =json_decode($response);
        
        if($response_data->success == true){   
            $request->session()->flush();
            return redirect()->route('admin-login')->with('success', 'Logout successfully');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Public function / User Create
    |--------------------------------------------------------------------------
    */ 
    public function userCreate(Request $request)
    {

        try {
 
            $validation_array =[
                'first_name'    => 'required|string|between:2,100',
                'last_name'     => 'required|string|between:2,100',
                "phone"         => 'required|min:11|numeric',
                'password'      => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d@$!^%*#?&]{5,}$/',
                'email'         => 'required|email',
                'user_role'     => 'required|numeric',
            ];

            $customMessages = [
                'regex' => 'Password should be minimum 5 characters, at least one uppercase letter and one lowercase letter'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     
           
            $data = array(
                "first_name"            => $validator->valid()['first_name'],
                "last_name"             => $validator->valid()['last_name'],
                "phone"                 => $validator->valid()['phone'],
                "email"                 => $validator->valid()['email'],  
                "user_role"             => $validator->valid()['user_role'],   
                'password'              => $validator->valid()['password'],   
                'password_confirmation' => $validator->valid()['password_confirmation'],        
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'user-create',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('user-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
          
        } catch (\Throwable $e) {  
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }
    }



    /*
    |--------------------------------------------------------------------------
    | Public function / User Edit
    |--------------------------------------------------------------------------
    */ 
    public function userEdit(Request $request)
    {

        try {
 
            $validation_array =[
                'first_name'    => 'required|string|between:2,100',
                'last_name'     => 'required|string|between:2,100',
                "phone"         => 'required|min:11|numeric',
                'email'         => 'required|email',
                'user_role'     => 'required|numeric',
                'user_id'       => 'required|numeric',
                'reset_password'=> 'nullable',
            ];

            if($request->has('reset_password')){
                $validation_array['password']  = 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d@$!^%*#?&]{5,}$/';
            } 
            $customMessages = [
                'regex' => 'Password should be minimum 5 characters, at least one uppercase letter and one lowercase letter'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     
           
            $data = array(
                "first_name"            => $validator->valid()['first_name'],
                "last_name"             => $validator->valid()['last_name'],
                "phone"                 => $validator->valid()['phone'],
                "email"                 => $validator->valid()['email'],  
                "user_role"             => $validator->valid()['user_role'], 
                "user_id"               => $validator->valid()['user_id'],          
            );

            if($request->has('reset_password')){
                $data['reset_password']         = $validator->valid()['reset_password'];
                $data['password']               = $validator->valid()['password'];
                $data['password_confirmation']  = $validator->valid()['password_confirmation'];
            }

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'user-edit',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){ 
                $request->session()->put('user_role',$response_data->data->user_role);
                $request->session()->put('user_permissions',$response_data->data->permissions);
                return redirect()->route('user-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
          
        } catch (\Throwable $e) {  
            return response()->json($e->getMessage());
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Public function /  User Role Create
    |--------------------------------------------------------------------------
    */
    public function userRoleCreate(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'role_name'      => 'required',
                'description'    => 'nullable',
                'permission'     => 'required|array',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "role_name"      => $validator->valid()['role_name'],
                "description"    => $validator->valid()['description'],
                "permission"     => $validator->valid()['permission'],     
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'user-role-create',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('user-role-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Public function /  User Role Edit
    |--------------------------------------------------------------------------
    */
    public function userRoleEdit(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'role_id'        => 'required|numeric',
                'role_name'      => 'required',
                'description'    => 'nullable',
                'permission'     => 'required|array',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "role_id"        => $validator->valid()['role_id'],
                "role_name"      => $validator->valid()['role_name'],
                "description"    => $validator->valid()['description'],
                "permission"     => $validator->valid()['permission'],     
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'user-role-edit',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){ 
                $request->session()->put('user_role',$response_data->data->user_role);
                $request->session()->put('user_permissions',$response_data->data->permissions); 
                return redirect()->route('user-role-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }



    /*
    |--------------------------------------------------------------------------
    | Public function /  User Role Create
    |--------------------------------------------------------------------------
    */
    public function customerCreate(Request $request){

        try {
            $validation_array =[
                "phone"         => 'required|min:11|numeric',
                'full_name'     => 'required|string|between:2,100',
                'email'         => 'required|email',
                'address'       => 'required|string|between:2,100',
                'dob'           => 'required|date',
                'nic'           => 'required|string',
                'password'      => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d@$!^%*#?&]{5,}$/',
            ];

            $customMessages = [
                'regex' => 'Password should be minimum 5 characters, at least one uppercase letter and one lowercase letter'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     
           
            $data = array(
                "phone"                 => $validator->valid()['phone'],
                "full_name"             => $validator->valid()['full_name'],
                "address"               => $validator->valid()['address'],
                "email"                 => $validator->valid()['email'], 
                "dob"                   => $validator->valid()['dob'],  
                "nic"                   => $validator->valid()['nic'],   
                'password'              => $validator->valid()['password'],   
                'password_confirmation' => $validator->valid()['password_confirmation'],        
            );

            $response = Http::post(config('site-specific.api_url').'customer-register', $data);
            $response_data =json_decode($response); 

            if($response_data->success == true){  
                return redirect()->route('customer-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->route('customer-create-view')->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }



    /*
    |--------------------------------------------------------------------------
    | Public function / Customer Edit
    |--------------------------------------------------------------------------
    */ 
    public function customerEdit(Request $request)
    {

        try {
 
            $validation_array =[
                "phone"         => 'required|min:11|numeric',
                'full_name'     => 'required|string|between:2,100',
                'email'         => 'required|email',
                'address'       => 'required|string|between:2,100',
                'dob'           => 'required|date',
                'nic'           => 'required|string',
                'reset_password'=> 'nullable',
                'customer_id'   => 'required|numeric',
            ];

            if($request->has('reset_password')){
                $validation_array['password']  = 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d@$!^%*#?&]{5,}$/';
            } 
            $customMessages = [
                'regex' => 'Password should be minimum 5 characters, at least one uppercase letter and one lowercase letter'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     
           
            $data = array(
                "phone"                 => $validator->valid()['phone'],
                "full_name"             => $validator->valid()['full_name'],
                "address"               => $validator->valid()['address'],
                "email"                 => $validator->valid()['email'], 
                "dob"                   => $validator->valid()['dob'],  
                "nic"                   => $validator->valid()['nic'],  
                "customer_id"           => $validator->valid()['customer_id'],          
            );

            if($request->has('reset_password')){
                $data['reset_password']         = $validator->valid()['reset_password'];
                $data['password']               = $validator->valid()['password'];
                $data['password_confirmation']  = $validator->valid()['password_confirmation'];
            }

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'customer-edit',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){ 
                return redirect()->route('customer-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
          
        } catch (\Throwable $e) {  
            return response()->json($e->getMessage());
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }
    }



    /*
    |--------------------------------------------------------------------------
    | Public function /  Brand Create
    |--------------------------------------------------------------------------
    */
    public function brandCreate(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'brand_name'     => 'required',
                'description'    => 'nullable',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "brand_name"     => $validator->valid()['brand_name'],
                "description"    => $validator->valid()['description'],   
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'brand-create',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('brand-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Public function /  Brand Edit
    |--------------------------------------------------------------------------
    */
    public function brandEdit(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'brand_id'       => 'required|numeric',
                'brand_name'     => 'required',
                'description'    => 'nullable',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "brand_id"       => $validator->valid()['brand_id'],
                "brand_name"     => $validator->valid()['brand_name'],
                "description"    => $validator->valid()['description'],   
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'brand-edit',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('brand-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Public function /  Category Create
    |--------------------------------------------------------------------------
    */
    public function categoryCreate(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'category_name'  => 'required',
                'description'    => 'nullable',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "category_name"  => $validator->valid()['category_name'],
                "description"    => $validator->valid()['description'],   
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'category-create',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('category-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Public function /  Category Edit
    |--------------------------------------------------------------------------
    */
    public function categoryEdit(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'category_id'    => 'required|numeric',
                'category_name'  => 'required',
                'description'    => 'nullable',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "category_id"    => $validator->valid()['category_id'],
                "category_name"  => $validator->valid()['category_name'],
                "description"    => $validator->valid()['description'],   
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'category-edit',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('category-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Public function /  Product Create
    |--------------------------------------------------------------------------
    */
    public function productCreate(Request $request){
        try {
            $validation_array =[
                "title"             => 'required|string|between:2,100',
                'sku'               => 'required|string|between:2,100',
                'stock'             => 'required',
                'short_description' => 'required|string',
                'long_description'  => 'required|string',
                'weight'            => 'required',
                'price'             => 'required',
                'brand'             => 'required|numeric',
                'category'          => 'required|numeric',
                'slug'              => 'required|regex:/^[a-z0-9-]+$/',
                'meta_title'        => 'nullable',
                'meta_description'  => 'nullable',
                'product_image'     => 'required',
                'image_name'        => 'required',
                
            ];

            if(session()->get('user_role') != 2){
                $validation_array['vendor'] = 'required|numeric';
            }

            $customMessages = [
                'regex' => 'Slug is not valid'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     

            $data = array(
                "title"             => $validator->valid()['title'],
                "sku"               => $validator->valid()['sku'],
                "stock"             => $validator->valid()['stock'], 
                "short_description" => $validator->valid()['short_description'],
                "long_description"  => $validator->valid()['long_description'],
                "weight"            => $validator->valid()['weight'],  
                "price"             => $validator->valid()['price'],
                "brand"             => $validator->valid()['brand'],
                "category"          => $validator->valid()['category'],
                "slug"              => $validator->valid()['slug'],
                "meta_title"        => $validator->valid()['meta_title'],
                "meta_description"  => $validator->valid()['meta_description'],
            );
            if(session()->get('user_role') != 2){
                $data['vendor'] = $validator->valid()['vendor'];
            }

            if($request->has('product_image') && $request->has('image_name')){
                $image = $this->uploadImage64Base($validator->valid()['product_image'],$validator->valid()['image_name'],'product-images'); 
                $data['cover_image']  = $image;  
            }

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'product-create',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return redirect()->route('product-list-view')->with('success', $response_data->message);           
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }



    /*
    |--------------------------------------------------------------------------
    | Public function /  Product Edit
    |--------------------------------------------------------------------------
    */
    public function productEdit(Request $request){
        try {
            $validation_array =[
                "product_id"        => 'required|numeric',
                "title"             => 'required|string|between:2,100',
                'sku'               => 'required|string|between:2,100',
                'stock'             => 'required',
                'short_description' => 'required|string',
                'long_description'  => 'required|string',
                'weight'            => 'required',
                'price'             => 'required',
                'brand'             => 'required|numeric',
                'category'          => 'required|numeric',
                'slug'              => 'required|regex:/^[a-z0-9-]+$/',
                'meta_title'        => 'nullable',
                'meta_description'  => 'nullable',
                'product_image'     => 'nullable',
                'image_name'        => 'nullable',
                'image_count'       => 'required',
                'exists_image'      => 'nullable',
            ];

            if(session()->get('user_role') != 2){
                $validation_array['vendor'] = 'required|numeric';
            }

            $customMessages = [
                'regex' => 'Slug is not valid'
            ];

            $validator = Validator::make($request->all(), $validation_array,$customMessages);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }     

            $data = array(
                "product_id"        => $validator->valid()['product_id'],
                "title"             => $validator->valid()['title'],
                "sku"               => $validator->valid()['sku'],
                "stock"             => $validator->valid()['stock'], 
                "short_description" => $validator->valid()['short_description'],
                "long_description"  => $validator->valid()['long_description'],
                "weight"            => $validator->valid()['weight'],  
                "price"             => $validator->valid()['price'],
                "brand"             => $validator->valid()['brand'],
                "category"          => $validator->valid()['category'],
                "slug"              => $validator->valid()['slug'],
                "meta_title"        => $validator->valid()['meta_title'],
                "meta_description"  => $validator->valid()['meta_description'],
                "image_count"       => $validator->valid()['image_count'],
            );
            if(session()->get('user_role') != 2){
                $data['vendor'] = $validator->valid()['vendor'];
            }

            if($request->has('product_image') && $request->has('image_name')){
                $image = $this->uploadImage64Base($validator->valid()['product_image'],$validator->valid()['image_name'],'product-images'); 
                $data['cover_image']  = $image;  
            }

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'product-edit',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                if(isset($data['cover_image'])){
                    $this->deleteImage($validator->valid()['exists_image'],'product-images');
                }
                return redirect()->route('product-list-view')->with('success', $response_data->message);         
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }



    
    /*
    |--------------------------------------------------------------------------
    | Public function /  Change Product Status
    |--------------------------------------------------------------------------
    */
    public function changeProductStatus(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'product_id'        => 'required|numeric',
                'status'            => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "product_id"    => $validator->valid()['product_id'],
                "status"        => $validator->valid()['status'],
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'change-product-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){ 
                //sendNotification('msg','Update '.$response_data->data->name.'(product) status as '.$validator->valid()['status'].'.');   
                return redirect()->back()->with('success', $response_data->message);
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }



    /*
    |--------------------------------------------------------------------------
    | Public function /  Order Create
    |--------------------------------------------------------------------------
    */
    public function orderCreate(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'customer'        => 'required|numeric',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('error', implode(" / ",$validator->messages()->all()));
            }

            $data = array(
                "customer"    => $validator->valid()['customer'],
            );

            $orders = array();

            foreach ($request['product_id'] as $index => $products) {
                $items = array();
                foreach ($products as $key => $product) {
                    $items[$key] = array(
                        "product_id" => $product,
                        "quantity"   => $request['qty'][$index][$key],
                    );
                }
                $data['vendor'] = $index;
                $data['items']  = $items;
                array_push($orders, $data);
            }

            $req_data['data'] = $orders;

            return response()->json($orders);

            $data = array(
                "product_id"    => $validator->valid()['product_id'],
                "status"        => $validator->valid()['status'],
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'change-product-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){ 
                //sendNotification('msg','Update '.$response_data->data->name.'(product) status as '.$validator->valid()['status'].'.');   
                return redirect()->back()->with('success', $response_data->message);
            }else{
                return redirect()->back()->with('error', $response_data->message);
            }
        } 
        catch (\Throwable $e){
            return redirect()->back()->with('error', 'Oops! Something went wrong please try again later'.$e->getMessage());
        }

    }





    private function deleteImage($fileName,$diskName){

        if(Storage::disk($diskName)->exists($fileName)){
            Storage::disk('product-images')->delete($fileName);
        }
    }


    /*
    |--------------------------------------------------------------------------
    |Public function / Get Storage Product Image
    |--------------------------------------------------------------------------
    */
    public function getStorgeProductImage($filename){
        
        $path =  storage_path('app/product-images/'. $filename);
        if(!File::exists($path)) {
            //abort(404);
            $file = File::get(public_path('assets/theme-default/dist/img/no-image-preview.jpg'));
            $type = File::mimeType(public_path('assets/theme-default/dist/img/no-image-preview.jpg'));
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }



    /*
    |--------------------------------------------------------------------------
    | Private Function / Image Upload
    |--------------------------------------------------------------------------
    */
    private function uploadImage64Base($image,$filename,$diskName){

        $base64_image = $image;

        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $data = base64_decode($data);
            //generate unic id
            $unique_name = md5($filename. time());
            //store image in file storeage
            Storage::disk($diskName)->put($unique_name.'.webp',  $data);
            $image_name = $unique_name.'.webp'; 
            return $image_name;
        }
    }



    public function changeUserStatusAjax(Request $request){

        try {
            if(!isPermissions('user-edit-view')){
                return array(
                    'success' =>false,
                    'message' =>'You Don`t Have Enough Permissions!',
                );    
            }

            $validator = Validator::make($request->all(), [
                'user_id'        => 'required|numeric',
                'status'         => 'required|numeric',
            ]);

            if($validator->fails()){
                return array(
                    'success' =>false,
                    'message' =>implode(" / ",$validator->messages()->all()),
                );
            }

            $data = array(
                "user_id"        => $validator->valid()['user_id'],
                "status"         => $validator->valid()['status'],  
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->post(config('site-specific.api_url').'change-user-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                $status = ($validator->valid()['status'] ==1)? 'Active' : 'Inactive';
                sendNotification('msg','Update '.$response_data->data->username.'(user) status as '.$status.'.');
                return array(
                    'success' =>true,
                    'message' =>$response_data->message,
                );         
            }else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }


    public function getNotificationsAjax(Request $request){

        try {
            if(!isPermissions('allowed-notifications')){
                return array(
                    'success' =>false,
                    'message' =>'You Don`t Have Enough Permissions!',
                );    
            }

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->get(config('site-specific.api_url').'get-single-user-notification-data');
            $response_data =json_decode($response);

            if($response_data->success == true){  
                return array(
                    'success'   =>true,
                    'data'      =>$response_data->data,
                    'message'   =>$response_data->message,
                );         
            }
            else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }


    public function changeCustomerStatusAjax(Request $request){

        try {
            if(!isPermissions('customer-edit-view')){
                return array(
                    'success' =>false,
                    'message' =>'You Don`t Have Enough Permissions!',
                );    
            }

            $validator = Validator::make($request->all(), [
                'customer_id'    => 'required|numeric',
                'status'         => 'required|numeric',
            ]);

            if($validator->fails()){
                return array(
                    'success' =>false,
                    'message' =>implode(" / ",$validator->messages()->all()),
                );
            }

            $data = array(
                "customer_id"    => $validator->valid()['customer_id'],
                "status"         => $validator->valid()['status'],  
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'change-customer-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                $status = ($validator->valid()['status'] ==1)? 'Active' : 'Inactive';
                sendNotification('msg','Update '.$response_data->data->username.'(customer) status as '.$status.'.');
                return array(
                    'success' =>true,
                    'message' =>$response_data->message,
                );         
            }else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }



    public function changeRoleStatusAjax(Request $request){

        try {
            if(!isPermissions('user-role-edit-view')){
                return array(
                    'success' =>false,
                    'message' =>'You Don`t Have Enough Permissions!',
                );    
            }

            $validator = Validator::make($request->all(), [
                'role_id'    => 'required|numeric',
                'status'     => 'required|numeric',
            ]);

            if($validator->fails()){
                return array(
                    'success' =>false,
                    'message' =>implode(" / ",$validator->messages()->all()),
                );
            }

            $data = array(
                "role_id"    => $validator->valid()['role_id'],
                "status"     => $validator->valid()['status'],  
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'change-role-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                $status = ($validator->valid()['status'] ==1)? 'Active' : 'Inactive';
                sendNotification('msg','Update '.$response_data->data->username.'(role) status as '.$status.'.');
                return array(
                    'success' =>true,
                    'message' =>$response_data->message,
                );         
            }else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }


    public function changeBrandStatusAjax(Request $request){

        try {
            if(!isPermissions('brand-edit-view')){
                return array(
                    'success' =>false,
                    'message' =>'You Don`t Have Enough Permissions!',
                );    
            }

            $validator = Validator::make($request->all(), [
                'brand_id'    => 'required|numeric',
                'status'      => 'required|numeric',
            ]);

            if($validator->fails()){
                return array(
                    'success' =>false,
                    'message' =>implode(" / ",$validator->messages()->all()),
                );
            }

            $data = array(
                "brand_id"   => $validator->valid()['brand_id'],
                "status"     => $validator->valid()['status'],  
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'change-brand-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                $status = ($validator->valid()['status'] ==1)? 'Active' : 'Inactive';
                sendNotification('msg','Update '.$response_data->data->name.'(brand) status as '.$status.'.');
                return array(
                    'success' =>true,
                    'message' =>$response_data->message,
                );         
            }else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }


    public function changeCategoryStatusAjax(Request $request){

        try {
            if(!isPermissions('category-edit-view')){
                return array(
                    'success' =>false,
                    'message' =>'You Don`t Have Enough Permissions!',
                );    
            }

            $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric',
                'status'      => 'required|numeric',
            ]);

            if($validator->fails()){
                return array(
                    'success' =>false,
                    'message' =>implode(" / ",$validator->messages()->all()),
                );
            }

            $data = array(
                "category_id"=> $validator->valid()['category_id'],
                "status"     => $validator->valid()['status'],  
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->put(config('site-specific.api_url').'change-category-status',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
                $status = ($validator->valid()['status'] ==1)? 'Active' : 'Inactive';
                sendNotification('msg','Update '.$response_data->data->name.'(category) status as '.$status.'.');
                return array(
                    'success' =>true,
                    'message' =>$response_data->message,
                );         
            }else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }


    public function getSingleCustomerDataAjax(Request $request){

        try {
            
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|numeric',
            ]);

            if($validator->fails()){
                return array(
                    'success' =>false,
                    'message' =>implode(" / ",$validator->messages()->all()),
                );
            }

            $data = array(
                "customer_id"=> $validator->valid()['customer_id'],
            );

            $response = Http::withHeaders([
                'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
            ])->get(config('site-specific.api_url').'get-single-customer-data',$data);
            $response_data =json_decode($response);

            if($response_data->success == true){  
               
                return array(
                    'success' =>true,
                    'message' =>$response_data->message,
                    'data'    =>$response_data->data,
                );         
            }else{
                return array(
                    'success' =>false,
                    'message' =>$response_data->message,
                );    
            }
        } 
        catch (\Throwable $e){
            return array(
                'success' =>false,
                'message' =>'Oops! Something went wrong please try again later'.$e->getMessage(),
            );   
        }
    }


}
