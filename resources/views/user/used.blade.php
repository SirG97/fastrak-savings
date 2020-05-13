@extends('layouts.dashboard')

@section('content')

 <!-- Used table starts -->
 <div class="panel panel-warning mytable">
    <!-- Default panel contents -->
    <div class="panel-heading">Used Pins</div>
    
    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Pin</th>
                <th>Amount</th>
                <th>Generated on</th>
                <th>Used on</th>
                <th>Status</th>               
                <th>Bank</th>
                <th>Used by</th>
            </tr>
            </thead>
            <tbody>
            @php($usedPins = \App\Pins::where('status', 'used')->orderBy('id', 'desc')->paginate(20))
        
            @foreach($usedPins as $usedPin)
            <tr>
                <td>{{ $usedPin['serial'] }}</td>
                <td>{{ $usedPin['pin'] }}</td>
                <td>{{ $usedPin['amount'] }}</td>
                <td>{{ $usedPin['created_at'] }}</td>
                <td>{{ $usedPin['updated_at'] }}</td>
                <td>{{ $usedPin['status'] }}</td>
                <td>{{ $usedPin['bank'] }}</td>
                <td>{{ $usedPin['user_id'] }}</td>
            </tr>
            @endforeach
            
            </tbody>
    </table>
    <div class="panel-footer text-center">{{ $usedPins->render() }}</div>
    </div>
    <!-- Used table ends-->

@endsection