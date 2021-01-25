@extends('template.main')

@section('title', $title)

@section('content_title',"Dashboard")
@section('content_description',"Operate All The Things Here")
@section('breadcrumbs')
<ol class="breadcrumb">
    <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>

@endsection

@section('main_content')

    <div class="row">
            <!-- right column -->
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Patient Records')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                @if ($patient)
                <form class="form-horizontal" action="{{route('update-patient-records')}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->name}}" disabled="disabled" type="text" required class="form-control" name="patient_name"
                                    placeholder="Enter Patient Full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Symptoms')}}</label>
                            <div class="col-sm-10">
                                <?php //print_r($symptoms);die;?>
                            <select class="form-control select2-multi" multiple="multiple" name="patient_symptoms[]" id="patient_symptoms">
                                @foreach ($symptoms as $symptom)
                                <option value="{{$symptom->id}}" <?php if(in_array($symptom->id,explode(',', $patient->symptom_id))) {?>selected <?php }?>>{{ucWords($symptom->name)}}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Arrival')}}</label>
                            <div class="col-sm-10">                               
                                <select class="form-control select2-multi" multiple="multiple" name="patient_arrival_name[]" id="patient_arrival_name">
                                    <option value="">Select Arrival</option>
                                    @foreach ($arrival as $avl)
                                    <option value="{{$avl->id}}" <?php if(in_array($avl->id,explode(',', $patient->arrival_id))) {?>selected <?php }?>>{{ucWords($avl->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Investigation Type')}}</label>
                            <div class="col-sm-10">                                
                                <select class="form-control select2-multi" multiple="multiple" name="patient_investigation_type[]" id="patient_investigation_type">
                                    <option value="">Select Investigation Type</option>
                                    @foreach ($investigation as $inv)
                                    <option value="{{$inv->id}}" <?php if(in_array($inv->id,explode(',', $patient->investigation_id))) {?>selected <?php }?>>{{ucWords($inv->type)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Investigation Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->investigation}}" disabled="disabled" type="text" required class="form-control" name="patient_investigation"
                                    placeholder="Enter Patient Investigation">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Temprature')}}</label>
                            <div class="col-sm-10">
                                <input  type="text" value="{{$patient->temprature}}" required class="form-control" name="temprature"
                                    placeholder="Enter Patient Temprature ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('RR')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->rr}}" type="tel" class="form-control" name="patient_rr"
                                    placeholder="Patient RR">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Pulse Rate')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->pulse_rate}}" type="text" required class="form-control" name="pulse_rate"
                                    placeholder="Enter Patient Pulse Rate">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('BP')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->bp}}" type="text" required class="form-control" name="patient_bp"
                                    placeholder="Enter Patient BP">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('SPO2')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->spo2}}" type="text" required class="form-control" name="patient_spo2"
                                    placeholder="Enter Patient SPO2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Weight')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->weight}}" type="text" required class="form-control" name="patient_weight"
                                    placeholder="Enter Patient Weight">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Ht & Lt')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->ht_lt}}" type="text" required class="form-control" name="patient_ht_lt"
                                    placeholder="Enter Patient HT & LT">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Mu & Ac')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->mu_ac}}" type="text" required class="form-control" name="patient_mu_ac"
                                    placeholder="Enter Patient MU & AC">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Weight & Legnth')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->weight_legnth}}" type="text" required class="form-control" name="patient_weight_legnth"
                                    placeholder="Enter Patient Weight & Legnth">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Systemic Examination')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->systemic_examination}}" type="text" required class="form-control" name="patient_systemic_examination"
                                    placeholder="Enter Patient Systemic Examination">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Treatment Info')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->treatment_info}}" type="text" required class="form-control" name="patient_treatment_info"
                                    placeholder="Enter Patient Treatment Info">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Diagnosis Info')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->diagnosis_info}}" type="text" required class="form-control" name="patient_diagnosis_info"
                                    placeholder="Enter Patient Diagnosis Info">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{__('CRT')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->crt}}" type="text" required class="form-control" name="patient_crt"
                                    placeholder="Enter Patient CRT ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Report')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->report}}" type="text" required class="form-control" name="patient_report"
                                    placeholder="Enter Patient Report">
                            </div>
                        </div>



                        <!-- select -->
                        <div class="form-group">
                            
                            <label class="col-sm-2 control-label">{{__('Date')}}</label>
                            <div class="col-sm-2 mr-0 pr-0 date">
                                <input type="date" value="{{$patient->date}}" required max="2014-12-30" class="form-control pull-right"
                                    name="patient_date" placeholder="Enter Patient Date">
                            </div>

                            
                            <input readonly value="{{$patient->id}}" type="text" class="form-control pull-right" name="reg_pid" style="display:none">

                            <div class="col-sm-3">
                                        <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                            </div>

                            <div class="col-sm-3">
                                <a href="{{ url('/investigation-sheet/' . $patient->patient_id) }}" class="btn btn-danger pull-right">Investigation Sheet</a>
                            </div>

                        </div>


                    </div>

                </form>
                @endif
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> 
<script>
    
    $(document).ready(function() {
        $("#patient_symptoms").select2();
        $("#patient_arrival_name").select2();
        $("#patient_investigation_type").select2();
    });
</script>

@endsection
