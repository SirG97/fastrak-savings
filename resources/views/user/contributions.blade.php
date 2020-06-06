@extends('user.layout.base')
@section('title', 'Contributions')
@section('icon', 'fa-coins')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="searchbox mt-0 mr-0">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" id="search-contribution" placeholder="Search Contributions" style="border:0;">
                    </div>
                    <div class="search-result">
                        <ul class="list-group list-group-flush" id="search-result-list">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Latest Contributions
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="trx-bg-head text-secondary py-3 px-3">
                            <tr>
                                <th scope="col">Pin</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Ledger balance</th>
                                <th scope="col">Available balance</th>
                                <th scope="col">Cycle</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($contributions) && count($contributions) > 0)
                                    @foreach($contributions as $contribution)
                                    <tr>
                                        <td scope="row">{{ $contribution['pin'] }}</td>
                                        <td>{{ $contribution['phone'] }}</td>
                                        <td>{{ $contribution['ledger_bal'] }}</td>
                                        <td>{{ $contribution['available_bal'] }}</td>
                                        <td>{{ $contribution['points'] }}</td>
                                        <td>{{ $contribution['created_at'] }}</td>
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

        </div>
    </div>
@endsection()