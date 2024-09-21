<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function index()
    {        
        $membership = Membership::where('user_id', Auth::id())->first();

        return view('membership.index', compact('membership'));
    }
}
