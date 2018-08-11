<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo isset($students[0])?$students[0]['code'] . '-' . $students[0]['arm'] . '(' . $students[0]['session'] . ')':''; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">students</a></li>
                        <li class="breadcrumb-item active"><?php echo isset($student['first_name']) && (!empty($student['first_name'])) ? $student['first_name'] . ', ' . $student['last_name'] : "" ?></li>
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
                    <div class="card card-primary">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Behavioural Scoresheet</a></li>
                                <li class="nav-item"><a class="nav-link" href="#demographic" data-toggle="tab">Demographics</a></li>
                                <li class="nav-item"><a class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#myModal">Assign Employee</a></li>
                                <li class="nav-item"><a class="nav-link" href="" data-href="<?php echo site_url('students/edit/')?>">Edit</a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <div class="card card-primary card-outline">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Student List</h5>
                                                        <hr>
                                                        <ul class="list-group">
                                                            <?php foreach ($students as $student): $admission_no = $student['admission_no']; ?>
                                                                <a href="javascript:void(0)"><li class="list-group-item list-group-item-primary">
                                                                        <?php echo $student['first_name'].' '.$student['last_name'],"($admission_no)"; ?></li></a>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div><!-- /.card -->

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <div class="card card-primary card-outline">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Report</h5>

                                                        <p class="card-text">
                                                            Some quick example text to build on the card title and make up the bulk of the card's
                                                            content.
                                                        </p>
                                                        <a href="#" class="card-link">Card link</a>
                                                        <a href="#" class="card-link">Another link</a>
                                                    </div>
                                                </div><!-- /.card -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="demographic">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Admission No</th>
                                                    <th>Name</th>
                                                    <th>Birthday</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($students as $student): ?>
                                                        <tr>
                                                            <td><?php echo $student['admission_no'] ?></td>
                                                            <td><?php echo $student['first_name'].' '.$student['last_name']; ?></td>
                                                            <td><?php echo date('F j, Y',strtotime($student['date_of_birth'])) ; ?></td>
                                                            <td>
                                                                <a class="btn btn-xs btn-info" target="_blank" href="<?php echo base_url()."students/student_profile/".$student['student_id']; ?>">
                                                                    <i class="fa fa-user"></i> View Profile
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Personal Details</h5>

                                        </div>
                                    </div>
                                </div>

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
    </section>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Roles</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="assign_employee" method="post" role="form"
                      data-action="<?php echo site_url('batches/assign_employees') ?>"
                      enctype="multipart/form-data">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                    <input type="hidden" name="email" value="<?php echo $student['email']; ?>">
                    <div class="assign_employee">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select id="employee" name="employee[]" class="form-control">
                                    <option selected="">Please Select</option>
                                    <?php foreach ($employees as $employee): ?>
                                        <option value="<?php echo $employee['employee_id']; ?>"><?php echo $employee['first_name'].' '.$employee['surname'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select id="role" name="role[]" class="form-control">
                                    <option selected="">Please Select</option>
                                    <option value="1">Class Teacher</option>
                                    <option value="5">Guidance Counsellor</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <a class="btn btn-danger btn-sm" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="container"></div>
                        <div class="col-md-12">
                            <div class="form-group" style="text-align: center">
                                <button type="button" id="add_role" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>Add Role</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="change_password" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus fa-floppy-o"></i>Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $("#example1").DataTable();
        });

        $('#add_role').click(function () {
            var fieldHTML = '<div class="form-row"><div class="form-group col-md-4">' +
                                '<select id="employee" name="employee[]" class="form-control">' +
                                    '<option selected="">Please Select</option>' +
                                     <?php foreach ($employees as $employee): $id = $employee['employee_id'];
                                        $name = $employee['first_name'].' '.$employee['surname']; ?>
                                        '<option value="<?php echo $id; ?>"><?php echo $name; ?></option>' +
                                     <?php endforeach; ?>
                                '</select>' +
                             '</div>' +
                             '<div class="form-group col-md-4">' +
                                '<select id="employee" name="employee[]" class="form-control">' +
                                '<option selected="">Please Select</option>' +
                                '<option value="1">Class Teacher</option>' +
                                '<option value="2">Guidance Counsellor</option>' +
                                '</select>' +
                              '</div>' +
                              '<div class="form-group col-md-4">' +
                                    '<a class="btn btn-danger btn-sm remove_button" href="#"><i class="fa fa-trash"></i></a>' +
                              '</div></div>';

            $('.assign_employee').append(fieldHTML); //Add field html

        });

        //Once remove button is clicked
        $('.assign_employee').on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).closest(".form-row").remove();
        });


    </script>