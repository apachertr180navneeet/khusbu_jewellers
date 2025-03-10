@extends('executive.layouts.app') 
@section('style')
<style>
    .card-border{
        border: 1px solid;
        padding: 9px 3px;
        margin-bottom: 22px !important;
    }
</style> 
@endsection 
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">View Order</span>
            </h5>
        </div>
    </div>
    <form action="{{route('executive.order.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $order->id }}">
        <div class="row">
            {{--  Order Details  --}}
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <h5 class="card-header">Order Detail</h5>
                    <div class="card-body">
                        <div class="row card-border">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_payment_type" class="form-label">Order Payment Type</label>
                                    <select id="order_payment_type" name="order_payment_type" class="form-select" required disabled>
                                        <option value="">Select Order Value</option>
                                        <option value="prepaid" {{ $order->order_payment_type == 'prepaid' ? 'selected' : '' }}>Prepaid</option>
                                        <option value="cod" {{ $order->order_payment_type == 'cod' ? 'selected' : '' }}>COD</option>
                                    </select>
                                    @error('order_payment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="delivery_type" class="form-label">Delivery Type</label>
                                    <select id="delivery_type" name="delivery_type" class="form-select" required disabled>
                                        <option value="">Select Delivery Type</option>
                                        <option value="simple" {{ $order->delivery_type == 'simple' ? 'selected' : '' }}>Simple</option>
                                        <option value="premium" {{ $order->delivery_type == 'premium' ? 'selected' : '' }}>Premium</option>
                                    </select>
                                    @error('delivery_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="col-md">
                                        <small class="text-light fw-medium d-block">Order Type</small>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="order_type" id="normal" value="normal"
                                                {{ $order->order_type == 'normal' ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="order_type" id="manufacturing" value="manufacturing"
                                                {{ $order->order_type == 'manufacturing' ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="manufacturing">Manufacturing</label>
                                        </div>
                                        @error('order_type')
                                            <span class="text-danger d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  Product Details  --}}
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <h5 class="card-header">
                        Product Details 
                        {{--  <button type="button" class="btn btn-xs btn-primary" onclick="addProduct()">+</button>  --}}
                    </h5>
                    @foreach ($order->orderProducts as $orderProduct)
                        <div class="card-body" id="product-details-container">
                            <div class="row product-detail card-border">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="product_image" class="form-label">Product Image</label>
                                        <input class="form-control @error('product_image.*') is-invalid @enderror" type="file" id="product_image" name="product_image[]" required>
                                        <img src="{{ asset($orderProduct->product_image) }}" alt="{{ $orderProduct->product_name }}" class="mt-2" style="width: 5%">

                                        @error('product_image.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control @error('product_name.*') is-invalid @enderror" id="product_name" name="product_name[]" placeholder="Enter Product Name" value="{{ $orderProduct->product_name }}" required readonly>
                                        @error('product_name.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Product Price</label>
                                        <input type="text" class="form-control @error('price.*') is-invalid @enderror" id="price" name="price[]" placeholder="Enter Product Price" value="{{ $orderProduct->product_price }}" required readonly>
                                        @error('price.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control @error('quantity.*') is-invalid @enderror" id="quantity" name="quantity[]" placeholder="Enter Quantity" value="{{ $orderProduct->product_qty }}" required readonly>
                                        @error('quantity.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="mb-3">
                                        <textarea class="form-control" id="comment" name="comment[]" rows="3" readonly>{{ $orderProduct->comment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="button" class="btn btn-danger remove-btn" style="display:none;" onclick="removeProduct(this)">Remove</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>            
            {{--  Customer Details  --}}
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <h5 class="card-header">Customer Details</h5>
                    <div class="card-body">
                        <div class="row card-border">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" required readonly value="{{ $order->customer->full_name }}">
                                    @error('customer_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required readonly value="{{ $order->customer->phone }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">WhatsApp NUmber</label>
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp Number" readonly value="{{ $order->customer->whatsapp }}">
                                    @error('whatsapp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required readonly value="{{ $order->customer->address }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 row">
                                    <label for="pincode" class="col-md-2 col-form-label text-end">Pincode</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" placeholder="Enter Pincode" id="pincode" name="pincode" required readonly value="{{ $order->customer->pincode }}">
                                    </div>
                                    @error('pincode')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 row">
                                    <label for="city" class="col-md-2 col-form-label text-end">City</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" placeholder="Enter City" id="city" name="city" required readonly value="{{ $order->customer->city }}">
                                    </div>
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 row">
                                    <label for="state" class="col-md-2 col-form-label text-end">State</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" placeholder="Enter State" id="state" name="state" required readonly value="{{ $order->customer->state }}">
                                    </div>
                                    @error('state')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <label for="feedback" class="col-md-1 col-form-label text-center">Feedback</label>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" placeholder="Enter feedback" id="feedback" name="feedback" readonly value="{{ $order->feedback }}">
                                    </div>
                                    @error('feedback')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <label for="customer_comment" class="col-md-1 col-form-label text-center">Comment</label>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" placeholder="Enter Comment" id="customer_comment" name="customer_comment" readonly value="{{ $order->comment }}">
                                    </div>
                                    @error('customer_comment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <label for="product_founder" class="col-md-1 col-form-label text-center">Product Founder</label>
                                    <div class="col-md-11">
                                        <select id="product_founder" name="product_founder" class="form-select" required disabled>
                                            <option value="">Select Product Founder</option>
                                            @foreach ( $productfounder as  $product)
                                                <option {{ $order->product_founder == $product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('product_founder')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  Payment Details  --}}
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <h5 class="card-header">Payment Details</h5>
                    <div class="card-body">
                        <div class="row card-border">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_screen_shot" class="form-label">Payment Screen Shot</label>
                                    <input class="form-control" type="file" id="payment_screen_shot" name="payment_screen_shot" required>
                                    <img src="{{ asset($order->paymentDetail->payment_screen_shot) }}" alt="{{ $order->paymentDetail->paid_amoun }}" class="mt-2" style="width: 5%">
                                    @error('payment_screen_shot')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="paid_amount" class="form-label">Paid Amount</label>
                                    <input class="form-control" type="text" id="paid_amount" name="paid_amount" placeholder="Enter Paid Amount" value="{{ $order->paymentDetail->paid_amount }}" readonly>
                                    @error('paid_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_via" class="form-label">Payment Via</label>
                                    <select id="payment_via" name="payment_via" class="form-select" required disabled>
                                        <option value="">Select Payment Via</option>
                                        <option {{ $order->paymentDetail->payment_via == "upi" ? 'selected' : '' }} value="upi">UPI</option>
                                        <option {{ $order->paymentDetail->payment_via == "cheque" ? 'selected' : '' }} value="cheque">Cheque</option>
                                        <option {{ $order->paymentDetail->payment_via == "cash" ? 'selected' : '' }} value="cash">Cash</option>
                                    </select>
                                    @error('payment_via')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_date" class="form-label">Payment Date</label>
                                    <input class="form-control" type="date" id="payment_date" name="payment_date" placeholder="Enter Payment Date" required readonly value="{{ $order->paymentDetail->date }}">
                                    @error('payment_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="utr_id" class="form-label">UTR Id</label>
                                    <input class="form-control" type="text" id="utr_id" name="utr_id" placeholder="Enter UTR ID" required readonly value="{{ $order->paymentDetail->utr_id }}">
                                    @error('utr_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total_amount" class="form-label">Total Amount</label>
                                    <input class="form-control" type="text" id="total_amount" name="total_amount" placeholder="Enter Total Amount" readonly value="{{ $order->paymentDetail->total_amount }}">
                                    @error('total_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @if ($order->order_payment_type == 'cod')
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="adv_amount" class="form-label">Adv. Amount</label>
                                        <input class="form-control" type="text" id="adv_amount" name="adv_amount" placeholder="Enter Adv. Amount" required readonly value="{{ $order->paymentDetail->adv_amount }}" >
                                        @error('adv_amount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cod_amount" class="form-label">COD Amount</label>
                                        <input class="form-control" type="text" id="cod_amount" name="cod_amount" placeholder="Enter COD Amount" required readonly value="{{ $order->paymentDetail->cod_amount }}">
                                        @error('cod_amount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{--  <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>  --}}
        </div>
    </form>
</div>

@endsection 
@section('script')

@endsection
