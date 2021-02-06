<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content_title',__("Dashboard")); ?>
<?php $__env->startSection('content_description',__("Operate All The Things Here")); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<ol class="breadcrumb">
    <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>

<div class="row">
    <div class="m-0 col-md-12">
        <div class="pl-0 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-user-md"></i></span>
                <div class="info-box-content">
                    <h3><b><span class="info-box-text"><?php echo e(__('Doctors')); ?></span></b></h3>
                    <span class="info-box-number"><?php echo e($doctorcnt); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-id-card-alt"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text"><?php echo e(__('General Staff')); ?></span></b></h3>
                    <span class="info-box-number"><?php echo e($generalcnt); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-briefcase-medical"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text"><?php echo e(__('Pharmacists')); ?></span></b></h3>
                    <span class="info-box-number"><?php echo e($pharmacistcnt); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 pr-0 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-user-injured"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text"><?php echo e(__('In Patients')); ?></span></b></h3>
                    <span class="info-box-number"><?php echo e($inpatientcnt); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__('Quick Reports')); ?></h3>
            </div>
            <div class="box-body list-group">
                <?php if(Auth::user()->user_type=='doctor' || Auth::user()->user_type=='admin'): ?>
                <a href="<?php echo e(route('mon_stat_report')); ?>" class="list-group-item list-group-item-action btn btn-danger">
                   <?php echo e(__('Monthly Statistic Report')); ?>

                </a>
                <?php endif; ?>
                <?php if(Auth::user()->user_type=='doctor' || Auth::user()->user_type=='admin'): ?>
                <a href="<?php echo e(route('stats')); ?>" class="list-group-item mt-4 list-group-item-action btn btn-warning">
                    <?php echo e(__('Statistics')); ?>

                </a>
                <?php endif; ?>

                <a href="<?php echo e(route('attendance_report')); ?>"
                    class="list-group-item mt-4 list-group-item-action btn btn-success">
                    <?php echo e(__('Attendance Report')); ?>

                </a>
                <?php if(Auth::user()->user_type!='pharmacist'): ?>
                <a href="<?php echo e(route('clinic_reports')); ?>" class="list-group-item mt-4 list-group-item-action btn btn-info">
                    <?php echo e(__('Clinic Report')); ?>

                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-default col-md-12">

            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__('Quick Links')); ?></h3>
            </div>

            <div class="box-body">
                <?php if(Auth::user()->user_type!='pharmacist'): ?>
                <div class="col-sm-2">
                    <a href="<?php echo e(route('patient')); ?>" class="btn btn-app">
                        <i class="ion ion-person-add"></i> <?php echo e(__('Register out-patient')); ?>

                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('searchPatient')); ?>" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i><?php echo e(__('Search Patient')); ?>

                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('register_in_patient_view')); ?>" class="btn btn-app">
                        <i class="fa fa-procedures"></i> <?php echo e(__('Register in-Patient')); ?>

                    </a>
                </div>

                <?php if(Auth::user()->user_type!='general'): ?>
                <div class="col-sm-2">
                    <a href="<?php echo e(route('check_patient_view')); ?>" class="btn btn-app">
                        <i class="fa fa-heartbeat"></i> <?php echo e(__('Check Patient')); ?>

                    </a>
                </div>
                <?php endif; ?>
                


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('create_channel_view')); ?>" class="btn btn-app">
                        <i class="fa fa-plus-square"></i> <?php echo e(__('Create Appointment')); ?>

                    </a>
                </div>

                <?php endif; ?>

                <?php if(Auth::user()->user_type=='pharmacist' || Auth::user()->user_type=='admin'): ?>
                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('issueMedicineView')); ?>" class="btn btn-app">
                        <i class="fa fa-medkit"></i> <?php echo e(__('Issue Medicine')); ?>

                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="box-body">

                <div class="col-sm-2">
                    <a href="<?php echo e(route('myattend')); ?>" class="btn btn-app">
                        <i class="fa fa-user"></i> <?php echo e(__('My Attendance')); ?>

                    </a>
                </div>

                <?php if(Auth::user()->user_type=='admin'): ?>
                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('newuser')); ?>" class="btn btn-app">
                        <i class="fa fa-user-plus"></i> <?php echo e(__('Register User')); ?>

                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('regfinger')); ?>" class="btn btn-app">
                        <i class="fa fa-fingerprint"></i> <?php echo e(__('Register Fingerprints')); ?>

                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="<?php echo e(route('resetuser')); ?>" class="btn btn-app">
                        <i class="fa fa-user-edit"></i> <?php echo e(__('Reset Users')); ?>

                    </a>
                </div>
                <?php endif; ?>

                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="<?php echo e(route('profile')); ?>" class="btn btn-app">
                        <i class="fa fa-home"></i> <?php echo e(__('User Profile')); ?>

                    </a>
                </div>
                <?php if(Auth::user()->user_type=='admin'): ?>
                <div class="col-sm-2">
                    <a href="<?php echo e(route('createnoticeview')); ?>" class="btn btn-app">
                        <i class="fa fa-commenting"></i> <?php echo e(__('Notices')); ?>

                    </a>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__('Noticeboard')); ?></h3>
            </div>
            <div class="box-body">

                <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <b>
                                <h4 class="mb-1"><?php echo e($note->subject); ?></h4>
                            </b>
                            <small><?php echo e($note->time); ?></small>
                        </div>
                        <p class="mb-1"><?php echo e($note->description); ?></p>
                        <small>By <?php echo e($note->name); ?> (<?php echo e($note->user_type); ?>)</small>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($notices)==0): ?>
                <h3 class="text-center"><i class="fas fa-angle-double-left"></i>..........Empty..........<i
                        class="fas fa-angle-double-right"></i></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">

        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>
<script>
    // The Calender
    $('#calendar').datepicker();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hospital-managment-system\resources\views/dash.blade.php ENDPATH**/ ?>