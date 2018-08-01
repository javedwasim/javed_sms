<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Search Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">search</li>
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
          <div class="col-md-12">
              <div id="employee_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              </div>
              <div id="employee_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              </div>
            <div class="card card-primary">
            <div class="card-header">
              <!-- <h3 class="card-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>Add Employee</button>
                </div>
                <div class="col-md-2 offset-md-7">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6" style="padding: 0px;">
                        <label>Show more</label>
                      </div>
                      <div class="col-md-1" style="padding: 0px;">
                        <input type="checkbox" name="" class="flat-red">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr />
              <form rol="form" style="width: 100%;">
              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label> Search</label>
                      <input type="text" name="search-employee" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control">
                          <option value="">Please select</option>
                          <option>Active</option>
                          <option>Left institution</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control">
                          <option value="">Please select</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" >
                          <option value="">All</option>
                          <option value="3">Teaching Staff</option>
                          <option value="1">System Admin Operator</option>
                          <option value="6">Security Personnel</option>
                          <option value="4">Non-Teaching Staff</option>
                          <option value="5">Administrative Staff</option>
                          <option value="2">Accounts</option>
                        </select>
                    </div>
                  </div>
                </div>
              </form>
              <form>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Department</label>
                      <select class="form-control" >
                        <option value="">All</option>
                        <option value="1">System Admin</option>
                        <option value="5">Security</option>
                        <option value="2">Secondary</option>
                        <option value="6">primary</option>
                        <option value="4">ICT Department</option>
                        <option value="3">Account Department</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Position</label>
                      <select class="form-control">
                        <option value="">All</option>
                        <option value="2">Teacher</option>
                        <option value="1">System Admin</option>
                        <option value="5">Secretary</option>
                        <option value="3">Principal</option>
                        <option value="7">Dean of Studies</option>
                        <option value="4">Chief Security Staff</option>
                        <option value="8">Bursar</option>
                        <option value="6">Accountant</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label> Date Joined</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      </div>
                      <input type="text" class="form-control datepicker" id="emp-li-dob">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label>Date of Birth</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      </div>
                      <input type="text" class="form-control datepicker" id="emp-li-doj">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Show more fields</label>
                      <select class="form-control select2" multiple="multiple" data-placeholder="Show more fields" style="width: 100%;">
                        <option value="AL">Employee no</option>
                        <option value="WY">Department</option>
                        <option value="WY">Category</option>
                        <option value="WY">Position</option>
                        <option value="WY">Joining date</option>
                        <option value="WY">Date left</option>
                        <option value="WY">Date of birth</option>
                        <option value="WY">Blood group</option>
                        <option value="WY">Religion</option>
                        <option value="WY">Registration started</option>
                        <option value="WY">Last updated</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group mt-3">
                      <button type="submit" class="btn btn-info btn-md" ><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </form>
              <hr />
              <table id="employee_listing_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Employee No</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($employees as $employee) { ?>
                    <tr>
                        <td>
                            <a href="javascript:void(0)"><?php echo $employee['surname'].', '.$employee['first_name'] ?></a>
                        </td>
                        <td><?php echo $employee['employee_no'];?></td>
                        <td>
                            <!-- use function to pass edit url -->
                            <a class="edit-studentsss btn btn-info btn-xs" onclick="loadEditForm('<?php echo site_url('employee/edit/').$employee['employee_id']; ?>')" href="javascript:void(0)" data-href="<?php echo site_url('employees/edit/').$employee['employee_id'] ?>">Edit  <i class="fa fa-edit" title="Edit"></i></a>
                            <a class="delete-student btn btn-danger btn-xs" href="#" data-href="<?php echo site_url('employee/delete_user/').$employee['employee_id'];?>">Delete  <i class="fa fa-trash" title="Delete"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->