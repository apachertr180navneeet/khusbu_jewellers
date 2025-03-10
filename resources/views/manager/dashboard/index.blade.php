@extends('manager.layouts.app')
@section('style')
@endsection  

@section('content')

<!-- Content -->

<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row mb-4">
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Today Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Prepaid Orders</p>
                            <h5> {{ $dashboardCount['today_prepaid_order'] }} Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Orders</p>
                            <h5> {{ $dashboardCount['today_cod_order'] }} Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Today Sale</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Prepaid Sale</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Sale</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">This Month Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Prepaid Orders</p>
                            <h5> {{ $dashboardCount['month_prepaid_order'] }} Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Orders</p>
                            <h5> {{ $dashboardCount['month_cod_order'] }} Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">This Month Sales</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Prepaid Sale</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Sale</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Executive</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Active</p>
                            <h5>{{ $dashboardCount['today_user_active'] }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>In Active</p>
                            <h5>{{ $dashboardCount['today_user_inactive'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Order Detail</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Open</p>
                            <h5>{{ $dashboardCount['open_order'] }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Close</p>
                            <h5>{{ $dashboardCount['close_order'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Process Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Purchase</p>
                            <h5>{{ $dashboardCount['normal_order'] }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Manufacture</p>
                            <h5>{{ $dashboardCount['manufacturing_order'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Verify Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Founder</p>
                            <h5>{{ $dashboardCount['normal_order'] }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Payment</p>
                            <h5>{{ $dashboardCount['manufacturing_order'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection

@section('script')
@endsection