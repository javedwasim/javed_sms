<?php $user_data = $this->session->userdata('userdata'); $user_name = $user_data['name'];?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fee Detail</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Fee</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if($this->session->flashdata('error')) { $message = $this->session->flashdata('error'); ?>
                                <h4 class="card-title "><?php echo $message['insertID']; ?></h4>
                            <?php    }  ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="create_student_fee_pdf_form" method="post" role="form" target="_blank" action="<?php echo site_url('students/unpaid_fee_pdf') ?>" enctype="multipart/form-data">
                                        <button type="button" id="create_pdf" class="btn btn-primary" data-toggle="modal"><i class="fa fa-print"></i>Print PDF</button>
                                    </form>
                                </div>
                            </div>
                            <table id="fee_management_table" class="display responsive no-wrap table-bordered table-striped" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Batch</th>
                                    <th>Created</th>
                                    <th>Charged</th>
                                    <th>Discount</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fees as $fee): ?>
                                        <tr>
                                            <td><?php echo $fee['fee_name']; ?></td>
                                            <td><?php echo $fee['description']; ?></td>
                                            <td><?php echo date('F j, Y',strtotime($fee['start_date'])); ?></td>
                                            <td><?php echo date('F j, Y',strtotime($fee['due_date'])); ?></td>
                                            <td><?php echo $fee['status']==1?'Active':''; ?></td>
                                            <td><?php echo $fee['code'] . '-' . $fee['arm'] . '(' . $fee['session'] . ')' ?></td>
                                            <td><?php echo date('F j, Y',strtotime($fee['created_at'])); ?></td>
                                            <td><?php echo $fee['amount']; ?></td>
                                            <td><?php echo $fee['discount']; ?></td>
                                            <td><?php echo $fee['amount_paid']; ?></td>
                                            <td><?php echo $fee['amount']- $fee['amount_paid']; ?></td>
                                            <td>
                                                <a class="fee-payment-btn btn btn-success btn-xs
                                                   <?php echo $fee['amount']-$fee['amount_paid']==0?'disabled':''; ?>"
                                                   data-href="<?php echo site_url('students/student_paid_fees/').$fee['id'] ?>"
                                                   data-value="<?php echo $fee['id']; ?>"
                                                   user-id="<?php echo $student_id; ?>">
                                                   <i class="fa fa-dollar icon-margin" title="Pay"></i>Pay</a>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 font-weight-bold" style="text-align: center">Pay Fee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="paid_fee_container"></div>
                </div>
            </div>
        </div>
    </section>
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $("#fee_management_table").DataTable({
            "scrollX": true
        });
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

        $('#date_created').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

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

</script>