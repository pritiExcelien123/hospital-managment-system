<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Clinic;
use App\Http\Controllers\Redirect;
use App\inpatient;
use App\Medicine;
use App\Transaction;
use App\Patients;
use App\Patients_Record;
use App\Prescription;
use App\Prescription_Medicine;
use App\Symptoms;
use App\Arrival;
use App\Investigation;
use App\Treatment;
use App\Monitoring;
use App\Ward;
use App\InvestigationSheet;
use App\NurseOrderSheet;
use App\MonitoringSheet;
use App\TreatmentSheet;
use App\Round_Shift;
use App\Examination_Type;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;

class PatientController extends Controller
{
    protected $wardArray;

    public function __construct()
    {
        $this->middleware('auth');
        $this->wardList = ['' => 'Select Ward No'] + Ward::pluck('id', 'ward_no')->all();
    }

    public function inPatientReport()
    {

        return view('patient.inpatient.inpatients', ["date"=>null,"title" => "Inpatient Details", "data_count" => 0]);

    }

    public function inPatientReportData(Request $request)
    {
        $data=DB::table('inpatients')->whereDate('created_at', '=', $request->date)->get();
        if($data->count()>0){
            return view('patient.inpatient.inpatients', ["title" => "Inpatient Details","date"=>$request->date,"data_count"=>$data->count(), "data" => $data]);

        }else{
            return redirect(route("inPatientReport"))->with('fail',"No Results Found");
        }
      
    }

    public function index()
    {
        $user = Auth::user();
        return view('patient.register_patient', ['title' => $user->name]);
    }

    public function patientHistory($id)
    {
        $prescs = Prescription::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        $title = "Patient History ($id)";

        $patient = Patients::withTrashed()->find($id);
        $hospital_visits = 1;
        $status = "Active";
        $last_seen = explode(" ", $patient->updated_at)[0];
        if ($patient->trashed()) {
            $status = "Inactive";
        }
        $hospital_visits += Prescription::where('patient_id', $patient->id)->count();

        return view('patient.history.index', compact('prescs', 'patient', 'title', 'hospital_visits', 'status', 'last_seen'));
    }

    public function patientProfileIntro(Request $request)
    {
        if ($request->has('pid')) {
            return redirect()->route('patientProfile', $request->pid);
        } else {
            return view('patient.profile.intro', ['title' => "Patient Profile"]);
        }
    }

    public function patientDelete($id, $action)
    {
        if ($action == "delete") {
            Patients::find($id)->delete();
        }if ($action == 'restore') {
            Patients::withTrashed()->find($id)->restore();
        }
        return redirect()->route('patientProfile', $id);
    }

    public function patientProfile($id)
    {
        $patient = Patients::withTrashed()->find($id);
        $hospital_visits = 1;
        $status = "Active";
        $last_seen = explode(" ", $patient->updated_at)[0];
        if ($patient->trashed()) {
            $status = "Inactive";
        }
        $hospital_visits += Prescription::where('patient_id', $patient->id)->count();

        return view('patient.profile.profile',
            [
                'title' => $patient->name,
                'patient' => $patient,
                'status' => $status,
                'last_seen' => $last_seen,
                'hospital_visits' => $hospital_visits,

            ]);
    }

    public function searchPatient(Request $request)
    {
        return view('patient.search_patient_view', ['title' => "Search Patient", "old_keyword" => null, "search_result" => ""]);
    }

