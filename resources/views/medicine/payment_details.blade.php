@extends('template.main')
@section('title', $title)
@section('content_title',__("Search Patient"))
@section('content_description',__("Search,View & Update Patient Details"))
@section('breadcrumbs')
<ol class="breadcrumb">
   <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
   <li class="active">Here</li>
</ol>
@endsection
@section('main_content')
<div class="row">
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <form action={{route('search-details')}} method="GET" role="search">
         @csrf
         @if (session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
         @endif
         @if (session('unsuccess'))
         <div class="alert alert-danger">
            {{ session('unsuccess') }}
         </div>
         @endif
         <div class="callout callout-info">
            <label class="h4">{{__('Search Patient With ...')}}</label>
            <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-5">
                  <label class="mr-2">
                  <input onchange="changeFunc('Name');" style="display:inline-block" checked type="radio"
                     name="cat" id="cat" value="name">
                  {{__('Name')}}
                  </label>
                  <label class="ml-2 mr-4">
                  <input onchange="changeFunc('Telephone Number');" style="display:inline-block" type="radio"
                     name="cat" id="cat" value="telephone">
                  {{__('Telephone')}}
                  </label>
               </div>
               <div class="col-md-1"></div>
            </div>
            <script>
               function changeFunc(txt){
                   document.getElementById("keyword").placeholder ="Enter Patient " +txt;
               }
            </script>
            <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                  <div class="input-group">
                     <input required type="text" value="{{$old_keyword}}" class="form-control" id="keyword" name="keyword"
                        placeholder="Enter Patient">
                     <span class="input-group-btn">
                     <button type="submit" class="btn btn-default">
                     <span class="glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
               </div>
               <div class="col-md-1"></div>
            </div>
         </div>
   </div>
   <div class="col-md-1"></div>
</div>
</form>
@if($search_result)
@if(!$search_result->isEmpty())
@foreach($search_result as $patient)
{{-- Search Results --}}
<div class="row">
   <!-- right column -->
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <!-- Horizontal Form -->
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title">{{__('Search Results')}}</h3>
         </div>
         <!-- /.box-header -->
         <!-- form start -->
         <form class="form-horizontal" action="{{route('save-payment')}}" method="POST">
            @csrf
            <div class="box-body">
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">{{__('Patient ID')}}</label>
                  <div class="col-sm-10">
                     <input readonly value="{{$patient->id}}" type="text" required class="form-control"
                        name="reg_pname">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}</label>
                  <div class="col-sm-10">
                     <input readonly value="{{$patient->name}}" type="text" required class="form-control"
                        name="reg_pname" placeholder="Enter Patient Full Name">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">{{__('Address')}}</label>
                  <div class="col-sm-10">
                     <input readonly type="text" value="{{$patient->address}}" required class="form-control"
                        name="reg_paddress" placeholder="Enter Patient Address ">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">{{__('Telephone')}}</label>
                  <div class="col-sm-10">
                     <input readonly value="{{$patient->telephone}}" type="tel" class="form-control"
                        name="reg_ptel" placeholder="Patient Telephone Number">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">{{__('Occupation')}}</label>
                  <div class="col-sm-10">
                     <input readonly value="{{$patient->occupation}}" type="text" required class="form-control"
                        name="reg_poccupation" placeholder="Enter Patient Occupation ">
                  </div>
               </div>
               <!-- select -->
               <div class="form-group">
                  <label class="col-sm-2 control-label">{{__('Sex')}}</label>
                  <div class="col-sm-2 mr-0 pr-0">
                     <input readonly value="{{$patient->sex}}" type="text" required class="form-control"
                        name="reg_poccupation" placeholder="Enter Patient Occupation ">
                  </div>
                  <label class="col-sm-2 control-label">{{__('DOB')}}</label>
                  <div class="col-sm-3">
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input readonly value="{{$patient->dob}}" type="text" class="form-control pull-right"
                           name="reg_pbd" placeholder="Birthday">
                        <input readonly value="{{$patient->id}}" type="text" class="form-control pull-right"
                           name="reg_pid" style="display:none">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="btn-group pull-right" role="group" aria-label="Button group">
                        <button type="button" onclick="go('{{$patient->id}}')" class="btn bg-navy"><i class="far fa-id-card"></i> {{__('Profile')}}</button>
                        <!-- <button @if($patient->trashed()) type="button" disabled @endif class="btn btn-warning"><i class="fas fa-edit"></i> {{__('Edit')}}</button> -->
                     </div>
                  </div>
               </div>
               <!--                     <div class="form-group">
                  <div class="col-sm-12"> 
                          <div class="table-responsive"> 
                          <table class="table table-bordered"> 
                              <thead> 
                              <tr> 
                                  <th class="text-center">Medicine Name</th> 
                                  <th class="text-center">Qty</th> 
                                  <th class="text-center">Price</th> 
                                  <th class="text-center">Amount</th> 
                              </tr> 
                              </thead> 
                              <tbody id="tbody"> 
                  
                              </tbody> 
                          </table> 
                          </div> 
                          <button class="btn btn-md btn-primary"
                          id="addBtn" type="button"> 
                              Add new Row 
                          </button> 
                  </div> 
                  </div> -->
               <table class="table table-sm">
                  <thead>
                     <tr>
                        <th scope="col">Item ID</th>
                        <th scope="col">Medicine Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <th scope="row">ITEM001</th>
                        <td>                                 
                            <select class="col-sm-2  form-control select2-multi" multiple="multiple" name="medicine_name[]" id="medicine_name">
                                @foreach ($medicine as $medi)
                                <option value="{{$medi->id}}">{{ucWords($medi->name)}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="auto-calc unit-price form-control"></td>
                        <td><input type="text" class="auto-calc amount form-control"></td>
                        <td><input type="text" class="total-cost form-control"></td>
                     </tr>
                  </tbody>
               </table>
               <p>Total invoice amount: <span><input readonly type="text" name="total_amount" id="total_amount" value="0"></span>
                <label for="cars">Payment Mode</label>
                <select name="payment_mode" id="payment_mode">
                  <option value="card">Card</option>
                  <option value="cod">COD</option>
                </select>
               <p>
                  <button class="btn btn-md btn-primary" id="add">Add row</button>
                  <button @if($patient->trashed()) type="button" disabled @endif class="btn btn-warning">{{__('Payment')}}</button>
            </div>

         </form>
      </div>
   </div>
   <div class="col-md-1"></div>
</div>
@endforeach
<script>
   function go(pid){
       window.location.href = "/patient/"+pid;
   }
</script>
<script type="text/javascript"> 
   $(document).ready(function() {
   $(document).on("keyup change paste", "td > input.auto-calc", function() {
   
   // Determine parent row
   row = $(this).closest("tr");
   
   // Get first and second input values
   first = row.find("td input.unit-price").val();
   second = row.find("td input.amount").val();
   
   // Print input values to output cell
   row.find(".total-cost").val(first * second);
   
   
   // Update total invoice value
   var sum = 0;
   // Cycle through each input with class total-cost
   $("input.total-cost").each(function() {
   // Add value to sum
   sum += +$(this).val();
   });
   
   // Assign sum to text of #total-invoice
   // Using the id here as there is only one of these
   $("#total_amount").val(sum);
   
   
   });
   
   
   // Add dynamic row to demonstrate works in this case
   // $(document).on("click", "#add", function() {
   $("#add").click(function() {
   $("tbody").append('<tr><th scope="row">ITEM003</th><td><input type="text" class="form-control"></td><td><input type="text" class="auto-calc unit-price form-control"></td><td><input type="text" class="auto-calc amount form-control"></td><td><input type="text" class="total-cost amount form-control"></td></tr>');
   $(this).remove();
   
   });
   });
</script>
@else
<div class="row">
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <h4>{{__('No results found...')}}</h4>
   </div>
   <div class="col-md-1"></div>
</div>
@endif
@endif
@endsection