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
                    <h3 class="box-title">{{__('Edit Medicine')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                

                @if ($medicine)
                <form class="form-horizontal" action="{{route('update-medicine')}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Medicine Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$medicine->name}}" type="text" required class="form-control" name="medicine_name"
                                    placeholder="Enter Medicine Full Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Company Name')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$medicine->company}}" type="text" required class="form-control" name="company_name"
                                    placeholder="Enter Company Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Expiry Date')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$medicine->expiry_date}}" type="date" required class="form-control" name="expiry_date"
                                    placeholder="Enter Expiry Date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{__('Quantity')}}</label>
                            <div class="col-sm-10">
                                <input  value="{{$medicine->qty}}" type="text" required class="form-control" name="quantity"
                                    placeholder="Enter quantity">
                            </div>
                        </div>
                        

                        <!-- select -->
                        <div class="form-group">

                             <input readonly value="{{$medicine->id}}" type="text" class="form-control pull-right" name="medicine_id" style="display:none">

                            <div class="col-sm-3">
                                        <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
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
