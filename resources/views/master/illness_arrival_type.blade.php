@extends('template.main')

@section('title', $title)

@section('content_title',__("illness Arrival"))
@section('content_description',__("illness Arrival Management"))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:1vh;padding:3%" class="pb-0 row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session()->get('success')}}
        </div>
        @endif
        @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>

            {{session()->get('fail')}}
        </div>
        @endif
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Add New illness Arrival Type')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form method="POST" action="{{route('master/save_illness_arrival_type')}}" class="form-horizontal">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="ward_num">{{__('Name')}}<span style="color:red">*</span></label></label>

                        <div class="col-sm-10">
                            <input class="form-control" name="name" required id="name" type="text"
                                placeholder="illness Arrival Type">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" type="reset">{{__('Cancel')}}</button>
                    <button class="btn btn-info pull-right" type="submit">{{__('Save')}}</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<div style="padding:3%" class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('illness Arrival Type Details')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                    <br>
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Updated Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $app)
                            <tr>
                                <td>{{ucWords($app->name)}}</td>
                                <td>{{$app->status}}</td>
                                <td>{{$app->created_at}}</td>
                                <td>{{$app->updated_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Updated Date')}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <!-- /.box-body -->
</div>
@endsection
@section('optional_scripts')
<script>
    $(function () {

        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>

@endsection