    public function patientData(Request $request)
    {
        if ($request->cat == "name") {
            $result = Patients::withTrashed()->where('name', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        if ($request->cat == "nic") {
            $result = Patients::withTrashed()->where('nic', 'LIKE', '%' . $request->keyword . '%')->get();

        }
        if ($request->cat == "telephone") {
            $result = Patients::withTrashed()->where('telephone', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return view('patient.search_patient_view', ["title" => "Search Results", "old_keyword" => $request->keyword, "search_result" => $result]);
    }

    public function registerPatient(Request $request)
    {
        try {
            $patient = new Patients;
            $today_regs = (int) Patients::whereDate('created_at', date("Y-m-d"))->count();

            $number = $today_regs + 1;
            $year = date('Y') % 100;
            $month = date('m');
            $day = date('d');

            $reg_num = $year . $month . $day . $number;

            $date = date_create($request->reg_pbd);

            $patient->id = $reg_num;
            $patient->name = $request->reg_pname;
            $patient->father_name = $request->father_name;
            $patient->mother_name = $request->mother_name;
            $patient->age = $request->patient_age;
            $patient->refered_from = $request->refered_from;
            $patient->mode_of_transport = $request->mode_of_transport;
            $patient->immunizaition_status = $request->immunizaition_status;
            $patient->occupation = $request->occupation;
            $patient->birth_place = $request->birth_place;
            $patient->nationality = $request->nationality;
            $patient->religion = $request->religion;
            $patient->income  = $request->income;

            $patient->guardian = $request->guardian;
            $patient->guardian_address = $request->guardian_address;
            $patient->address = $request->reg_paddress;
            $patient->occupation = $request->reg_poccupation;
            $patient->sex = $request->reg_psex;
            $patient->dob = date_format($date, "Y-m-d");
            $patient->telephone = $request->reg_ptel;
            // $patient->nic = $request->reg_pnic;
            // $patient->image = $reg_num . ".png";
// print_r($patient);die;
            $patient->save();
            // echo $patient->id;die;
            if($patient->id){
                $patientRecord = new Patients_Record;
                $patientRecord->patient_id = $patient->id;
                $patientRecord->save();

                $nurseRecord = new NurseOrderSheet;
                $nurseRecord->patient_id = $patient->id;
                $nurseRecord->save();

                $monitoringRecord = new MonitoringSheet;
                $monitoringRecord->patient_id = $patient->id;
                $monitoringRecord->save();

                $investigationRecord = new InvestigationSheet;
                $investigationRecord->patient_id = $patient->id;
                $investigationRecord->save();

                $treatmentRecord = new TreatmentSheet;
                $treatmentRecord->patient_id = $patient->id;
                $treatmentRecord->save();
            }

            session()->flash('regpsuccess', 'Patient ' . $request->reg_pname . ' Registered Successfully !');
            session()->flash('pid', "$reg_num");

            $image = $request->regp_photo; // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            \Storage::disk('local')->put("public/" . $reg_num . ".png", base64_decode($image));

            // Log Activity
            activity()->performedOn($patient)->withProperties(['Patient ID' => $reg_num])->log('Patient Registration Success');

            return redirect()->back();
        } catch (\Exception $e) {
            // do task when error
            $error = $e->getCode();
            // log activity
            activity()->performedOn($patient)->withProperties(['Error Code' => $error, 'Error Message' => $e->getMessage()])->log('Patient Registration Failed');

            if ($error == '23000') {
                session()->flash('regpfail', 'Patient ' . $request->reg_pname . ' Is Already Registered..');
                return redirect()->back();
            }
        }
    }

    public function validateAppNum(Request $request)
    {
        $num = $request->number;
        $numlength = strlen((string) $num);
        if ($numlength < 5) { // this means the appointment number has entered
            $rec = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->select('patients.name as name', 'appointments.number as num', 'appointments.patient_id as pnum')
            ->whereRaw(DB::Raw("Date(appointments.created_at)=CURDATE() and appointments.number='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNum" => $rec->pnum,
                    "finger"=>Auth::user()->fingerprint ,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        } else { //this means the patient registration number has entered
            $rec = DB::table('appointments')->join('patients', 'appointments.patient_id', '=', 'patients.id')->select('patients.name as name', 'appointments.number as num', 'appointments.patient_id as pnum')->whereRaw(DB::Raw("Date(appointments.created_at)=CURDATE() and completed='NO' and appointments.patient_id='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNum" => $rec->pnum,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        }
    }

    public function checkPatientView()
    {
        $user = Auth::user();
        return view('patient.check_patient_intro', ['title' => "Check Patient"]);
    }

    public function checkPatient(Request $request)
    {
        //to get the latest appointment number for the day
        $appointment = Appointment::where('number', $request->appNum)->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->where('patient_id', $request->pid)->orderBy('created_at', 'desc')->first();

        if ($appointment->completed == "YES") {
            return redirect()->route('check_patient_view')->with('fail', "This Appointment Has Already Been Channeled.");
        }

        $patient = Patients::find($appointment->patient_id);

        $user = Auth::user();

        //need to get the latest issued prescription to fetch the patient bp,sugar,cholestrol to be displayed in the checkpatient
        $prescriptions = Prescription::where('patient_id', $appointment->patient_id)->orderBy('created_at', 'DESC')->get();

        //creates thress objects to store these data
        //sometimes thses may get blank so use the flag to resolve this issue if flag is false these will not be displayed in the view
        $pBloodPressure = new stdClass;
        $pBloodPressure->flag = false;

        $pBloodSugar = new stdClass;
        $pBloodSugar->flag = false;

        $pCholestrol = new stdClass;
        $pCholestrol->flag = false;

        foreach ($prescriptions as $prescription) {

            if (!$pBloodPressure->flag == true) {
                $bp = json_decode($prescription->bp)->value;
                if ($bp != null) {
                    $pBloodPressure->sys = explode("/", $bp)[0];
                    $pBloodPressure->dia = explode("/", $bp)[1];
                    $pBloodPressure->date = json_decode($prescription->bp)->updated;
                    $pBloodPressure->flag = true;

                }
            }

            if (!$pCholestrol->flag == true) {
                $cholestrol = json_decode($prescription->cholestrol)->value;
                if ($cholestrol != null) {
                    $pCholestrol->value = $cholestrol;
                    $pCholestrol->date = json_decode($prescription->cholestrol)->updated;
                    $pCholestrol->flag = true;
                }
            }

            if (!$pBloodSugar->flag == true) {
                $sugar = json_decode($prescription->blood_sugar)->value;
                if ($sugar != null) {
                    $pBloodSugar->value = $sugar;
                    $pBloodSugar->date = json_decode($prescription->blood_sugar)->updated;
                    $pBloodSugar->flag = true;
                }
            }

        }

        $updated = "No Previous Visits";
        if ($prescriptions->count() > 0) {
            $updated = explode(" ", $prescriptions[0]->created_at)[0];
        }
        // $updated = explode(" ", $prescriptions[0]->created_at)[0];

        $pHistory = new stdClass;

        $assinged_clinics = Patients::find($request->pid)->clinics;

        $clinics = Clinic::all();

        return view('patient.check_patient_view', [
            'title' => "Check Patient",
            'appNum' => $request->appNum,
            'appID' => $appointment->id,
            'pName' => $appointment->patient->name,
            'pSex' => $appointment->patient->sex,
            'pAge' => $patient->getAge(),
            'pCholestrol' => $pCholestrol,
            'pBloodSugar' => $pBloodSugar,
            'pBloodPressure' => $pBloodPressure,
            // 'pHistory' => $pHistory,
            'inpatient' => $appointment->admit,
            'pid' => $appointment->patient->id,
            'medicines' => Medicine::all(),
            'updated' => $updated,
            'assinged_clinics' => $assinged_clinics,
            'clinics' => $clinics,
        ]);
    }

    public function addToClinic(Request $request)
    {
        foreach ($request->clinic as $clinic) {
            $c = Clinic::find($clinic);
            $c->addPatientToClinic($request->pid);
        }
        $assinged_clinics = Patients::find($request->pid)->clinics;
        $clinics = Clinic::all();
        $pid = $request->pid;
        $html_list = view('patient.patinet_clinic', compact('pid', 'assinged_clinics', 'clinics'))->render();
        $html_already = view('patient.patient_clinic_registered', compact('assinged_clinics', 'clinics'))->render();
        return response()->json([
            'code' => 200,
            'html_already' => $html_already,
            'html_list' => $html_list,
        ]);

    }

    public function markInPatient(Request $request)
    {
        $pid = $request->pid;
        $app_num = $request->app_num;
        $user = Auth::user();
        $appointment = Appointment::where('number', $app_num)->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->where('patient_id', $pid)->first();
        if ($appointment->admit == "NO") {
            $appointment->admit = "YES";
            $appointment->doctor_id = $user->id;
            $appointment->save();
            return response()->json([
                'success' => true,
                'appid' => $appointment->id,
                'pid' => $pid,
                'app_num' => $app_num,
            ]);
        }
    }

    public function checkPatientSave(Request $request)
    {

        $user = Auth::user();
        $presc = new Prescription;
        $presc->doctor_id = $user->id;
        $presc->patient_id = $request->patient_id;
        $presc->diagnosis = $request->diagnosis;
        $presc->appointment_id = $request->appointment_id;

        $presc->medicines = json_encode($request->medicines);

        $bp = new stdClass;
        $bp->value = $request->pressure;
        $bp->updated = Carbon::now()->toDateTimeString();
        $presc->bp = json_encode($bp);

        $gloucose = new stdClass;
        $gloucose->value = $request->glucose;
        $gloucose->updated = Carbon::now()->toDateTimeString();
        $presc->blood_sugar = json_encode($gloucose);

        $cholestrol = new stdClass;
        $cholestrol->value = $request->cholestrol;
        $cholestrol->updated = Carbon::now()->toDateTimeString();
        $presc->cholestrol = json_encode($cholestrol);

        $presc->save();

        $appointment = Appointment::find($request->appointment_id);
        $appointment->completed = "YES";
        $appointment->doctor_id = $user->id;
        $appointment->save();

        foreach ($request->medicines as $medicine) {
            $med = Medicine::where('name_english', strtolower($medicine['name']))->first();
            $pres_med = new Prescription_Medicine;
            $pres_med->medicine_id = $med->id;
            $pres_med->prescription_id = $presc->id;
            $pres_med->note = $medicine['note'];
            $pres_med->save();
        }

        // Log Activity
        activity()->performedOn($presc)->withProperties(['Patient ID' => $request->patient_id, 'Doctor ID' => $user->id, 'Prescription ID' => $presc->id, 'Appointment ID' => $request->appointment_id, 'Medicines' => json_encode($request->medicines)])->log('Check Patient Success');

        return http_response_code(200);
    }

    public function create_channel_view()
    {
        $user = Auth::user();
        $appointments = DB::table('appointments')->join('patients', 'appointments.patient_id', '=', 'patients.id')->select('patients.name', 'appointments.number', 'appointments.patient_id')->whereRaw(DB::Raw('Date(appointments.created_at)=CURDATE()'))->orderBy('appointments.created_at', 'desc')->get();

        return view('patient.create_channel_view', ['title' => "Channel Appointments", 'appointments' => $appointments]);
    }

    public function regcard($id)
    {
        $patient = Patients::find($id);
        $url = Storage::url($id . '.png');
        $data = [
            'name' => $patient->name,
            'sex' => $patient->sex,
            'id' => $patient->id,
            'reg' => explode(" ", $patient->created_at)[0],
            'dob' => $patient->bod,
            'url' => $url,
        ];
        return view('patient.patient_reg_card', $data);
    }

    public function register_in_patient_view()
    {
        $user = Auth::user();
        $data = DB::table('wards')
                    ->select('*')
                    ->join('users', 'wards.doctor_id', '=', 'users.id')
                    ->get();
        // dd($data);
        return view('patient.register_in_patient_view', ['title' => "Register Inpatient",'data'=>$data]);
    }

    public function regInPatientValid(Request $request)
    {
        $pNum = $request->pNum;
        $pNumLen = strlen((string) $pNum);
        if($pNumLen < 5) //if appointemnt number have been given
        {
            $patient = DB::table('patients')
            ->join('appointments', 'patients.id', '=', 'appointments.patient_id')
            ->select('patients.id as id', 'patients.name as name', 'patients.sex as sex', 'patients.address as address', 'patients.occupation as occ', 'patients.telephone as tel', 'patients.nic as nic', 'appointments.admit as ad', 'patients.bod as bod','appointments.number as appnum','appointments.doctor_id as D1', 'patients.updated_at')
            ->whereRaw(DB::Raw("appointments.admit='YES' and appointments.number='$pNum'"))
            ->first();

            if ($patient) {

            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'sex' => $patient->sex,
                'address' => $patient->address,
                'occupation' => $patient->occ,
                'telephone' => $patient->tel,
                'nic' => $patient->nic,
                'age' => Patients::find($patient->id)->getAge(),
                'id' => $patient->id,
            ]);
        } else { //if patient registration number have been given
            return response()->json([
                'exist' => false,
            ]);
        }
        }
        
        else
        {
 
        $patient = DB::table('patients')
                        ->join('appointments', 'patients.id', '=', 'appointments.patient_id')
                        ->select('patients.id as id', 'patients.name as name', 'patients.sex as sex', 'patients.address as address', 'patients.occupation as occ', 'patients.telephone as tel', 'patients.nic as nic', 'appointments.admit as ad', 'patients.bod as bod','appointments.number as appnum','appointments.doctor_id as D1')
                        ->whereRaw(DB::Raw("appointments.admit='YES' and patients.id='$pNum'"))
                        ->first();
        if ($patient) {

            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'sex' => $patient->sex,
                'address' => $patient->address,
                'occupation' => $patient->occ,
                'telephone' => $patient->tel,
                'nic' => $patient->nic,
                'age' => Patients::find($patient->id)->getAge(),
                'id' => $patient->id,
            ]);
        } else {
            return response()->json([
                'exist' => false,
            ]);
        }
    }
}

    public function store_inpatient(Request $request)
    {
        $pid = $request->reg_pid;
        $Ptable = Patients::find($pid);
        $INPtable = new inpatient;

        $Ptable->civil_status = $request->reg_ipcondition;
        $Ptable->birth_place = $request->reg_ipbirthplace;
        $Ptable->nationality = $request->reg_ipnation;
        $Ptable->religion = $request->reg_ipreligion;
        $Ptable->income = $request->reg_inpincome;
        $Ptable->guardian = $request->reg_ipguardname;
        $Ptable->guardian_address = $request->reg_ipguardaddress;

        $INPtable->patient_id = $request->reg_pid;
        $INPtable->ward_id = $request->reg_ipwardno;
        $INPtable->patient_inventory = $request->reg_ipinventory;
    
        $INPtable->house_doctor = $request->reg_iphousedoc;
        $INPtable->approved_doctor = $request->reg_ipapprovedoc;
        $INPtable->disease = $request->reg_admitofficer1;
        $INPtable->duration = $request->reg_admitofficer2;
        $INPtable->condition = $request->reg_admitofficer3;
        $INPtable->certified_officer = $request->reg_admitofficer4;

        $Ptable->save();
        $INPtable->save();

        // decrement bed count by 1
        $getFB = Ward::where('ward_no', $request->reg_ipwardno)->first();
        $newFB = $getFB->free_beds-=1;
        Ward::where('ward_no', $request->reg_ipwardno)->update(['free_beds' => $newFB]);

      
        return redirect()->back()->with('regpsuccess', "Inpatient Successfully Registered");
    }

    public function get_ward_list()
    {
        $wardList = $this->wardList;
        $data=DB::table('wards')->join('users','wards.doctor_id','=','users.id')->select('*')->get();
         return view('register_in_patient_view', ['data'=>$data]);
        // $wards = Ward::all();
        // dd($wardss);
        // return view('register_in_patient_view', compact(['wards']));
    }

    public function discharge_inpatient()
    {
        $user = Auth::user();
        return view('patient.discharge_inpatient_view', ['title' => "Discharge Inpatient"]);
    }

    public function disInPatientValid(Request $request)
    {
        $pNum = $request->pNum;
        $inpatient = DB::table('patients')
                        ->join('inpatients', 'patients.id', '=', 'inpatients.patient_id')
                        ->select('inpatients.patient_id as id', 'patients.name as name', 'patients.address as address', 'patients.telephone as tel', 'inpatients.discharged as dis')
                        ->whereRaw(DB::Raw("inpatients.patient_id='$pNum' and inpatients.discharged='NO'"))
                        ->first();

        if ($inpatient) {

            return response()->json([
                'exist' => true,
                'name' => $inpatient->name,
                'address' => $inpatient->address,
                'telephone' => $inpatient->tel,
                'id' => $inpatient->id,
            ]);
        } else {
            return response()->json([
                'exist' => false,
            ]);
        }
    }

    public function store_disinpatient(Request $request)
    {
        // try{
        $pid = $request->reg_pid;
        $INPtableUpdate = Inpatient::where('patient_id', $pid)->first();

        $timestamp = now();
        $INPtableUpdate->discharged = 'YES';
        $INPtableUpdate->discharged_date = $timestamp;
        $INPtableUpdate->description = $request->reg_medicalofficer1;
        $INPtableUpdate->discharged_officer = $request->reg_medicalofficer2;

        $INPtableUpdate->save();

        // increment bed count by 1
        $wardNo = $INPtableUpdate->ward_id;
        $getFB = Ward::where('ward_no', $wardNo)->first();
        $newFB = $getFB->free_beds+=1;
        Ward::where('ward_no', $wardNo)->update(['free_beds' => $newFB]);

        return view('patient.discharge_recipt',compact('INPtableUpdate'))->with('regpsuccess', "Inpatient Successfully Discharged");;
        // }
        // catch(\Throwable $th){
        //     return redirect()->back()->with('error',"Unkown Error Occured");
        // }
    }

    public function getPatientData(Request $request)
    {
        $regNum = $request->regNum;
        $patient = Patients::find($regNum);
        if ($patient) {

            $num = DB::table('appointments')->select('id')->whereRaw(DB::raw("date(created_at)=CURDATE()"))->count() + 1;

            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'sex' => $patient->sex,
                'address' => $patient->address,
                'occupation' => $patient->occupation,
                'telephone' => $patient->telephone,
                'nic' => $patient->nic,
                'age' => $patient->getAge(),
                'id' => $patient->id,
                'appNum' => $num,
            ]);
        } else {
            return response()->json([
                'exist' => false,
            ]);
        }
    }
public function addChannel(Request $request)
    {
        $app = new Appointment;
        $num = DB::table('appointments')->select('id')->whereRaw(DB::raw("date(created_at)=CURDATE()"))->count() + 1;
        $pid = $request->id;
        $patient = Patients::find($pid);

        $app->number = $num;
        $app->patient_id = $pid;
        $app->save();
        try {
            $app->save();
            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'id' => $patient->id,
                'appID' => $app->id,
                'appNum' => $num,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'exist' => false,
            ]);
        }
    }

