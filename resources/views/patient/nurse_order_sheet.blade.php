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
                

                @if ($patient)
                <form class="form-horizontal" action="{{route('update-investigation-sheet')}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->patient_name}}" type="text" required class="form-control" name="patient_name"
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
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Treatment Type')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->type}}" type="tel" class="form-control" name="treatment_type"
                                    placeholder="Treatment Type">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Treatment Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->name}}" type="text" required class="form-control" name="treatment_name"
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
                                    <input  value="{{$patient->time}}" type="text" class="form-control pull-right" name="treatment_time"
                                        placeholder="Enter Treatment Time">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Total Dose')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->total_dose}}" type="text" required class="form-control" name="total_dose"
                                    placeholder="Enter Total Dose">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Remark')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->remark}}" type="text" required class="form-control" name="remark"
                                    placeholder="Enter Remark">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Report')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$patient->report}}" type="text" required class="form-control" name="report"
                                    placeholder="Enter Report">
                            </div>
                        </div>
                        
                        <!-- select -->
                        <div class="form-group">
                            <input readonly value="{{$patient->id}}" type="text" class="form-control pull-right" name="reg_pid" style="display:none">
                            
                            <div class="col-sm-3">
                                <a href="{{ url('/patient-record/' . $patient->patient_id) }}" class="btn btn-danger pull-right">Back</a>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                            </div>

                            <div class="col-sm-3">
                                <a href="{{ url('/nurse-order-sheet/' . $patient->patient_id) }}" class="btn btn-danger pull-right">Nurse Order Sheet</a>
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
