<form id="add_domain_indicator_form" method="post" role="form"
      data-action="<?php echo site_url('domains/add_domain_indicator') ?>" enctype="multipart/form-data">
    <input type="hidden" name="domain_group_id" value="<?php echo isset($domain_id)&&($domain_id>0)?$domain_id:''; ?>">
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Name:</label>
        <input type="text" class="form-control"  name="name" value="" required>
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Abbreviation:</label>
        <input type="text" class="form-control"  name="code" value="" required>
    </div>
    <div class="form-group">
        <label for="message-text" class="col-form-label">Description:</label>
        <textarea class="form-control" name="description" rows="5"></textarea>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button id="save_domain_indicator" type="submit" class="btn btn-primary">
            <?php if(isset($domain_id)): ?>
                <i class="fa fa-floppy-o"></i>
                Save Domain Indicator
            <?php else: ?>
                <i class="fa fa-plus"></i>
                Add Domain Indicator
            <?php endif; ?>
        </button>
    </div>
</form>