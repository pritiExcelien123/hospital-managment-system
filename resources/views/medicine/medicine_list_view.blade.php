@extends('template.main')

@section('title', $title)

@section('content_title',__("Medicine"))
@section('content_description',__("Medicine List"))
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
        
    </div>
    <div class="col-md-1"></div>
</div>

<div style="padding:3%" class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('Medicine Lists')}}</h3>
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
                                <th>{{__('Company')}}</th>
                                <th>{{__('Expiry Date')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $app)
                            <tr>
                                <td>{{$app->name}}</td>
                                <td>{{$app->company}}</td>
                                <td>{{$app->expiry_date}}</td>
                                <td>{{$app->qty}}</td>
                                <td>
                                    <div class="form-group">
                                        <a style="display:inline-block;align-content: center" class="btn btn-warning" href="{{url('/edit-medicine',$app->id)}}"><i
                                    class="fas fa-edit"></i> Edit Details</a>
                                    <a style="display:inline-block;align-content: center" class="btn btn-danger" href="{{url('/medicine-delete',$app->id)}}"><i
                                    class="fas fa-remove"></i> Delete</a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
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

    function editPersonDetails(person_id){
        var action = $("#select_action").val();
        //alert(action);
        var url = "./"+action+"/"+person_id;

        window.location.href = url;

    }

</script>

@endsection
