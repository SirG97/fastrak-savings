@extends('user.layout.base')
@section('title', 'Dashboard')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Customers</h6>
                        <h5 class="text-right">
                            <i class="fas fa-user  float-left"></i>
                            <span>
                                @if(!empty($total_customer) || $total_customer !== null)
                                    {{$total_customer}}
                                @else
                                    N/A
                                @endif
                            </span>
                        </h5>
                        <p class="mb-0">New customers<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Saved</h6>
                        <h5 class="text-right">
                            <i class="fas fa-award  float-left"></i>
                            <span>
                                 @if(!empty($total_saved) || $total_saved !== null)
                                    {{$total_saved}}
                                @else
                                    N/A
                                @endif
                            </span>
                        </h5>
                        <p class="mb-0">This week<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Revenue</h6>
                        <h5 class="text-right">
                            <i class="fas fa-coins  float-left"></i>
                            <span>
                                @if(!empty($total_revenue) || $total_revenue !== null)
                                    {{$total_revenue}}
                                @else
                                    N/A
                                @endif
                            </span>
                        </h5>
                        <p class="mb-0">This week<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Pins</h6>
                        <h5 class="text-right">
                            <i class="fas fa-key  float-left"></i>
                            <span>
                                @if(!empty($total_pins) || $total_pins !== null)
                                    {{$total_pins}}
                                @else
                                    N/A
                                @endif
                            </span>
                        </h5>
                        <p class="mb-0">This week<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>

        </div>
{{--        Daily contribution chart--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                            Daily contribution
                        </div>
                        <div id="canvas-container" class="cool-border">
                            <canvas id="contribution-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

{{--        Latest transaction and channedl used section--}}
            <div class="row">
                <div class="col-md-8">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                            Latest Transactions
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead class="trx-bg-head text-secondary py-3 px-3">
                                <tr>
                                    <th scope="col">Pin</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Point</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($latest_contributions) && count($latest_contributions) > 0)
                                    @foreach($latest_contributions as $contribution)
                                        <tr>
                                            <td scope="row">{{ $contribution['pin'] }}</td>
                                            <td>{{ $contribution['phone'] }}</td>
                                            <td>{{ $contribution['available_bal'] }}</td>
                                            <td>{{ $contribution['points'] }}</td>
                                            <td>{{ $contribution['created_at']->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-center">No Contributions yet</div>
                                        </td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-primary mb-1 py-3 px-3">
                            Used Channel
                        </div>
                        <div id="channel-container" class="cool-border px-2">
                            <canvas id="channel-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </div>
{{--    <script>--}}
{{--        var app = <?php echo json_encode($contribution_count); ?>;--}}
{{--        console.log(app);--}}
{{--    </script>--}}
@endsection()