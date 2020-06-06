@extends('user.layout.base')
@section('title', 'Pins')
@section('icon', 'fa-user-plus')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('includes/message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav class="nav pin-nav mr-2">
                <a class="nav-link active" href="/pins">All</a>
                <a class="nav-link " href="/pins/live">Live</a>
                <a class="nav-link" href="/pins/used">Used</a>
                <a class="nav-link" href="#">Pending</a>
            </nav>
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
                                <td colspan="5">
                                    <div class="d-flex justify-content-center">No pins generated</div>
                                </td>
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

        <div class="g-btn-container">
            <button type="submit" class="generate-btn pull-right">Set Pins To Live</button>
        </div>
    </form>

</div>


@endsection