<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    LogisticCompany,
};
use Mail, DB, Hash, Validator, Session, File, Exception, Redirect, Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class LogisticController extends Controller
{
    /**
     * Display the User index page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        //dd($user);

        // Pass the company and comId to the view
        return view('admin.logistic_companies.index', compact('user'));
    }

    /**
     * Fetch all companies and return as JSON.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getall(Request $request)
    {

        $users = LogisticCompany::get();

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
            $User = LogisticCompany::findOrFail($request->userId);
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
            LogisticCompany::where('id', $id)->delete();

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
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10|unique:logistic_companies,phone',
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

        $compId = $user->firm_id;
        // Save the User data
        $dataUser = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];
        LogisticCompany::create($dataUser);
        return response()->json([
            'success' => true,
            'message' => 'Department Users saved successfully!',
        ]);
    }

    // Fetch user data
    public function get($id)
    {
        $user = LogisticCompany::find($id);
        return response()->json($user);
    }

    // Update user data
    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|integer|exists:logistic_companies,id', // Adjust as needed
            'name' => 'required|string',
            'phone'  => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('logistic_companies', 'phone')->ignore($request->id), // Ensure account number is unique, ignoring the current record
            ]
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $user = LogisticCompany::find($request->id);
        if ($user) {
            $dataUser = [
                'full_name' => $request->full_name,
                'phone' => $request->phone
            ];
            $user->update($dataUser);
            return response()->json(['success' => true , 'message' => 'Branch Update Successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Branch not found']);
    }
}
