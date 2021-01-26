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
                    <h3 class="box-title">{{__('Treatment Continuation Sheet')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                

                @if ($patient)
                <form class="form-horizontal" action="{{route('update-treatment-sheet')}}" method="POST">
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
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Treatment Type')}}</label>
                            <div class="col-sm-10">                                
                                <select class="form-control select2-multi" multiple="multiple" name="treatment_type[]" id="treatment_type">
                                    <option value="">Select Treatment Type</option>
                                    @foreach ($treatment as $trt)
                                    <option value="{{$trt->id}}" <?php if(in_array($trt->id,explode(',', $patient->treatment_id))) {?>selected <?php }?>>{{ucWords($trt->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Round')}}</label>
                            <div class="col-sm-10">                                
                                <select class="form-control select2-multi" multiple="multiple" name="round_type[]" id="round_type">
                                    <option value="">Select Round Type</option>
                                    @foreach ($round as $rd)
                                    <option value="{{$rd->id}}" <?php if(in_array($rd->id,explode(',', $patient->round_id))) {?>selected <?php }?>>{{ucWords($rd->name)}}</option>
                                    @endforeach
                                </select>
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
                                <a href="{{ url('/nurse-order-sheet/' . $patient->patient_id) }}" class="btn btn-danger pull-right">Back</a>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                            </div>

                            <div class="col-sm-3">
                                <a href="{{ url('/monitoring-sheet/' . $patient->patient_id) }}" class="btn btn-danger pull-right">Monitoring Sheet</a>
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
