<form id="report_card_group_form" method="post" role="form"  data-action="<?php echo site_url('reportcard/save') ?>" enctype="multipart/form-data">
    <input type="hidden" name="report_id" value="<?php echo $report['id']; ?>">
    <div class="modal-body">
        <div class="form-group row">
            <label for="name" class="col-sm-5 col-form-label">Name<span style="color: red">*</span></label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $report['name']; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="course_set_id" class="col-sm-5 col-form-label">Class Set<span style="color: red">*</span></label>
            <div class="col-sm-7">
                <select class="form-control" name="course_set_id" id="course_set_id">
                    <option value="">Please Select</option>
                    <?php foreach ($class_set as $set): ?>
                        <option value="<?php echo $set['id']; ?>"<?php echo $set['id'] == $report['course_set_id']?'selected':''; ?>><?php echo $set['session'].' '.$set['code'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="report_card_template_id" class="col-sm-5 col-form-label">Template</label>
            <div class="col-sm-7">
                <select class="form-control" name="report_card_template_id" id="report_card_template_id">
                    <option value="">Please Select</option>
                    <?php foreach ($class_set as $set): ?>
                        <option value="<?php echo $set['id'] ?>"><?php echo $set['session'].' '.$set['code'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="report_type" class="col-sm-5 col-form-label">Report type<span style="color: red">*</span></label>
            <div class="col-sm-7">
                <select class="form-control" name="report_type" id="report_type">
                    <option value="">Please select</option>
                    <option value="progress"<?php echo $report['report_type']=='progress'?'selected':''; ?>>Progress</option>
                    <option value="final"<?php echo $report['report_type']=='final'?'selected':''; ?>>Final</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="report_card_group_for" class="col-sm-5 col-form-label">For<span style="color: red">*</span></label>
            <div class="col-sm-7">
                <select class="form-control" name="report_card_group_for" id="report_card_group_for">
                    <option value="">Please select</option>
                    <option value="first_term"<?php echo $report['report_card_group_for']=='first_term'?'selected':''; ?>>First term</option>
                    <option value="second_term"<?php echo $report['report_card_group_for']=='second_term'?'selected':''; ?>>Second term</option>
                    <option value="third_term"<?php echo $report['report_card_group_for']=='third_term'?'selected':''; ?>>Third term</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="published" class="col-sm-5 col-form-label">Published<span style="color: red">*</span></label>
            <div class="col-sm-7">
                <input type="checkbox" class="form-control" id="published" name="published" value="1" <?php echo $report['published']==1?'checked':''; ?>>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-5 col-form-label">Status <?php echo $report['status'];?><span style="color: red">*</span></label>
            <div class="col-sm-7">
                <input type="checkbox" class="form-control" id="status" name="status" value=1" <?php echo $report['status']==1?'checked':''; ?>>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center">
            <button type="submit" class="btn btn-primary" id="save_report_card_group">
                <i class="fa fa-floppy-o"></i>Update Report Card Group
            </button>
        </div>
    </div>
</form>