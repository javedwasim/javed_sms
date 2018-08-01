 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark">Search</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">guardian search</li>
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
          <div id="student_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          </div>
          <div id="student_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          </div>
        </div>
      </div>
      <div class="row"> 
       <div class="col-md-12">
        <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Guardians</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
          <div class="row">
            <div class="col-md-2">
              
            </div>
            <div class="col-md-2 offset-md-8">
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
            </div>
          </form>
          <form>
            <div class="row">
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
              <div class="col-md-3">
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
            </div>
            <div class="row">
              <div class="col-md-1">
                <div class="form-group">
                  <button type="submit" class="btn btn-info" ><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </form>
          <hr />
          <table id="guardian-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Ward</th>
                <th> Activated at</th>
                <th data-orderable="false">Action</th>
              </tr>
            </thead>
             <tbody>
              <?php foreach($guardians as $guardian){ ?>
                <tr>
                  <td>
                    <p><?php echo $guardian['surname'].', '.$guardian['first_name'].'('.$guardian['guardian_id'].')' ?></p>
                  </td>
                  <td>
                    <p>
                      Daniel Nduati (5p12)
                    </p>
                  </td> 
                  <td>
                    <p> Jun 01, 2018 05:18 pm</p>
                  </td>
                  <td>
                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-user-plus"></i> Select</a>
                  </td>
                </tr>
              <?php } ?>
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
</section>
<!-- /.content -->
</div>