<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use App\Repositories\LocationRepo;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemSubject;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $user, $loc;
    public function __construct(UserRepo $user, LocationRepo $loc)
    {
        $this->user = $user;
        $this->loc = $loc;
    }


    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }

    public function dashboard()
    {
        $d=[];
        if(Qs::userIsTeamSAT()){
            $d['users'] = $this->user->getAll();
        }

        return view('pages.support_team.dashboard', $d);
    }

    public function link(){
        $data['user_types'] = $this->user->getAllTypes();
        if(Qs::userIsTeamSA()){
            $data['schools'] = School::all();
        }
        else $data['schools'] = School::where('id',Auth::user()->school_id)->first();
        // dd(Auth::user());
        if (is_null($data['schools'])){
            return redirect()->route('schools.index');
        }
        return view('pages.support_team.create_link',$data);
    }

    public function registerByUrl($type,$school = null){
        $data['school']=School::find($school);
        $data['user_type'] = $this->user->getUserType($type);
        $data['states'] = $this->loc->getStates();
        $data['users'] = $this->user->getPTAUsers();
        $data['nationals'] = $this->loc->getAllNationals();
        $data['blood_groups'] = $this->user->getBloodGroups();
        $data['subjects'] = $data['user_type']['title'] == 'teacher' ? SystemSubject::all() : null;
        return view('pages.other.register_by_url',$data);
    }
}
