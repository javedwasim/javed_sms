<form role="form" id="fee_paid_form" method="post" class="form-horizontal"
     action="<?php echo site_url('students/create_payment'); ?>"
     data-action="<?php echo site_url('students/create_payment'); ?>" enctype="multipart/form-data">
    <?php if(!empty($student_id)): ?>
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
    <?php endif; ?>
    <input type="hidden" name="fee_management_id" value="<?php echo $fee_management_id; ?>">
    <input type="hidden" name="due_balance" value="<?php echo $fee['amount']-$fee['amount_paid']; ?>">
    <input type="hidden" name="fee_type_id" value="<?php echo $fee['fee_type_id']; ?>">
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
                <div class="accordion" id="accordionExample">
                    <div class="accordion" id="accordion1" style="text-align: center">
                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Pay Fee
                        </button>
                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                            Pay Online Fee
                        </button>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="amount_paid" class="">Total Fee to pay<span style="color: red">*</span></label>
                                    </div>
                                </div>
                                <?php if(empty($student_id)): ?>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select name="student_id" class="form-control" required>
                                                <option value="">Select a student</option>
                                                <?php foreach ($student_list as $std): ?>
                                                    <option value="<?php echo $std['student_id']; ?>"><?php echo $std['first_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="amount_paid" name="amount" value="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="submit" id="fee_pay_btn" class="btn btn-sm btn-primary">
                                            <i class="fa fa-dollar"></i>Pay Fee</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapsetwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="student_id">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email@you.com"
                                       value="<?php echo set_value('email'); ?>"  required/>
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
                                                <input type="text" name="exp_month" maxlength="2" class="form-control" id="card-expiry-month" placeholder="MM"
                                                       value="<?php echo set_value('exp_month'); ?>" required/>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="exp_year" class="form-control" maxlength="4" id="card-expiry-year" placeholder="YYYY"
                                                       value="<?php echo set_value('exp_year'); ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="cvc" id="card-cvc" maxlength="3" class="form-control" autocomplete="off" placeholder="CVC"
                                               value="<?php echo set_value('cvc'); ?>" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="">
                            </div>
                            <div class="form-group">
                                <label for="description" class="">Description</label>
                                <textarea class="form-control" required="" rows="5" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fee_date" class="">Date</label>
                                <input type="text" class="form-control" id="date" name="date" value="">
                            </div>
                            <div class="form-group">
                                <label for="amount_paid" class="">Amount</label>
                                <input type="text" class="form-control" id="amount_paid" name="amount_paid" value="">
                            </div>
<<<<<<< HEAD
                            <div class="form-group" style="text-align: center">
                                <button type="submit" id="payBtn" class="btn btn-primary">
                                    <i class="far fa-money-bill-alt"></i>Create invoice</button>
                            </div>
=======
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD

=======
            <div class="form-group" style="text-align: center">
                <button type="submit" id="payBtn" class="btn btn-primary">
                    <i class="far fa-money-bill-alt"></i>Create invoice</button>
            </div>
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
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
                var form$ = $("#fee_paid_form");
                //get token id
                var token = response['id'];
                //insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                //submit form to the server
                form$.get(0).submit();

            }
        }

        $('#date').datepicker({
            format: 'yyyy-mm-dd'
        });

        //on form submit
        $("#fee_paid_form").submit(function(event) {
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

    });
</script>