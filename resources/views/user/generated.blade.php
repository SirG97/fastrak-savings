@extends('user.layout.base')
@section('title', 'Pins')
@section('icon', 'fa-user-plus')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="custom-panel card py-2">
                <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                    Pins
                </div>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="trx-bg-head text-secondary py-3 px-3">
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Pin</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Generated On</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody class="table-style">
                        @if(!empty($pins) && count($pins) > 0)
                            @foreach($pins as $pin)
                                <tr>
                                <td scope="row">
                                    {{ $pin['serial'] }}
                                </td>
                                <td>{{ $pin['pin'] }}</td>
                                <td>{{ $pin['amount'] }}</td>
                                <td>{{ $pin['created_at'] }}</td>
                                <td>{{ $pin['status'] }}</td>

                            </tr>
                            @endforeach
                        @else
                            <tr>
                                No customers yet

                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer py-1 mt-0 mr-3 d-flex justify-content-end">
                    {!! $links !!}
                </div>

            </div>
        </div>

    </div>
    <form method="post" action="">

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
            {{--        <thead>--}}
            {{--            <tr>--}}
            {{--                <th>S/N</th>--}}
            {{--                <th>Serial No</th>--}}
            {{--                <th>Pin</th>--}}
            {{--                <th>Amount</th>--}}
            {{--                <th>Generated on</th>--}}
            {{--                <th>Status</th>--}}
            {{--                --}}
            {{--            </tr>--}}
            {{--            </thead>--}}
            {{--            <tbody>--}}
            {{--            @php($livePins = \App\Pins::where('status', 'generated')->orderBy('id', 'desc')->paginate(20))--}}
            {{--            @php($i = 1)--}}
            {{--            @foreach($livePins as $livePin)--}}
            {{--            --}}
            {{--            <tr>--}}
            {{--                <td>{{ $i++ }}</td>--}}
            {{--                <td>{{ $livePin['serial'] }}</td>--}}
            {{--                <td>{{ $livePin['pin'] }}</td>--}}
            {{--                <td>{{ $livePin['amount'] }}</td>--}}
            {{--                <td>{{ $livePin['created_at'] }}</td>--}}
            {{--                <td>{{ $livePin['status'] }}</td>--}}
            {{--            </tr>--}}
            {{--            @endforeach--}}
            {{--            </tbody>--}}
            {{--            <tfoot></tfoot>--}}
        </table>

        {{--    <div class="panel-footer text-center">{{ $livePins->render() }}</div>--}}
    </div>
</div>


@endsection