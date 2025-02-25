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

class OrderController extends Controller
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
        return view('executive.order.index', compact('users'));
    }


    public function add()
    {
        $users = User::where('role', 'executive')->get();
        //dd($user);

        // Pass the company and comId to the view
        return view('executive.order.add', compact('users'));
    }
}
