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
                <span class="text-primary fw-light">Add Order</span>
            </h5>
        </div>
    </div>
    <div class="row">
        {{--  Order Details  --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card mb-4">
                <h5 class="card-header">Order Detail</h5>
                <div class="card-body">
                    <div class="row card-border">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="order_type" class="form-label">Order payment Type</label>
                                <select id="order_payment_type" name="order_payment_type" class="form-select">
                                    <option value="">Select Order Value</option>
                                    <option value="prepaid">prepaid</option>
                                    <option value="cod">cod</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="delivery_type" class="form-label">Delivery Type</label>
                                <select id="delivery_type" name="delivery_type" class="form-select">
                                    <option value="">Select Delivery Type</option>
                                    <option value="simple">simple</option>
                                    <option value="premium">premium</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="col-md">
                                    <small class="text-light fw-medium d-block">Order Type</small>
                                    <div class="form-check form-check-inline mt-3">
                                      <input class="form-check-input" type="radio" name="order_type" id="normal" value="normal" checked>
                                      <label class="form-check-label" for="normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="order_type" id="manufacturing" value="manufacturing">
                                      <label class="form-check-label" for="manufacturing">Manufacturing</label>
                                    </div>
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
                    <button type="button" class="btn btn-xs btn-primary" onclick="addProduct()">+</button>
                </h5>
                <div class="card-body" id="product-details-container">
                    <div class="row product-detail card-border">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="product_image" name="product_image[]">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name[]" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="text" class="form-control" id="price" name="price[]" placeholder="Enter Product Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Enter Quantity">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="mb-3">
                                <textarea class="form-control" id="comment" name="comment[]" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-danger remove-btn" style="display:none;" onclick="removeProduct(this)">Remove</button>
                        </div>
                    </div>
                </div>
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
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp NUmber</label>
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp NUmber">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 row">
                                <label for="pincode" class="col-md-2 col-form-label text-end">Pincode</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="Enter Pincode" id="pincode" name="pincode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 row">
                                <label for="city" class="col-md-2 col-form-label text-end">City</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="Enter City" id="city" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 row">
                                <label for="state" class="col-md-2 col-form-label text-end">State</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="Enter State" id="state" name="state">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 row">
                                <label for="feedback" class="col-md-1 col-form-label text-center">Feedback</label>
                                <div class="col-md-11">
                                    <input class="form-control" type="text" value="Enter feedback" id="feedback" name="feedback">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 row">
                                <label for="comment" class="col-md-1 col-form-label text-center">Comment</label>
                                <div class="col-md-11">
                                    <input class="form-control" type="text" value="Enter Comment" id="comment" name="comment">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 row">
                                <label for="product_founder" class="col-md-1 col-form-label text-center">Product Founder</label>
                                <div class="col-md-11">
                                    <select id="product_founder" name="product_founder" class="form-select">
                                        <option value="">Select Product Founder</option>
                                        <option value="1">Product Founder 1</option>
                                        <option value="2">Product Founder 2</option>
                                    </select>
                                </div>
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
                                <input class="form-control" type="file" id="payment_screen_shot" name="payment_screen_shot">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="paid_amount" class="form-label">Paid Amount</label>
                                <input class="form-control" type="text" id="paid_amount" name="paid_amount" placeholder="Enter Paid Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_via" class="form-label">Payment Via</label>
                                <select id="payment_via" name="payment_via" class="form-select">
                                    <option value="">Select Payment Via</option>
                                    <option value="upi">UPI</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input class="form-control" type="date" id="payment_date" name="payment_date" placeholder="Enter Payment Date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="utr_id" class="form-label">UTR Id</label>
                                <input class="form-control" type="text" id="utr_id" name="utr_id" placeholder="Enter UTR ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_amount" class="form-label">Total Amount</label>
                                <input class="form-control" type="text" id="total_amount" name="total_amount" placeholder="Enter Total Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="adv_amount" class="form-label">Adv. Amount</label>
                                <input class="form-control" type="text" id="adv_amount" name="adv_amount" placeholder="Enter Adv. Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cod_amount" class="form-label">COD Amount</label>
                                <input class="form-control" type="text" id="cod_amount" name="cod_amount" placeholder="Enter COD Amount">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

@endsection 
@section('script')
<script>
    function addProduct() {
        // Clone the first product detail form (excluding the first one, which already exists)
        var productDetailClone = document.querySelector('.product-detail').cloneNode(true);
        
        // Clear input values in the cloned form
        var inputs = productDetailClone.querySelectorAll('input, textarea');
        inputs.forEach(input => input.value = '');
        
        // Make the remove button visible in the cloned form
        var removeButton = productDetailClone.querySelector('.remove-btn');
        removeButton.style.display = 'inline-block';  // Show remove button
        
        // Append the cloned form to the container
        document.getElementById('product-details-container').appendChild(productDetailClone);
    }
    
    function removeProduct(button) {
        // Find the product detail row to be removed
        var productDetail = button.closest('.product-detail');
        
        // Remove the product detail row
        productDetail.remove();
    }
    
</script>
@endsection
