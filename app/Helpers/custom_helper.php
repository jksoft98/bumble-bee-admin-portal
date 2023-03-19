<?php

use Illuminate\Http\Request;
use Pusher\Pusher;



if (!function_exists('isPermissions')) {
    function isPermissions($permission){
        if(session()->get('user_role') !=1){
            return checkHasPermissions($permission);
        }
        return true;  
    }
}

if (!function_exists('checkHasPermissions')) {
    function checkHasPermissions($permission){
        if(in_array($permission, session()->get('user_permissions'))){
            return true;    
        }else{
            return false;
        }
    }
}


if (!function_exists('sendNotification')) {
    function sendNotification($type,$message){

        $response = Http::withHeaders([
            'content-Type'  => 'applications/json','authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-allowed-notification-user-role-as-pluck',["message" => $message]);
        $response_data =json_decode($response);


        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true,
        );

        $pusher = new Pusher(
            '40d75bd8f0e0c4dcf690',
            '6d23dde9772e3820b836',
            '1550888',
            $options
        );

        if($response_data->success == true){  
            $data = ['username'=> session()->get('username'), 'to' =>$response_data->data, 'type' => $type, 'message' => $message];
            $pusher->trigger('my-channel', 'my-tool', $data);
        }
        return true;
    }
}




/*
|--------------------------------------------------------------------------
| Function Implement User Roles SelectBox
|--------------------------------------------------------------------------
|
*/ 
if (!function_exists('getUserRolesSelectBox')) {
    function getUserRolesSelectBox($select_id='',$show_select=false)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-user-role-data');
        $response_data =json_decode($response);

        if($response_data->success == true){   
            $str=($show_select)? '<option value="">-select role-</option>' : '';
            if(!empty($response_data->data)){
                foreach($response_data->data as $data){
                    $str.= ($select_id!='' && $select_id==$data->id)? '<option selected value="'.$data->id.'">'.$data->role_name.'</option>' : '<option value="'.$data->id.'">'.$data->role_name.'</option>';
                }
            }
            else{
                $str='<option value="">No Records Found</option>';
            }
        }
        else{
            $str='<option value="">No Records Found</option>';
        }

        return $str;
    }
}


/*
|--------------------------------------------------------------------------
| Function Implement Brand SelectBox
|--------------------------------------------------------------------------
|
*/ 
if (!function_exists('getBrandSelectBox')) {
    function getBrandSelectBox($select_id='',$show_select=false)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-brand-data');
        $response_data =json_decode($response);

        if($response_data->success == true){   
            $str=($show_select)? '<option value="">-select brand-</option>' : '';
            if(!empty($response_data->data)){
                foreach($response_data->data as $data){
                    if($data->status){
                        $str.= ($select_id!='' && $select_id==$data->id)? '<option selected value="'.$data->id.'">'.$data->brand_name.'</option>' : '<option value="'.$data->id.'">'.$data->brand_name.'</option>';
                    }
                }
            }
            else{
                $str='<option value="">No Records Found</option>';
            }
        }
        else{
            $str='<option value="">No Records Found</option>';
        }

        return $str;
    }
}


/*
|--------------------------------------------------------------------------
| Function Implement Category SelectBox
|--------------------------------------------------------------------------
|
*/ 
if (!function_exists('getCategorySelectBox')) {
    function getCategorySelectBox($select_id='',$show_select=false)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-category-data');
        $response_data =json_decode($response);

        if($response_data->success == true){   
            $str=($show_select)? '<option value="">-select category-</option>' : '';
            if(!empty($response_data->data)){
                foreach($response_data->data as $data){
                    if($data->status){
                        $str.= ($select_id!='' && $select_id==$data->id)? '<option selected value="'.$data->id.'">'.$data->category_name.'</option>' : '<option value="'.$data->id.'">'.$data->category_name.'</option>';
                    }
                }
            }
            else{
                $str='<option value="">No Records Found</option>';
            }
        }
        else{
            $str='<option value="">No Records Found</option>';
        }

        return $str;
    }
}



/*
|--------------------------------------------------------------------------
| Function Implement Vendor SelectBox
|--------------------------------------------------------------------------
|
*/ 
if (!function_exists('getVendorSelectBox')) {
    function getVendorSelectBox($select_id='',$show_select=false)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-vendor-data');
        $response_data =json_decode($response);

        if($response_data->success == true){   
            $str=($show_select)? '<option value="">-select vendor-</option>' : '';
            if(!empty($response_data->data)){
                foreach($response_data->data as $data){
                    if($data->status){
                        $str.= ($select_id!='' && $select_id==$data->id)? '<option selected value="'.$data->id.'">'.$data->first_name.' '.$data->last_name.'-('.$data->phone.')'.'</option>' : '<option value="'.$data->id.'">'.$data->first_name.' '.$data->last_name.'-('.$data->phone.')'.'</option>';
                    }
                }
            }
            else{
                $str='<option value="">No Records Found</option>';
            }
        }
        else{
            $str='<option value="">No Records Found</option>';
        }

        return $str;
    }
}


/*
|--------------------------------------------------------------------------
| Function Implement Customer SelectBox
|--------------------------------------------------------------------------
|
*/ 
if (!function_exists('getCustomerSelectBox')) {
    function getCustomerSelectBox($select_id='',$show_select=false)
    {
        $response = Http::withHeaders([
            'content-Type'  => 'applications/json', 'authorization' => session()->get('access_token')
        ])->get(config('site-specific.api_url').'get-all-customer-data');
        $response_data =json_decode($response);

        if($response_data->success == true){   
            $str=($show_select)? '<option value="">-select customer-</option>' : '';
            if(!empty($response_data->data)){
                foreach($response_data->data as $data){
                    if($data->status){
                        $str.= ($select_id!='' && $select_id==$data->id)? '<option selected value="'.$data->id.'">'.$data->full_name.'-('.$data->phone.')'.'</option>' : '<option value="'.$data->id.'">'.$data->full_name.'-('.$data->phone.')'.'</option>';
                    }
                }
            }
            else{
                $str='<option value="">No Records Found</option>';
            }
        }
        else{
            $str='<option value="">No Records Found</option>';
        }

        return $str;
    }
}

?>