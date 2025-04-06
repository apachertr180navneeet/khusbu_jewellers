<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
        User,
        Order,
        OrderProductImage,
        OrderProduct,
        PaymentDetail,
        OrderPaymentImage
};
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail,Hash,File,DB,Helper,Auth;
use App\Mail\UserRegisterVerifyMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;



class OrderController extends Controller
{
    
    public function orderType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exicutive_id' => 'required|exists:users,id',
            'order_payment_type' => 'required|in:prepaid,cod',
            'order_type' => 'required|in:normal,manufacturing',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::findOrFail($request->exicutive_id);

            $order = Order::create([
                'order_payment_type' => $request->order_payment_type,
                'order_type' => $request->order_type,
                'exicutive_id' => $user->id,
                'sale_manager_id' => $user->sale_executive,
                'date' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Order Type Created successfully.',
                'order_id' => $order->id,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage(),
            ], 500);
        }
    }
    public function productDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'products.items' => 'required|array',
            'products.items.*.product_name' => 'required|string',
            'products.items.*.product_date' => 'required',
            'products.items.*.product_price' => 'required|numeric',
            'products.items.*.product_qty' => 'required|integer|min:1',
            'products.items.*.product_type' => 'required|string|in:simple,premium',
            'products.items.*.comment' => 'nullable|string',
            'products.items.*.product_weight' => 'required|numeric',
            'products.items.*.product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $orderId = $request->input('order_id');
            $products = $request->input('products.items');
            $totalAmount = 0;

            foreach ($products as $index => $product) {
                // Create Order Product
                $orderProduct = OrderProduct::create([
                    'order_id' => $orderId,
                    'product_name' => $product['product_name'],
                    'product_date' => $product['product_date'],
                    'product_price' => $product['product_price'],
                    'product_qty' => $product['product_qty'],
                    'product_weight' => $product['product_weight'],
                    'product_weight' => $product['product_weight'],
                    'comment' => $product['comment'] ?? null,
                ]);

                $orderProductId = $orderProduct->id;
                $totalAmount += $product['product_price'] * $product['product_qty']; // Calculate total amount

                // Handle Single Image Upload
                if ($request->hasFile("products.items.{$index}.product_image")) {
                    $image = $request->file("products.items.{$index}.product_image");
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Unique filename
                    $imagePath = 'uploads/product_image/' . $imageName; // Path for saving in DB

                    $image->move(public_path('uploads/product_image'), $imageName); // Move to public directory

                    // Save image path in database
                    OrderProductImage::create([
                        'order_id' => $orderId,
                        'order_product_id' => $orderProductId,
                        'product_image' => $imagePath, // Store single image
                    ]);
                }
            }

            // Update order amount
            Order::where('id', $orderId)->update(['amount' => \DB::raw("amount + $totalAmount")]);

            return response()->json([
                'status' => true,
                'message' => 'Order Products Created Successfully.',
                'order_id' => $orderId,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage(),
            ], 500);
        }
    }
    public function getCustomer(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Retrieve customer from users table
            $customer = User::where('role', 'customer')
                            ->where('phone', $request->phone)
                            ->first(); // Get single record

            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Customer not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'customer' => $customer->toArray(), // Convert to array
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage(),
            ], 500);
        }
    }
    public function getProductFounder(Request $request){
        try {        
            $productfounder = User::where('role', 'product founder')->get();

            if (!$productfounder) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product Fouder not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'product_fiunder' => $productfounder->toArray(), // Convert to array
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage(),
            ], 500);
        }
    }
    public function customerDetail(Request $request){
        // Validate request
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id', // Ensure order_id exists in orders table
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:10', // Ensure phone is unique in users table
            'whatsapp_number' => 'required|numeric|digits:10', // Ensure WhatsApp number is unique
            'address' => 'required|string|max:500',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'feedback' => 'nullable|string|max:1000',
            'product_founder' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {        
            $user = Auth::user();
            $salesExicutiveId = $user->id;

            $user = User::where('phone', $request->phone)->first();

            if ($user) {
                $userId = $user->id;
            }else{
                $customerUser = User::create([
                    'full_name' => $request->customer_name, // Default name, you can modify this
                    'phone' => $request->phone,
                    'whatsapp_number' => $request->whatsapp_number,
                    'role' => 'customer',
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zipcode' => $request->pincode,
                    'sale_executive' => $salesExicutiveId,
                ]);
                $userId = $customerUser->id;
            }

            // Update the order with customer details
            Order::where('id', $request->order_id)->update([
                'customer_id' => $userId,
                'feedback' => $request->feedback,
                'product_founder' => $request->product_founder,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Order updated with customer Details.',
                'order_id' => $request->order_id,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage(),
            ], 500);
        }
    }
    public function paymentDetail(Request $request){
        // Validate request
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'payments' => 'required|array',
            'payments.*.payment_date' => 'required|string',
            'payments.*.payment_time' => 'required',
            'payments.*.payment_via' => 'required|string',
            'payments.*.utr_id' => 'required|string',
            'payments.*.total_amount' => 'required|numeric',
            'payments.*.adv_amount' => 'required|numeric',
            'payments.*.cod_amount' => 'required|numeric',
            'payments.*.payment_image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048' // Fixed this rule
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        try {   
            $orderId = $request->input('order_id');     
            $products = $request->input('payments');
            foreach ($products as $index => $product) {
                // Create Order Payment
                $orderPayment = PaymentDetail::create([
                    'order_id' => $orderId,
                    'date' => $product['payment_date'],
                    'payment_time' => $product['payment_time'],
                    'paid_amount' => $product['total_amount'],
                    'payment_via' => $product['payment_via'],
                    'utr_id' => $product['utr_id'],
                    'total_amount' => $product['total_amount'],
                    'adv_amount' => $product['adv_amount'],
                    'cod_amount' => $product['cod_amount'],
                ]);
    
                $orderPaymentId = $orderPayment->id;
    
                // Store single payment image
                if ($request->hasFile("payments.{$index}.payment_image")) {
                    $image = $request->file("payments.{$index}.payment_image");
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = 'uploads/product_image/' . $imageName;
    
                    $image->move(public_path('uploads/product_image'), $imageName);
    
                    // Save image path in the database
                    OrderProductImage::create([
                        'order_id' => $orderId,
                        'order_payment_id' => $orderPaymentId,
                        'payment_image' => $imagePath,
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Order updated with Payment Details.',
                'order_id' => $request->order_id,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage(),
            ], 500);
        }
    }
}