    public function editPatientview(Request $request)
    {
        // dd($request->reg_pid);
        $user = Auth::user();
        // $data = DB::table('patients')->select('*')->where('id',$request->reg_pid)->first();
        $data = Patients::find($request->reg_pid);
        return view('patient.edit_patient_view', ['title' => "Edit Patient", 'patient' => $data]);
    }

    public function updatePatient(Request $result)
    {
        // dd($result->reg_pbd);
        $user = Auth::user();
        
        $query = DB::table('patients')
            ->where('id', $result->reg_pid)
            ->update(array(
                'name' => $result->reg_pname,
                'address' => $result->reg_paddress,
                'sex' => $result->reg_psex,
                'bod' => $result->reg_pbd,
                'occupation' => $result->reg_poccupation,
                'nic' => $result->reg_pnic,
                'telephone' => $result->reg_ptel,
            ));

        if ($query) {
            //activity log
            activity()->performedOn($user)->log('Patient details updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated patient details.');
        } else {
            return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }

    }

    /*
        get patient records
    */
    public function patientRecord($id)
    {
        $user = Auth::user();
        $data = DB::table('ps_patients_record')
                ->join('patients', 'patients.id', '=', 'ps_patients_record.patient_id')
                ->join('ms_symptoms_type', 'ms_symptoms_type.id', '=', 'ps_patients_record.symptom_id')
                ->join('ms_illness_arrival_type', 'ms_illness_arrival_type.id', '=', 'ps_patients_record.arrival_id')
                ->join('ms_investigation_type', 'ms_investigation_type.id', '=', 'ps_patients_record.investigation_id')
                ->select('ps_patients_record.*','patients.name','ms_symptoms_type.name as symptoms','ms_illness_arrival_type.name as arrival_name','ms_investigation_type.name as investigation','ms_investigation_type.type as investigation_type')
                ->where('ps_patients_record.patient_id',$id)
                ->first();
                // print_r($data);die;
        $symptoms = Symptoms::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        $arrival = Arrival::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        $investigation = Investigation::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        $systematicexam = Examination_Type::where(function ($query) {
                $query->where('status', '=', '1')->where('ex_type','systemic') ;                 
                })->get();
        $generalexam = Examination_Type::where(function ($query) {
                $query->where('status', '=', '1')->where('ex_type','general') ;                 
                })->get();
        // print_r($arrival);die;
        return view('patient.patient_record_view', ['title' => "Edit Patient",'patient' => $data,'symptoms' => $symptoms,'arrival' => $arrival,'investigation' => $investigation,'systematicexam' =>$systematicexam,'generalexam' =>$generalexam]);
    }

