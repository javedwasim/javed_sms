<form id="exam_edit_question_form" method="post" role="form"
      data-action="<?php echo site_url('online_test/add_question') ?>" enctype="multipart/form-data">
    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>" >
    <div class="modal-body">
        <div id="add-form-panel" class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Select Exam<span style="color: red;">*</span></label>
                    <select class="form-control" name="exam_id">
                        <option value="">Select An Option</option>
                        <?php foreach ($examinations as $examination): ?>
                            <option value="<?php echo $examination['id']; ?>"<?php echo ($examination['id']==$question['exam_id'])?'selected':''; ?>>
                                <?php echo $examination['exam_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Question<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="text"  value="<?php echo $question['question']; ?>"
                           placeholder="Enter the question" name="question" class="form-control">
                </div>
                <?php $options = explode(',',$question['answer_options']);?>
                <div class="form-group">
                    <label>Answer option 1<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="text" name="answer_option[]" value="<?php echo $options[0] ?>"
                           placeholder="Enter answer option 1" class="form-control">
                </div>
                <div class="form-group">
                    <label>Answer option 2<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="text" name="answer_option[]" value="<?php echo $options[1] ?>"
                           placeholder="Enter answer option 2" class="form-control">
                </div>
                <div class="form-group">
                    <label>Answer option 3<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="text" name="answer_option[]" value="<?php echo $options[2] ?>"
                           placeholder="Enter answer option 3" class="form-control">
                </div>
                <div class="form-group">
                    <label>Answer option 4<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="text" name="answer_option[]" value="<?php echo $options[3] ?>"
                           placeholder="Enter answer option 4" class="form-control">
                </div>
                <div class="form-group">
                    <label>Correct Answer<span style="color: red;">*</span></label>
                    <div class="radio">
                        <label><input type="radio" name="correct_ans" value="1" <?php echo ($question['correct_answer_id'] == 1)?'checked':''; ?>>Option 1</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="correct_ans" value="2" <?php echo ($question['correct_answer_id'] == 2)?'checked':''; ?>>Option 2</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="correct_ans" value="3" <?php echo ($question['correct_answer_id'] == 3)?'checked':''; ?>>Option 3</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="correct_ans" value="4" <?php echo ($question['correct_answer_id'] == 4)?'checked':''; ?>>Option 4</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="update_question" class="btn btn-sm btn-success pull-right add-btn"><i class="fa fa-plus"></i>Update Question</button>
    </div>
</form>