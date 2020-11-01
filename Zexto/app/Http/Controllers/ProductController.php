<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\User;
use App\Tax;
use App\ProductTax;
use File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $data = $product->orderBy('updated_at', 'DESC')->get();
        for($i = 0; $i < sizeof($data); $i++)
        {
            $data[$i]['vendor'] = User::find($data[$i]['vendor_id']);
        }
        return response()->json($data, 200);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex($id)
    {
        $data = Product::where('vendor_id', $id)->orderBy('updated_at', 'DESC')->get();
    
        for($i = 0; $i < sizeof($data); $i++)
        {
            $data[$i]['vendor'] = User::find($data[$i]['vendor_id']);
        }
        return response()->json($data, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request['product_amount'] = round((float)$request->product_amount, 2); //Changing string numeric values into float value
        $request['product_previous_amount'] = round((float)$request->product_previous_amount, 2); //Changing string numeric values into float value or we can use => $request['product_previous_amount'] = (float)$request->product_previous_amount; => but it does't give round off value
        $request['product_weight'] = round((float)$request->product_weight, 2); //Changing string numeric values into float value or we can use => $request['product_previous_amount'] = (float)$request->product_previous_amount; => but it does't give round off value
        $request['product_stock'] = (int)$request->product_stock;
        $product = Product::create($request->all());

        //Inserting Taxes
        $pivot_taxes = [];
        $taxes_id_array = json_decode($request->taxes);
        for($i =0; $i < sizeof($taxes_id_array); $i++)
        {
            $tax = Tax::find($taxes_id_array[$i]);
            array_push($pivot_taxes, ['tax_id' => $tax->id, 'product_id' => $product->id]);
        }
        ProductTax::insert($pivot_taxes);

        //Uploading images to server
        $main_image_name = static::imageFileUpload($request->product_main_image, "images/products/main", "product_main_image", null);
        $product['product_main_image'] = $main_image_name;

        $description_image_name = static::imageFileUpload($request->product_description_image, "images/products/description", "product_description_image", null);
        $product['product_description_image'] = $description_image_name;

        $sub_image_1_name = static::imageFileUpload($request->product_sub_image_1, "images/products/sub/1", "product_sub_image_1_", null);
        $product['product_sub_image_1'] = $sub_image_1_name;

        $sub_image_2_name = static::imageFileUpload($request->product_sub_image_2, "images/products/sub/2", "product_sub_image_2_", null);
        $product['product_sub_image_2'] = $sub_image_2_name;

        $sub_image_3_name = static::imageFileUpload($request->product_sub_image_3, "images/products/sub/3", "product_sub_image_3_", null);
        $product['product_sub_image_3'] = $sub_image_3_name;

        $sub_image_4_name = static::imageFileUpload($request->product_sub_image_4, "images/products/sub/4", "product_sub_image_4_", null);
        $product['product_sub_image_4'] = $sub_image_4_name;

        $sub_image_5_name = static::imageFileUpload($request->product_sub_image_5, "images/products/sub/5", "product_sub_image_5_", null);
        $product['product_sub_image_5'] = $sub_image_5_name;

        $sub_image_6_name = static::imageFileUpload($request->product_sub_image_6, "images/products/sub/6", "product_sub_image_6_", null);
        $product['product_sub_image_6'] = $sub_image_6_name;

        $product->save();
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $user = User::find($product->vendor_id);
        $product['vendor'] = $user;
        $product['taxes'] = $product->taxes;
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $previous_main_image_name = $product->product_main_image;
        $previous_description_image_name = $product->product_description_image;
        $previous_sub_image_1_name = $product->product_sub_image_1;
        $previous_sub_image_2_name = $product->product_sub_image_2;
        $previous_sub_image_3_name = $product->product_sub_image_3;
        $previous_sub_image_4_name = $product->product_sub_image_4;
        $previous_sub_image_5_name = $product->product_sub_image_5;
        $previous_sub_image_6_name = $product->product_sub_image_6;

        ProductTax::where('product_id', $product->id)->delete();

        //Inserting Taxes
        $pivot_taxes = [];
        $taxes_id_array = json_decode($request->taxes);
        for($i =0; $i < sizeof($taxes_id_array); $i++)
        {
            $tax = Tax::find($taxes_id_array[$i]);
            array_push($pivot_taxes, ['tax_id' => $tax->id, 'product_id' => $product->id]);
        }
        ProductTax::insert($pivot_taxes);

        $request['product_amount'] = round((float)$request->product_amount, 2); //Changing string numeric values into float value
        $request['product_previous_amount'] = round((float)$request->product_previous_amount, 2); //Changing string numeric values into float value or we can use => $request['product_previous_amount'] = (float)$request->product_previous_amount; => but it does't give round off value
        $request['product_weight'] = round((float)$request->product_weight, 2); //Changing string numeric values into float value or we can use => $request['product_previous_amount'] = (float)$request->product_previous_amount; => but it does't give round off value
        $request['product_stock'] = (int)$request->product_stock;
        $product->update($request->all());
        //Uploading images to server
        $main_image_name = static::imageFileUpload($request->product_main_image, "images/products/main", "product_main_image", $previous_main_image_name);
        $product['product_main_image'] = $main_image_name;

        $description_image_name = static::imageFileUpload($request->product_description_image, "images/products/description", "product_description_image", $previous_description_image_name);
        $product['product_description_image'] = $description_image_name;

        $sub_image_1_name = static::imageFileUpload($request->product_sub_image_1, "images/products/sub/1", "product_sub_image_1_", $previous_sub_image_1_name);
        $product['product_sub_image_1'] = $sub_image_1_name;

        $sub_image_2_name = static::imageFileUpload($request->product_sub_image_2, "images/products/sub/2", "product_sub_image_2_", $previous_sub_image_2_name);
        $product['product_sub_image_2'] = $sub_image_2_name;

        $sub_image_3_name = static::imageFileUpload($request->product_sub_image_3, "images/products/sub/3", "product_sub_image_3_", $previous_sub_image_3_name);
        $product['product_sub_image_3'] = $sub_image_3_name;

        $sub_image_4_name = static::imageFileUpload($request->product_sub_image_4, "images/products/sub/4", "product_sub_image_4_", $previous_sub_image_4_name);
        $product['product_sub_image_4'] = $sub_image_4_name;

        $sub_image_5_name = static::imageFileUpload($request->product_sub_image_5, "images/products/sub/5", "product_sub_image_5_", $previous_sub_image_5_name);
        $product['product_sub_image_5'] = $sub_image_5_name;

        $sub_image_6_name = static::imageFileUpload($request->product_sub_image_6, "images/products/sub/6", "product_sub_image_6_", $previous_sub_image_6_name);
        $product['product_sub_image_6'] = $sub_image_6_name;

        $product->save();
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_data = Product::find($id);

        $product = Product::destroy($id);
        return response()->json($product, 204);     
    }

    public function changeStatus($id)
    {
        $product = Product::find($id);
        if($product->product_status == 'Approved')
        {
            $product->product_status = 'Disapproved';
        } elseif($product->product_status == 'Disapproved')
        {
            $product->product_status = 'Approved';
        }
        $product->save();
        return response()->json($product, 200);
    }
}
