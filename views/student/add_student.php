<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add New Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Student</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php if (isset($errors)): ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $errors; ?></strong>
        </div>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <?php  if(!empty($validation_errors)): ?>
                <div id="employee_error" class="alert alert-danger alert-dismissible"
                     role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $validation_errors; ?>
                </div>
            <?php endif; ?>
            <div class="row student_info">
                <div class="col-md-12">
                    <form id="student_form" method="post" role="form"
                          data-action="<?php echo site_url('students/add_new_student') ?>"
                          enctype="multipart/form-data">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Student Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><code>*</code>Surname</label>
                                            <input type="text" class="form-control" name="surname" placeholder="Surname" maxlength="20"
                                                 value="<?php echo isset($form_data['surname'])?$form_data['surname']:''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><code>*</code>First Name</label>
                                            <input type="text" class="form-control" name="first_name"placeholder="First Name" maxlength="20"
                                                   value="<?php echo isset($form_data['first_name'])?$form_data['first_name']:''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" maxlength="20"
                                                       value="<?php echo isset($form_data['last_name'])?$form_data['last_name']:''; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label><code>*</code>Admission No</label>
                                                <input type="text" class="form-control" name="admission_no" placeholder="Admission No" maxlength="10"
                                                       value="<?php echo isset($form_data['admission_no'])?$form_data['admission_no']:''; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><code>*</code>Admission Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                  </span>
                                                </div>
                                                <input type="text" class="form-control datepicker" autocomplete="off" data-date-format="yyyy-mm-dd" name="admission_date" id="admission_date"
                                                       value="<?php echo isset($form_data['admission_date'])?$form_data['admission_date']:''; ?>"  placeholder="Admission Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($student_fields['date_of_birth']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                          <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control datepicker" autocomplete="off" id="date_of_birth"
                                                           data-date-format="yyyy-mm-dd" name="date_of_birth" placeholder="Date of Birth"
                                                           value="<?php echo isset($form_data['date_of_birth'])?$form_data['date_of_birth']:''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['sgender']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"<?php echo isset($form_data['gender'])&&($form_data['gender']=='Male')?'selected':''; ?>>Male</option>
                                                    <option value="Female"<?php echo isset($form_data['gender'])&&($form_data['gender']=='Female')?'selected':''; ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['religion']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="form-control" name="religion">
                                                    <option value="">Select Religion</option>
                                                    <option value="Christianity"<?php echo isset($form_data['religion'])&&($form_data['religion']=='Christianity')?'selected':''; ?>>Christianity</option>
                                                    <option value="Islam"<?php echo isset($form_data['religion'])&&($form_data['religion']=='Islam')?'selected':''; ?>>Islam</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['sphoto']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employee_photo">Photo</label>
                                                <input type="file" name="photo" class="form-control" id="employee_photo">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['blood_group']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <select class="form-control" name="blood_group">
                                                    <option value="">Blood Group</option>
                                                    <option value="A+"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='A+')?'selected':''; ?>>A+</option>
                                                    <option value="A-"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='A-')?'selected':''; ?>>A-</option>
                                                    <option value="AB+"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='AB+')?'selected':''; ?>>AB+</option>
                                                    <option value="AB-"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='AB-')?'selected':''; ?>>AB-</option>
                                                    <option value="B+"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='B+')?'selected':''; ?>>B+</option>
                                                    <option value="B-"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='B-')?'selected':''; ?>>B-</option>
                                                    <option value="O+"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='O+')?'selected':''; ?>>O+</option>
                                                    <option value="O-"<?php echo isset($form_data['blood_group'])&&($form_data['blood_group']=='O-')?'selected':''; ?>>O-</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['genotype']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Geno Type</label>
                                                <select class="form-control" name="genotype">
                                                    <option value="">Select Genotype</option>
                                                    <option value="AA"<?php echo isset($form_data['genotype'])&&($form_data['genotype']=='AA')?'selected':''; ?>>AA</option>
                                                    <option value="AS"<?php echo isset($form_data['genotype'])&&($form_data['genotype']=='AS')?'selected':''; ?>>AS</option>
                                                    <option value="SS"<?php echo isset($form_data['genotype'])&&($form_data['genotype']=='SS')?'selected':''; ?>>SS</option>
                                                    <option value="AC"<?php echo isset($form_data['genotype'])&&($form_data['genotype']=='AC')?'selected':''; ?>>AC-</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['nationality']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nationality</label>
                                                <select class="form-control select2" id="nationality" name="nationality">
                                                    <option value="">Select Nationality</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?php echo $country['id'] ?>"
                                                            <?php echo isset($form_data['nationality'])&&($form_data['nationality']==$country['id'])?'selected':''; ?>>
                                                            <?php echo $country['country_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['state_of_origin']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State of Origin</label>
                                                <select class="form-control select2" id="country_states" name="state_of_origin">
                                                    <option value=''>Please select a state</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['lga_of_origin']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>L.G.A of Origin</label>
                                                <select class="form-control select2" id="lga_of_origin" name="lga_of_origin">
                                                    <option value=''>Please select a origin</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><code>*</code>Batch</label>
                                            <!--                          <input type="text" class="form-control" placeholder="Batch No." name="batch_no" maxlength="20" required="">-->
                                            <select prompt="Select Batch" class="form-control" required="required" name="batch_no">
                                                <option value=""></option>
                                                <?php $priorGroup = "";
                                                foreach ($batches as $batch){ ?>
                                                <?php if ($batch["session"] != $priorGroup){ ?>
                                                <optgroup label="<?php echo $batch['session']; ?>">
                                                    <?php } ?>
                                                    <option value="<?php echo $batch['id']; ?>"
                                                        <?php echo isset($form_data['batch_no'])&&($form_data['batch_no']==$batch['id'])?'selected':''; ?>>
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
                                    <?php if ($student_fields['student_category']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Student Category</label>
                                                <select class="form-control select2" name="student_category">
                                                    <option value="">Please select a state</option>
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo $category['id']; ?>"
                                                            <?php echo isset($form_data['student_category'])&&($form_data['student_category']==$category['id'])?'selected':''; ?>>
                                                            <?php echo $category['category']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($student_fields['mobile_phone']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile Phone</label>
                                                <input type="tel" maxlength="15" id="mobile_phone" name="mobile_phone" class="form-control" placeholder="&nbsp;"
                                                       value="<?php echo isset($form_data['mobile_phone'])?$form_data['mobile_phone']:''; ?>"
                                                       oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="email" maxlength="50" placeholder="Email" required
                                                   value="<?php echo isset($form_data['email'])?$form_data['email']:''; ?>">
                                        </div>
                                    </div>
                                    <?php if ($student_fields['phone']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="tel" class="form-control" name="phone" maxlength="15" id="phone" placeholder="&nbsp;"
                                                       value="<?php echo isset($form_data['phone'])?$form_data['phone']:''; ?>"
                                                       oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <?php if ($student_fields['address']) { ?>
                                <div class="card-header">
                                    <h3 class="card-title">Student Address</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address Line</label>
                                                <textarea class="form-control" rows="1" maxlength="70"
                                                          name="address_line"><?php echo isset($form_data['address_line'])?$form_data['address_line']:''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control select2" name="country" id="snationality">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?php echo $country['id'] ?>"
                                                            <?php echo isset($form_data['snationality'])&&($form_data['snationality']==$country['id'])?'selected':''; ?>><?php echo $country['country_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control select2" id="scountry_states" name="state">
                                                    <option value="">Please select a state</option>
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?php echo $state['id']; ?>"
                                                            <?php echo isset($form_data['state'])&&($form_data['state']==$state['id'])?'selected':''; ?>><?php echo $state['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label></label>
                                                <select class="form-control select2" id="slga_of_origin" name="city">
                                                    <option value="">Please select</option>
                                                    <?php foreach ($cities as $city): ?>
                                                        <option value="<?php echo $city['id']; ?>"
                                                            <?php echo isset($form_data['city'])&&($form_data['city']==$city['id'])?'selected':''; ?>>
                                                            <?php echo $city['name']; ?></option>
                                                    <?php  endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-4" style="margin-bottom: 20px;">
                                    <button id="save_students" type="submit" class="btn btn-primary btn-lg pull-right">
                                        <i class="fa fa-floppy-o"></i> Save Student
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
    </section>
</div>

<script>
    $(document).ready(function () {
        $('.select2').select2({});
        $('#admission_date').datepicker().datepicker("setDate", new Date());
        $('#date_of_birth').datepicker().datepicker("setDate", new Date());

    });
    $("#nationality").change(function () {
        var base_url = $('#base').val();
        var country = $('#nationality').val();
        $.ajax({
            url: base_url+'students/get_state/' + country,
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
        $.ajax({
            url: '/isms/students/get_origin/' + state,
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

    $("#snationality").change(function () {
        var country = $('#snationality').val();
        $.ajax({
            url: '/isms/students/get_state/'+country,
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('#scountry_states').empty();
                    $('#scountry_states').append(response.states_html);
                } else {
                    toastr["warning"](response.message);
                }
            }
        });
    });

    $("#scountry_states").change(function () {
        var state = $('#scountry_states').val();
        $.ajax({
            url: '/isms/students/get_origin/'+state,
            cache: false,
            success: function(response) {
                console.log(response);
                if (response.success) {
                    $('#slga_of_origin').empty();
                    $('#slga_of_origin').append(response.origin_html);
                } else {
                    toastr["warning"](response.message);
                }
            }
        });
    });
</script>