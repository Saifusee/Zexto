<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    //Setting Payment and Order Status Constant Values.
    const PAYMENT_FAIL = '0';
    const PAYMENT_SUCCESS = '1';
    const PAYMENT_IN_PROGRESS = '2';
    const PAYMENT_CANCEL = '3';
    const PAYMENT_REFUND = '4';

    const ORDER_FAIL = '0';
    const ORDER_SUCCESS = '1';
    const ORDER_IN_PROGRESS = '2';
    const ORDER_CANCEL = '3';
    const ORDER_YET_TO_DELIVERED = '4';

    //To Upload a image file 
    public function imageFileUpload($request_field_name, $location, $image_prefix, $previous_image_name)
    {
        //Checking if images exist in the request recieved and then do functionality.
        if($request_field_name!== 'undefined' && $request_field_name !== null)
        {
            //Renaming images file 
            $image_name = $image_prefix.time().'.'.$request_field_name->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request_field_name->move(public_path($location), $image_name);
            //Copy image to thumb folder to convert it later in low size image
            File::copy($location.'/'.$image_name, $location.'/thumb/'.$image_name);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image($location.'/thumb/'.$image_name, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            //Deleting previous file
            if ($previous_image_name != null)
            {
                $this->deleteFile($location, $previous_image_name);
            }
            $model_field_name = $image_name;
        } elseif($previous_image_name == null)
        {
            $model_field_name = "0_default.png";
        } else
        {
            $model_field_name = $previous_image_name;
        }
        return $model_field_name;
    }

    //To delete image and its thumb, but preventing not to delete the defaault image
    public function deleteFile($location_direction, $name)
    {
        if($name != '0_default.png')
        {
            File::delete($location_direction.'/'.$name);
            File::delete($location_direction.'/thumb/'.$name);
        }
    }

}
