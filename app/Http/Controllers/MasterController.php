<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Symptoms_Type;
use App\Diagnosis_Type;
use App\Examination_Type;
use App\Illness_Arrival_Type;
use App\Investigation_Type;
use App\Monitoring_Type;
use App\Round_Shift;
use App\Treatment_Type;
use Illuminate\Support\Facades\DB;




class MasterController extends Controller
{
    //
    public function index(){
       /* $title='Wards';
        $docs=User::where(function ($query) {
            $query->where('user_type', '=', 'doctor')
                  ->orWhere('user_type', '=', 'admin');
        })->get();
        $data=DB::table('wards')->get();
        return view('ward.index',compact("title","docs","data"));*/
    }

    public function symptomsType(Request $request) {
        if(!empty($request->name)) {
            $data = new Symptoms_Type();
            $data->name = $request->name;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Symptoms Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Symptoms Type';
            $data=DB::table('ms_symptoms_type')->get();
            return view('master.symptoms_type',compact("title","data"));
        }
    }

    public function illnessArrivalType(Request $request) {
        if(!empty($request->name)) {
            $data = new Illness_Arrival_Type();
            $data->name = $request->name;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Condition Arrival Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='illness Arrival Type';
            $data=DB::table('ms_illness_arrival_type')->get();
            return view('master.illness_arrival_type',compact("title","data"));
        }
        
    }

    public function roundShift(Request $request){
        if(!empty($request->name)) {
            $data = new Round_Shift();
            $data->name = $request->name;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Round Shift Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Round Shift';
            $data=DB::table('ms_round_shift')->get();
            return view('master.round_shift',compact("title","data"));
        }        
    }

    public function monitoringType(Request $request){
        if(!empty($request->name)) {
            $data = new Monitoring_Type();
            $data->name = $request->name;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Monitoring Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Monitoring Type';
            $data=DB::table('ms_monitoring_type')->get();
            return view('master.monitoring_type',compact("title","data"));
        }
    }

    public function treatmentType(Request $request){
        if(!empty($request->name)) {
            $data = new Treatment_Type();
            $data->name = $request->name;
            $data->type = $request->type;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Treatment Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Treatment Type';
            $data=DB::table('ms_treatment_type')->get();
            return view('master.treatment_type',compact("title","data"));
        }
    }

    public function investigationType(Request $request) {
        if(!empty($request->name)) {
            $data = new Investigation_Type();
            $data->name = $request->name;
            $data->type = $request->type;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Investigation Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Investigation Type';
            $data=DB::table('ms_investigation_type')->get();
            return view('master.investigation_type',compact("title","data"));
        }
        
    }

    public function ExaminationType(Request $request) {
        echo $url_segment = \Request::segment(5);
        if(!empty($request->name)) {
            $url_segment = \Request::segment(3);
            $data = new Examination_Type();
            $data->name = $request->name;            
            $data->ex_type = $request->type;
            $data->parent_id = $request->parent_id;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Examination Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Examination Type';
            $data=DB::table('ms_examination_type')->get();
            return view('master.examination_type',compact("title","data"));
        }        
    }
    
    public function diagnosisType(Request $request){
        if(!empty($request->name)) {
            $data = new Diagnosis_Type();
            $data->parent_id = !empty($request->parent_id)?$request->parent_id:0;
            $data->name = $request->name;
            try {
                $data->save();
                return redirect()->back()->with('success',"New Diagnosis Type Added Success.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail',"Error Occured!");
            }
        } else {
            $title='Diagnosis Type';
            $parent_data = DB::table('ms_diagnosis_type')->where("parent_id","0")->get();
            $data=DB::table('ms_diagnosis_type')->get();
            return view('master.diagnosis_type',compact("title","data","parent_data"));
        }
    }
    
    

}

