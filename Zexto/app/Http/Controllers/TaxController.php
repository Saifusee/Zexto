<?php

namespace App\Http\Controllers;

use App\Tax;
use App\stdObject;
use Illuminate\Http\Request;
use App\Http\Requests\TaxRequest;
use PhpParser\Node\Expr\Cast\Object_;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex($id)
    {
        $tax = Tax::where('user_id', $id)->orderBy('updated_at', 'DESC')->get();

        return response()->json($tax, 200);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRequest $request)
    {
        $request['tax_percentage'] = round((float)$request->tax_percentage, 2);
        $tax = Tax::create($request->all());
        return response()->json($tax, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = Tax::find($id);
        return response()->json($tax, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRequest $request, Tax $tax)
    {
        $request['tax_percentage'] = round((float)$request->tax_percentage, 2);
        $tax->update($request->all());
        return response()->json($tax, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);
        $tax = $tax->delete();
        return response()->json($tax, 204);
    }
}