    /*
       update patient records
    */

    public function updatePatientRecord(Request $result)
    {
        $user = Auth::user();
        $patientSymptoms = implode(',', $result->patient_symptoms);
        $patientArrivalName = implode(',', $result->patient_arrival_name);
        $patientSystemicExamination = implode(',', $result->patient_systemic_examination);
        $patientGeneralExamination = implode(',', $result->patient_general_examination);

        $patientInvestigationType = implode(',', $result->patient_investigation_type);
        $record = Patients_Record::find($result->reg_pid);
      
        if (!is_null($record)) {
            $patientRecord = Patients_Record::find($result->reg_pid);
            $patientRecord->temprature =  $result->temprature;
            $patientRecord->rr = $result->patient_rr;
            $patientRecord->pulse_rate = $result->pulse_rate;
            $patientRecord->crt = $result->patient_crt;
            $patientRecord->bp = $result->patient_bp;
            $patientRecord->spo2 = $result->patient_spo2;
            $patientRecord->weight = $result->patient_weight;
            $patientRecord->ht_lt = $result->patient_ht_lt;
            $patientRecord->mu_ac = $result->patient_mu_ac;
            $patientRecord->weight_legnth = $result->patient_weight_legnth;
            $patientRecord->systemic_examination = $result->patient_systemic_examination;
            $patientRecord->treatment_info = $result->patient_treatment_info;
            $patientRecord->diagnosis_info = $result->patient_diagnosis_info;
            $patientRecord->date = $result->patient_date;
            $patientRecord->report = $result->patient_report;
            $patientRecord->symptom_id = $patientSymptoms;
            $patientRecord->arrival_id = $patientArrivalName;
            $patientRecord->investigation_id = $patientInvestigationType;
            $patientRecord->systemic_examination = $patientSystemicExamination;
            $patientRecord->general_examination_id = $patientGeneralExamination;
            $patientRecord->save();
            //activity log
            activity()->performedOn($user)->log('Patient details updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated patient details.');
        }else{
             return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }      

    }


