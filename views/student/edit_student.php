<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v2</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="row">
        <div class="col-md-12">

          <div id="student_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          </div>
          <div id="student_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          </div>
          
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row"> 
            <div class="col-md-12">
              <form id="student_update_form" role="form" method="post"
                    data-action="<?php echo site_url('students/update_student/').$student['student_id'] ?>" enctype="multipart/form-data">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Student</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><code>*</code>Surname</label>
                          <input type="text" class="form-control" value="<?php echo $student['surname'] ?>" name="surname" maxlength="100" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><code>*</code>First Name</label>
                          <input type="text" class="form-control" value="<?php echo $student['first_name'] ?>" name="first_name" maxlength="100" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" maxlength="100" value="<?php echo $student['last_name'] ?>">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="form-group">
                            <label><code>*</code>Admission No</label>
                            <input type="text" class="form-control" value="<?php echo $student['admission_no'] ?>" autocomplete="off"
                                   name="admission_no" placeholder="Admission No" required>
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
                            <input type="text" class="form-control" data-date-format="yyyy-mm-dd" autocomplete="off"
                                  id="admission_date" name="admission_date" value="<?php echo ($student['admission_date'] == "0000-00-00")? '':$student['admission_date'] ; ?>" required>
                          </div>
                        </div>
                      </div>
                      <?php if($student_fields['date_of_birth']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Date of Birth</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control" data-date-format="yyyy-mm-dd"  autocomplete="off"
                                   id="date_of_birth" name="date_of_birth" value="<?php echo ($student['date_of_birth'] == "0000-00-00")? '':$student['date_of_birth'] ; ?>">
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['sgender'] || $student['sgender']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Gender</label>
                          <select class="form-control" name="gender">
                            <option value="">Select Gender</option>
                            <option <?php echo($student['gender'] == 'Male')? 'selected': ''; ?> value="Male">Male</option>
                            <option <?php echo($student['gender'] == 'Feale')? 'selected': ''; ?> value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['religion'] || $student['religion']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Religion</label>
                          <select class="form-control" name="religion">
                            <option value="">Select Religion</option>
                            <option <?php echo ($student['religion'] == 'Christianity')? 'selected': ''; ?> value="Christianity">Christianity</option>
                            <option <?php echo ($student['religion'] == 'Islam')? 'selected': ''; ?> value="Islam">Islam</option>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['sphoto']) { ?>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="student_photo">Photo</label>
                                  <input type="file" name="photo" class="form-control" id="student_photo">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if($student_fields['blood_group'] || $student['blood_group']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Blood Group</label>
                          <select class="form-control" name="blood_group">
                            <option value="">Blood Group</option>
                            <option <?php echo ($student['blood_group'] == 'A+')? 'selected': ''; ?> value="A+">A+</option>
                            <option <?php echo ($student['blood_group'] == 'A-')? 'selected': ''; ?> value="A-">A-</option>
                            <option <?php echo ($student['blood_group'] == 'AB+')? 'selected': ''; ?> value="AB+">AB+</option>
                            <option <?php echo ($student['blood_group'] == 'AB-')? 'selected': ''; ?> value="AB-">AB-</option>
                            <option <?php echo ($student['blood_group'] == 'B+')? 'selected': ''; ?> value="B+">B+</option>
                            <option <?php echo ($student['blood_group'] == 'B-')? 'selected': ''; ?> value="B-">B-</option>
                            <option <?php echo ($student['blood_group'] == 'O+')? 'selected': ''; ?> value="O+">O+</option>
                            <option <?php echo ($student['blood_group'] == 'O-')? 'selected': ''; ?> value="O-">O-</option>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['genotype'] || $student['genotype']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Geno Type</label>
                          <select class="form-control" name="genotype">
                            <option value="">Select Genotype</option>
                            <option <?php echo ($student['genotype'] == 'AA')? 'selected': ''; ?> value="AA">AA</option>
                            <option <?php echo ($student['genotype'] == 'AS')? 'selected': ''; ?> value="AS">AS</option>
                            <option <?php echo ($student['genotype'] == 'SS')? 'selected': ''; ?> value="SS">SS</option>
                            <option <?php echo ($student['genotype'] == 'AC')? 'selected': ''; ?> value="AC">AC-</option>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['nationality'] || $student['nationality']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Nationality</label>
                          <select class="form-control select2" name="nationality" id="nationality">
                            <option value="">Select Nationality</option>
                            <?php foreach($countries as $country) { ?>
                                <option <?php echo ($country['id'] == $student['nationality'])? 'selected': ''; ?> value="<?php echo $country['id'] ?>"><?php echo $country['country_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['state_of_origin'] || $student['state_of_origin']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>State of Origin</label>
                           <select class="form-control select2" id="country_states" name="state_of_origin">
                               <?php foreach ($states as $state): ?>
                                   <option value="<?php echo $state['id']; ?>"<?php echo ($state['id'] == $student['state_of_origin'])? 'selected': ''; ?>>
                                       <?php echo $state['name']; ?></option>
                               <?php  endforeach; ?>
                           </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['lga_of_origin'] || $student['lga_of_origin']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>L.G.A of Origin</label>
                          <select class="form-control select2" id="lga_of_origin" name="lga_of_origin">
                              <?php foreach ($origins as $origin): ?>
                                  <option value="<?php echo $origin['id']; ?>"<?php echo ($origin['id'] == $student['lga_of_origin'])? 'selected': ''; ?>>
                                      <?php echo $origin['name']; ?></option>
                              <?php  endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><code>*</code>Batch</label>
<!--                          <input type="text" class="form-control" value="--><?php //echo $student['batch_no'] ?><!--" placeholder="Batch No." name="batch_no" required="">-->
                            <select prompt="Select Batch" class="form-control" required="required" name="batch_no">
                                <option value=""></option>
                                <?php $priorGroup = "";
                                foreach ($batches as $batch){ ?>
                                <?php if ($batch["session"] != $priorGroup){    ?>
                                <optgroup label="<?php echo $batch['session']; ?>">
                                    <?php } ?>
                                    <option  value="<?php echo $batch['id']; ?>"<?php echo $batch['id']==$student['batch_no']?'selected':'';  ?>>
                                        <?php echo $batch['code'].'-'.$batch['arm'].'('.$batch['session'].')' ?>
                                    </option>
                                    <?php  $priorGroup = $batch["session"];  } if ($batch["session"] != $priorGroup){echo '</optgroup>';}?>
                            </select>
                        </div>
                      </div>
                      <?php if($student_fields['student_category'] || $student['student_category']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Student Category</label>
                            <select class="form-control select2" name="student_category">
                                <option value="">Please select a state</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"<?php echo $student['student_category']==$category['id']?'selected':''; ?>><?php echo $category['category']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['mobile_phone'] || $student['mobile_phone']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Mobile Phone</label>
                          <input type="tel" id="mobile_phone" value="<?php echo $student['mobile_phone'] ?>" name="mobile_phone" class="form-control" maxlength="15">
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['email'] || $student['email']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" value="<?php echo $student['email'] ?>" name="email" readonly required>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($student_fields['phone'] || $student['phone']) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="tel" class="form-control" value="<?php echo $student['phone'] ?>" name="phone" id="phone" maxlength="15" placeholder="&nbsp;">
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php if($student_fields['address'] || $student['address_line']) { ?>
                  <div class="card-header">
                    <h3 class="card-title">Student Address</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Address Line</label>
                          <textarea class="form-control" rows="1" name="address_line" maxlength="100"><?php echo $student['address_line'] ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Country</label>
                          <select class="form-control select2" name="country" id="snationality">
                            <option value="">Select Country</option>
                            <?php foreach($countries as $country) { ?>
                                <option <?php echo ($country['id'] == $student['country'])? 'selected': ''; ?>
                                    value="<?php echo $country['id'] ?>"><?php echo $country['country_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>State</label>
                            <select class="form-control select2" id="scountry_states" name="state">
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state['id']; ?>"<?php echo ($state['id'] == $student['state'])? 'selected': ''; ?>>
                                        <?php echo $state['name']; ?></option>
                                <?php  endforeach; ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label></label>
                            <select class="form-control select2" id="slga_of_origin" name="city">
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo $city['id']; ?>">
                                        <?php echo $city['name']; ?></option>
                                <?php  endforeach; ?>
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                  <button id="update_students" type="submit" class="btn btn-primary float-right">
                      <i class="fa fa-floppy-o"></i>Update Student</button>
                </div>
                
              </div>
            </form>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script>
    $(document).ready(function () {

        $('.select2').select2({});
        $('#admission_date').datepicker({
            format: 'yyyy-mm-dd'
        }).on('changeDate', function(e){
            $(this).datepicker('hide');
        });

        $('#date_of_birth').datepicker({
            format: 'yyyy-mm-dd'
        }).on('changeDate', function(e){
            $(this).datepicker('hide');
        });

    });


    $("#nationality").change(function () {
        var country = $('#nationality').val();
        $.ajax({
            url: '/isms/students/get_state/'+country,
            cache: false,
            success: function(response) {
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
            url: '/isms/students/get_origin/'+state,
            cache: false,
            success: function(response) {
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