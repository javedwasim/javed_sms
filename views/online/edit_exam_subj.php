<form id="subject_edit_form" method="post" role="form"
      data-action="<?php echo site_url('online_test/save_exam_subjects') ?>" enctype="multipart/form-data">
    <input type="hidden" name="subject_id" value="<?php echo isset($subject_id)?$subject_id:''; ?>">
    <div class="modal-body">
        <div class="form-group">
            <label>Select Course<span style="color: red;">*</span></label>
            <select class="form-control" name="course_id">
                <option value="">Select An Option</option>
                <?php foreach($classes as $class): ?>
                    <option value="<?php echo $class['id']; ?>"
                        <?php echo ($class_id == $class['id'])?'selected':''; ?>><?php echo $class['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Subject Name<span style="color: red;">*</span></label>
            <input autocomplete="off" name="subject_name" type="text" value="<?php echo isset($subject['subject_name'])?$subject['subject_name']:''; ?>"
                   placeholder="Enter subject name" class="form-control">
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="update_exam_subject" class="btn btn-sm btn-success pull-right add-btn"><i class="fa fa-floppy-o"></i> Update Subject</button>
    </div>
</form>