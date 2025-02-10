@extends('admin.layouts.app')
@section('style')
@endsection  

@section('content')

<!-- Content -->

<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row mb-4">
        <h4>Sales Executive</h4>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Today Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Prepaid Orders</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Orders</p>
                            <h5> 0 Order</h5>
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
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Orders</p>
                            <h5> 0 Order</h5>
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
    <div class="row mb-4">
        <h4>Sales Manager</h4>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Today Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Prepaid Orders</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Orders</p>
                            <h5> 0 Order</h5>
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
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>COD Orders</p>
                            <h5> 0 Order</h5>
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
                    <span class="fw-medium d-block mb-1 text-center">Today Executive</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Active</p>
                            <h5>0</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>In-Active</p>
                            <h5>0</h5>
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
                            <p>Open Order</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Close Order</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Process Orders</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Purchase</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Manufacture</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Verify Orders</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Founder</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Payment</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Product Founder</h4>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order To Check</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Pending Orders</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Complete Orders</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Shift to Manufacture Dept.</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Outward</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Inward</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Normal Order</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Total</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Pending</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Shift To Purchase Dept.</span>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <p>Outward</p>
                            <h5> 0 Order</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Inward</p>
                            <h5> 0 Order</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Payment Check</h4>
        <div class="col-lg-6 col-md-6 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order Payment</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Payment</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Logistic Booking</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Assign Logistic</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Logistics</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Billing Department</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order Invoiced</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Invoice</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Packing Department</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Packing</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Complete Packing</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Dispatch Department</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Order</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Dispatch</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Complete Dispatch</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Calling Department</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Calls</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Confirm Orders</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Rejected Orders</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Purchase Department</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Items</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Outwards Items</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Inwards Items</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Manufacturing Department</h4>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Items</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Total</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Outwards Items</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Pending Inwards Items</span>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--  <p>Pending</p>  --}}
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Department Users</h4>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Sales Executive</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Sales Manager</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Product Founder</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Payment Check</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Logistic Person</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Billing Person</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Packing Person</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Calling Person</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Purchase Person</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Manufacturing Person</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h4>Logistic Company</h4>
        <div class="col-lg-3 col-md-3 order-1 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-medium d-block mb-1 text-center">Total Logistic Company</span>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p>Total</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>Active</p>
                            <h5> 0 </h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>In-Active</p>
                            <h5> 0 </h5>
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