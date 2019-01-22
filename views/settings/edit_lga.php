<div class="modal-header text-center">
    <h4 class="modal-title w-100 font-weight-bold">Save Origin</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="origin_form" method="post" role="form"
      data-action="<?php echo site_url('general_setting/add_origin') ?>" enctype="multipart/form-data">
    <input type="hidden" name="city_id" id="city_id" value="<?php echo $origin['id']; ?>">
    <div class="modal-body">
        <div class="form-group">
            <input type="text"  name="name" id="city_name" class="form-control validate" value="<?php echo $origin['name'] ?>" placeholder="City Name">
        </div>
        <div class="form-group">
            <select class="form-control select2" name="state_id" id="state_id">
                <option value="">Select a state</option>
                <?php foreach ($states as $state): ?>
                    <option value="<?php echo $state['id']; ?>"<?php echo $state['id']==$origin['state_id']?'selected':''; ?>>
                        <?php echo $state['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button id="save_origin" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Update Origin</button>
    </div>
</form>