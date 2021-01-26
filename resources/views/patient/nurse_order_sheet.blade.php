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
                    <h3 class="box-title">{{__('Nurse Order Sheet')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
<?php //print_r($patient[0]->id);die;?>
                @if ($patient)
                <form class="form-horizontal" action="{{route('update-nurseorder-sheet')}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{!empty($patient[0]->patient_name) ? $patient[0]->patient_name : '' }}" type="text" required class="form-control" name="patient_name"
                                    placeholder="Enter Patient Full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Doctor Name')}}</label>
                            <div class="col-sm-10">
                                <input  type="text" value="TEst" required class="form-control" name="doctor_name"
                                    placeholder="Enter Doctor Name ">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Treatment Type')}}</label>
                            <div class="col-sm-10">                                
                                <select class="form-control select2-multi" multiple="multiple" name="treatment_type[]" id="treatment_type">
                                    <option value="">Select Treatment Type</option>
                                    @php $treatmentType= !empty($patient[0]->treatment_id) ? $patient[0]->treatment_id :'';@endphp
                                    @foreach ($treatment as $trt)
                                    <option value="{{$trt->id}}" <?php if(in_array($trt->id,explode(',', $treatmentType))) {?>selected <?php }?>>{{ucWords($trt->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Treatment Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{!empty($patient[0]->name) ? $patient[0]->name : '' }}" type="text" required class="form-control" name="treatment_name"
                                    placeholder="Enter Treatment Name">
                            </div>
                        </div>

                        
                        <div class="form-group">
                             <label class="col-sm-2 control-label">{{__('Treatment Time')}}<span style="color:red">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input  value="{{!empty($patient[0]->time) ? $patient[0]->time : '' }}" type="date" class="form-control pull-right" name="treatment_time"
                                        placeholder="Enter Treatment Time">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Total Dose')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{!empty( $patient[0]->total_dose) ?  $patient[0]->total_dose : ''}}" type="text" required class="form-control" name="total_dose"
                                    placeholder="Enter Total Dose">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Remark')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{!empty( $patient[0]->remark) ?  $patient[0]->remark : ''}}" type="text" required class="form-control" name="remark"
                                    placeholder="Enter Remark">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Report')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{!empty($patient[0]->report) ?  $patient[0]->report : ''}}" type="text" required class="form-control" name="report"
                                    placeholder="Enter Report">
                            </div>
                        </div>
                        
                        <!-- select -->
                        <div class="form-group">
                            <input readonly value="{{$patient[0]->id}}" type="text" class="form-control pull-right" name="reg_pid" style="display:none">
                            @php $patient_id = !empty($patient[0]->patient_id) ?  $patient[0]->patient_id : '';@endphp
                            <div class="col-sm-3">
                                <a href="{{ url('/investigation-sheet/' . $patient_id) }}" class="btn btn-danger pull-right">Back</a>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                            </div>

                            <div class="col-sm-3">
                                <a href="{{ url('/monitoring-sheet/' . $patient_id) }}" class="btn btn-danger pull-right">Monitoring Sheet</a>
                            </div>

                        </div>


                    </div>

                </form>
                @endif
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


@endsection
