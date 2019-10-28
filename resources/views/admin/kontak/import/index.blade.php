@extends('layouts.admin-master')



@section('title')

Import

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Manage Phonebook</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-6 col-lg-6">

        <div class="card">

            <div class="card-header">

                   <h4> <i class ="fa fa-phone"></i> Tambah Phonebook</h4>

              </div>

              <div class="card-body m-3">

                    <form action="{{ route('admin.parse_import') }}" enctype="multipart/form-data" method=POST class="form-horizontal">

                        @csrf

                        <p>Pilih berkas CSV untuk isian buku telepon</p>

                        <div class="text-center">

                            <p><input type="file" name="csv_file" id="csv_file" class="form-control"></p>

                        </div>

                        <div class="checkbox">

                            <label>

                                <input type="checkbox" name="header" checked> File contains header row?

                            </label>

                        </div>

                        <p class=text-info>CSV file format : Nama, Ponsel, Email, Tags</p>

                        <p><input name="Import" type="submit" onclick="myFunction()"  class="btn btn-primary" value="Upload">&nbsp;&nbsp;  <strong id="demo"></strong><br></p>
                        
                        @if ($errors->has('csv_file'))

                            <div id="hidealert" class="alert alert-danger">

                              {{ $errors->first('csv_file') }}

                            </div>

                        @endif

                    </form>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

<script>
function myFunction() {
  document.getElementById("demo").innerHTML = "Uploading...";
}
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
  $(document).ready( function() {
    $('#hidealert').delay(5000).fadeOut();
  });
</script>
@endsection

