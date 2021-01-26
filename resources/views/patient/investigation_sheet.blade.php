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
                    <h3 class="box-title">{{__('Investigation Sheet')}}</h3>
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
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Investigation Type')}}</label>
                            <div class="col-sm-10">                                
                                <select class="form-control select2-multi" multiple="multiple" name="investigation_type[]" id="investigation_type">
                                    <option value="">Select Investigation Type</option>
                                     @php $investigationType= !empty($patient[0]->investigation_id) ? $patient[0]->investigation_id :'';@endphp
                                    @foreach ($investigation as $inv)
                                    <option value="{{$inv->id}}" <?php if(in_array($inv->id,explode(',', $investigationType))) {?>selected <?php }?>>{{ucWords($inv->type)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                       

                        
                        <div class="form-group">
                             <label class="col-sm-2 control-label">{{__('Investigation Date')}}<span style="color:red">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input  value="{{!empty($patient[0]->date) ? $patient[0]->date : ''}}" type="date" class="form-control pull-right" name="investigation_date"
                                        placeholder="Enter Investigation Date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">{{__('Investigation Report')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{!empty($patient[0]->report) ? $patient[0]->report : ''}}" type="text" required class="form-control" name="investigation_report"
                                    placeholder="Enter Investigation Date">
                            </div>
                        </div>
                        
                        <!-- select -->
                        <div class="form-group">
                            <input readonly value="{{$patient[0]->id}}" type="text" class="form-control pull-right" name="reg_pid" style="display:none">
                            @php $patient_id = !empty($patient[0]->patient_id) ?  $patient[0]->patient_id : '';@endphp
                            <div class="col-sm-3">
                                <a href="{{ url('/patient-record/' . $patient_id) }}" class="btn btn-danger pull-right">Back</a>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                            </div>

                            <div class="col-sm-3">
                                <a href="{{ url('/nurse-order-sheet/' . $patient_id) }}" class="btn btn-danger pull-right">Nurse Order Sheet</a>
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
