
@extends('layouts.admin-master')

@section('title')
'Check Confirm'
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<section class="section">
  <div class="section-header">
      <div class="col-sm-8">           
          <h1>Credit Confirmation</h1>
      </div>          
  </div>   

<!--   @if (session('status'))
      <div id="disappear" class="alert alert-success alert-dismissible">
        <button type="button" class="close">&times;</button>
         <strong>Harap Menunggu...!</strong> {{ session('status') }}
      </div>
  @endif   -->     
    @if (session('status'))
        <div class="alert alert-success alert-block mt-3">
            <!-- {{ session('status') }} -->
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('status') }}</strong>
        </div>
    @endif    
   
  <div class="section-body">
    <div class="row">
  		  <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
                <h4 align="left" class="text-info" style="font-family: verdana"><b>Transaction Form</b></h4>
                <hr>
             </div>
                            
              <div class="card-body">                                             
                  <div class="form-group row">
                      <label for="kdBooking" class="col-sm-3 ml-4 col-form-label" >Nomor. Tagihan</label> 
                      <div class="col-sm-8">    
                      <form method="POST" action="/pay_verify" name="frm_verify" class="form-inline">
                          @csrf
                          @method('patch')      
                          <input type="text" name="kdBooking" id="kdBooking" class="form-control" value="{{ $CCredits->nomor_tagihan}}" placeholder="Ketikan nomor tagihan anda..." > 
                           <input type="submit" class="btn btn-danger btn-lg ml-2" name="chkBooking" id="chkBooking" value="Check" >                    
                          </form>                                               
                      </div>                          
                  </div>
                  <form method="POST" action="/pay_verify" name="post_Verify" enctype="multipart/form-data">
                  @csrf                                        
                  <!-- <div class="form-group row">
                      <label for="trans_bank" class="col-sm-3 ml-4 col-form-label" >Transfer Bank</label> 
                      <div class="col-sm-8">
                          <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Jenis Rekening" value="{{ $CCredits->nm_ATM}}" disabled >
                          <input type="hidden" name="Hid_kdBooking" id="Hid_kdBooking" value="{{ $CCredits->nomor_tagihan}}" > 
                      </div>                     
                   </div> -->

                   <div class="form-group row">
                      <label for="nm_Paket" class="col-sm-3 ml-4 col-form-label" >Paket</label> 
                      <div class="col-sm-8">
                          <input type="text" name="nm_Paket" id="nm_Paket" class="form-control" value="{{ $CCredits->nama_paket}}" placeholder="Nama Paket yang dibeli..." disabled> 
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="jml_nominal" class="col-sm-3 ml-4 col-form-label" >Harga</label> 
                      <div class="col-sm-8">       
                           @if(isset($CCredits->nominal))                  
                              <input type="text" name="jml_nominal" id="jml_nominal" class="form-control" value= "{{number_format($CCredits->nominal,2,",",".")}}" placeholder="Harga Paket..." disabled >
                           @endif
                      </div>                     
                  </div>

                  <div class="form-group row">
                     <input type="bts_Rpem" name="bts_Rpem" id="bts_Rpem" class="form-control bg-primary text-white " value="Rekening Pembeli" disabled >
                  </div>

                  <div class="form-group row">
                      <label for="trans_bank" class="col-sm-3 ml-4 col-form-label" >Transfer Bank</label> 
                      <div class="col-sm-8">
                          <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Rekening Bank" value="{{ $CCredits->nm_ATM}}" disabled >
                          <input type="hidden" name="Hid_kdBooking" id="Hid_kdBooking" value="{{ $CCredits->nomor_tagihan}}" > 
                      </div>                     
                   </div>

                  <div class="form-group row">
                      <label for="rek_BuyerEx" class="col-sm-3 ml-4 col-form-label" >Nomor Rekening
                            <span class="errRequired">*</span> 
                      </label> 
                      <div class="col-sm-8">
                          <input type="text" name="rek_BuyerEx" id="rek_BuyerEx" class="form-control @error('rek_BuyerEx') is-invalid @enderror" placeholder="Ketik nomor rekening anda... " style="background-color: #e8f0fd">

                           @error('rek_BuyerEx')<div class="invalid-feedback">{{ 'Tolong isi nomor rekening anda..!'}}</div>@enderror
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="rNm_BuyerEx" class="col-sm-3 ml-4 col-form-label" >Pemilik Rekening
                            <span class="errRequired">*</span> 
                      </label> 
                      <div class="col-sm-8">
                          <input type="text" name="rNm_BuyerEx" id="rNm_BuyerEx" class="form-control @error('rNm_BuyerEx') is-invalid @enderror" placeholder="Ketik nama yang terdaftar atas rekening ini..." style="background-color: #e8f0fd">

                          @error('rNm_BuyerEx')<div class="invalid-feedback">{{ 'Tolong isi nama yang terdaftar untuk rekening ini..!'}}</div>@enderror
                      </div>                     
                  </div>   

                  <div class="form-group row " id="frmGroup">
                    <label class="col-sm-3 ml-4 col-form-label">Bukti Transfer
                        <span class="errRequired">*</span> 
                    </label>
                          <a href="#" onclick="" id="CGmbr">
                            <img src="#" alt="pic" id="gmbr"  height="50px" class="mt-1 ml-3 gmbrHsl" > 
                          </a>                          
                          <input type="hidden" name="Hwidth" id="Hwidth">
                          <input type="hidden" name="Hheight" id="Hheight">
                          <input type="hidden" name="Cekheight" id="Cekheight">
                          <input type="hidden" name="hsl" id="hslID">    
                          <input type="hidden" name="LocFile" id="LocFile">

                          <span class="custom-file col-sm-6 mt-1 mb-2 ml-2">                      
                            <input type="file" class="custom-file-input" name="lblFile" id="lblFile" 
                            aria-describedby="lblFile" accept=".jpg, .jpeg, .png, .gif">
                            <label class="custom-file-label" for="lblFile" id="lblFileChoose"></label>
                          </span>                  
                        </div>                

                  <button type="submit" class="btn btn-info form-control" name="btn_post_Verify" id="btn_post_Verify">Process</button>                  
               </form>                
              </div>
              

           </div> 
  			                                      
        </div>
  		
  	</div>
  </div>

</section>

    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-danger">              
            <i class="fa fa-times-circle fa-3x text-white mb-2"></i><h2 class="modal-title text text-white ml-3 mb-2">Upload gagal..!</h2>
            <button type="button" class="close text-white" data-dismiss="modal" id="btnDismis">&times;</button>
          </div>
          <div class="modal-body mt-2">
            <p>File ini bukan file gambar. Silahkan upload gambar dengan extensi: jpg, png atau gif</p>
            <hr>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnClose">Close</button>
          </div>
        </div>        
      </div>
    </div>

@endsection
