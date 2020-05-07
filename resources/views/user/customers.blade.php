@extends('user.layout.base')
@section('title', 'Customers')
@section('icon', 'fa-users')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="searchbox mt-0 mr-0">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" id="search" placeholder="Search customers" style="border:0;">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Customers
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="trx-bg-head text-secondary py-3 px-3">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Pledged Amount</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="table-style">

                            @if(!empty($customers) && count($customers) > 0)
                                @foreach($customers as $customer)<tr>
                                    <td scope="row">
                                        @if($customer->status === 1)
                                            <i class="fas fa-fw fa-check-circle text-success"></i>
                                        @else
                                            <i class="fas fa-fw fa-exclamation-triangle text-warning"></i>
                                        @endif
                                    </td>
                                    <td>{{ $customer->firstname }}</td>
                                    <td>{{ $customer->surname }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->amount }}</td>
                                    <td class="table-action d-flex flex-nowrap"><i class="fas fa-fw fa-eye text-success" title="View customer details"></i> &nbsp; &nbsp;
                                        <i class="fas fa-fw fa-edit text-primary" title="Edit customer details"></i> &nbsp; &nbsp;
                                        <i class="fas fa-fw fa-trash text-danger" title="Delete customer details"></i>
                                    </td>


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

                </div>
            </div>

        </div>
    </div>
@endsection()