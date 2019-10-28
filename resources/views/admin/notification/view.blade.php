@extends('layouts.admin-master')



@section('title')

Inbox

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Notification Details</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

          <div class="progress"></div>

        <div class="card">

            <div class="card-header">

                <a href="{{ route('admin.notification') }}" class="btn btn-sm btn-success mr-2">All Notification</a>

              </div>

              <div class="card-body p-0 ml-2 mr-2">
                <div class="table-responsive">

                   <table class="table table-striped">

                      <tr>
                        <th>Nomor</th>
                        <td>:</td>
                        <td>{{$notifDet->noTelp}}</td> 
                      </tr>

                      <tr>
                      <th>Message</th>
                      <td>:</td>
                      <td>Pengisian Paket {{$notifDet->nominal}}</td>
                    </tr>

                    <tr>
                      <th>Tanggal</th>
                      <td>:</td>
                      <!-- <td>{{Carbon\Carbon::parse($notifDet->in_datetime)->addHour('7')}}</td> -->
                      <td>{{ $notifDet->createDt}}</td>
                    </tr>
                   </table> 


                </div>

              </div>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

@endsection