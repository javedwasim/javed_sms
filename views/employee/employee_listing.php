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
                    <div id="employee_error" style="display: none;" class="alert alert-danger alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php
                        $message = $this->session->flashdata('error');
                        echo !empty($message)?$message:''; ?>
                    </div>

                    <div id="employee_success" style="display: none;" class="alert alert-success alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                             <h3 class="card-title">Employees</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary" id="list_itmes_employee_add">
                                        <i class="fa fa-plus"></i>Add Employee</button>
                                </div>
                            </div>
                            <hr/>
                            <form rol="form" style="width: 100%;" id="employee_form_filters">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Search</label>
                                            <input type="text" name="search-employee" class="form-control emp_filter"
                                                   value="<?php echo isset($filters['search-employee']) ? $filters['search-employee'] : ''; ?>"
                                                   onchange="employee_filters()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control emp_filter" name="status" onchange="employee_filters()">
                                                <option value="">Please select</option>
                                                <option value="1"<?php echo isset($filters['status']) &&($filters['status']==1) ? 'selected' : ''; ?>>Active</option>
                                                <option value="0"<?php echo isset($filters['status']) &&($filters['status']==0) ? 'selected' : ''; ?>>Left institution</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control emp_filter" name="gender" onchange="employee_filters()">
                                                <option value="">Please select</option>
                                                <option value="male"<?php echo isset($filters['gender']) &&($filters['gender']=='male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="female"<?php echo isset($filters['gender']) &&($filters['gender']=='female') ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control emp_filter" name="category" onchange="employee_filters()">
                                                <option value="">All</option>
                                                <?php foreach ( $categories as $category) : ?>
                                                    <option value="<?php echo $category['id']; ?>"<?php echo isset($filters['category']) &&($filters['category']==$category['id']) ? 'selected' : ''; ?>><?php echo $category['category']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control emp_filter" name="department"
                                                    onchange="employee_filters()">
                                                <option value="">All</option>
                                                <?php foreach ( $departments as $department) : ?>
                                                    <option value="<?php echo $department['id']; ?>"<?php echo isset($filters['department']) &&($filters['department']==$department['id']) ? 'selected' : ''; ?>><?php echo $department['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control emp_filter" name="position" onchange="employee_filters()">
                                                <option value="">All</option>
                                                <?php foreach ( $positions as $position) : ?>
                                                    <option value="<?php echo $position['id']; ?>"<?php echo isset($filters['position']) &&($filters['position']==$position['id']) ? 'selected' : ''; ?>><?php echo $position['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label> Date Joined</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control emp_filter"  name="date_of_join"
                                                   onchange="employee_filters()" value="<?php echo isset($filters['date_of_join'])?$filters['date_of_join']: ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date of Birth</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control emp_filter" name="date_of_birth"
                                                   onchange="employee_filters()" value="<?php echo isset($filters['date_of_birth'])?$filters['date_of_birth']: ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary btn-md" onclick="return resetForm()">
                                            <i class="fa fa-refresh"></i> Reset</button>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <table id="employee_listing_table" class="table table-bordered table-striped" width="100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Employee No</th>
                                    <th class="visibility">Department</th>
                                    <th class="visibility">Category</th>
                                    <th class="visibility">Postion</th>
                                    <th class="visibility">Joining Date</th>
                                    <th class="visibility">Date Left</th>
                                    <th class="visibility">Date of birth</th>
                                    <th class="visibility">Blood Group</th>
                                    <th class="visibility">Religion</th>
                                    <th class="visibility">Registration Started</th>
                                    <th class="visibility">Last Updated</th>
                                    <th class="visibility">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($employees as $employee) { ?>
                                    <tr>
                                        <td>
                                            <a class="prof-link emp_profile"
                                               data-href="<?php echo site_url('employee/profile/') . $employee['employee_id'] ?>" >
                                                <?php echo $employee['surname'] . ', ' . $employee['first_name'] ?></a>
                                        </td>
                                        <td><?php echo $employee['employee_no']; ?></td>
                                        <td class="visibility"><?php echo $employee['dept_name']; ?></td>
                                        <td class="visibility"><?php echo $employee['category']; ?></td>
                                        <td class="visibility"><?php echo $employee['position']; ?></td>
                                        <td class="visibility"><?php echo $employee['date_of_join']; ?></td>
                                        <td class="visibility"><?php echo $employee['status_updated_at']; ?></td>
                                        <td class="visibility"><?php echo $employee['date_of_birth']; ?></td>
                                        <td class="visibility"><?php echo $employee['blood_group']; ?></td>
                                        <td class="visibility"><?php echo $employee['religion']; ?></td>
                                        <td class="visibility"><?php echo $employee['created']; ?></td>
                                        <td class="visibility"><?php echo $employee['updated']; ?></td>
                                        <td class="visibility">
                                            <a class="edit-studentsss btn btn-info btn-xs" href="javascript:void(0)">
                                                <i class="fa fa-user-plus"></i> Select</a>
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
    <?php $message = $this->session->flashdata('success'); if(!empty($message)): ?>
        <script>
            $(document).ready(function(){
                toastr["success"]('<?php echo $message ?>');
            });
        </script>
    <?php endif; ?>
    <?php $message = $this->session->flashdata('error'); if(!empty($message)): ?>
        <script>
            $(document).ready(function(){
                toastr["warning"]('<?php echo $message ?>');
            });
        </script>
    <?php endif; ?>

<script>

    $(document).ready(function(){

        var epmtable = $("#employee_listing_table").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'colvis'
            ]
        });
        epmtable.columns( [ 2, 3,4, 5, 6,7,8,9,10,11] ).visible( false, false );
        $(".buttons-colvis").html('Fields to Show');

        $('#date_of_join').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#date_of_birth').datepicker({
            format: 'yyyy-mm-dd'
        });

    });
    function employee_filters() {
        $.ajax({
            url: '/isms/employee/employee_filters',
            data: $('#employee_form_filters').serialize(),
            type: 'post',
            cache: false,
            success: function (response) {
                if (response.employee_html != '') {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.employee_html);
                    $('#title').html('Employee Listing | ISMS');
                }
            }
        });
    }

    function resetForm() {
        $('.emp_filter').val('');
        employee_filters();
    }

</script>