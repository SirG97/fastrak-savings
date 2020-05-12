@extends('layouts.dashboard')

@section('content')
@if (\Session::has('setpin'))
    <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p><strong>Success!</strong> {{ \Session::get('setpin') }}</p>
    </div><br />
@endif

<div class="panel panel-success mytable">
     <!-- Default panel contents -->
    <div class="panel-heading">Live Pins</div>
    
    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Pin</th>
                <th>Amount</th>
                <th>Generated on</th>
                <th>Status</th>
                <th>Used by</th>
            </tr>
            </thead>
            <tbody>
            @php($livePins = \App\Pins::where('status', 'live')->orderBy('id', 'desc')->paginate(20))
            @foreach($livePins as $livePin)
                <tr>
                    <td>{{ $livePin['serial'] }}</td>
                    <td>{{ $livePin['pin'] }}</td>
                    <td>{{ $livePin['amount'] }}</td>
                    <td>{{ $livePin['created_at'] }}</td>
                    <td>{{ $livePin['status'] }}</td>
                    <td>{{ $livePin['updated_at'] }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    <div class="panel-footer text-center">{{ $livePins->render() }}</div>
    </div>

@endsection