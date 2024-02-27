<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $user = auth()->user();
         // Check if the user is a super admin
    if ($user->hasRole('Super-Admin')) {
        $totalContacts = Contact::count();
        $totalContactsActive = Contact::where('status', 1)->count();
        $totalContactsInActive = Contact::where('status', 0)->count();
    } else {
        $totalContacts = Contact::where('company_id', $user->company_id)->count();
        $totalContactsActive = Contact::where('company_id', $user->company_id)->where('status', 1)->count();
        $totalContactsInActive = Contact::where('company_id', $user->company_id)->where('status', 0)->count();
        
    }

         
        return view('admin.dashboard',compact('totalContactsActive','totalContacts','totalContactsInActive'));
    }

}
