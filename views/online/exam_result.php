<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Exam Result</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Exam Result</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="class_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="class_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Exam result by student</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- START main content-->
                                <div class="col-lg-12">
                                    <div id="search-by-student-form-panel" class="panel panel-default">
                                        <div class="panel-body">
                                            <form id="student_result_form" method="post" role="form"
                                                  data-action="<?php echo site_url('online_test/student_exam_result') ?>" enctype="multipart/form-data">
                                                <?php if(empty($student_data)): ?>
                                                    <div class="form-group">
                                                        <label>Student ID<span style="color: red;">*</span></label>
                                                        <select name="student_id" class="form-control m-b select2">
                                                            <option value="">Select an student</option>
                                                            <?php foreach ($students as $student): ?>
                                                                <option value="<?php echo $student['student_id']; ?>"><?php echo $student['first_name'].' '.$student['surname']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group">
                                                    <label>Select Exam<span style="color: red;">*</span></label>
                                                    <select name="exam_id" class="form-control m-b">
                                                        <option value="">Select an option</option>
                                                        <?php foreach ($examinations as $examination): ?>
                                                            <option value="<?php echo $examination['id']; ?>"><?php echo $examination['exam_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?php if(empty($student_data)): ?>
                                                    <select prompt="Select Batch" class="form-control" required="required"
                                                            name="batch_no">
                                                        <option value="">Please select batch</option>
                                                        <?php $priorGroup = "";
                                                        foreach ($batches as $batch){ ?>
                                                        <?php if ($batch["session"] != $priorGroup){ ?>
                                                        <optgroup label="<?php echo $batch['session']; ?>">
                                                            <?php } ?>
                                                            <option value="<?php echo $batch['id']; ?>">
                                                                <?php echo $batch['code'] . '-' . $batch['arm'] . '(' . $batch['session'] . ')' ?>
                                                            </option>
                                                            <?php $priorGroup = $batch["session"];
                                                            }
                                                            if ($batch["session"] != $priorGroup) {
                                                                echo '</optgroup>';
                                                            } ?>
                                                    </select>
                                                <?php endif; ?>
                                                <button id="student_result_summary" type="submit" class="btn btn-sm btn-success pull-right get-btn"><i class="fa fa-plus"></i> Get Student Result</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div id="result_container"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content -->