    /*
        get patient investigation sheet
    */
    public function investigationSheet($id)
    {
        $user = Auth::user();
        $data = DB::table('ps_investigation_sheet')
                ->leftjoin('patients', 'patients.id', '=', 'ps_investigation_sheet.patient_id')
                ->leftjoin('ms_investigation_type', 'ms_investigation_type.id', '=', 'ps_investigation_sheet.investigation_id')
                ->select('ps_investigation_sheet.*','patients.name as patient_name','ms_investigation_type.type','ms_investigation_type.name')
                ->where('ps_investigation_sheet.patient_id',$id)
                ->get();
        $investigation = Investigation::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
                // print_r($data);die;
        return view('patient.investigation_sheet', ['title' => "Investigation Sheet",'patient' => $data,'investigation' => $investigation]);
    }


    /*
       update patient records
    */

    public function updateInvestigationSheet(Request $result)
    {
        $user = Auth::user();
        $patientInvestigationType = implode(',', $result->investigation_type);        

        $investigation = InvestigationSheet::find($result->reg_pid);
      // print_r($investigation);die;
        if (!is_null($investigation)) {
            $investigationRecord = InvestigationSheet::find($result->reg_pid);
            $investigationRecord->date =  $result->investigation_date;
            $investigationRecord->report = $result->investigation_report;
            $investigationRecord->investigation_id = $patientInvestigationType;            
            $investigationRecord->save();

            //activity log
            activity()->performedOn($user)->log('Investigation Sheet updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated patient investigation sheet.');
        }
         else {
            return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }

    }


