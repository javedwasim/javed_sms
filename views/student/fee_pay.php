<form role="form" id="fee_paid_form" method="post" class="form-horizontal"
     data-action="<?php echo site_url('students/create_payment'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
    <input type="hidden" name="fee_management_id" value="<?php echo $fee_management_id; ?>">
    <div class="card card-primary">
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
                <!-- form start -->
                <div class="card-body">
                    <table id="fee_management_table" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Desc</th>
                            <th>Charged</th>
                            <th>Discount</th>
                            <th>Paid</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $fee['fee_name']; ?></td>
                                <td><?php echo $fee['description']; ?></td>
                                <td><?php echo $fee['amount']; ?></td>
                                <td><?php echo $fee['discount']; ?></td>
                                <td><?php echo $fee['amount_paid']; ?></td>
                                <td><?php echo $fee['amount']-$fee['amount_paid']; ?></td>

                            </tr>
                        </tbody>
                    </table>
                    <hr/>
                    <div class="form-group">
                        <label for="amount_paid">Total Fees to pay<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="amount_paid" name="amount" value="">
                    </div>
                    <div class="form-group">
                        <label for="student_id">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@you.com" value="<?php echo set_value('email'); ?>"  />
                    </div>
                    <div class="form-group">
                        <label for="student_id">Card Number</label>
                        <input type="number" name="card_num" id="card_num" class="form-control" placeholder="Card Number" autocomplete="off" value="<?php echo set_value('card_num'); ?>" >
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="exp_month" maxlength="2" class="form-control" id="card-expiry-month" placeholder="MM" value="<?php echo set_value('exp_month'); ?>" >
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="exp_year" class="form-control" maxlength="4" id="card-expiry-year" placeholder="YYYY"  value="<?php echo set_value('exp_year'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="cvc" id="card-cvc" maxlength="3" class="form-control" autocomplete="off" placeholder="CVC" value="<?php echo set_value('cvc'); ?>" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="fee_pay_btn" class="btn btn-primary">
                            <i class="fa fa-dollar"></i>Pay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>