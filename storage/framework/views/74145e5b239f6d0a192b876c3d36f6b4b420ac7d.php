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
                    <h3 class="box-title"><?php echo e(__('Edit Patient')); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                

                <?php if($patient): ?>
                <form class="form-horizontal" action="<?php echo e(route('updatepatientdetails')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('Full Name')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->name); ?>" type="text" required class="form-control" name="reg_pname"
                                    placeholder="Enter Patient Full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo e(__('NIC Number')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->nic); ?>" type="text" required class="form-control" name="reg_pnic"
                                    placeholder="National Identity Card Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Address')); ?></label>
                            <div class="col-sm-10">
                                <input  type="text" value="<?php echo e($patient->address); ?>" required class="form-control" name="reg_paddress"
                                    placeholder="Enter Patient Address ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Telephone')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->telephone); ?>" type="tel" class="form-control" name="reg_ptel"
                                    placeholder="Patient Telephone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo e(__('Occupation')); ?></label>
                            <div class="col-sm-10">
                                <input  value="<?php echo e($patient->occupation); ?>" type="text" required class="form-control" name="reg_poccupation"
                                    placeholder="Enter Patient Occupation ">
                            </div>
                        </div>

                        <!-- select -->
                        <div class="form-group">

                            <label class="col-sm-2 control-label"><?php echo e(__('Sex')); ?></label>
                            <div class="col-sm-2 mr-0 pr-0">
                                <input  value="<?php echo e($patient->sex); ?>" type="text" required class="form-control" name="reg_psex"
                                    placeholder="Enter Patient Occupation ">
                            </div>

                            <label class="col-sm-2 control-label"><?php echo e(__('DOB')); ?><span style="color:red">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input  value="<?php echo e($patient->bod); ?>" type="text" class="form-control pull-right" name="reg_pbd"
                                        placeholder="Birthday">
                                    </div>
                                </div>
                                <input readonly value="<?php echo e($patient->id); ?>" type="text" class="form-control pull-right" name="reg_pid" style="display:none">

                            <div class="col-sm-3">
                                        <button type="submit" class="btn btn-danger pull-right"><i class="fas fa-update"></i> Update </button>
                                </div>

                        </div>


                    </div>

                </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hospital-managment-system\resources\views/patient/edit_patient_view.blade.php ENDPATH**/ ?>