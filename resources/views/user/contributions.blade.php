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
                        <input type="text" class="form-control" id="search" placeholder="Search" style="border:0;">
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
                                <th scope="col">Status</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-times-circle text-danger"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection()