<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.coupon.index',[
        'coupons' => Coupon::paginate(10)
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
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
            'coupon_name' => ['required','min:3','unique:coupons'],
            'slug' => ['required','unique:colors'],
            'coupon_amount' => ['required'],
            'coupon_validity' => ['required'],
            'coupon_limit' => ['required'],
        ]);
        $coupon = new Coupon;
        $coupon->coupon_name = $request->coupon_name;
        $coupon->slug = $request->slug;
        $coupon->coupon_amount = $request->coupon_amount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->coupon_limit = $request->coupon_limit;

        $coupon->save();

        return back()->with('success','Coupon added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('backend.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
        'coupon_name' => ['unique:coupons,coupon_name,'.$coupon->id],
        'coupon_amount' => ['required'],
        'coupon_validity' => ['required'],
        'coupon_limit' => ['required'],
        ]);

        $coupon->coupon_name = $request->coupon_name;
        $coupon->slug = $request->slug;
        $coupon->coupon_amount = $request->coupon_amount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->coupon_limit = $request->coupon_limit;

        $coupon->save();

        return back()->with('success','Coupon Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success','Coupon Deleted successfully');
    }

    public function trashed()
    {
        $coupons = Coupon::onlyTrashed()->paginate(10);
        return view('backend.coupon.trashed',compact('coupons'));
    }

    public function restore($id)
    {
        Coupon::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Coupon Restored Successfully');
    }
    public function permanentdelete($id)
    {
        Coupon::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success','Coupon Permanently Deleted Successfully');
    }
}
