
@extends('layouts.admin-master')

@section('title')
'Confirmation'
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<section class="section">
  <div class="section-header">
      <div class="col-sm-8">           
          <h1>Credit Confirmation</h1>
      </div>          
  </div>   

  @if (session('status'))
      <div id="disappear" class="alert alert-success alert-dismissible">
        <button type="button" class="close">&times;</button>
         <strong>Pembayaran Berhasil di Verifikasi...!</strong> {{ session('status') }}
      </div>
  @endif   

   @if (session('notFound'))
      <div id="disappear" class="alert alert-danger alert-dismissible">
        <button type="button" class="close">&times;</button>
         <strong>ERROR...!</strong> {{ session('notFound') }}
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
              <label for="kdBooking" class="col-sm-3 ml-4 col-form-label" >Nomor Tagihan
                    <span class="errRequired">*</span> 
              </label> 

              <div class="col-sm-8">
                <form method="POST" action="/pay_verify" class="form-inline">
                    @csrf
                    @method('patch')                                   

                    @if(isset($CCredits->nomor_tagihan)) 
                      <input type="text" name="kdBooking" id="kdBooking" class="form-control @error('kdBooking') is-invalid @enderror" value="{{$CCredits->nomor_tagihan}}" placeholder="Ketikan nomor tagihan...">                                                 
                      <input type="submit" class="btn btn-danger btn-lg ml-2" name="chkBooking" id="chkBooking" value="Check" >                    
                       @error('kdBooking')<div class="invalid-feedback">{{ 'Kode Booking tidak boleh kosong..!'}}</div>@enderror
                    @else                       
                        <input type="text" name="kdBooking" id="kdBooking" class="form-control @error('kdBooking') is-invalid @enderror" placeholder="Ketikan nomor tagihan...">                                                 
                      <input type="submit" class="btn btn-danger btn-lg ml-2" name="chkBooking" id="chkBooking" value="Check" >                    
                       @error('kdBooking')<div class="invalid-feedback">{{ 'Kode Booking tidak boleh kosong..!'}}</div>@enderror                    
                     
                    @endif
                </form>    
              </div>                          
            </div>                  
                
            <form method="POST" action="/pay_verify" name="post_Verify" enctype="multipart/form-data">
            @csrf     
            
            <div class="form-group row">
               <label for="nm_Paket" class="col-sm-3 ml-4 col-form-label" >Paket</label> 
               <div class="col-sm-8">
                @if(isset($CCredits->nama_paket)) 
                    <input type="text" name="nm_Paket" id="nm_Paket" class="form-control" value="{{$CCredits->nama_paket}}" placeholder="Nama Paket yang dibeli..." disabled> 
                @else
                     <input type="text" name="nm_Paket" id="nm_Paket" class="form-control" placeholder="Nama Paket yang dibeli..." disabled> 
                @endif
                </div>                     
            </div>

            <div class="form-group row">
              <label for="jml_nominal" class="col-sm-3 ml-4 col-form-label" >Harga</label> 
              <div class="col-sm-8">  
                @if(isset($CCredits->nominal))              
                  <input type="text" name="jml_nominal" id="jml_nominal" class="form-control" value= "{{number_format($CCredits->nominal,2,",",".")}}" placeholder="Harga Paket..." disabled >
                @else
                  <input type="text" name="jml_nominal" id="jml_nominal" class="form-control" placeholder="Harga Paket..." disabled >
                @endif
              </div>                     
            </div>

            <div class="form-group row">
               <input type="bts_Rpem" name="bts_Rpem" id="bts_Rpem" class="form-control bg-primary text-white " value="Rekening Pembeli" disabled >
            </div>

            <div class="form-group row">
              <label for="trans_bank" class="col-sm-3 ml-4 col-form-label" >Transfer Bank</label> 
               <div class="col-sm-8">
                 @if(isset($CCredits->nm_ATM))  
                    <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Rekening Bank" value="{{$CCredits->nm_ATM}}" disabled >
                  @else
                    <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Rekening Bank" disabled >
                  @endif
                
                  @if(isset($CCredits->nomor_tagihan)) 
                    <input type="hidden" name="Hid_kdBooking" id="Hid_kdBooking" value="{{$CCredits->nomor_tagihan}}" > 
                  @else
                      <input type="hidden" name="Hid_kdBooking" id="Hid_kdBooking"> 
                  @endif
                  
              </div>                     
            </div>
            
            <div class="form-group row">
              <label for="rek_BuyerEx" class="col-sm-3 ml-4 col-form-label" >Nomor Rekening
                <span class="errRequired">*</span>
              </label> 
              <div class="col-sm-8">
                  <input type="text" name="rek_BuyerEx" id="rek_BuyerEx" class="form-control @error('rek_BuyerEx') is-invalid @enderror" placeholder="Ketik nomor rekening anda... " style="background-color: #e8f0fd" value="{{old('rek_BuyerEx')}}">

                   @error('rek_BuyerEx')<div class="invalid-feedback">{{ 'Tolong isi nomor rekening anda..!'}}</div>@enderror
              </div>                     
            </div>

            <div class="form-group row">
              <label for="rNm_BuyerEx" class="col-sm-3 ml-4 col-form-label" >Pemilik Rekening
                    <span class="errRequired">*</span> 
              </label> 
              <div class="col-sm-8">
                  <input type="text" name="rNm_BuyerEx" id="rNm_BuyerEx" class="form-control @error('rNm_BuyerEx') is-invalid @enderror" placeholder="Ketik nama yang terdaftar atas rekening ini..." style="background-color: #e8f0fd" value="{{old('rNm_BuyerEx')}}">

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
                <input type="file" name="lblFile" id="lblFile" class="custom-file-input @error('lblFile') is-invalid @enderror"  
                aria-describedby="lblFile" accept=".jpg, .jpeg, .png, .gif">
                @error('lblFile')               
                <div class="invalid-feedback mt-2">{{'BUKTI TRANSFER belum dipilih...!!!'}}</div>@enderror
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

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
  $(document).ready( function() {
    $('#disappear').delay(3000).fadeOut();
  });
</script>

@endsection
