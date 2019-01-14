<form role="form" id="fee_management_form" method="post"
      data-action="<?php echo site_url('fee_management/create_fee'); ?>" enctype="multipart/form-data">
    <input type="hidden" value="1" name="status">
    <input type="hidden"  name="fee_group_id" value="<?php echo $fee_group['id']; ?>">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="fee_type_id">Fee Type<span style="color: red">*</span></label>
                        <select class="form-control" name="fee_type_id" id="fee_type_id">
                            <option value="">Select</option>
                            <?php foreach ($fee_types as $fee_type): ?>
                                <option value=<?php echo $fee_type['id']; ?>
                                    <?php echo isset($fee_group) && ($fee_group['fee_type_id']==$fee_type['id'])?'selected':''; ?>><?php echo $fee_type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description<span style="color: red">*</span></label>
                        <textarea class="form-control" required="" rows="5" name="description" id="fee_description"><?php echo isset($fee_group)?$fee_group['description']:''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="amount_paid" name="amount" value="<?php echo isset($fee_group)?$fee_group['amount']:''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fee_date">Start Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo isset($fee_group)?$fee_group['start_date']:''; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="fee_date">Due Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="due_dt" name="due_date" value="<?php echo isset($fee_group)?$fee_group['due_date']:''; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="batch_id">Batch<span style="color: red">*</span></label>
                        <select class="custom-select custom-select-md "
                                name="batch_id" id="batch_id" <?php echo !empty($batch_id)?'':''; ?>>
                            <option>Please select student</option>
                            <?php foreach ($batches as $batch):$session = $batch['session']; ?>
                                <option value="<?php echo $batch['id']; ?>"<?php echo isset($fee_group)&&($fee_group['batch_id'] == $batch['id']) ? 'selected' : '' ?>>
                                    <?php echo $batch['code'] . '-' . $batch['arm'] . "($session)"; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer" style="text-align: center">
                    <button type="submit" id="update_fee_btn" class="btn btn-primary">
                        <i class="fa fa-save"></i>Update Fee Group</button>
                </div>
            </div>

        </div>

    </div>
</form>

<script>
    $(document).ready(function () {

        $('#date_payment').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#due_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#due_dt').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });


    });


</script>