<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Guardian Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">guardians</a></li>
                        <li class="breadcrumb-item active">guardian name</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center mb-3">
                  <img class="profile-user-img img-fluid img-circle"
                    src="<?php echo base_url(); ?>assets/dist/img/avatar.png"
                      alt="User profile picture">
                </div>
                <h3 class="profile-username text-center mb-3">Alh, Nura Muhammad</h3>
                <!--  <p class="text-muted text-center">Software Engineer</p> -->
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                      <b>Guardian Id</b> <a class="float-right">1322</a>
                  </li>
                  <li class="list-group-item">
                      <b>Status</b> <a class="float-right">Registering</a>
                  </li>
                  <li class="list-group-item">
                      <b>Mobile Phone:</b> <a class="float-right">+2348099000000</a>
                  </li>
                </ul>
                <!--  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                Overview
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h3 class="profile-username profile-badge mb-4"><i class="fa fa-user"></i>Profile </h3>
                     <!--  <p class="text-muted text-center">Software Engineer</p> -->
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                          <b>Title</b> <a class="float-right">Mr</a>
                      </li>
                      <li class="list-group-item">
                          <b>Last Name:</b> <a class="float-right">Alh</a>
                      </li>
                      <li class="list-group-item">
                          <b>First Name:</b> <a class="float-right">Nura</a>
                      </li>
                      <li class="list-group-item">
                          <b>Middle Name:</b> <a class="float-right">Muhammad</a>
                      </li>
                      <li class="list-group-item">
                          <b>Gender:</b> <a class="float-right">Male</a>
                      </li>
                      <li class="list-group-item">
                          <b>Activated at:</b> <a class="float-right"></a>
                      </li>
                      <li class="list-group-item">
                          <b>Mobile Phone:</b> <a class="float-right">+2348099000000</a>
                      </li>
                      <li class="list-group-item">
                          <b>SMS enabled?:</b> <a class="float-right">Yes</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <div class="profile-contacts">
                      <div class="profile-b1">
                        <h3 class="profile-username profile-badge"><i class="fa fa-phone orange"></i>Contacts</h3>
                        <div class="contact-info">
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Phone :</b> <a class="float-right">NONE</a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile No:</b> <a class="float-right">+2348099000000</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email:</b> <a class="float-right">mmm@gmail.com</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="">
                        <h3 class="profile-username profile-badge"><i class="fa fa-map-marker azure"></i>Address</h3>
                      </div>
                        <div class="contact-info">
                          <p>
                            Kano, Kibiya, Kano, Nigeria
                          </p>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /row 1-->
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Wards</a></li>
                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Edit</a></li>
                      <li class="nav-item"><a class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#myModal">Change Password</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Remove</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <div class="row">
                        <div class="col-md-12">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                              <table id="guardian-ward" class="display table table-striped" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Admission No</th>
                                          <th>Status</th>
                                          <th>Batch</th>
                                          <th>Admission Date</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Tiger Nixon</td>
                                          <td>System Architect</td>
                                          <td>Edinburgh</td>
                                          <td>2011/04/25</td>
                                          <td>$320,800</td>
                                          <td>
                                              <a class="btn btn-xs btn-info" target="_blank" href="<?php echo site_url('students/student_profile') ?>">
                                                  <i class="fa fa-user"></i> View Profile
                                              </a>
                                          </td>
                                      </tr>
                                    </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                      <div class="row">
                        <div class="col-md-12">
                          <h5>Personal Details</h5>
                          <hr>
                          <form>
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Title</label>
                                      <input type="text" class="form-control" name="emp_surname" />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Surname</label>
                                      <input type="text" class="form-control" name="emp_first_name" />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>First name</label>
                                      <input type="text" class="form-control" />
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Middle name</label>
                                    <input type="text" class="form-control" name="emp_surname" />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile phone</label>
                                    <input type="text" class="form-control" name="emp_first_name" />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" />
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                  <label>Email</label>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                      </div>
                                      <input type="email" class="form-control" />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Gender</label>
                                      <select class="form-control">
                                          <option value="">Please select</option>
                                          <option>Male</option>
                                          <option>Female</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="exampleInputFile">File input</label>
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
                            </div>
                            <h5>Wards</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relationship with student</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <h5>Contact Address</h5>
                            <hr>
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Country</label>
                                      <select class="form-control">
                                          <option>Select Nationality</option>
                                          <?php foreach ($countries as $country) { ?>
                                              <option value="<?php echo $country['country_code'] ?>"><?php echo $country['country_name'] ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>State</label>
                                      <select class="form-control">
                                          <option value="">Please Select</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control" />
                                  </div>
                              </div>
                            </div>
                            <div class="row"> 
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Address line</label>
                                      <textarea class="form-control" rows="3" ></textarea>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>L.G.A</label>
                                      <select class="form-control">
                                          <option value="">Please Select</option>
                                      </select>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Update</button>
                              </div>
                          </div>
                          </form>
                        </div>
                    </div>
                    </div>
                    <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <div class="col-md-6">
                      <div class="well bordered-top bordered-bottom bordered-danger">
                        <h4><i class="fa fa-exclamation-circle danger"></i> Delete Guardian</h4>
                        <p>
                          Completely delete guardian's records from the Institution's databases. Use this option
                          only if you created the guardian record by accident and want to remove it completely.
                        </p>
                        <div id="guardian-destroy-form-errors"></div>
                        <div class="alert alert-warning">
                          <i class="fa-fw fa fa-warning"></i>
                          <strong>Warning</strong> All records associated with guardian will be deleted and
                          cannot be recovered.
                        </div>
                        <a data-confirm-title="Delete Guardian" data-confirm="Are you absolutely sure?" data-disable-with="<i class=&quot;fa fa-spinner fa-spin&quot;></i> Please wait..." class="btn btn-danger delete" data-remote="true" rel="nofollow" data-method="delete" href="/guardians/364">
                            <i class="fa fa-trash-o"></i> Delete
</a>                      </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
            <!-- /row 2-->
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit password: Alh, Nura Muhammad</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Current password</label>
                      <input type="text" class="form-control" name="emp_surname" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>New Password</label>
                      <input type="text" class="form-control" name="emp_surname" />
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Password confirmation</label>
                      <input type="text" class="form-control" name="emp_surname" />
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->