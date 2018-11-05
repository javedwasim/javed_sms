<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fees</h1>
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
                            <h3 class="card-title">Fees</h3>
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
                            <form rol="form" style="width: 100%;" id="student_form_filters">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" name="search-employee" id="search-employee" class="form-control st_filter"
                                                   value="<?php echo isset($filters['search-employee']) ? $filters['search-employee'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fee Type</label>
                                            <select class="form-control st_filter" name="status" onchange="student_filters()">
                                                <option value="">All</option>
                                                <?php foreach ($fee_types as $type): ?>
                                                    <option value="<?php echo $type['id'] ?>"><?php echo $type['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" name="search-employee" id="search-employee" class="form-control st_filter"
                                                   value="<?php echo isset($filters['search-employee']) ? $filters['search-employee'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="fee_search_request" id="fee_search_request_status">
                                                <option value=""></option>
                                                <option value="inactive">Inactive</option>
                                                <option value="active">Active</option>
                                                <option value="hold">Hold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input class="form-control" type="text" name="due_date" id="due_date" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Created</label>
                                            <input class="form-control" type="text" name="date_created" id="date_created" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary btn-md" id="filter" onclick="return resetForm()">
                                                <i class="fa fa-search"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
                                            <td><?php echo $fee['status']==1?'Actve':''; ?></td>
                                            <td><?php echo $fee['code'] . '-' . $fee['arm'] . '(' . $fee['session'] . ')' ?></td>
                                            <td><?php echo date('F j, Y',strtotime($fee['created_at'])); ?></td>
                                            <td><?php echo $fee['amount']; ?></td>
                                            <td><?php echo $fee['discount']; ?></td>
                                            <td><?php echo $fee['amount_paid']; ?></td>
                                            <td><?php echo $fee['amount']- $fee['amount_paid']; ?></td>
                                            <td>
                                                <a class="fee-payment-btn btn btn-success btn-xs"
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
                        <h5 class="modal-title" id="exampleModalLabel">Pay Fee</h5>
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
        var table = $("#fee_management_table").DataTable();
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