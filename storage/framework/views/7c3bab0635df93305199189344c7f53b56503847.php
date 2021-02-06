<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content_title',"Dashboard"); ?>
<?php $__env->startSection('content_description',"Operate All The Things Here"); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<ol class="breadcrumb">
    <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>

    <div class="row">
            <!-- right column -->
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('Patient Records')); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                <?php if($patient): ?>
                <form class="form-horizontal" action="<?php echo e(route('update-patient-records')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo e(__('Basic Information -')); ?></label>
                        </div> 
                        <div style="border-style:groove;border-spacing:2px;">                        
                            <div class="form-group">
                                 <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Full Name')); ?></label>
                                <div class="col-sm-6">
                                    <input  value="<?php echo e($patient->name); ?>" disabled="disabled" type="text" required class="form-control" name="patient_name"
                                        placeholder="Enter Patient Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Symptoms')); ?></label>
                                <div class="col-sm-6">
                                    <?php //print_r($symptoms);die;?>
                                    <select class="form-control select2-multi" multiple="multiple" name="patient_symptoms[]" id="patient_symptoms">
                                        <?php $__currentLoopData = $symptoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symptom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($symptom->id); ?>" <?php if(in_array($symptom->id,explode(',', $patient->symptom_id))) {?>selected <?php }?>><?php echo e(ucWords($symptom->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Arrival')); ?></label>
                                <div class="col-sm-6">                               
                                    <select class="form-control select2-multi" multiple="multiple" name="patient_arrival_name[]" id="patient_arrival_name">
                                        <option value="">Select Arrival</option>
                                        <?php $__currentLoopData = $arrival; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($avl->id); ?>" <?php if(in_array($avl->id,explode(',', $patient->arrival_id))) {?>selected <?php }?>><?php echo e(ucWords($avl->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Investigation Type')); ?></label>
                                <div class="col-sm-6">                                
                                    <select class="form-control select2-multi" multiple="multiple" name="patient_investigation_type[]" id="patient_investigation_type">
                                        <option value="">Select Investigation Type</option>
                                        <?php $__currentLoopData = $investigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($inv->id); ?>" <?php if(in_array($inv->id,explode(',', $patient->investigation_id))) {?>selected <?php }?>><?php echo e(ucWords($inv->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                        </div>


                       <!--  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Full Name')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->name); ?>" disabled="disabled" type="text" required class="form-control" name="patient_name"
                                    placeholder="Enter Patient Full Name">
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Symptoms')); ?></label>
                            <div class="col-sm-10">
                                <?php //print_r($symptoms);die;?>
                            <select class="form-control select2-multi" multiple="multiple" name="patient_symptoms[]" id="patient_symptoms">
                                <?php $__currentLoopData = $symptoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symptom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($symptom->id); ?>" <?php if(in_array($symptom->id,explode(',', $patient->symptom_id))) {?>selected <?php }?>><?php echo e(ucWords($symptom->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Arrival')); ?></label>
                            <div class="col-sm-10">                               
                                <select class="form-control select2-multi" multiple="multiple" name="patient_arrival_name[]" id="patient_arrival_name">
                                    <option value="">Select Arrival</option>
                                    <?php $__currentLoopData = $arrival; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($avl->id); ?>" <?php if(in_array($avl->id,explode(',', $patient->arrival_id))) {?>selected <?php }?>><?php echo e(ucWords($avl->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div> -->
                       <!--  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Investigation Type')); ?></label>
                            <div class="col-sm-10">                                
                                <select class="form-control select2-multi" multiple="multiple" name="patient_investigation_type[]" id="patient_investigation_type">
                                    <option value="">Select Investigation Type</option>
                                    <?php $__currentLoopData = $investigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($inv->id); ?>" <?php if(in_array($inv->id,explode(',', $patient->investigation_id))) {?>selected <?php }?>><?php echo e(ucWords($inv->type)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Investigation Name')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->investigation); ?>" disabled="disabled" type="text" required class="form-control" name="patient_investigation"
                                    placeholder="Enter Patient Investigation">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo e(__('Vitals -')); ?></label>
                        </div>
                        <div style="border-style:groove;border-spacing:2px;">                        
                            <div class="form-group">
                                 <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Temprature')); ?></label>
                                <div class="col-sm-2">
                                    <input  type="text" value="<?php echo e($patient->temprature); ?>" required class="form-control" name="temprature"
                                        placeholder="Enter Patient Temprature ">
                                </div>

                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('RR')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->rr); ?>" type="tel" class="form-control" name="patient_rr"
                                        placeholder="Patient RR">
                                </div>

                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Pulse Rate')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->pulse_rate); ?>" type="text" required class="form-control" name="pulse_rate"
                                        placeholder="Enter Patient Pulse Rate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo e(__('CRT')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->crt); ?>" type="text" required class="form-control" name="patient_crt"
                                        placeholder="Enter Patient CRT ">
                                </div>

                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('BP')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->bp); ?>" type="text" required class="form-control" name="patient_bp"
                                        placeholder="Enter Patient BP">
                                </div>

                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('SPO2')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->spo2); ?>" type="text" required class="form-control" name="patient_spo2"
                                        placeholder="Enter Patient SPO2">
                                </div>
                            </div> 
                        </div>   
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo e(__('Anthropology -')); ?></label>
                        </div> 
                        <div style="border-style:groove;border-spacing:2px;">                        
                            <div class="form-group">
                                 <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Weight')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->weight); ?>" type="text" required class="form-control" name="patient_weight"
                                        placeholder="Enter Patient Weight">
                                </div>

                               <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Ht & Lt')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->ht_lt); ?>" type="text" required class="form-control" name="patient_ht_lt"
                                        placeholder="Enter Patient HT & LT">
                                </div>

                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Mu & Ac')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->mu_ac); ?>" type="text" required class="form-control" name="patient_mu_ac"
                                        placeholder="Enter Patient MU & AC">
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Weight & Legnth')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->weight_legnth); ?>" type="text" required class="form-control" name="patient_weight_legnth"
                                        placeholder="Enter Patient Weight & Legnth">
                                </div>
                            </div>

                        </div>                