    /*
        get nurse order sheet
    */
    public function nurseOrderSheet($id)
    {
        $user = Auth::user();
        $data = DB::table('ps_nurse_order_sheet')
                ->leftjoin('patients', 'patients.id', '=', 'ps_nurse_order_sheet.patient_id')
                ->leftjoin('ms_treatment_type', 'ms_treatment_type.id', '=', 'ps_nurse_order_sheet.treatment_id')
                ->select('ps_nurse_order_sheet.*','patients.name as patient_name','ms_treatment_type.type','ms_treatment_type.name')
                ->where('ps_nurse_order_sheet.patient_id',$id)
                ->get();
                // print_r($data);die;
        $treatment = Treatment::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        return view('patient.nurse_order_sheet', ['title' => "Nurse Order Sheet",'patient' => $data,'treatment' =>$treatment]);
    }


    /*
       update nurse order
    */

    public function updateNurseOrderSheet(Request $result)
    {
        $user = Auth::user();
        $treatmentType = implode(',', $result->treatment_type);
        
        $nurseOrderSheet = NurseOrderSheet::find($result->reg_pid);
      
        if (!is_null($nurseOrderSheet)) {
            $nurseOrderSheet = NurseOrderSheet::find($result->reg_pid);
            $nurseOrderSheet->time =  $result->treatment_time;
            $nurseOrderSheet->total_dose = $result->total_dose;
            $nurseOrderSheet->remark = $result->remark;            
            $nurseOrderSheet->report = $result->report;          
            $nurseOrderSheet->treatment_id = $treatmentType;            
            $nurseOrderSheet->save();

            //activity log
            activity()->performedOn($user)->log('Nurse Order Sheet updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated nurse order sheet.');
        }
         else {
            return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }

    }

