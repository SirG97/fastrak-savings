@extends('layouts.dashboard')

@section('content')


         <div class="container-fluid">
                <div class="content">
                @if (\Session::has('success'))
                  <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p><strong>Success!</strong> {{ \Session::get('success') }}</p>
                  </div><br />
                @endif
                    <div class="g-btn-container">
                        <a href="/generate" class="generate-btn pull-right">Generate New Pins</a>
                    </div>

                    <div class="widget-box">
                        <div class="widget widget-1">
                        @php( $totalPins = DB::table('pins')->count())
                            <p class="count">{{ $totalPins }}</p>
                            <p class="description">Total Pin generated</p>
                        </div>
                        <div class="widget widget-2">
                        @php( $totalPinsUsed = DB::table('pins')->where('status', '=', 'used')->count())
                                <p class="count">{{ $totalPinsUsed }}</p>
                                <p class="description">Total Pin used</p>
                        </div>
                        <div class="widget widget-3">
                        @php ($date = date('d'))
                        @php( $generatedToday = DB::table('pins')->where('created_at', '>=', date('Y-m-d').' 00:00:00')->count())
                                <p class="count">{{ $generatedToday }}</p>
                                <p class="description">Total generated today</p>
                        </div>
                        <div class="widget widget-4">
                        @php( $usedToday = DB::table('pins')->where([['created_at', '>=', date('Y-m-d').' 00:00:00'], ['status', '=', 'used']])->count())
                                <p class="count">{{ $usedToday }}</p>
                                <p class="description">Total used today</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-success mytable">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Recently Generated</div>
                  
                    <!-- Table -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <th>Serial No</th>
                              <th>Pin</th>
                              <th>Amount</th>
                              <th>Batch</th>
                              <th>Generated on</th>
                              <th>Used by</th>
                            </tr>
                          </thead>
                          <tbody>
                          @php( $pins = \App\Pins::limit(5)->orderBy('id','desc')->get())
                          @foreach($pins as $pin)
                            <tr>
                              <td>{{ $pin->serial }}</td>
                              <td>{{ $pin->pin }}</td>
                              <td>{{ $pin->amount }}</td>
                              <td>{{ $pin->batch_no }}</td>
                              <td>{{ $pin->created_at }}</td>
                              <td>{{ $pin->user_id }}</td>
                            </tr>
                          @endforeach
                          </tbody>
                    </table>
                    <div class="panel-footer"><a class="btn btn-default" href="/generated">View more</a></div>
                  </div>
                  
                  <div class="panel panel-danger mytable">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Recently Used</div>
                  
                    <!-- Table -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <th>Serial No</th>
                              <th>Pin</th>
                              <th>Amount</th>
                              <th>Batch</th>
                              <th>Generated on</th>
                              <th>Used on</th>
                              <th>Bank</th>
                              <th>Used by</th>

                            </tr>
                          </thead>
                          <tbody>
                          @php( $usedPins = \App\Pins::limit(5)->where('status', '=', 'used')->latest()->get())
                          @foreach($usedPins as $usedPin)
                            <tr>
                              <td>{{ $usedPin['serial'] }}</td>
                              <td>{{ $usedPin['pin'] }}</td>
                              <td>{{ $usedPin['amount'] }}</td>
                              <td>{{ $usedPin['batch_no'] }}</td>
                              <td>{{ $usedPin['created_at'] }}</td>
                              <td>{{ $usedPin['updated_at'] }}</td>
                              <td>{{ $usedPin['bank'] }}</td>
                              <td>{{ $usedPin['user_id'] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
                    </table>
                    <div class="panel-footer"><a class="btn btn-default" href="/used">View more</a></div>
                  </div>
                  </div>

@endsection
