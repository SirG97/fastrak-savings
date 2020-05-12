@extends('layouts.dashboard')

@section('content')

<form method="post" action="{{URL::to('/generated')}}">
        @csrf
        <!-- <input name="_method" type="hidden" value="PATCH"> 
        <input type="hidden" name="id" > -->
        <div class="g-btn-container">
            <button type="submit" class="generate-btn pull-right">Set Pins To Live</button>
        </div>
</form>
<div class="panel panel-success mytable">
     <!-- Default panel contents -->
    <div class="panel-heading">Generated Pins</div>
    
    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Serial No</th>
                <th>Pin</th>
                <th>Amount</th>
                <th>Generated on</th>
                <th>Status</th>
                
            </tr>
            </thead>
            <tbody>
            @php($livePins = \App\Pins::where('status', 'generated')->orderBy('id', 'desc')->paginate(20))
            @php($i = 1)
            @foreach($livePins as $livePin)
            
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $livePin['serial'] }}</td>
                <td>{{ $livePin['pin'] }}</td>
                <td>{{ $livePin['amount'] }}</td>
                <td>{{ $livePin['created_at'] }}</td>
                <td>{{ $livePin['status'] }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot></tfoot>
    </table>
    
    <div class="panel-footer text-center">{{ $livePins->render() }}</div>
    </div>

@endsection