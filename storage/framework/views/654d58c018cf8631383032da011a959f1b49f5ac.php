<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content_title',__("Search Patient")); ?>
<?php $__env->startSection('content_description',__("Search,View & Update Patient Details")); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<ol class="breadcrumb">
   <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
   <li class="active">Here</li>
</ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
<div class="row">
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <form action=<?php echo e(route('search-details')); ?> method="GET" role="search">
         <?php echo csrf_field(); ?>
         <?php if(session('success')): ?>
         <div class="alert alert-success">
            <?php echo e(session('success')); ?>

         </div>
         <?php endif; ?>
         <?php if(session('unsuccess')): ?>
         <div class="alert alert-danger">
            <?php echo e(session('unsuccess')); ?>

         </div>
         <?php endif; ?>
         <div class="callout callout-info">
            <label class="h4"><?php echo e(__('Search Patient With ...')); ?></label>
            <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-5">
                  <label class="mr-2">
                  <input onchange="changeFunc('Name');" style="display:inline-block" checked type="radio"
                     name="cat" id="cat" value="name">
                  <?php echo e(__('Name')); ?>

                  </label>
                  <label class="ml-2 mr-4">
                  <input onchange="changeFunc('Telephone Number');" style="display:inline-block" type="radio"
                     name="cat" id="cat" value="telephone">
                  <?php echo e(__('Telephone')); ?>

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
                     <input required type="text" value="<?php echo e($old_keyword); ?>" class="form-control" id="keyword" name="keyword"
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
<?php if($search_result): ?>
<?php if(!$search_result->isEmpty()): ?>
<?php $__currentLoopData = $search_result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="row">
   <!-- right column -->
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <!-- Horizontal Form -->
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(__('Search Results')); ?></h3>
         </div>
         <!-- /.box-header -->
         <!-- form start -->
         <form class="form-horizontal" action="<?php echo e(route('save-payment')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="box-body">
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Patient ID')); ?></label>
                  <div class="col-sm-10">
                     <input readonly value="<?php echo e($patient->id); ?>" type="text" required class="form-control"
                        name="reg_pname">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Full Name')); ?></label>
                  <div class="col-sm-10">
                     <input readonly value="<?php echo e($patient->name); ?>" type="text" required class="form-control"
                        name="reg_pname" placeholder="Enter Patient Full Name">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Address')); ?></label>
                  <div class="col-sm-10">
                     <input readonly type="text" value="<?php echo e($patient->address); ?>" required class="form-control"
                        name="reg_paddress" placeholder="Enter Patient Address ">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Telephone')); ?></label>
                  <div class="col-sm-10">
                     <input readonly value="<?php echo e($patient->telephone); ?>" type="tel" class="form-control"
                        name="reg_ptel" placeholder="Patient Telephone Number">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Occupation')); ?></label>
                  <div class="col-sm-10">
                     <input readonly value="<?php echo e($patient->occupation); ?>" type="text" required class="form-control"
                        name="reg_poccupation" placeholder="Enter Patient Occupation ">
                  </div>
               </div>
               <!-- select -->
               <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo e(__('Sex')); ?></label>
                  <div class="col-sm-2 mr-0 pr-0">
                     <input readonly value="<?php echo e($patient->sex); ?>" type="text" required class="form-control"
                        name="reg_poccupation" placeholder="Enter Patient Occupation ">
                  </div>
                  <label class="col-sm-2 control-label"><?php echo e(__('DOB')); ?></label>
                  <div class="col-sm-3">
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input readonly value="<?php echo e($patient->dob); ?>" type="text" class="form-control pull-right"
                           name="reg_pbd" placeholder="Birthday">
                        <input readonly value="<?php echo e($patient->id); ?>" type="text" class="form-control pull-right"
                           name="reg_pid" style="display:none">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="btn-group pull-right" role="group" aria-label="Button group">
                        <button type="button" onclick="go('<?php echo e($patient->id); ?>')" class="btn bg-navy"><i class="far fa-id-card"></i> <?php echo e(__('Profile')); ?></button>
                        <!-- <button <?php if($patient->trashed()): ?> type="button" disabled <?php endif; ?> class="btn btn-warning"><i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?></button> -->
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
                                <?php $__currentLoopData = $medicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($medi->id); ?>"><?php echo e(ucWords($medi->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                  <button <?php if($patient->trashed()): ?> type="button" disabled <?php endif; ?> class="btn btn-warning"><?php echo e(__('Payment')); ?></button>
            </div>

         </form>
      </div>
   </div>
   <div class="col-md-1"></div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php else: ?>
<div class="row">
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <h4><?php echo e(__('No results found...')); ?></h4>
   </div>
   <div class="col-md-1"></div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hospital-managment-system\resources\views/medicine/payment_details.blade.php ENDPATH**/ ?>