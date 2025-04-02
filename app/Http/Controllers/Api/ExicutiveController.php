<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
        User,
        Order
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
        $order = Order::with([
            'orderProducts.orderProductImages', // Include product images
            'paymentDetail.orderPaymentImages', // Include payment images
            'customer'
        ])->find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        // Base URL for images
        $baseUrl = asset('storage/'); 

        // // Update orderProducts with images in an array
        // $order->orderProducts->each(function ($product) use ($baseUrl) {
        //     $product->product_images = $product->orderProductImages->map(function ($image) use ($baseUrl) {
        //         return $baseUrl . '/' . ltrim($image->image_path, '/');
        //     });
        //     unset($product->orderProductImages); // Remove unnecessary relation from response
        // });

        // // Ensure paymentDetail is an object before processing images
        // if ($order->paymentDetail) {
        //     $order->paymentDetail->payment_images = $order->paymentDetail->orderPaymentImages->map(function ($image) use ($baseUrl) {
        //         return $baseUrl . '/' . ltrim($image->image_path, '/');
        //     });
        //     unset($order->paymentDetail->orderPaymentImages); // Remove unnecessary relation from response
        // }

        return response()->json([
            'status' => true,
            'data' => $order,
        ], 200);
    }
}
