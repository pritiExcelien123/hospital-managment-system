<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content_title',__("Patient")); ?>
<?php $__env->startSection('content_description',__("Patient List")); ?>
<?php $__env->startSection('breadcrumbs'); ?>

<ol class="breadcrumb">
    <li><a href="<?php echo e(route('dash')); ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>

<div style="margin-top:1vh;padding:3%" class="pb-0 row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <?php echo e(session()->get('success')); ?>

        </div>
        <?php endif; ?>
        
    </div>
    <div class="col-md-1"></div>
</div>

<div style="padding:3%" class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo e(__('Patient Lists')); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                    <br>
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Age')); ?></th>
                                <th><?php echo e(__('Father Name')); ?></th>
                                <th><?php echo e(__('Mobile NO.')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($app->name); ?></td>
                                <td><?php echo e($app->age); ?></td>
                                <td><?php echo e($app->father_name); ?></td>
                                <td><?php echo e($app->contactnumber); ?></td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" id="select_action" onchange="editPersonDetails(<?php echo e($app->id); ?>);">
                                            <option value="patient-record">Select action</option>
                                            <option value="patient-record">Case Record</option>
                                            <option value="treatment-sheet">Treatment & continuation Sheet</option>
                                            <option value="nurse-order-sheet">Nurse Order Sheet</option>
                                            <option value="monitoring-sheet">Nurse Monitoring Sheet</option>
                                            <option value="investigation-sheet">Investigation Sheet</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hospital-managment-system\resources\views/patient/patient_list_view.blade.php ENDPATH**/ ?>