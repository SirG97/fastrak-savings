@extends('layouts.dashboard')

@section('content')

        <div class="col-md-6 col-md-offset-3">

            <div class="panel card-border-color">
                <div class="panel-heading navbar-custom-color">
                    <h3 class="panel-title">Generate Pins</h3>
                </div>
               <form action="{{url('pins')}}" method="POST">
               @csrf
                <div class="panel-body">
                   <p><strong>Select Quantity</strong></p>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">&#8358;</span>
                            <!-- <label for="qty">Amount:</label> -->
                            <!-- Five hundred Naira -->
                                <input type="text" class="form-control input-lg" aria-label="" name="amt500" value="500" readonly>
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <!-- <label for="qty">Qty:</label> -->
                                <input type="number" min="0" max="1000" id="qty" name="qty500" class="form-control input-lg" aria-label="" placeholder="Quantity">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                        <span class="input-group-addon">&#8358;</span>
                        <!-- <label for="qty">Amount:</label> -->
                            <input type="number" class="form-control input-lg" aria-label="" name="amt1000" value="1000" readonly>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <!-- <label for="qty">Qty:</label> -->
                            <input type="number" min="0" max="1000" id="qty" name="qty1000" class="form-control input-lg" aria-label="" placeholder="Quantity">
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                        <span class="input-group-addon">&#8358;</span>
                        <!-- <label for="qty">Amount:</label> -->
                            <input type="number" class="form-control input-lg" aria-label="" name="amt2000" value="2000" readonly>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <!-- <label for="qty">Qty:</label> -->
                            <input type="number" min="0" max="1000" id="qty" name="qty2000" class="form-control input-lg" aria-label="" placeholder="Quantity">
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                        <span class="input-group-addon">&#8358;</span>
                        <!-- <label for="qty">Amount:</label> -->
                            <input type="number" class="form-control input-lg" aria-label="" name="amt3000" value="3000" readonly>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <!-- <label for="qty">Qty:</label> -->
                            <input type="number" min="0" max="1000" id="qty" name="qty3000" class="form-control input-lg" aria-label="" placeholder="Quantity">
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                        <span class="input-group-addon">&#8358;</span>
                        <!-- <label for="qty">Amount:</label> -->
                            <input type="number" class="form-control input-lg" aria-label="" name="amt5000" value="5000" readonly>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <!-- <label for="qty">Qty:</label> -->
                            <input type="number" min="0" max="1000" id="qty" name="qty5000" class="form-control input-lg" aria-label="" placeholder="Quantity">
                        </div>
                    </div>
                    </div>
                    <button class="btn btn-default pull-right btn-lg submit-btn" type="submit">Let's Go!</button>
                    </form>
                </div>
            </div>
        </div>

    

@endsection