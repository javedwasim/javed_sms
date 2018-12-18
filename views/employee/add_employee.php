<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add New Employee</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">add employee</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid --->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php  if(!empty($validation_errors)): ?>
                <div id="employee_error" class="alert alert-danger alert-dismissible"
                     role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $validation_errors; ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div id="employee_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="employee_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Employee Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="employee_form" method="post" role="form" enctype="multipart/form-data"
                              data-action="<?php echo isset($form_action) ? $form_action : site_url('employee/add_new_employee') ?>">
                            <div class="card-body">
                                <!-- text input -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Surname<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="surname" value="<?php  if(isset($employee['surname'])) {echo $employee['surname'];}  elseif(isset($form_data['surname'])){ echo $form_data['surname']; } ?>" maxlength="100" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First name<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="first_name"
                                                   value="<?php  if(isset($employee['first_name'])) {echo $employee['first_name'];}  elseif(isset($form_data['first_name'])){ echo $form_data['first_name']; } ?>" maxlength="100" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                   value="<?php  if(isset($employee['middle_name'])) {echo $employee['middle_name'];}  elseif(isset($form_data['middle_name'])){ echo $form_data['middle_name']; } ?>" maxlength="100" />
                                        </div>
                                    </div>

                                    <?php if ($employee_fields['title']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"
                                                       value="<?php  if(isset($employee['title'])) {echo $employee['title'];}  elseif(isset($form_data['title'])){ echo $form_data['title']; } ?>" maxlength="100" />
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employee No</label>
                                            <input type="text" class="form-control" name="employee_no"
                                                   value="<?php  if(isset($employee['employee_no'])) {echo $employee['employee_no'];}  elseif(isset($form_data['employee_no'])){ echo $form_data['employee_no']; } ?>" maxlength="100" />
                                        </div>
                                    </div>
                                    <?php if ($employee_fields['egender']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">Please select</option>
                                                    <option value="male" <?php echo isset($employee['gender']) && $employee['gender'] == 'male' ? 'selected' : ''; ?> >Male</option>
                                                    <option value="female" <?php echo isset($employee['gender']) && $employee['gender'] == 'female' ? 'selected' : ''; ?> >Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($employee_fields['date_of_birth']) { ?>
                                        <div class="col-md-4">
                                            <label>Date of birth</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" autocomplete="off"
                                                       value="<?php  if(isset($employee['date_of_birth'])) {echo $employee['date_of_birth'];}  elseif(isset($form_data['date_of_birth'])){ echo $form_data['date_of_birth']; } ?>" maxlength="15">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['ephoto']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employee_photo">Photo</label>
                                                <input type="file" name="photo" class="form-control" id="employee_photo">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['date_of_join']) { ?>
                                        <div class="col-md-4">
                                            <label>Date joined</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="date_of_join" name="date_of_join" autocomplete="off"
                                                       value="<?php  if(isset($employee['date_of_join'])) {echo $employee['date_of_join'];}  elseif(isset($form_data['date_of_join'])){ echo $form_data['date_of_join']; } ?>" maxlength="15">
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($employee_fields['phone']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input  type="tel" class="form-control" id="emp-phone" name="phone" placeholder="&nbsp;"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        value="<?php  if(isset($employee['phone'])) {echo $employee['phone'];}  elseif(isset($form_data['phone'])){ echo $form_data['phone']; } ?>" maxlength="15">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['email']) { ?>
                                        <div class="col-md-4">
                                            <label>Email<span style="color: red">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" maxlength="100" required
                                                       value="<?php  if(isset($employee['email'])) {echo $employee['email'];}  elseif(isset($form_data['email'])){ echo $form_data['email']; } ?>"
                                                       <?php echo isset($employee['email']) ? 'readonly' : ''; ?> />
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['mobile_phone']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile phone</label>
                                                <input  type="tel" class="form-control" id="emp-mb-phone" name="mobile_phone" maxlength="15" placeholder="&nbsp;"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        value="<?php  if(isset($employee['mobile_phone'])) {echo $employee['mobile_phone'];}  elseif(isset($form_data['mobile_phone'])){ echo $form_data['mobile_phone']; } ?>"  >
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($employee_fields['employee_category']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Employee Category<span style="color: red">*</span></label>
                                                <select class="form-control" name="category" required>
                                                    <option value="">Please select</option>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?php echo $category['id']; ?>"<?php echo isset($employee['category']) && ($employee['category'] == $category['id']) ? 'selected' : ''; ?>><?php echo $category['category']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['employee_department']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Employee Department</label>
                                                <select class="form-control" name="department">
                                                    <option value="">Please select</option>
                                                    <?php foreach ($departments as $department) : ?>
                                                        <option value="<?php echo $department['id']; ?>"<?php echo isset($employee['department']) && ($employee['department'] == $department['id']) ? 'selected' : ''; ?>><?php echo $department['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['employee_position']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Employee Positions</label>
                                                <select class="form-control" name="position">
                                                    <option value="">Please select</option>
                                                    <?php foreach ($positions as $position) : ?>
                                                        <option value="<?php echo $position['id']; ?>"<?php echo isset($employee['position']) && ($employee['position'] == $position['id']) ? 'selected' : ''; ?>><?php echo $position['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($employee_fields['religion']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="form-control" name="religion">
                                                    <option value="">Please Select</option>
                                                    <option value="christianity"<?php echo isset($employee['religion']) && $employee['religion'] == 'christianity' ? 'selected' : ''; ?>>Christianity</option>
                                                    <option value="islam"<?php echo isset($employee['religion']) && $employee['religion'] == 'islam' ? 'selected' : ''; ?>>Islam</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['marital_status']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Marital status</label>
                                                <select class="form-control" name="marital_status">
                                                    <option value="">Please Select</option>
                                                    <option value="single"<?php echo isset($employee['marital_status']) && $employee['marital_status'] == 'single' ? 'selected' : ''; ?>>Single</option>
                                                    <option value="married"<?php echo isset($employee['marital_status']) && $employee['marital_status'] == 'married' ? 'selected' : ''; ?>>Married</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['blood_group']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Blood group</label>
                                                <select class="form-control" name="blood_group">
                                                    <option value="">Please Select</option>
                                                    <option value="A+"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'A+' ? 'selected' : ''; ?>>A+</option>
                                                    <option value="A-"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'A-' ? 'selected' : ''; ?>>A-</option>
                                                    <option value="AB+"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'AB+' ? 'selected' : ''; ?>>AB+</option>
                                                    <option value="AB-"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'AB-' ? 'selected' : ''; ?>>AB-</option>
                                                    <option value="B+"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'B+' ? 'selected' : ''; ?>>B+</option>
                                                    <option value="B-"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'B-' ? 'selected' : ''; ?>>B-</option>
                                                    <option value="O+"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'O+' ? 'selected' : ''; ?>>O+</option>
                                                    <option value="O-"<?php echo isset($employee['blood_group']) && $employee['blood_group'] == 'O-' ? 'selected' : ''; ?>>O-</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['nationality']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nationality</label>
                                                <select class="form-control select2" name="nationality">
                                                    <option>Select Nationality</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?php echo $country['id'] ?>"<?php echo isset($employee['nationality']) && $employee['nationality'] == $country['id'] ? 'selected' : ''; ?>><?php echo $country['country_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($employee_fields['qualification']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Qualification</label>
                                                <select class="form-control" name="qualification">
                                                    <option value="">Please Select</option>
                                                    <option value="Bsc"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'Bsc' ? 'selected' : ''; ?>>Bsc</option>
                                                    <option value="Msc"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'Msc' ? 'selected' : ''; ?>>Msc</option>
                                                    <option value="HND"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'HND' ? 'selected' : ''; ?>>Hnd</option>
                                                    <option value="OND"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'OND' ? 'selected' : ''; ?>>Ond</option>
                                                    <option value="NCE"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'NCE' ? 'selected' : ''; ?>>Nce</option>
                                                    <option value="BA"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'BA' ? 'selected' : ''; ?>>Ba</option>
                                                    <option value="PGDE"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'PGDE' ? 'selected' : ''; ?>>Pgde</option>
                                                    <option value="PROF"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'PROF' ? 'selected' : ''; ?>>Prof</option>
                                                    <option value="DR"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'DR' ? 'selected' : ''; ?>>Dr</option>
                                                    <option value="KCPE"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'KCPE' ? 'selected' : ''; ?>>Kcpe</option>
                                                    <option value="KCSE"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'KCSE' ? 'selected' : ''; ?>>Kcse</option>
                                                    <option value="UNDERGRADUATE"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'UNDERGRADUATE' ? 'selected' : ''; ?>>Undergraduate</option>
                                                    <option value="ECDE"<?php echo isset($employee['qualification']) && $employee['qualification'] == 'ECDE' ? 'selected' : ''; ?>>Ecde</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br />
                                <?php if ($employee_fields['address']) { ?>
                                    <div class="card-header">
                                        <h3 class="card-title">Employee Address</h3>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address line</label>
                                                <textarea class="form-control" rows="3" name="address_line"><?php  if(isset($employee['address_line'])) {echo $employee['address_line'];}  elseif(isset($form_data['address_line'])){ echo $form_data['address_line']; } ?></textarea>
                                            </div>
                                        </div>
                                        <?php if ($employee_fields['nationality']) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control select2" id="nationality" name="country">
                                                        <option value="">Select Nationality</option>
                                                        <?php foreach ($countries as $country) { ?>
                                                            <option value="<?php echo $country['id'] ?>"<?php echo isset($employee['country']) && $employee['country'] == $country['id'] ? 'selected' : ''; ?>><?php echo $country['country_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <br />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                        <!--                          <input type="text" class="form-control" name="state" maxlength="20" placeholder="State" value="--><?php //echo isset($employee['state'])? $employee['state']:'';  ?><!--">-->
                                                <select class="form-control select2" id="country_states" name="state">
                                                    <option value=''>Please select a state</option>
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?php echo $state['id']; ?>"<?php echo isset($employee['state']) && $employee['state'] == $state['id'] ? 'selected' : ''; ?>><?php echo $state['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control select2" id="lga_of_origin" name="lga_of_origin">
                                                    <?php foreach ($origins as $origin): ?>
                                                        <option value="<?php echo $origin['id']; ?>">
                                                            <?php echo $origin['name']; ?></option>
                                                    <?php  endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <br />
                                <?php if ($employee_fields['next_of_kin']) { ?>
                                    <div class="card-header">
                                        <h3 class="card-title">Next of Kin Information</h3>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="next_of_kin_name" maxlength="100"
                                                       value="<?php  if(isset($employee['next_of_kin_name'])) {echo $employee['next_of_kin_name'];}  elseif(isset($form_data['next_of_kin_name'])){ echo $form_data['next_of_kin_name']; } ?>"/>
                                            </div>
                                        </div>
                                        <?php if ($employee_fields['relation_next_of_kin']) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship with next of kin</label>
                                                    <input type="text" class="form-control" name="next_of_kin_relation" maxlength="100"
                                                           value="<?php  if(isset($employee['next_of_kin_relation'])) {echo $employee['next_of_kin_relation'];}  elseif(isset($form_data['next_of_kin_relation'])){ echo $form_data['next_of_kin_relation']; } ?>"/>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($employee_fields['next_of_kin_phone']) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Next of kin phone</label>
                                                    <input type="number" class="form-control" name="next_of_kin_phone" maxlength="15"
                                                           value="<?php  if(isset($employee['next_of_kin_phone'])) {echo $employee['next_of_kin_phone'];}  elseif(isset($form_data['next_of_kin_phone'])){ echo $form_data['next_of_kin_phone']; } ?>"/>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($employee_fields['next_of_kin_mobile']) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Next of kin mobile phone</label>
                                                    <input type="number" class="form-control" name="next_of_kin_mobile" maxlength="15"
                                                           value="<?php  if(isset($employee['next_of_kin_mobile'])) {echo $employee['next_of_kin_mobile'];}  elseif(isset($form_data['next_of_kin_mobile'])){ echo $form_data['next_of_kin_mobile']; } ?>"/>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if ($employee_fields['next_of_kin_address']) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Next of kin address</label>
                                                    <textarea class="form-control" rows="3" name="next_of_kin_address_line" maxlength="300"><?php  if(isset($employee['next_of_kin_address_line'])) {echo $employee['next_of_kin_address_line'];}  elseif(isset($form_data['next_of_kin_address_line'])){ echo $form_data['next_of_kin_address_line']; } ?></textarea>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <br />
                                <?php if ($employee_fields['bank_account_details']) { ?>
                                    <div class="card-header">
                                        <h3 class="card-title">Bank Account Details</h3>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <select class="form-control" name="bank_name">
                                                    <option value="">Please Select</option>
                                                    <?php foreach ($banks as $bank): ?>
                                                        <option value="<?php echo $bank['id']; ?>"<?php echo isset($employee['bank_name']) && $employee['bank_name'] == $bank['id'] ? 'selected' : ''; ?>><?php echo $bank['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account name</label>
                                                <input type="text" class="form-control" name="account_name" maxlength="100"
                                                       value="<?php  if(isset($employee['account_name'])) {echo $employee['account_name'];}  elseif(isset($form_data['account_name'])){ echo $form_data['account_name']; } ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account number</label>
                                                <input type="number" class="form-control" name="account_number" maxlength="20"
                                                       value="<?php  if(isset($employee['account_number'])) {echo $employee['account_number'];}  elseif(isset($form_data['account_number'])){ echo $form_data['account_number']; } ?>" />
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button id="<?php echo isset($update_employee_button) && (!empty($update_employee_button)) ? 'save_employees' : 'save_employees'; ?>"
                                        type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-floppy-o"></i>Save Employee</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
<script>
    $(document).ready(function () {
        $('.select2').select2({});
    });
    $(document).ready(function () {
        $('#date_of_join').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).datepicker("setDate", new Date());
        $('#date_of_birth').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).datepicker("setDate", new Date());

        $("#nationality").change(function () {
            var country = $('#nationality').val();
            var base_url = $('#base').val();
            $.ajax({
                url: base_url+'employee/get_state/' + country,
                cache: false,
                success: function (response) {
                    if (response.success) {
                        $('#country_states').empty();
                        $('#country_states').append(response.states_html);
                    } else {
                        toastr["warning"](response.message);
                    }
                }
            });
        });

        $("#country_states").change(function () {
            var state = $('#country_states').val();
            var base_url = $('#base').val();
            $.ajax({
                url: base_url+'employee/get_origin/' + state,
                cache: false,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        $('#lga_of_origin').empty();
                        $('#lga_of_origin').append(response.origin_html);
                    } else {
                        toastr["warning"](response.message);
                    }
                }
            });
        });
    });
</script>