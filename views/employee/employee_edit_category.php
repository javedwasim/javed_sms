<form id="employee_cat_update" method="post" role="form" data-action="<?php echo site_url('employee_setting/update_employee_category') ?>" enctype="multipart/form-data">
    <input type="hidden" id="category_id" name="category_id" value="<?php echo $category['id']; ?>">
    <div class="modal-body mx-3">
        <div class="md-form mb-6">
            <input type="text" id="category_name_update" name="category"
                   value="<?php echo $category['category']; ?>" class="form-control validate" placeholder="Category Name">
        </div>
    </div>
    <div class="modal-body mx-3">
        <div class="md-form mb-6">
            <select class="form-control" name="role_id">
                <option value="">Select a role</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['id']; ?>"<?php echo $category['role_id']==$role['id']?'selected':''; ?>><?php echo $role['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button id="update_employee_category" type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i> Update Employee Category</button>
    </div>
</form>