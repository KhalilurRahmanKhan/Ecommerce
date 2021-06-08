<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCupon;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cupon.index',[
            'cupons'=>Cupon::all()
        ]);
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
    public function store(Request $request)
    {
        $request->validate([
            'cupon_name'=>'required|max:20|unique:cupons,cupon_name',
            'discount'=>'required|numeric|max:99|min:1',
            'validity'=>'required|date| after_or_equal:today',
        ]);

        Cupon::insert([
            'cupon_name'=>strtoupper($request->cupon_name),
            'discount'=>$request->discount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);

        $cupun_name=strtoupper($request->cupon_name);

        foreach (User::where('role',2)->get() as $recipient) {
            Mail::to($recipient->email)->send(new SendCupon($cupun_name));
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Cupon $cupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cupon $cupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupon $cupon)
    {
        //
    }
}
