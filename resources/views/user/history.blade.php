@extends('layouts.dashboard')

@section('content')

<div class="panel panel-warning mytable">
                    <!-- Default panel contents -->
                    <div class="panel-heading">History</div>
                  
                    <!-- Table -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <th>S/N</th>
                              <th>Serial No</th>
                              <th>Pin</th>
                              <th>Amount</th>
                              <th>Generated on</th>
                              <th>Used on</th>
                              <th>Status</th>
                              <th>Used by</th>
                              <th>Bank</th>
                              <th>Account No</th>
                            </tr>
                          </thead>
                          <tbody>
                          @php($pins = DB::table('pins')->orderBy('id', 'desc')->paginate(20))
                          @php($i = 1)
                          @foreach($pins as $pin)
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $pin->serial }}</td>
                              <td>{{ $pin->pin }}</td>
                              <td>{{ $pin->amount }}</td>
                              <td>{{ $pin->created_at }}</td>
                              <td>{{ $pin->updated_at }}</td>
                              <td>{{ $pin->status }}</td>
                              <td>{{ $pin->user_id }}</td>
                              <td>{{ $pin->bank }}</td>
                              <td>{{ $pin->account_sent_to }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                    <div class="text-center">{{ $pins->render() }}</div>
                  </div>

@endsection