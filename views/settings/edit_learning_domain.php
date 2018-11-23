<div class="modal-header text-center">
    <h4 class="modal-title w-100 font-weight-bold"><?php echo $batch['session']; ?>&nbsp;Learning Domain Setup</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="class_set_form" method="post" role="form"
      data-action="<?php echo site_url('general_setting/update_class_set_domain') ?>" enctype="multipart/form-data">
    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
    <input type="hidden" name="session" value="<?php echo $session; ?>">
    <div class="modal-body">
        <div class="form-group">
            <select class="form-control" name="affective_domain">
                <option value="">none</option>
                <?php foreach ($domain['affective'] as $affective): ?>
                    <option value="<?php echo $affective['id']; ?>"<?php echo in_array($affective['id'], $class_set_domains)?'selected':''; ?>><?php echo $affective['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="phychomotor_domain">
                <option value="">none</option>
                <?php foreach ($domain['pychomotor'] as $pychomotor): ?>
                    <option value="<?php echo $pychomotor['id']; ?>"<?php echo in_array($pychomotor['id'], $class_set_domains)?'selected':''; ?>><?php echo $pychomotor['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button id="save_class_set_domain" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
    </div>
</form>