    /*
        get monitoring sheet
    */
    public function monitoringSheet($id)
    {
        $user = Auth::user();
        $data = DB::table('ps_monitoring_sheet')
                ->join('patients', 'patients.id', '=', 'ps_monitoring_sheet.patient_id')
                ->select('ps_monitoring_sheet.*','patients.name as patient_name')
                ->where('ps_monitoring_sheet.patient_id',$id)
                ->first();
                // print_r($data);die;
        $monitoring = Monitoring::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        return view('patient.monitoring_sheet', ['title' => "Nurse Order Sheet",'patient' => $data,'monitoring' =>$monitoring]);
    }


    /*
       update monitoring sheet
    */

    public function updateMonitoringSheet(Request $result)
    {
        $user = Auth::user();
        $monitoringType = implode(',', $result->monitoring_type);
        
        $monitoringSheet = MonitoringSheet::find($result->reg_pid);
      
        if (!is_null($monitoringSheet)) {
            $monitoringSheet = MonitoringSheet::find($result->reg_pid);
            $monitoringSheet->report =  $result->report;
            $monitoringSheet->monitoring_id  = $monitoringType;
            $monitoringSheet->nurse_id = $monitoringType;            
            $monitoringSheet->save();

            //activity log
            activity()->performedOn($user)->log('Monitoring Sheet updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated monitoring sheet.');
        }
         else {
            return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }

    }


