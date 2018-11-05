<?php $loggedin_user = $this->session->userdata('userdata'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <!-- /.card-header -->
            <div class="card-body">
                <?php if($questions): ?>
                <form id="student_exam_form" method="post" role="form"
                      data-action="<?php echo site_url('online_test/save_exam') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="total_questions" value="<?php echo count($questions); ?>">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                    <input type="hidden" name="exam_id" value="<?php echo isset($questions[0])?$questions[0]['exam_id']:''; ?>">
                    <?php $count = 1; foreach($questions as $question): $options = explode(',',$question['answer_options']); ?>
                        <fieldset class="form-group">
                            <legend><?php echo "Q".$count; ?> - <?php echo $question['question']; ?></legend>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="<?php echo $question['id']; ?>"  value="1">
                                    <?php echo $options[0]; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="<?php echo $question['id']; ?>"  value="2">
                                    <?php echo $options[1]; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="<?php echo $question['id']; ?>"  value="3">
                                    <?php echo $options[2]; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="<?php echo $question['id']; ?>"  value="4">
                                    <?php echo $options[3]; ?>
                                </label>
                            </div>
                        </fieldset>
                        <?php $count++; endforeach; ?>
                    <?php if($loggedin_user['name'] != 'admin'): ?>
                        <button id="student_exam_result" type="submit" class="btn btn-primary">Submit</button>
                    <?php endif; ?>
                </form>
                <?php else : ?>
                    <h3>No question(s) found</h3>
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>