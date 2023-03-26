<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class ViewController extends Controller
{
    //


    /*
    |--------------------------------------------------------------------------
    | Public Function setDefault
    |--------------------------------------------------------------------------
    |
    */  
    public function setDefault($data)
    {   
        // Defalut css
        $css =array(
            config('site-specific.fonts-googleapis-css'),
            config('site-specific.all-min-css'),
            config('site-specific.ionicons-min-css'),
            config('site-specific.tempusdominus-bootstrap-4-min-css'),
            config('site-specific.icheck-bootstrap-min-css'),
            config('site-specific.jqvmap-min-css'),
            config('site-specific.overlay-scrollbars-min-css'),
            config('site-specific.daterangepicker-css'),
            config('site-specific.summernote-bs4-min-css'),
            config('site-specific.select2-min-css'),
            config('site-specific.select2-bootstrap4-min-css'),
            config('site-specific.adminlte-min-css'),
            config('site-specific.custom-style-css'),
            config('site-specific.toastr-min-css'),   
        );
        //Default script
        $script =array(
            config('site-specific.jquery-min-js'),
            config('site-specific.jquery-ui-min-js'),
            config('site-specific.bootstrap-bundle-min-js'),
            config('site-specific.chart-min-js'),
            config('site-specific.sparkline-js'),
            config('site-specific.jquery-vmap-min-js'),
            config('site-specific.jquery-vmap-usa-js'),
            config('site-specific.jquery-knob-min-js'),
            config('site-specific.moment-min-js'),
            config('site-specific.daterangepicker-js'),
            config('site-specific.jquery-inputmask-min-js'),
            config('site-specific.tempusdominus-bootstrap-4-min-js'),
            config('site-specific.summernote-bs4-min-js'),
            config('site-specific.jquery-overlay-scrollbars-min-js'),
            config('site-specific.select2-full-min-js'),
            config('site-specific.adminlte-js'),
            config('site-specific.toastr-min-js'),       
            config('site-specific.jquery-validate-js'),
            config('site-specific.additional-methods-js'),
            config('site-specific.form-validation-init'),
            config('site-specific.common-init-js'),     
        );

        if(isset($data['css'])){
            $data['css'] = array_merge($css,$data['css']);
        }else{
            $data['css'] = $css;
        }
        if(isset($data['script'])){
            $data['script'] = array_merge($script,$data['script']);
        }else{
            $data['script'] = $script;
        }

        return View::make('template', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function Dashboard
    |--------------------------------------------------------------------------
    |
    */  
    public function dashboard(Request $request)
    {
        
        $data =array(
            'title'             => 'Dashboard',
            'view'              => 'dashboard',
            //'script'          => array(config('site-specific.dashboard-js')),
            'script'            => array('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.cjs.map',config('site-specific.chart-init-js')),
            
        );
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-dashboard-data');
        $response_data =json_decode($response);
        if(!empty($response_data)){
            if($response_data->success == true){
                $data['dashboard_data'] = $response_data->data;
            }
        }
        return $this->setDefault($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function User List
    |--------------------------------------------------------------------------
    |
    */  
    public function userList(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-users-data');
        $response_data =json_decode($response);

        if(!empty($response_data)){
            if($response_data->success == true){
                $data =array(
                    'title'             => 'User List',
                    'view'              => 'user_list',
                    'css'               => array(config('site-specific.dataTables-bootstrap4-min-css'),config('site-specific.responsive-bootstrap4-min-css'),
                                                config('site-specific.buttons-bootstrap4-min-css')),
                    'script'            => array(config('site-specific.jquery-dataTables-min-js'),config('site-specific.dataTables-bootstrap4-min-js'),
                                                config('site-specific.dataTables-responsive-min-js'),config('site-specific.responsive-bootstrap4-min-js'),
                                                config('site-specific.dataTables-buttons-min-js'),config('site-specific.buttons-bootstrap4-min-js'),
                                                config('site-specific.jszip-min-js'),config('site-specific.pdfmake-min-js'),
                                                config('site-specific.vfs-fonts-js'),config('site-specific.buttons-html5-min-js'),
                                                config('site-specific.buttons-print-min-js'),config('site-specific.buttons-colVis-min-js'),
                                                config('site-specific.user-list-init-js')),
                    'users'             => $response_data->data,
                );
                return $this->setDefault($data);
            }
            return redirect()->route('dashboard-view')->with('error', $response_data->message);
        }
        return redirect()->route('dashboard-view')->with('error', 'Oops! Data Not Loaded.');
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function User Create
    |--------------------------------------------------------------------------
    |
    */  
    public function userCreate(Request $request)
    {
        $data =array(
            'title'             => 'User Create',
            'view'              => 'user_create',
            'script'            => array(config('site-specific.user-init-js')),
        );

       return $this->setDefault($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function User Edit
    |--------------------------------------------------------------------------
    |
    */  
    public function userEdit(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-single-user-data',["user_id" => $request->id]);
        $response_data =json_decode($response);

        if(!empty($response_data)){
            if($response_data->success == true){
                $data =array(
                    'title'             => 'User Edit',
                    'view'              => 'user_edit',
                    'script'            => array(config('site-specific.user-init-js')),
                    'user'              => $response_data->data,
                );
                return $this->setDefault($data);
            }
            return redirect()->route('user-list-view')->with('error', $response_data->message);
        }
        return redirect()->route('user-list-view')->with('error', 'Oops! Data Not Loaded.');
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function Customer List
    |--------------------------------------------------------------------------
    |
    */  
    public function customerList(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-customer-data');
        $response_data =json_decode($response);

        if(!empty($response_data)){
            if($response_data->success == true){
        
                $data =array(
                    'title'             => 'Customer List',
                    'view'              => 'customer_list',
                    'css'               => array(config('site-specific.dataTables-bootstrap4-min-css'),config('site-specific.responsive-bootstrap4-min-css'),
                                                config('site-specific.buttons-bootstrap4-min-css')),
                    'script'            => array(config('site-specific.jquery-dataTables-min-js'),config('site-specific.dataTables-bootstrap4-min-js'),
                                                config('site-specific.dataTables-responsive-min-js'),config('site-specific.responsive-bootstrap4-min-js'),
                                                config('site-specific.dataTables-buttons-min-js'),config('site-specific.buttons-bootstrap4-min-js'),
                                                config('site-specific.jszip-min-js'),config('site-specific.pdfmake-min-js'),
                                                config('site-specific.vfs-fonts-js'),config('site-specific.buttons-html5-min-js'),
                                                config('site-specific.buttons-print-min-js'),config('site-specific.buttons-colVis-min-js'),
                                                config('site-specific.customer-list-init-js')),
                    'customers'         => $response_data->data,                            
                );
                return $this->setDefault($data);
            }
            return redirect()->route('dashboard-view')->with('error', $response_data->message);
        }
        return redirect()->route('dashboard-view')->with('error', 'Oops! Data Not Loaded.');
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function Customer Create
    |--------------------------------------------------------------------------
    |
    */  
    public function customerCreate(Request $request)
    {
        $data =array(
            'title'             => 'Customer Create',
            'view'              => 'customer_create',
        );

       return $this->setDefault($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function Customer Edit
    |--------------------------------------------------------------------------
    |
    */  
    public function customerEdit(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-single-customer-data',["customer_id" => $request->id]);
        $response_data =json_decode($response);

        if(!empty($response_data)){
            if($response_data->success == true){
                $data =array(
                    'title'             => 'Customer Edit',
                    'view'              => 'customer_edit',
                    'customer'          => $response_data->data,
                );
                return $this->setDefault($data);
            }
            return redirect()->route('customer-list-view')->with('error', $response_data->message);
        }
        return redirect()->route('customer-list-view')->with('error', 'Oops! Data Not Loaded.');
    }

    
    /*
    |--------------------------------------------------------------------------
    | Public Function User Role Create
    |--------------------------------------------------------------------------
    |
    */  
    public function userRoleCreate(Request $request)
    {
        $data =array(
            'title'             => 'User Role Create',
            'view'              => 'user_role_create',
            'script'            => array(config('site-specific.user-role-init-js')), 
        );

       return $this->setDefault($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function User Role Edit
    |--------------------------------------------------------------------------
    |
    */  
    public function userRoleEdit(Request $request)
    {
        if($request->id == 1){
            return redirect()->route('user-list-view')->with('error', 'Oops! This Role Can not update.');
        }
        $response_role = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-single-user-role-data',["role_id" => $request->id]);
        $response_role_data =json_decode($response_role);

        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-user-permission-data-as-pluck',["role_id" => $request->id]);
        $response_data =json_decode($response);

        if(!empty($response_role_data) && !empty($response_data)){
            if($response_role_data->success == true && $response_data->success == true){
                $data =array(
                    'title'             => 'User Role Edit',
                    'view'              => 'user_role_edit',
                    'script'            => array(config('site-specific.user-role-init-js')), 
                    'permission'        => $response_data->data,
                    'role'              => $response_role_data->data,
                );
                //return response()->json($response_data);
                return $this->setDefault($data);
            }
            return redirect()->route('user-role-list-view')->with('error', $response_role_data->message);
        }
        return redirect()->route('user-role-list-view')->with('error', 'Oops! Data Not Loaded.');
    }




    /*
    |--------------------------------------------------------------------------
    | Public Function User Role List
    |--------------------------------------------------------------------------
    |
    */  
    public function userRoleList(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-user-role-data');
        $response_data =json_decode($response);

        if(!empty($response_data)){
            if($response_data->success == true){
                $data =array(
                    'title'             => 'User Role List',
                    'view'              => 'user_role_list',
                    'css'               => array(config('site-specific.dataTables-bootstrap4-min-css'),config('site-specific.responsive-bootstrap4-min-css'),
                                                config('site-specific.buttons-bootstrap4-min-css')),
                    'script'            => array(config('site-specific.jquery-dataTables-min-js'),config('site-specific.dataTables-bootstrap4-min-js'),
                                                config('site-specific.dataTables-responsive-min-js'),config('site-specific.responsive-bootstrap4-min-js'),
                                                config('site-specific.dataTables-buttons-min-js'),config('site-specific.buttons-bootstrap4-min-js'),
                                                config('site-specific.jszip-min-js'),config('site-specific.pdfmake-min-js'),
                                                config('site-specific.vfs-fonts-js'),config('site-specific.buttons-html5-min-js'),
                                                config('site-specific.buttons-print-min-js'),config('site-specific.buttons-colVis-min-js'),
                                                config('site-specific.user-role-init-js')),
                    'user_roles'        => $response_data->data,
                );
                return $this->setDefault($data);
            }
            return redirect()->route('dashboard-view')->with('error', $response_data->message);
        }
        return redirect()->route('dashboard-view')->with('error', 'Oops! Data Not Loaded.');
    }



    /*
    |--------------------------------------------------------------------------
    | Public Function Brand List
    |--------------------------------------------------------------------------
    |
    */  
    public function brandList(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-brand-data');
        $response_data =json_decode($response);
        if(!empty($response_data)){
            if($response_data->success == true){
        
                $data =array(
                    'title'             => 'Brand List',
                    'view'              => 'brand_list',
                    'css'               => array(config('site-specific.dataTables-bootstrap4-min-css'),config('site-specific.responsive-bootstrap4-min-css'),
                                                config('site-specific.buttons-bootstrap4-min-css')),
                    'script'            => array(config('site-specific.jquery-dataTables-min-js'),config('site-specific.dataTables-bootstrap4-min-js'),
                                                config('site-specific.dataTables-responsive-min-js'),config('site-specific.responsive-bootstrap4-min-js'),
                                                config('site-specific.dataTables-buttons-min-js'),config('site-specific.buttons-bootstrap4-min-js'),
                                                config('site-specific.jszip-min-js'),config('site-specific.pdfmake-min-js'),
                                                config('site-specific.vfs-fonts-js'),config('site-specific.buttons-html5-min-js'),
                                                config('site-specific.buttons-print-min-js'),config('site-specific.buttons-colVis-min-js'),
                                                config('site-specific.brand-list-init-js')),
                    'brands'            => $response_data->data,                            
                );
                return $this->setDefault($data);
            }
            return redirect()->route('dashboard-view')->with('error', $response_data->message);
        }
        return redirect()->route('dashboard-view')->with('error', 'Oops! Data Not Loaded.');
    }



    /*
    |--------------------------------------------------------------------------
    | Public Function Category List
    |--------------------------------------------------------------------------
    |
    */  
    public function categoryList(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-category-data');
        $response_data =json_decode($response);
        if(!empty($response_data)){
            if($response_data->success == true){
        
                $data =array(
                    'title'             => 'Category List',
                    'view'              => 'category_list',
                    'css'               => array(config('site-specific.dataTables-bootstrap4-min-css'),config('site-specific.responsive-bootstrap4-min-css'),
                                                config('site-specific.buttons-bootstrap4-min-css')),
                    'script'            => array(config('site-specific.jquery-dataTables-min-js'),config('site-specific.dataTables-bootstrap4-min-js'),
                                                config('site-specific.dataTables-responsive-min-js'),config('site-specific.responsive-bootstrap4-min-js'),
                                                config('site-specific.dataTables-buttons-min-js'),config('site-specific.buttons-bootstrap4-min-js'),
                                                config('site-specific.jszip-min-js'),config('site-specific.pdfmake-min-js'),
                                                config('site-specific.vfs-fonts-js'),config('site-specific.buttons-html5-min-js'),
                                                config('site-specific.buttons-print-min-js'),config('site-specific.buttons-colVis-min-js'),
                                                config('site-specific.category-list-init-js')),
                    'categories'        => $response_data->data,                            
                );
                return $this->setDefault($data);
            }
            return redirect()->route('dashboard-view')->with('error', $response_data->message);
        }
        return redirect()->route('dashboard-view')->with('error', 'Oops! Data Not Loaded.');
    }



    /*
    |--------------------------------------------------------------------------
    | Public Function Product Create
    |--------------------------------------------------------------------------
    |
    */  
    public function productCreate(Request $request)
    {
        $data =array(
            'title'             => 'Product Create',
            'view'              => 'product_create',
            'css'               => array(config('site-specific.cropper-min-css')),
            'script'            => array(config('site-specific.cropper-min-js'),config('site-specific.product-init-js')),
        );
       return $this->setDefault($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function Product Edit
    |--------------------------------------------------------------------------
    |
    */  
    public function productEdit(Request $request)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-single-product-data',["product_id" => $request->id]);
        $response_data =json_decode($response);

        if(!empty($response_data)){
            if($response_data->success == true){
    
                if(session()->get('user_role') == 2){
                    if(session()->get('user_id') != $response_data->data->vendor){
                        return redirect()->route('product-list-view')->with('error', 'You Don`t Have Enough Permissions!');
                    }
                }
                 
                $data =array(
                    'title'             => 'Product Edit',
                    'view'              => 'product_edit',
                    'css'               => array(config('site-specific.cropper-min-css')),
                    'script'            => array(config('site-specific.cropper-min-js'),config('site-specific.product-init-js')),
                    'product'           => $response_data->data,
                );
                //return response()->json($data['product']);
                return $this->setDefault($data);
            }
            return redirect()->route('product-list-view')->with('error', $response_data->message);
        }
        return redirect()->route('product-list-view')->with('error', 'Oops! Data Not Loaded.');
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function Product List
    |--------------------------------------------------------------------------
    |
    */  
    public function productList(Request $request,$status=null)
    {
        $requestArray = [];
        if($status!=null){
            $requestArray = ["status" => $status];
        }
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-product-data',$requestArray);
        $response_data =json_decode($response);
        if(!empty($response_data)){
            if($response_data->success == true){
        
                $data =array(
                    'title'             => 'Product List',
                    'view'              => 'product_list',
                    'css'               => array(config('site-specific.dataTables-bootstrap4-min-css'),config('site-specific.responsive-bootstrap4-min-css'),
                                                config('site-specific.buttons-bootstrap4-min-css')),
                    'script'            => array(config('site-specific.jquery-dataTables-min-js'),config('site-specific.dataTables-bootstrap4-min-js'),
                                                config('site-specific.dataTables-responsive-min-js'),config('site-specific.responsive-bootstrap4-min-js'),
                                                config('site-specific.dataTables-buttons-min-js'),config('site-specific.buttons-bootstrap4-min-js'),
                                                config('site-specific.jszip-min-js'),config('site-specific.pdfmake-min-js'),
                                                config('site-specific.vfs-fonts-js'),config('site-specific.buttons-html5-min-js'),
                                                config('site-specific.buttons-print-min-js'),config('site-specific.buttons-colVis-min-js'),
                                                config('site-specific.product-list-init-js')),
                    'products'          => $response_data->data->products,
                    'counts'            => $response_data->data->counts,
                    'selected_status'   => $status,                              
                );
                return $this->setDefault($data);
            }
            return redirect()->route('dashboard-view')->with('error', $response_data->message);
        }
        return redirect()->route('dashboard-view')->with('error', 'Oops! Data Not Loaded.');
    }



    /*
    |--------------------------------------------------------------------------
    | Public Function Order Create
    |--------------------------------------------------------------------------
    |
    */  
    public function orderCreate(Request $request)
    {
        $data =array(
            'title'             => 'Order Create',
            'view'              => 'order_create',
            'script'            => array(config('site-specific.order-init-js')),
        );
       return $this->setDefault($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Function 403 page
    |--------------------------------------------------------------------------
    |
    */  
    public function forbidden(Request $request)
    {
        $data =array(
            'title'             => 'Forbidden',
            'view'              => '403', 
        );

       return $this->setDefault($data);
    }



    /*
    |--------------------------------------------------------------------------
    | Public Function Admin Login
    |--------------------------------------------------------------------------
    |
    */  
    public function adminLogin(Request $request)
    {
        return View::make('admin_login');
    }



    /*
    |--------------------------------------------------------------------------
    | Public Function Customer Register
    |--------------------------------------------------------------------------
    |
    */  
    public function customerRegister(Request $request)
    {
        return View::make('customer_register');
    }


    

}
