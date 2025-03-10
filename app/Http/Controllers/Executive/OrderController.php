<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    User,
    Order,
    OrderProduct,
    PaymentDetail
};
use Mail, DB, Hash, Validator, Session, File, Exception, Redirect, Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display the User index page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $salesExicutiveId = $user->id;

        $OrderList = Order::where('exicutive_id', $salesExicutiveId)
                    ->with('customer') // Eager load customer details
                    ->get();

        // Pass the company and comId to the view
        return view('executive.order.index', compact('OrderList'));
    }
    public function add()
    {
        $users = User::where('role', 'executive')->get();

        $productfounder = User::where('role', 'product founder')->get();
        //dd($user);

        // Pass the company and comId to the view
        return view('executive.order.add', compact('users','productfounder'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $salesExicutiveId = $user->id;
        $salemanagerId = $user->sale_executive;
        $currentDate = Carbon::now();

        // Validate request data with custom messages
        $validatedData = $request->validate([
            'order_payment_type' => 'required|in:prepaid,cod',
            'delivery_type' => 'required|in:simple,premium',
            'order_type' => 'required|in:normal,manufacturing',
            'product_image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'whatsapp' => 'nullable|digits:10',
            'address' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'feedback' => 'nullable|string|max:255',
            'customer_comment' => 'nullable|string|max:255',
            'product_founder' => 'required|integer',
            'payment_screen_shot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'paid_amount' => 'required|numeric|min:0',
            'payment_via' => 'nullable|in:upi,cheque,cash',
            'payment_date' => 'nullable|date',
            'utr_id' => 'nullable|string|max:100',
            'total_amount' => 'required|numeric|min:0',
            'adv_amount' => 'nullable|numeric|min:0',
            'cod_amount' => 'nullable|numeric|min:0',
        ], [
            'order_payment_type.required' => 'Please select an order payment type.',
            'order_payment_type.in' => 'Invalid order payment type selected.',
            
            'delivery_type.required' => 'Delivery type is required.',
            'delivery_type.in' => 'Invalid delivery type selected.',
            
            'order_type.required' => 'Order type is required.',
            'order_type.in' => 'Invalid order type selected.',
        
            'product_image.*.required' => 'Product image is required.',
            'product_image.*.image' => 'Only image files (JPEG, PNG, JPG, GIF) are allowed.',
            'product_image.*.mimes' => 'Invalid file format. Allowed formats: JPEG, PNG, JPG, GIF.',
            'product_image.*.max' => 'Product image size must be less than 2MB.',
        
            'product_name.*.required' => 'Product name is required.',
            'product_name.*.string' => 'Product name must be a valid string.',
            'product_name.*.max' => 'Product name cannot exceed 255 characters.',
        
            'price.*.required' => 'Price is required.',
            'price.*.numeric' => 'Price must be a valid number.',
            'price.*.min' => 'Price cannot be negative.',
        
            'quantity.*.required' => 'Quantity is required.',
            'quantity.*.integer' => 'Quantity must be a whole number.',
            'quantity.*.min' => 'Quantity must be at least 1.',
        
            'customer_name.required' => 'Customer name is required.',
            'customer_name.string' => 'Customer name must be a valid string.',
            'customer_name.max' => 'Customer name cannot exceed 255 characters.',
        
            'phone.required' => 'Phone number is required.',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
        
            'whatsapp.digits' => 'WhatsApp number must be exactly 10 digits.',
        
            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a valid string.',
            'address.max' => 'Address cannot exceed 255 characters.',
        
            'pincode.required' => 'Pincode is required.',
            'pincode.digits' => 'Pincode must be exactly 6 digits.',
        
            'city.required' => 'City is required.',
            'city.string' => 'City must be a valid string.',
            'city.max' => 'City cannot exceed 100 characters.',
        
            'state.required' => 'State is required.',
            'state.string' => 'State must be a valid string.',
            'state.max' => 'State cannot exceed 100 characters.',
        
            'feedback.string' => 'Feedback must be a valid string.',
            'feedback.max' => 'Feedback cannot exceed 255 characters.',
        
            'customer_comment.string' => 'Customer comment must be a valid string.',
            'customer_comment.max' => 'Customer comment cannot exceed 255 characters.',
        
            'product_founder.required' => 'Product founder ID is required.',
            'product_founder.integer' => 'Product founder ID must be a valid integer.',

            'payment_screen_shot.*.required' => 'Product image is required.',
            'payment_screen_shot.*.image' => 'Only image files (JPEG, PNG, JPG, GIF) are allowed.',
            'payment_screen_shot.*.mimes' => 'Invalid file format. Allowed formats: JPEG, PNG, JPG, GIF.',
            'payment_screen_shot.*.max' => 'Product image size must be less than 2MB.',
        
            'paid_amount.required' => 'Paid amount is required.',
            'paid_amount.numeric' => 'Paid amount must be a valid number.',
            'paid_amount.min' => 'Paid amount cannot be negative.',
        
            'payment_via.in' => 'Invalid payment method selected.',
        
            'payment_date.date' => 'Invalid payment date format.',
        
            'utr_id.string' => 'UTR ID must be a valid string.',
            'utr_id.max' => 'UTR ID cannot exceed 100 characters.',
        
            'total_amount.required' => 'Total amount is required.',
            'total_amount.numeric' => 'Total amount must be a valid number.',
            'total_amount.min' => 'Total amount cannot be negative.',
        
            'adv_amount.numeric' => 'Advance amount must be a valid number.',
            'adv_amount.min' => 'Advance amount cannot be negative.',
        
            'cod_amount.numeric' => 'COD amount must be a valid number.',
            'cod_amount.min' => 'COD amount cannot be negative.',
        ]);
        

        try {
            if ($request->hasFile("payment_screen_shot")) {
                // payment screenshot
                $paymentScreenshot = $request->file('payment_screen_shot');
                $paymentScreenshotName = time().'_payment_screenshot.'.$paymentScreenshot->getClientOriginalExtension();
                $paymentScreenshot->move(public_path('uploads/product'), $paymentScreenshotName);
                $paymentScreenshotPath = 'uploads/product/'.$paymentScreenshotName;
            }

            $user = User::where('phone', $request->phone)->first();

            if ($user) {
                $userId = $user->id;
            }else{
                $customerUser = User::create([
                    'full_name' => $request->customer_name, // Default name, you can modify this
                    'phone' => $request->phone,
                    'whatsapp_number' => $request->whatsapp,
                    'role' => 'customer',
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zipcode' => $request->pincode,
                    'sale_executive' => $salesExicutiveId,
                ]);
                $userId = $customerUser->id;
            }
            
            $customerOrder = Order::create([
                'order_payment_type' => $request->order_payment_type, // Default name, you can modify this
                'delivery_type' => $request->delivery_type,
                'order_type ' => $request->order_type,
                'product_founder' => $request->product_founder,
                'customer_id' => $userId,
                'exicutive_id' => $salesExicutiveId,
                'sale_manager_id' => $salemanagerId,
                'date' => $currentDate,
                'amount' => $request->total_amount,
                'feedback' => $request->feedback,
                'comment' => $request->customer_comment,
            ]);
            $orderId = $customerOrder->id;

            foreach ($request->product_name as $index => $productName) {
                $productImagePath = null;
                if ($request->hasFile("product_image.$index")) {
                    $productImage = $request->file("product_image.$index");
                    $productImageName = time().'_product_'.$index.'.'.$productImage->getClientOriginalExtension();
                    $productImage->move(public_path('uploads/product'), $productImageName);
                    $productImagePath = 'uploads/product/'.$productImageName;
                }
                OrderProduct::create([
                    'order_id' => $orderId,
                    'product_image' => $productImagePath,
                    'product_name' => $productName,
                    'product_price' => $request->price[$index],
                    'product_qty' => $request->quantity[$index],
                    'comment' => $request->comment[$index] ?? null
                ]);
            }
            if($request->order_payment_type == "cod"){
                $cod = $request->cod_amount;
            }else{
                $cod = "0.00";
            }
            PaymentDetail::create([
                'order_id' => $customerOrder->id,
                'date' => $request->payment_date,
                'paid_amount' => $request->paid_amount,
                'payment_via' => $request->payment_via,
                'utr_id' => $request->utr_id,
                'total_amount' => $request->total_amount,
                'adv_amount' => $request->adv_amount,
                'cod_amount' => $cod,
                'payment_screen_shot' => $paymentScreenshotPath,
            ]);

            return redirect()->route('executive.order.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
    public function delete($id)
    {
        try {
            $order = Order::find($id);

            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Order not found'], 404);
            }

            // Delete related order products
            $order->orderProducts()->forceDelete();

            // Delete related payment details
            $order->paymentDetail()->forceDelete();

            // Force delete the order
            $order->forceDelete();

            return response()->json(['success' => true, 'message' => 'Order deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function view($id)
    {
        try {
            $order = Order::with(['orderProducts', 'paymentDetail','customer'])->find($id);

            $users = User::where('role', 'executive')->get();

            $productfounder = User::where('role', 'product founder')->get();
            //dd($user);

            // Pass the company and comId to the view
            return view('executive.order.view', compact('users','productfounder','order'));


            
        } catch (\Exception $e) {
            dd($e);
        }
    }

}
