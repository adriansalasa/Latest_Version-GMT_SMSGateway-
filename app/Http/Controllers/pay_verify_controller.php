<?php

namespace App\Http\Controllers;

use App\buycredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator,Redirect,Response,File;

class pay_verify_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pay_verify.index');
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
    public function store(Request $request, buycredit $buycredit)
    {

        $request->validate([
            'rek_BuyerEx' => 'required',
            'rNm_BuyerEx' => 'required',
             'lblFile' => 'required'
        ]);
        $lblFile = $request->file('lblFile');      
        $nmFile = $lblFile->getClientOriginalName();    
        // buycredit::where('nomor_tagihan', $request->Hid_kdBooking)
        //          ->update([
        //             'paidYn' => 'Y'
        //          ]);    
        $folderUpload = 'assets/img/bk_trans';
        $lblFile->move($folderUpload, $lblFile->getClientOriginalName());   
        
         DB::table('Playsms_BuyCredit')->where('nomor_tagihan',$request->Hid_kdBooking)->update([
        'paidYn' => 'Y', 'nrek_pembeli' => $request->rek_BuyerEx, 'nmrek_pembeli' => $request->rNm_BuyerEx,'pathGambar'=> $nmFile ]);                           
         
        return redirect(route('admin.pay_verify'))->with('status', 'Paket anda segera dikonfirmasi admin..!');               
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request)
    {   
        $request->validate([
          'kdBooking' => 'required'  
        ]);     
        $CCredits = buycredit::all()->where('nomor_tagihan', $request->kdBooking)->where('paidYn', 'N')->first();            

         
        if(!is_null($CCredits)){                              
            return view('admin.pay_verify.index', compact('CCredits'));             
        }
        else{
             $CCredits = 0; 
            return redirect('pay_verify')->with('notFound', 'Nomor Tagihan tidak ditemukan');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buycredit $buycredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