<!--                         <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Temprature')); ?></label>
                            <div class="col-sm-10">
                                <input  type="text" value="<?php echo e($patient->temprature); ?>" required class="form-control" name="temprature"
                                    placeholder="Enter Patient Temprature ">
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('RR')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->rr); ?>" type="tel" class="form-control" name="patient_rr"
                                    placeholder="Patient RR">
                            </div>
                        </div> -->
                       <!--  <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Pulse Rate')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->pulse_rate); ?>" type="text" required class="form-control" name="pulse_rate"
                                    placeholder="Enter Patient Pulse Rate">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('BP')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->bp); ?>" type="text" required class="form-control" name="patient_bp"
                                    placeholder="Enter Patient BP">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('SPO2')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->spo2); ?>" type="text" required class="form-control" name="patient_spo2"
                                    placeholder="Enter Patient SPO2">
                            </div>
                        </div> -->

                       <!--  <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Weight')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->weight); ?>" type="text" required class="form-control" name="patient_weight"
                                    placeholder="Enter Patient Weight">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Ht & Lt')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->ht_lt); ?>" type="text" required class="form-control" name="patient_ht_lt"
                                    placeholder="Enter Patient HT & LT">
                            </div>
                        </div> -->

                       <!--  <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Mu & Ac')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->mu_ac); ?>" type="text" required class="form-control" name="patient_mu_ac"
                                    placeholder="Enter Patient MU & AC">
                            </div>
                        </div> -->

                       <!--  <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Weight & Legnth')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->weight_legnth); ?>" type="text" required class="form-control" name="patient_weight_legnth"
                                    placeholder="Enter Patient Weight & Legnth">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo e(__('Examinations -')); ?></label>
                        </div> 
                        <div style="border-style:groove;border-spacing:2px;">                        
                            <div class="form-group">                               
                                <label for="inputEmail3" class="col-sm-3 control-label"><?php echo e(__('Systemic Examination')); ?></label>
                                <div class="col-sm-4">                                
                                    <select class="form-control select2-multi" multiple="multiple" name="patient_systemic_examination[]" id="patient_systemic_examination">
                                        <option value="">Select Systemic Examination</option>
                                        <?php $__currentLoopData = $systematicexam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($exa->id); ?>" <?php if(in_array($exa->id,explode(',', $exa->systemic_examination))) {?>selected <?php }?>><?php echo e(ucWords($exa->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Treatment Info')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->treatment_info); ?>" type="text" required class="form-control" name="patient_treatment_info"
                                        placeholder="Enter Patient Treatment Info">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label"><?php echo e(__('General Examination')); ?></label>
                                <div class="col-sm-4">                                
                                    <select class="form-control select2-multi" multiple="multiple" name="patient_general_examination[]" id="patient_general_examination">
                                        <option value="">Select General Examination</option>
                                        <?php $__currentLoopData = $generalexam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ge->id); ?>" <?php if(in_array($ge->id,explode(',', $ge->general_examination_id))) {?>selected <?php }?>><?php echo e(ucWords($ge->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Diagnosis Info')); ?></label>
                                <div class="col-sm-2">
                                    <input  value="<?php echo e($patient->diagnosis_info); ?>" type="text" required class="form-control" name="patient_diagnosis_info"
                                        placeholder="Enter Patient Diagnosis Info">
                                </div>
                            </div>
                            <!-- <div class="form-group">

                               

                                
                                
                            </div> -->
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label"><?php echo e(__('Report')); ?></label>
                                <div class="col-sm-4">
                                    <input  value="<?php echo e($patient->report); ?>" type="text" required class="form-control" name="patient_report"
                                        placeholder="Enter Patient Report">
                                </div>

                                 <label class="col-sm-2 control-label"><?php echo e(__('Date')); ?></label>
                                <div class="col-sm-2 date">
                                    <input type="date" value="<?php echo e($patient->date); ?>" required max="2014-12-30" class="form-control pull-right"
                                        name="patient_date" placeholder="Enter Patient Date">
                                </div>
                            </div>

                        </div>
                       

                        <!-- select -->
                        <div class="form-group">   
                        </div>
                        <div class="form-group">                            
                            <input readonly value="<?php echo e($patient->id); ?>" type="text" class="form-control pull-right" name="reg_pid" style="display:none">

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                            </div>

                            <div class="col-sm-3">
                                <a href="<?php echo e(url('/investigation-sheet/' . $patient->patient_id)); ?>" class="btn btn-danger pull-right">Investigation Sheet</a>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> 
<script>
    
    $(document).ready(function() {
        $("#patient_symptoms").select2();
        $("#patient_arrival_name").select2();
        $("#patient_investigation_type").select2();
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hospital-managment-system\resources\views/patient/patient_record_view.blade.php ENDPATH**/ ?>