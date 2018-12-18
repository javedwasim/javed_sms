<?php $user_data = $this->session->userdata('userdata'); $role = $user_data['role']; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fee Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">fees</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="student_error" style="display: none;" class="alert alert-danger alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="student_success" style="display: none;" class="alert alert-success alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Fee Group</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i>Add Fee</button>
                                </div>
                            </div>
                            <hr/>
                            <form rol="form" style="width: 100%;" id="fee_group_filter_form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fee Type</label>
                                            <select class="form-control st_filter" name="fee_type">
                                                <option value="">All</option>
                                                <?php foreach ($fee_types as $type): ?>
                                                    <option value="<?php echo $type['id'] ?>"<?php echo !empty($filter)&&($filter['fee_type']==$type['id'])?'selected':''; ?>>
                                                        <?php echo $type['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Fee Balance</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select class="form-control st_filter" name="balance_filter">
                                                        <option value="greater"<?php echo !empty($filter['balance_filter']) && ($filter['balance_filter']=='greater') ? 'selected' : ''; ?>>&gt;</option>
                                                        <option value="less"<?php echo !empty($filter['balance_filter']) && ($filter['balance_filter']=='less') ? 'selected' : ''; ?>>&lt;</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control"
                                                       value="<?php echo !empty($filter['due_balance']) ? $filter['due_balance'] : ''; ?>"
                                                       aria-label="Text input with dropdown button" name="due_balance">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="fee_status">
                                                <option value=""></option>
                                                <option value="inactive"
                                                    <?php echo !empty($filter['fee_status'])&&($filter['fee_status']=='inactive')?'selected':''; ?>>
                                                    Inactive</option>
                                                <option value="active"
                                                    <?php echo !empty($filter['fee_status'])&&($filter['fee_status']=='active')?'selected':''; ?>>
                                                    Active</option>
                                                <option value="hold"
                                                    <?php echo !empty($filter['fee_status'])&&($filter['fee_status']=='hold')?'selected':''; ?>>
                                                    Hold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input class="form-control due_date" type="text" name="due_date"
                                                   value="<?php echo !empty($filter['due_date'])?$filter['due_date']:''; ?>"  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input class="form-control" type="text" name="start_date"
                                                  value="<?php echo !empty($filter['start_date'])?$filter['start_date']:''; ?>" id="date_created" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary btn-md" id="fee_group_filter">
                                                <i class="fa fa-search"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="fee_management_table" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Fee Type</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Associated with</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                        <tr>
                                            <td><?php echo $payment['fee_name']; ?></td>
                                            <td><?php echo $payment['description']; ?></td>
                                            <td><?php echo $payment['amount']; ?></td>
                                            <td><?php echo date('F j, Y',strtotime($payment['start_date'])); ?></td>
                                            <td><?php echo date('F j, Y',strtotime($payment['due_date'])); ?></td>
                                            <td><?php echo $payment['status']==1?'Active':''; ?></td>
                                            <td><?php echo $payment['code'] . '-' . $payment['arm'] . '(' . $payment['session'] . ')' ?></td>
                                            <td><?php echo date('F j, Y',strtotime($payment['created_at'])); ?></td>
                                            <td>
                                                <a class="edit-fee-group btn btn-info btn-xs" href="javascript:void(0)"
                                                   data-action="<?php echo site_url('fee_management/edit_fee_group/').$payment['id']; ?>">
                                                   <i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                                <a class="delete-fee-group btn btn-danger btn-xs" href="#"
                                                   data-href="<?php echo site_url('fee_management/delete_fee_group/').$payment['id']; ?>">
                                                   <i class="fa fa-trash icon-margin" title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 font-weight-bold" style="text-align: center">Save Fee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="fee_group_form_container">
                        <form role="form" id="fee_management_form" method="post"
                              data-action="<?php echo site_url('fee_management/create_fee'); ?>" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="status">
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
                                                            <?php echo isset($fee_type_id) && ($fee_type_id==$fee_type['id'])?'selected':''; ?>><?php echo $fee_type['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description<span style="color: red">*</span></label>
                                                <textarea class="form-control" required="" rows="5" name="description" id="fee_description"><?php echo isset($description)?$description:''; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount_paid">Amount<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="amount_paid" name="amount" value="<?php echo isset($amount_paid)?$amount_paid:''; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="fee_date">Start Date<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo isset($fee_date)?$fee_date:''; ?>" autocomplete="off" />
                                            </div>
                                            <div class="form-group">
                                                <label for="fee_date">Due Date<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="due_dt" name="due_date" value="<?php echo isset($fee_date)?$fee_date:''; ?>" autocomplete="off" />
                                            </div>
                                            <div class="form-group">
                                                <label for="batch_id">Batch<span style="color: red">*</span></label>
                                                <select class="custom-select custom-select-md "
                                                        name="batch_id" id="batch_id" <?php echo !empty($batch_id)?'':''; ?>>
                                                    <option>Please select student</option>
                                                    <?php foreach ($batches as $batch):$session = $batch['session']; ?>
                                                        <option value="<?php echo $batch['id']; ?>"<?php echo $batch_id == $batch['id'] ? 'selected' : '' ?>>
                                                            <?php echo $batch['code'] . '-' . $batch['arm'] . "($session)"; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="text-align: center">
                                            <button type="submit" id="add_fee_btn" class="btn btn-primary">
                                                <i class="fa fa-plus"></i>Add Fee Group</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function () {
        $("#fee_management_table").DataTable({
            "scrollX": true
        });

        $('#date_payment').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('.due_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#due_dt').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        }).datepicker("setDate", new Date());

        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        }).datepicker("setDate", new Date());

        $('#date_created').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('.select2').select2();

    });
    function add_payment(value) {
        var base_url = $('#base').val();
        $.ajax({
            url: base_url+'fee_management/get_batch_students',
            data: {batch_id:value},
            type: 'post',
            cache: false,
            success: function (response) {
                if (response.employee_html != '') {
                    $('.batch-students').empty();
                    $('.batch-students').append(response);
                }
            }
        });
    }

    $('#exampleModal').on('hidden.bs.modal', function () {
        $('#fee_type_id').val('');
        $('#fee_description').val('');
        $('#amount_paid').val('');
        $('#start_date').val('');
        $('#due_dt').val('');
        $('#batch_id').val('');
    })

</script>