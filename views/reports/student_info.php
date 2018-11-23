<div class="row">
    <div class="col-sm-5" >
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td class="field-label">Name</td>
                <td class="field-value"><?php echo isset($student)?$student['surname'].' '.$student['first_name'].' '.$student['last_name']:''; ?></td>
            </tr>
            <tr>
                <td class="field-label">Adm. No.</td>
                <td class="field-value"><?php echo isset($student)?$student['username']:''; ?></td>
            </tr>
            <tr>
                <td class="field-label">Gender</td>
                <td class="field-value"><?php echo isset($student)?$student['gender']:''; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-5">
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td class="field-label">Batch</td>
                <td class="field-value"><?php echo isset($student)?$student['code'].'-'.$student['arm'].'('.$student['session'].')':''; ?></td>
            </tr>
            <tr>
                <td class="field-label">Next Term Begins</td>
                <td class="field-value">
                    <?php if(isset($term_id) && ($term_id==1)): ?>
                        <?php echo date('F j, Y', strtotime($student['second_term_start'])); ?>
                    <?php elseif(isset($term_id) && ($term_id==2)): ?>
                        <?php echo date('F j, Y', strtotime($student['third_term_start'])); ?>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="btn-group pull-right" style="height: 20%">
        <form id="student_report_form" method="post" role="form" target="_blank"
             action="<?php echo site_url('reportcard/createPdf') ?>" enctype="multipart/form-data">
            <input type="hidden" name="student_id" id="student_id" value="<?php echo $student['student_id']; ?>">
            <input type="hidden" name="term_id" id="term_id" value="<?php echo $term_id; ?>">
            <a class="btn btn-primary"  href="javascript:void(0)" id="student_report_btn">
                <i class="fa fa-file-pdf-o"></i>PDF</a>
        </form>
    </div>
</div>

<div class="modal fade" id="add_report_comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit comment-
                    <?php echo isset($student)?$student['surname'].', '.$student['first_name']:''; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="report_comment_form" method="post" role="form"
                      data-action="<?php echo site_url('reportcard/save_comment') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="batch_id" value="<?php echo $student['batch_no']; ?>">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                    <input type="hidden" name="term_id" value="<?php echo $term_id; ?>">
                    <input type="hidden" name="commented_by" id="commented_by">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Comment<span style="color: red">*</span>:</label>
                        <textarea class="form-control" maxlength="250" rows="3"name="comment"></textarea>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="save_report_comment" type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>