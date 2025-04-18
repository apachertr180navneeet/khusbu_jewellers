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
use App\Models\EmailOtp;
use App\Models\PhoneOtp;
use App\Models\AppUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use App\Models\SplashScreen;
use Carbon\Carbon;



class ExicutiveController extends Controller
{
    
    public function dashboard(){
        $user = JWTAuth::parseToken()->authenticate();
        $dashboardCount = [
            
            // Today's Prepaid Orders
            "today_prepaid_order" => Order::where('exicutive_id',$user->id)->whereDate("created_at", now()->toDateString())
                ->where("order_payment_type", "prepaid")
                ->count(),
        
            // Today's COD Orders
            "today_cod_order" => Order::where('exicutive_id',$user->id)->whereDate("created_at", now()->toDateString())
                ->where("order_payment_type", "cod")
                ->count(),
        
            // This Month's Prepaid Orders
            "month_prepaid_order" => Order::where('exicutive_id',$user->id)->whereMonth("created_at", now()->month)
                ->whereYear("created_at", now()->year)
                ->where("order_payment_type", "prepaid")
                ->count(),
        
            // This Month's COD Orders
            "month_cod_order" => Order::where('exicutive_id',$user->id)->whereMonth("created_at", now()->month)
                ->whereYear("created_at", now()->year)
                ->where("order_payment_type", "cod")
                ->count(),
            "today_prepaid_sale" => 0,
            "today_cod_sale" => 0,
            "month_prepaid_sale" => 0,
            "month_cod_sale" => 0,
            "target_order" => 0,
            "target_sales" => 0,
            "archived_order" => 0,
            "archived_sales" => 0,
            "archived_order_percentage" => 0,
            "archived_sales_percentage" => 0,
            "refund_order_cod" => 0,
            "refund_order_prepaid" => 0,
            "refund_amount_cod" => 0,
            "refund_amount_prepaid" => 0,
            "gold_order_cod" => 0,
            "gold_order_prepaid" => 0,
            "gold_amount_cod" => 0,
            "gold_amount_prepaid" => 0,
            "silver_order_cod" => 0,
            "silver_order_prepaid" => 0,
            "silver_amount_cod" => 0,
            "silver_amount_prepaid" => 0,
            "manufacturing_order" => 0,
            "manufacturing_amount" => 0,
            "cancel_order_cod" => 0,
            "cancel_order_prepaid" => 0,
            "cancel_amount_cod" => 0,
            "cancel_amount_prepaid" => 0,
            "incentive_order" => 0,
            "incentive_amount" => 0,
        ];

        return response()->json([
            'status' => true,
            'data' => $dashboardCount,
        ],200);

    }

    public function orderList()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $salesExicutiveId = $user->id;

        // Fetch paginated order list with customer details
        $OrderList = Order::where('exicutive_id', $salesExicutiveId)
                        ->with('customer') // Eager load customer details
                        ->paginate(10); // Change '10' to the number of items per page

        return response()->json([
            'status' => true,
            'data' => $OrderList, // Paginated data
        ], 200);
    }

    public function orderdetail(Request $request)
    {
        $id = $request->order_id;

        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        $baseUrl = url('/');
        
        $orderProducts = OrderProduct::where('order_id', $id)->get();
        $orderProductsArray = [];

        foreach ($orderProducts as $product) {
            // Fetch product images for this product
            //$orderProductImages = OrderProductImage::where('order_product_id', $product->id)->get();
            $orderProductImages = DB::table('order_product_image')
            ->where('order_product_id', $product->id)
            ->whereNull('deleted_at')
            ->get();

            // Prepare product_images array
            $productImagesArray = [];
            foreach ($orderProductImages as $image) {
                $productImagesArray[] = [
                    'product_image' => $image->product_image 
                        ? $baseUrl . '/' . $image->product_image 
                        : null,
                    'product_image_id' => $image->id,
                ];
            }

            // Add product details with images
            $orderProductsArray[] = [
                'product_id'    => $product->id,
                'product_date'    => $product->product_date,
                'product_name'    => $product->product_name,
                'product_price'   => $product->product_price,
                'product_qty'     => $product->product_qty,
                'product_weight'  => $product->product_weight,
                'product_type'    => $product->product_type,
                'comment'         => $product->comment,
                'product_images'  => $productImagesArray,
            ];
        }

        $order['orderProducts'] = $orderProductsArray;


        $orderPayments = PaymentDetail::where('order_id', $id)->get();
        $orderPaymentsArray = [];

        foreach ($orderPayments as $payment) {
            // Fetch product images for this product
            $orderPaymentsImages = DB::table('payment_image')
            ->where('order_payment_id', $payment->id)
            ->whereNull('deleted_at')
            ->get();

            // Prepare product_images array
            $paymentImagesArray = [];
            foreach ($orderPaymentsImages as $payimage) {
                $paymentImagesArray[] = [
                    'payment_image' => $payimage->payment_image 
                        ? $baseUrl . '/' . $payimage->payment_image 
                        : null,
                    'payment_image_id' => $payimage->id,
                ];
            }

            // Add product details with images
            $orderPaymentsArray[] = [
                'payment_id'    => $payment->id,
                'date'    => $payment->date,
                'payment_time'    => $payment->payment_time,
                'paid_amount'   => $payment->paid_amount,
                'payment_via'     => $payment->payment_via,
                'utr_id'  => $payment->utr_id,
                'total_amount'    => $payment->total_amount,
                'adv_amount'         => $payment->adv_amount,
                'cod_amount'         => $payment->cod_amount,
                'payment_images'  => $paymentImagesArray,
            ];
        }

        $order['orderPayments'] = $orderPaymentsArray;

        $customerDteail = User::where('id', $order->customer_id)->first();


        $order['customerDetail'] = $customerDteail;

        return response()->json([
            'status' => true,
            'data' => $order,
        ], 200);
    }

    public function orderSearch(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $salesExicutiveId = $user->id;

        // Read filters from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orderPaymentType = $request->input('order_payment_type'); // 'prepaid' or 'cod'
        $orderType = $request->input('order_type'); // 'manufacturing'
        $startAmount = $request->input('start_amount'); // min amount
        $endAmount = $request->input('end_amount');     // max amount

        // Build the query
        $query = Order::where('exicutive_id', $salesExicutiveId)
                    ->with('customer');

        // Apply date range filter
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Apply payment type filter
        if ($orderPaymentType) {
            $query->where('order_payment_type', $orderPaymentType);
        }

        // Apply order type filter
        if ($orderType) {
            $query->where('order_type', $orderType);
        }

        // Apply amount range filter
        if ($startAmount !== null && $endAmount !== null) {
            $query->whereBetween('amount', [$startAmount, $endAmount]);
        }

        // Get paginated result
        $OrderList = $query->paginate(10);

        // If no results found
        if ($OrderList->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No orders found for the given filters.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $OrderList,
        ], 200);
    }



}
