<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    User,
};
use Mail, DB, Hash, Validator, Session, File, Exception, Redirect, Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display the User index page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::where('role', 'executive')->get();
        //dd($user);

        // Pass the company and comId to the view
        return view('executive.customer.index', compact('users'));
    }

    /**
     * Fetch all companies and return as JSON.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getall(Request $request)
    {
        $user = Auth::user();

        $compId = $user->id;

        $users = User::where('sale_executive', $compId)->where('role', 'customer')->get();

        return response()->json(['data' => $users]);
    }

    /**
     * Update the status of a User.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        try {
            $User = User::findOrFail($request->userId);
            $User->status = $request->status;
            $User->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a User by its ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Branch deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'full_name' => 'required|string',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'whatsapp_number' => 'required|numeric|digits:10|unique:users,whatsapp_number',
            'address' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];        
        
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        

        $user = Auth::user();

        $compId = $user->id;
        // Save the User data
        $dataUser = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'whatsapp_number' => $request->whatsapp_number,
            'address' => $request->address,
            'zipcode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,
            'role' => 'customer',
            'sale_executive' => $compId,
        ];
        User::create($dataUser);
        return response()->json([
            'success' => true,
            'message' => 'Customer saved successfully!',
        ]);
    }

    // Fetch user data
    public function get($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    // Update user data
    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|integer|exists:users,id', // Adjust as needed
            'full_name' => 'required|string',
            'phone'  => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('users', 'phone')->ignore($request->id), // Ensure account number is unique, ignoring the current record
            ],
            'whatsapp_number'  => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('users', 'whatsapp_number')->ignore($request->id), // Ensure account number is unique, ignoring the current record
            ],
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $authuser = Auth::user();

        $compId = $authuser->id;
        $user = User::find($request->id);
        if ($user) {
            $dataUser = [
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'whatsapp_number' => $request->whatsapp_number,
                'address' => $request->address,
                'zipcode' => $request->zipcode,
                'city' => $request->city,
                'state' => $request->state,
                'sale_executive' => $compId,
            ];
            $user->update($dataUser);
            return response()->json(['success' => true , 'message' => 'Branch Update Successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Branch not found']);
    }
}
