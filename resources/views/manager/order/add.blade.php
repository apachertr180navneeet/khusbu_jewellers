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
    <form action="{{route('executive.order.store')}}" method="post" enctype="multipart/form-data">
        @csrf
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
                                    <select id="order_payment_type" name="order_payment_type" class="form-select" required>
                                        <option value="">Select Order Value</option>
                                        <option value="prepaid" {{ old('order_payment_type') == 'prepaid' ? 'selected' : '' }}>Prepaid</option>
                                        <option value="cod" {{ old('order_payment_type') == 'cod' ? 'selected' : '' }}>COD</option>
                                    </select>
                                    @error('order_payment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="delivery_type" class="form-label">Delivery Type</label>
                                    <select id="delivery_type" name="delivery_type" class="form-select" required>
                                        <option value="">Select Delivery Type</option>
                                        <option value="simple" {{ old('delivery_type') == 'simple' ? 'selected' : '' }}>Simple</option>
                                        <option value="premium" {{ old('delivery_type') == 'premium' ? 'selected' : '' }}>Premium</option>
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
                                                {{ old('order_type', 'normal') == 'normal' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="order_type" id="manufacturing" value="manufacturing"
                                                {{ old('order_type') == 'manufacturing' ? 'checked' : '' }}>
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
                        <button type="button" class="btn btn-xs btn-primary" onclick="addProduct()">+</button>
                    </h5>
                    <div class="card-body" id="product-details-container">
                        <div class="row product-detail card-border">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_image" class="form-label">Product Image</label>
                                    <input class="form-control @error('product_image.*') is-invalid @enderror" type="file" id="product_image" name="product_image[]" required>
                                    @error('product_image.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('product_name.*') is-invalid @enderror" id="product_name" name="product_name[]" placeholder="Enter Product Name" required>
                                    @error('product_name.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Product Price</label>
                                    <input type="text" class="form-control @error('price.*') is-invalid @enderror" id="price" name="price[]" placeholder="Enter Product Price" required>
                                    @error('price.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control @error('quantity.*') is-invalid @enderror" id="quantity" name="quantity[]" placeholder="Enter Quantity" required>
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
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" required>
                                    @error('customer_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required >
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">WhatsApp NUmber</label>
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp Number">
                                    @error('whatsapp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 row">
                                    <label for="pincode" class="col-md-2 col-form-label text-end">Pincode</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" placeholder="Enter Pincode" id="pincode" name="pincode" required>
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
                                        <input class="form-control" type="text" placeholder="Enter City" id="city" name="city" required>
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
                                        <input class="form-control" type="text" placeholder="Enter State" id="state" name="state" required>
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
                                        <input class="form-control" type="text" placeholder="Enter feedback" id="feedback" name="feedback">
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
                                        <input class="form-control" type="text" placeholder="Enter Comment" id="customer_comment" name="customer_comment">
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
                                        <select id="product_founder" name="product_founder" class="form-select" required>
                                            <option value="">Select Product Founder</option>
                                            @foreach ( $productfounder as  $product)
                                                <option value="{{ $product->id }}">{{ $product->full_name }}</option>
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
                                    @error('payment_screen_shot')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="paid_amount" class="form-label">Paid Amount</label>
                                    <input class="form-control" type="text" id="paid_amount" name="paid_amount" placeholder="Enter Paid Amount" readonly>
                                    @error('paid_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_via" class="form-label">Payment Via</label>
                                    <select id="payment_via" name="payment_via" class="form-select" required>
                                        <option value="">Select Payment Via</option>
                                        <option value="upi">UPI</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                    @error('payment_via')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_date" class="form-label">Payment Date</label>
                                    <input class="form-control" type="date" id="payment_date" name="payment_date" placeholder="Enter Payment Date" required>
                                    @error('payment_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="utr_id" class="form-label">UTR Id</label>
                                    <input class="form-control" type="text" id="utr_id" name="utr_id" placeholder="Enter UTR ID" required>
                                    @error('utr_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total_amount" class="form-label">Total Amount</label>
                                    <input class="form-control" type="text" id="total_amount" name="total_amount" placeholder="Enter Total Amount" value="0.00" readonly>
                                    @error('total_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adv_amount" class="form-label">Adv. Amount</label>
                                    <input class="form-control" type="text" id="adv_amount" name="adv_amount" placeholder="Enter Adv. Amount" value="0.00" required>
                                    @error('adv_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cod_amount" class="form-label">COD Amount</label>
                                    <input class="form-control" type="text" id="cod_amount" name="cod_amount" placeholder="Enter COD Amount" value="0.00" required>
                                    @error('cod_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
    </form>
</div>

@endsection 
@section('script')
<script>
    $(document).ready(function() {
        // Initially hide both fields
        $("#adv_amount, #cod_amount").closest('.col-md-6').hide();
    
        // On change event of select box
        $("#order_payment_type").change(function() {
            togglePaymentFields();
        });
    
        // Check on page load (in case of form reloading with old value)
        togglePaymentFields();
    
        function togglePaymentFields() {
            if ($("#order_payment_type").val() === "cod") {
                $("#adv_amount, #cod_amount").closest('.col-md-6').show();
            } else {
                $("#adv_amount, #cod_amount").closest('.col-md-6').hide();
            }
        }
    
        // Function to add a new product row
        window.addProduct = function() {
            let productDetailClone = $(".product-detail:first").clone(); // Clone first product row
            productDetailClone.find("input, textarea").val(""); // Clear input fields
            productDetailClone.find(".remove-btn").show(); // Show remove button
            $("#product-details-container").append(productDetailClone);
            updateTotal(); // Update total when a new product is added
        };
    
        // Function to remove a product row
        window.removeProduct = function(button) {
            $(button).closest(".product-detail").remove();
            updateTotal(); // Update total when a product is removed
        };
    
        // Function to calculate total price (quantity * price)
        function updateTotal() {
            let totalAmount = 0;
    
            // Loop through all product entries
            $(".product-detail").each(function() {
                let quantity = parseFloat($(this).find("input[name='quantity[]']").val()) || 0;
                let price = parseFloat($(this).find("input[name='price[]']").val()) || 0;
                totalAmount += quantity * price;
            });
    
            // Update total_amount and paid_amount fields
            $("#total_amount").val(totalAmount.toFixed(2));
            $("#paid_amount").val(totalAmount.toFixed(2));
    
            // Recalculate COD amount
            updateCODAmount();
        }
    
        // Function to update COD amount based on advance amount
        function updateCODAmount() {
            let totalAmount = parseFloat($("#total_amount").val()) || 0;
            let advAmount = parseFloat($("#adv_amount").val()) || 0;
    
            // Validation: Ensure advance amount is not greater than total amount
            if (advAmount > totalAmount) {
                alert("Advance amount cannot be greater than total amount!");
                $("#adv_amount").val(totalAmount.toFixed(2)); // Reset to total amount
                advAmount = totalAmount;
            }
    
            let codAmount = totalAmount - advAmount;
            $("#cod_amount").val(codAmount.toFixed(2));
        }
    
        // Ensure price and quantity fields accept only numbers
        $(document).on("input", "input[name='price[]'], input[name='quantity[]']", function() {
            this.value = this.value.replace(/[^0-9.]/g, ''); // Allow numbers and decimal only
            updateTotal();
        });
    
        // Trigger COD amount update when advance amount is entered
        $("#adv_amount").on("input", function() {
            updateCODAmount();
        });
    
        // Validation before form submission
        $('form').on('submit', function() {
            let isValid = true;
            $('input[name="product_name[]"], input[name="price[]"], input[name="quantity[]"]').each(function() {
                if ($(this).val().trim() === '') {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return isValid; // Stop form submission if validation fails
        });
    });               
</script>
@endsection
