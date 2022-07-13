<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\LocationRepo;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helpers\Qs;


class SchoolController extends Controller
{
    protected $loc;

    public function __construct(LocationRepo $loc){
        $this->middleware('super_admin', ['only' => ['reset_pass','destroy'] ]);
        $this->loc = $loc;
    }

    public function index(){
        $data['schools'] = School::all();
        $data['states'] = $this->loc->getStates();
        return view('pages.super_admin.schools',$data);
    }

    public function store(Request $request){
        if(!Auth::user()->user_type == 'super_admin' || !Auth::user()->user_type == 'admin'){
            if(Auth::user()->school_id){
                $request->validate([
                    'name' => 'required|string',
                    'address' => 'required|string',
                    'email' => 'required|email',
                    'category' => 'required|string',
                ]);
                $school= School::create([
                    'name' => $request->name,
                    'motto' => $request->motto,
                    'address' => $request->address,
                    'state_license_num' => $request->state_license_num,
                    'tax_id' => $request->tax_id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'sectiion' => $request->sectiion,
                    'category' => $request->category,
                ]);
                User::update([
                    'school_id' => $school->id
                ]);
                return Qs::jsonStoreOk();
            }
            else{
                return Qs::displayError(['error' => 'You have already registered a school']);
            }
        }else{
            $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'email' => 'required|email',
                'category' => 'required|string',
            ]);
            $school= School::create([
                'name' => $request->name,
                'motto' => $request->motto,
                'address' => $request->address,
                'state_license_num' => $request->state_license_num,
                'tax_id' => $request->tax_id,
                'phone' => $request->phone,
                'email' => $request->email,
                'sectiion' => $request->sectiion,
                'category' => $request->category,
            ]);
        }
    }
}
