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

            <form class="form-horizontal" action="{{route('editpatient')}}" method="POST">
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
                    <div class="form-group">
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
                    <table>
<thead>
    <tr>
        <th align=center>Name</th>
        <th align=center>Quantity<br></th>
        <th align=center>Price<br></th>
        <th align=center>Total:<br></th>
    </tr>
</thead>
<tbody>
<tr class='alt' onMouseOver="this.className='highlight'" onMouseOut="this.className='alt'">
    <td align=left>Windows Based PC</td>
    <td align=right><input class='saisie' type='text' size=4 name='1347_1'></td>
    <td align=right><input class='saisie' type='text' size=4 name='1347_2'></td>
    <td align=right></td>
</tr>
<tr class='normal' onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
    <td align=left>iOS based Phones</td>
    <td align=right><input class='saisie' type='text' size=4 name='4482_1'></td>
    <td align=right><input class='saisie' type='text' size=4 name='4482_2'></td>
    <td align=right></td>
</tr>
<tr class='alt' onMouseOver="this.className='highlight'" onMouseOut="this.className='alt'">
    <td align=left>Speakers</td>
    <td align=right><input class='saisie' type='text' size=4 name='7969_1'></td>
    <td align=right><input class='saisie' type='text' size=4 name='7969_2'></td>
    <td align=right></td>
</tr>
<tr class="totalColumn">
    <td class="totalCol" align=right>Total:</td>
    <td class="totalCol" align=right></td>
    <td class="totalCol" align=right></td>
    <td class="totalCol" align=right></td>
    <td class="totalCol" align=right></td>
</tr>
</tbody>
</table><span id=sum name sum></span>
                </div>
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
  <script> 
    $(document).ready(function () { 
  
      // Denotes total number of rows 
      var rowIdx = 0; 
  
      // jQuery button click event to add a row 
      $('#addBtn').on('click', function () { 
  
        // Adding a row inside the tbody. 
        $('#tbody').append(`<tr id="R${++rowIdx}"> 
             <td class="row-index text-center"> 
                <input type ="text" id ="medicine_name" name="medicine_name"> 
             </td>
             <td class="row-index text-center"> 
                <input type ="text" class="qty saisie" id ="qty_${++rowIdx}" value="" name="qty"> 
             </td>
             <td class="row-index text-center"> 
                <input type ="text" class="price saisie" id ="price_${++rowIdx}" value="" name="price"> 
             </td> 
             <td class="row-index text-center"> 
                <input type ="text" class="amount saisie" id ="amount_${++rowIdx}" value="" name="amount"> 
             </td> 
              <td class="text-center"> 
              <i class="fas fa-minus-circle remove"></i>                
                </td> 
              </tr>
              <tr class='alt' onMouseOver="this.className='highlight'" onMouseOut="this.className='alt'">
    <td align=left>Windows Based PC</td>
    <td align=right><input class='saisie' type='text' size=4 name='1347_1'></td>
    <td align=right><input class='saisie' type='text' size=4 name='1347_2'></td>
    <td align=right></td>
</tr>
<tr class='normal' onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
    <td align=left>iOS based Phones</td>
    <td align=right><input class='saisie' type='text' size=4 name='4482_1'></td>
    <td align=right><input class='saisie' type='text' size=4 name='4482_2'></td>
    <td align=right></td>
</tr>
<tr class='alt' onMouseOver="this.className='highlight'" onMouseOut="this.className='alt'">
    <td align=left>Speakers</td>
    <td align=right><input class='saisie' type='text' size=4 name='7969_1'></td>
    <td align=right><input class='saisie' type='text' size=4 name='7969_2'></td>
    <td align=right></td>
</tr>
<tr class="totalColumn">
    <td class="totalCol" align=right>Total:</td>
    <td class="totalCol" align=right></td>
    <td class="totalCol" align=right></td>
    <td class="totalCol" align=right></td>
    <td class="totalCol" align=right></td>
</tr>`); 
            $(".price").blur(function(){
              var qty = $(".qty").val();
              var price = $(".price").val();
              var amount = qty*price;
              alert(amount);
              $(".amount").val(amount);
            });

            $(".saisie").each(function() {
                $(this).keyup(function(){
                    calculateTotal($(this).parent().index());
                });
            });

                        function calculateTotal(index)
            {
               var total = 0;
                $('table tr td').filter(function(){
                    if($(this).index()==index)
                    {
                    total += parseFloat($(this).find('.saisie').val())||0;
                    }
                }
                );
                $('table tr td.totalCol:eq('+index+')').html(total);
                calculateSum();
                calculateRowSum();
            }
            function calculateRowSum()
            {
                $('table tr:has(td):not(:last)').each(function(){
                   var sum = 1; $(this).find('td').each(function(){
                      sum *= parseFloat($(this).find('.saisie').val()) || 1;
                    });
                       $(this).find('td:last').html(sum);
                });
            }
            function calculateSum() {
                var sum = 0;
                $("td.totalCol").each(function() {
                        sum += parseFloat($(this).html())||0;
                });
                $("#sum").html(sum.toFixed(2));
            }
      }); 
  
      // jQuery button click event to remove a row. 
      $('#tbody').on('click', '.remove', function () { 
  
        // Getting all the rows next to the row 
        // containing the clicked button 
        var child = $(this).closest('tr').nextAll(); 
  
        // Iterating across all the rows  
        // obtained to change the index 
        child.each(function () { 
  
          // Getting <tr> id. 
          var id = $(this).attr('id'); 
  
          // Getting the <p> inside the .row-index class. 
          var idx = $(this).children('.row-index').children('p'); 
  
          // Gets the row number from <tr> id. 
          var dig = parseInt(id.substring(1)); 
  
          // Modifying row index. 
          idx.html(`Row ${dig - 1}`); 
  
          // Modifying row id. 
          $(this).attr('id', `R${dig - 1}`); 
        }); 
  
        // Removing the current row. 
        $(this).closest('tr').remove(); 
  
        // Decreasing total number of rows by 1. 
        rowIdx--; 
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