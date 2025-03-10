@extends('executive.layouts.app')
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
    </div>
</div>
<!-- / Content -->
@endsection

@section('script')
@endsection