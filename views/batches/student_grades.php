<div class="row">
    <div class="col-md-6">
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title">Student List</h5>
                    <hr>
                    <ul class="list-group">
                        <?php foreach ($students as $student): $admission_no = $student['admission_no']; ?>
                            <a href="javascript:void(0)" class="<?php echo !empty($domain_indicators)?'student_grade_link':'' ?>" data-href="<?php echo $student['student_id'] ?>" data-action="<?php echo base_url()."batches/get_student_grade"; ?>">
                                <li class="list-group-item list-group-item-warning"><?php echo $student['first_name'].' '.$student['last_name'],"($admission_no)"; ?></li></a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- /.card -->

        </div>
    </div>
    <div class="col-md-6">
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="card card-primary card-outline">
                <div id="student_behaviour_score_model">
                    <div class="card-body">
                        <h5 class="card-title"><?php $session = $current_batch_info['session'];
                            echo $current_batch_info['code'].'-'.$current_batch_info['arm']."($session) behavioural scoresheet"; ?></h5>
                        <hr/>
                        <form id="student_behavioural_score_form" method="post" role="form"  data-action="<?php echo site_url('Batches/save_student_behavioural_score') ?>"
                              enctype="multipart/form-data">
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="grade_scale_id" id="grade_scale_id" value="2">
                            <input type="hidden" name="term_id" id="term_id" value="1">
                            <input type="hidden" name="batch_id" id="sbatch_id" value="<?php echo $batch_id; ?>">
                            <div class="form-group row" style="background-color: lightgrey;">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Affective Domain</label>
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Grade</label>
                            </div>
                            <?php foreach ($domain_indicators as $indicator): ?>
                                <div class="form-group row" style="background-color: #f9f9f9;">
                                    <label for="punctuality" class="col-sm-6 col-form-label"><?php echo $indicator['name']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="custom-select mr-sm-2" name="<?php echo strtolower($indicator['name']); ?>" id="<?php echo strtolower($indicator['name']); ?>">
                                            <option value="">Please Select</option>
                                            <?php foreach($scales as $scale): ?>
                                                <option value="<?php echo $scale['id']; ?>"><?php echo $scale['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="form-group row">
                                <div class="col-sm-10" style="text-align: center">
                                    <button type="submit" id="save_student_grade" class="btn btn-primary"><i class="fa fa-floppy-o"></i>Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>