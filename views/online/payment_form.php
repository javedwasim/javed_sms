<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Stripe Payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">payment</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" id="paymentFrm" enctype="multipart/form-data" action="<?php echo base_url(); ?>online_test/check">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Stripe Payment</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="batch_id">Batch</label>
                                    <select class="custom-select custom-select-md" onchange="batch_students($(this).val())"
                                            name="batch_id" id="batch_id" <?php echo !empty($batch_id)?'':''; ?>>
                                        <option>Please select student</option>
                                        <?php foreach ($batches as $batch):$session = $batch['session']; ?>
                                            <option value="<?php echo $batch['id']; ?>"<?php echo $batch_id == $batch['id'] ? 'selected' : '' ?>>
                                                <?php echo $batch['code'] . '-' . $batch['arm'] . "($session)"; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_id">Student</label>
                                    <select class="custom-select custom-select-md batch-students"
                                            name="student_id" id="student_id" <?php echo isset($student_id)?'':''; ?>>
                                        <option>Please select student</option>
                                        <?php foreach ($students as $student): ?>
                                            <option value="<?php echo $student['student_id'];?>"
                                                <?php echo isset($student_id)&&($student_id==$student['student_id'])?'selected':''; ?>>
                                                <?php echo $student['first_name'].' '.$student['last_name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_id">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@you.com" value="<?php echo set_value('email'); ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="student_id">Card Number</label>
                                    <input type="number" name="card_num" id="card_num" class="form-control" placeholder="Card Number" autocomplete="off" value="<?php echo set_value('card_num'); ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="exp_month" maxlength="2" class="form-control" id="card-expiry-month" placeholder="MM" value="<?php echo set_value('exp_month'); ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="exp_year" class="form-control" maxlength="4" id="card-expiry-year" placeholder="YYYY" required="" value="<?php echo set_value('exp_year'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="cvc" id="card-cvc" maxlength="3" class="form-control" autocomplete="off" placeholder="CVC" value="<?php echo set_value('cvc'); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo isset($title)?$title:''; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" required="" rows="5" name="description"><?php echo isset($description)?$description:''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="fee_date">Date</label>
                                    <input type="text" class="form-control" id="date" name="date" value="<?php echo isset($fee_date)?$fee_date:''; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Payment details
                                </h3>
                            </div>
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-3 control-label">Total</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo isset($amount)?$amount:''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount_paid" class="col-sm-3 control-label">Amount</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="amount_paid" name="amount_paid" value="<?php echo isset($amount_paid)?$amount_paid:''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" required="" name="status" id="status">
                                                <option value="">Select</option>
                                                <option value="completed"<?php echo isset($status)&&($status=='completed')?'selected':''; ?>>Completed</option>
                                                <option value="pending"<?php echo isset($status)&&($status=='pending')?'selected':''; ?>>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="method" class="col-sm-3 control-label">Method</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="method" id="method" <?php echo isset($method)?'disabled':''; ?>>
                                                <option value="">Select</option>
                                                <option value="card"<?php echo isset($method)&&($method=='card')?'selected':''; ?>>Card</option>
                                                <option value="cash"<?php echo isset($method)&&($method=='cash')?'selected':''; ?>>Cash</option>
                                                <option value="check"<?php echo isset($method)&&($method=='check')?'selected':''; ?>>Check</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="method" class="col-sm-3 control-label">Fee Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="fee_type_id" id="fee_type_id">
                                                <option value="">Select</option>
                                                <?php foreach ($fee_types as $fee_type): ?>
                                                    <option value=<?php echo $fee_type['id']; ?>><?php echo $fee_type['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" id="payBtn" class="btn btn-success">
                                        <i class="far fa-money-bill-alt"></i><?php echo isset($payment_id)?'Update invoice':'Create invoice'; ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<script type="text/javascript">
    //set your publishable key
    Stripe.setPublishableKey('pk_test_GJTsu9uDvyFCkc2GFAvubaI6');

    //callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            //enable the submit button
            $('#payBtn').removeAttr("disabled");
            //display the errors on the form
            // $('#payment-errors').attr('hidden', 'false');
            $('#payment-errors').addClass('alert alert-danger');
            $("#payment-errors").html(response.error.message);
        } else {
            var form$ = $("#paymentFrm");
            //get token id
            var token = response['id'];
            //insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            //submit form to the server
            form$.get(0).submit();
        }
    }
    $(document).ready(function() {
        //on form submit
        $("#paymentFrm").submit(function(event) {
            //disable the submit button to prevent repeated clicks
            $('#payBtn').attr("disabled", "disabled");
            //create single-use token to charge the user
            Stripe.createToken({
                number: $('#card_num').val(),
                cvc: $('#card-cvc').val(),
                exp_month: $('#card-expiry-month').val(),
                exp_year: $('#card-expiry-year').val()
            }, stripeResponseHandler);
            //submit from callback
            return false;
        });

        $('#date').datepicker({
            format: 'yyyy-mm-dd'
        });
    });

    function batch_students(value) {
        $.ajax({
            url: '/isms/fee_management/get_batch_students',
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