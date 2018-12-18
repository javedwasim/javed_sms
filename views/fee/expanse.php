<?php
$user_data = $this->session->userdata('userdata');
$user_name = $user_data['name'];
$role = $user_data['role'];
?>
<div class="content-wrapper" style="clear: both;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fee Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">fee</a></li>
                        <li class="breadcrumb-item active">management</li>
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
                    <div class="card card-primary">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#invoices" data-toggle="tab">Invoices</a></li>
                                <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">History</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="invoices">
                                    <?php if(($user_name == 'admin') || ($role == 'Finance')): ?>
                                        <form data-action="<?php echo site_url('fee_management/student_fee_status') ?>"
                                              id="student_fee_form" method="post" role="form"enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-3" style="margin-top: 20px">
                                                    <div class="form-group">
                                                        <select prompt="Select Batch" class="form-control" required="required"
                                                               id="batch_no" name="batch_no">
                                                            <option value="0">All</option>
                                                            <?php $priorGroup = "";
                                                            foreach ($batches as $batch){ ?>
                                                            <?php if ($batch["session"] != $priorGroup){ ?>
                                                            <optgroup label="<?php echo $batch['session']; ?>">
                                                                <?php } ?>
                                                                <option value="<?php echo $batch['id']; ?>"<?php echo isset($filter)&&($filter['batch_no']==$batch['id'])?'selected':''; ?>>
                                                                    <?php echo $batch['code'] . '-' . $batch['arm'] . '(' . $batch['session'] . ')' ?>
                                                                </option>
                                                                <?php $priorGroup = $batch["session"];
                                                                }
                                                                if ($batch["session"] != $priorGroup) {
                                                                    echo '</optgroup>';
                                                                } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fee_from">&nbsp;</label>
                                                        <input type="text" class="form-control" id="fee_from"  name="fee_from" value="<?php echo isset($filter['fee_from'])?$filter['fee_from']:''; ?>" placeholder="Fee from">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fee_to">&nbsp;</label>
                                                        <input type="text" class="form-control" id="fee_to"  name="fee_to" value="<?php echo isset($filter['fee_to'])?$filter['fee_to']:''; ?>" placeholder="Fee to">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fee_status">&nbsp;</label>
                                                        <select class="form-control" id="fee_status" name="fee_status">
                                                            <option value="0">All</option>
                                                            <?php foreach ($fee_status as $status) { ?>
                                                                <option value="<?php echo $status['id'] ?>"
                                                                    <?php echo isset($filter['fee_status'])&& $filter['fee_status']==$status['id']?'selected' :''; ?>><?php echo $status['status'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fee_status"></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <select class="form-control" name="fee_paid_filter" id="fee_paid_filter">
                                                                    <option value="greater"
                                                                        <?php echo isset($filter['fee_paid_filter'])&& $filter['fee_paid_filter']=='greater'?'selected' :''; ?>>&gt;</option>
                                                                    <option value="less"
                                                                        <?php echo isset($filter['fee_paid_filter'])&& $filter['fee_paid_filter']=='less'?'selected' :''; ?>>&lt;</option>
                                                                </select>
                                                            </div>
                                                            <input type="text" class="form-control" aria-label="Text input with dropdown button" name="fee_paid"
                                                                   id="fee_paid" value="<?php echo isset($filter['fee_paid'])?$filter['fee_paid']:''; ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit" id="student_fee_search" style="padding: 7px 15px;">
                                                                <i class="fa fa-search"></i>Search
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                    <?php if(($user_name == 'admin') || ($role == 'Finance')): ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="create_student_fee_pdf_form" method="post" role="form" target="_blank" action="<?php echo site_url('fee_management/createPdf') ?>" enctype="multipart/form-data">
                                                    <input type="hidden" name="batch_no" id="pdf_batch_no">
                                                    <input type="hidden" name="fee_from" id="pdf_fee_from">
                                                    <input type="hidden" name="fee_to" id="pdf_fee_to">
                                                    <input type="hidden" name="fee_status" id="pdf_fee_status">
                                                    <input type="hidden" name="fee_paid" id="pdf_fee_paid">
                                                    <input type="hidden" name="fee_paid_filter" id="pdf_fee_paid_filter">
                                                    <button type="button" id="create_pdf" class="btn btn-primary" data-toggle="modal"><i class="fa fa-print"></i>Print PDF</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="fee_history" class="table table-bordered table-striped nowrap"
                                                   style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Student</th>
                                                    <th>Batch</th>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <?php if(($user_name == 'admin') || ($role == 'Finance')): ?>
                                                        <th>Actions</th>
                                                    <?php endif; ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($payments as $payment):$session = $payment['session'];?>
                                                    <tr>
                                                        <td><?php echo $payment['first_name']. ' '.$payment['last_name']; ?></td>
                                                        <td><?php echo $payment['code']. ' '.$payment['arm']."($session)"; ?></td>
                                                        <td><?php echo $payment['title']; ?></td>
                                                        <td><?php echo $payment['amount']; ?></td>
                                                        <td><?php echo $payment['date']!='0000-00-00'?$payment['date']:''; ?></td>
                                                        <?php if(($user_name == 'admin') || ($role == 'Finance')): ?>
                                                            <td>
                                                                <a class="edit-fee-payment-btn btn btn-info btn-xs" href="javascript:void(0)"
                                                                   data-action="<?php echo site_url('fee_management/edit_payment_view'); ?>"
                                                                   data-payment-id="<?php echo $payment['student_fee_id']; ?>"
                                                                   data-batch-no="<?php echo $payment['batch_id']; ?>"
                                                                   data-title="<?php echo $payment['title']; ?>"
                                                                   data-description="<?php echo $payment['description']; ?>"
                                                                   data-amount="<?php echo $payment['amount']; ?>"
                                                                   data-amount-paid="<?php echo $payment['amount_paid']; ?>"
                                                                   data-student-id="<?php echo $payment['student_id']; ?>"
                                                                   data-fee="<?php echo $payment['date']; ?>"
                                                                   data-method="<?php echo $payment['method']; ?>"
                                                                   data-fee-type="<?php echo $payment['fee_type_id']; ?>"
                                                                   data-student-name="<?php echo $payment['first_name']. ' '.$payment['last_name']; ?>"
                                                                   data-status="<?php echo $payment['status']; ?>"><i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                                                <a class="delete-income btn btn-danger btn-xs"
                                                                   href="#"
                                                                   data-href="<?php echo site_url("fee_management/delete_income/").$payment['student_fee_id'];  ?>">
                                                                   <i class="fa fa-trash icon-margin" title="Delete"></i></a>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="history">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="fee_list" class="table table-bordered table-striped nowrap"
                                                   style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Method</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($payments as $payment):$session = $payment['session']; ?>
                                                    <tr>
                                                        <td><?php echo $payment['title']; ?></td>
                                                        <td><?php echo $payment['description']; ?></td>
                                                        <td><?php echo $payment['method']; ?></td>
                                                        <td><?php echo $payment['amount']; ?></td>
                                                        <td><?php echo $payment['date']!='0000-00-00'?$payment['date']:''; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>

        </div>
    </section>
</div>

<div class="modal fade" id="fee_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row" style="padding: 20px 15px;">
                <div class="col-md-12" id="edit_payment"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#fee_history").DataTable({});
        $("#fee_list").DataTable({});
        $('#fee_from').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });

        $('#fee_to').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });

        $('#fee_month').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });

    });

    $(function() {

    });

</script>