    /*
        get treatment sheet
    */
    public function treatmentSheet($id)
    {
        $user = Auth::user();
        $data = DB::table('ps_treatment_continuation_sheet')
                ->join('patients', 'patients.id', '=', 'ps_treatment_continuation_sheet.patient_id')
                ->select('ps_treatment_continuation_sheet.*','patients.name as patient_name')
                ->where('ps_treatment_continuation_sheet.patient_id',$id)
                ->first();
                // print_r($data);die;
        $treatment = Treatment::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        $round = Round_Shift::where(function ($query) {
                $query->where('status', '=', '1');                  
                })->get();
        return view('patient.treatment_sheet', ['title' => "Treatment Continuation Sheet",'patient' => $data,'treatment' =>$treatment,'round' => $round]);
    }


     /*
       update treatment sheet
    */

    public function updateTreatmentSheet(Request $result)
    {
        $user = Auth::user();
        $treatmentType = implode(',', $result->treatment_type);
        $roundType = implode(',', $result->round_type);
        
        $treatmentSheet = TreatmentSheet::find($result->reg_pid);
      
        if (!is_null($treatmentSheet)) {
            $treatmentSheet = TreatmentSheet::find($result->reg_pid);
            $treatmentSheet->report =  $result->report;
            $treatmentSheet->treatment_id  = $treatmentType;
            $treatmentSheet->round_id = $roundType;            
            $treatmentSheet->save();

            //activity log
            activity()->performedOn($user)->log('Monitoring Sheet updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated monitoring sheet.');
        }
         else {
            return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }

    }


    public function patientList()
    {
        $wardList = $this->wardList;
        $data=DB::table('patients')->select('*')->get();
         return view('patient.patient_list_view', ['title' => "Patient List",'data'=>$data]);
    }

    public function paymentDetail(Request $request)
    {
        return view('medicine.payment_details', ['title' => "Search Patient", "old_keyword" => null, "search_result" => ""]);
    }

    public function patientDetailData(Request $request)
    {
        if ($request->cat == "name") {
            $result = Patients::withTrashed()->where('name', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        
        if ($request->cat == "telephone") {
            $result = Patients::withTrashed()->where('telephone', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        $medicineData=DB::table('medicines')->select('*')->get();
        return view('medicine.payment_details', ["title" => "Search Results", "old_keyword" => $request->keyword, "search_result" => $result,"medicine" =>$medicineData]);
    }


    public function savePayment(Request $request)
    {
        try {
            
            $transaction = new Transaction;     
            $medicineName = implode(',', $request->medicine_name);       
            $transaction->transaction_id = mt_rand(100000, 999999);
            $transaction->medicine_id = $medicineName;
            $transaction->patient_id = $request->reg_pid;
            $transaction->payment_mode = $request->payment_mode;
            $transaction->amount = $request->total_amount;
            $transaction->save();

            session()->flash('regpsuccess', 'Payment ' . $request->reg_pid . ' Registered Successfully !');
            
            // Log Activity
            activity()->performedOn($transaction)->withProperties(['Payment' => $transaction->transaction_id])->log('Payment Successfully');

            return redirect()->back();
        } catch (\Exception $e) {
            // do task when error
            $error = $e->getCode();
            // log activity
            activity()->performedOn($transaction)->withProperties(['Error Code' => $error, 'Error Message' => $e->getMessage()])->log('Payment Failed');

            if ($error == '23000') {
                session()->flash('regpfail', 'Payment ' . $request->reg_pid . ' Is Already Registered..');
                return redirect()->back();
            }
        }
    }

}
