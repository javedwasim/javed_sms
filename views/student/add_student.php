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
              <form id="student_form" method="post" role="form" data-action="<?php echo site_url('students/add_new_student') ?>" enctype="multipart/form-data">
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
                          <input type="text" class="form-control" name="surname" placeholder="Surname" maxlength="20" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><code>*</code>First Name</label>
                          <input type="text" class="form-control" name="first_name" placeholder="First Name" maxlength="20" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" maxlength="20">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="form-group">
                            <label><code>*</code>Admission No</label>
                            <input type="text" class="form-control" name="admission_no" placeholder="Admission No" maxlength="10" required>
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
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="admission_date" placeholder="Admission Date" required>
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
                              <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="date_of_birth" placeholder="Date of Birth">
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['gender']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
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
                              <option value="Christianity">Christianity</option>
                              <option value="Islam">Islam</option>
                            </select>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['photo']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['blood_group']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Blood Group</label>
                            <select class="form-control" name="blood_group">
                              <option value="">Blood Group</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
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
                              <option value="AA">AA</option>
                              <option value="AS">AS</option>
                              <option value="SS">SS</option>
                              <option value="AC">AC-</option>
                            </select>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['nationality']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control" name="nationality">
                              <option value="">Select Nationality</option>
                              <?php foreach ($countries as $country) { ?>
                                <option value="<?php echo $country['country_code'] ?>"><?php echo $country['country_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['state_of_origin']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>State of Origin</label>
                            <input type="text" class="form-control" name="state_of_origin" maxlength="10" placeholder="State of Origin">
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['lga_of_origin']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>L.G.A of Origin</label>
                            <input type="text" class="form-control" name="lga_of_origin" maxlength="20" placeholder="L.G.A of Origin">
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
                                        <?php if ($batch["session"] != $priorGroup){    ?>
                                            <optgroup label="<?php echo $batch['session']; ?>">
                                        <?php } ?>
                                        <option  value="<?php echo $batch['id']; ?>">NCSS - MNIS (2018/2019)</option>
                                <?php  $priorGroup = $batch["session"];  } if ($batch["session"] != $priorGroup){echo '</optgroup>';}?>
                            </select>
                        </div>
                      </div>
                      <?php if ($student_fields['student_category']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Student Category</label>
                            <input type="text" class="form-control" name="student_category" maxlength="15" placeholder="Student Category">
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['mobile_phone']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Mobile Phone</label>
                            <input type="tel" maxlength="15" id="mobile_phone" name="mobile_phone" class="form-control">
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['email']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" maxlength="50" placeholder="Email">
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($student_fields['phone']) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" maxlength="15" id="phone">
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
                            <textarea class="form-control" rows="1" maxlength="70" name="address_line"></textarea>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="country">
                              <option value="">Select Country</option>
                              <?php foreach ($countries as $country) { ?>
                                <option value="<?php echo $country['country_code'] ?>"><?php echo $country['country_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" maxlength="20" placeholder="State">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label></label>
                            <input type="text" class="form-control" name="city" maxlength="20" placeholder="City">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if($student_fields['guardian_info_section'] == 0){ ?>
                    <div class="row">
                      <div class="col-md-6" style="margin-bottom: 20px;">

                        <button id="save_student" type="submit" class="btn btn-primary btn-lg pull-right">Save Student</button>
                      </div>
                      <div class="col-sm-6">
                        <button id="save_and_add_another" type="submit" class="btn btn-primary btn-lg pull-center">Save and add another</button>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if ($student_fields['guardian_info_section']) { ?>
                    <div class="card-header">
                      <h3 class="card-title">Guardian Details</h3>
                    </div>
                    <div class="card-body guardian-card">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="btn-group">
                              <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Assign Guardian</a>
                              <span class="sr-only"></span>
                              <div class="dropdown-menu">
                                <a href="#" class="dropdown-item" id="ex-guardian">Assign Existing Guardian</a>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModal">Create New Guardian</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <?php $this->load->view('parts/guardian_list'); ?>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-md-6" style="margin-bottom: 20px;">

                            <button id="save_student" type="submit" class="btn btn-primary btn-lg pull-right">Save Student</button>
                          </div>
                          <div class="col-sm-6">
                            <button id="save_and_add_another" type="submit" class="btn btn-primary btn-lg pull-center">Save and add another</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </form>
            </div>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

        <!-----------------modal guardian-------------------->
        <div class="container">
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <form id="guardian_form" method="post" role="form" enctype="multipart/form-data"
                    data-action="<?php echo site_url('guardians/add_new_guardian') ?>">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Create New Guardian</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h5>Personal Details</h5>
                      <hr>
                      
                        <div class="row">
                          <?php if($student_fields['title']) { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" maxlength="15" name="title"/>
                              </div>
                            </div>
                          <?php } ?>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label><code>*</code>Surname</label>
                              <input type="text" class="form-control" maxlength="15" name="surname" required />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label><code>*</code>First Name</label>
                              <input type="text" class="form-control" maxlength="15" name="first_name" required/>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Middle name</label>
                              <input type="text" class="form-control" maxlength="15" name="middle_name" />
                            </div>
                          </div>
                          <?php if($student_fields['mobile_phone']) { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Mobile phone</label>
                                <input type="tel" id="guardian_mobile_phone" class="form-control" maxlength="15" name="mobile_phone" />
                              </div>
                            </div>
                          <?php } ?>
                          <?php if($student_fields['phone']) { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" id="guardian_phone" maxlength="15" class="form-control" name="phone" />
                              </div>
                            </div>
                          <?php } ?>
                          <?php if($student_fields['email']) { ?>
                            <div class="col-md-4">
                              <label>Email</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" maxlength="30" name="email" />
                              </div>
                            </div>
                          <?php } ?>
                          <?php if($student_fields['gender']) { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control">
                                  <option value="">Please select</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                </select>
                              </div>
                            </div>
                          <?php } ?>
                          <?php if($student_fields['photo']) { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputFile">Photo</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                        <h5>Wards</h5>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Relationship with student</label>
                              <input type="text" class="form-control" name="relation_with_student" maxlength="20" />
                            </div>
                          </div>
                        </div>
                        <?php if($student_fields['address']){ ?>
                          <h5>Contact Address</h5>
                          <hr>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Country</label>
                                <select class="form-control" name="country">
                                  <option value="">Select Nationality</option>
                                  <?php foreach ($countries as $country) { ?>
                                    <option value="<?php echo $country['country_code'] ?>"><?php echo $country['country_name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>State</label>
                                <select class="form-control" name="state">
                                  <option value="">Please Select</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" maxlength="20" name="city" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Address line</label>
                                <textarea class="form-control" maxlength="70" rows="3" name="address_line"></textarea>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>L.G.A</label>
                                <select class="form-control" name="lga">
                                  <option value="">Please Select</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="save-guardian">Save</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>