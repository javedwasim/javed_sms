<?php $user_data = $this->session->userdata('userdata');$role = $user_data['role'];?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Students</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">students</li>
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
                    <div id="student_error" style="display: none;" class="alert alert-danger alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="student_success" style="display: none;" class="alert alert-success alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Students</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <?php if($user_data['name']=='admin'): ?>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary"
                                                id="list_itmes_add_student" data-func-call="add_student">
                                            <i class="fa fa-plus"></i>Add Student
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr/>
                            <form rol="form" style="width: 100%;" id="student_form_filters">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Search</label>
                                            <input type="text" name="search-employee" id="search-employee"
                                                   onchange="student_filters()" class="form-control st_filter"
                                                   value="<?php echo isset($filters['search-employee']) ? $filters['search-employee'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control st_filter" name="status" onchange="student_filters()">
                                                <option value="0">All</option>
                                                <option value="1"
                                                    <?php echo isset($filters['status']) && ($filters['status'] == 1) ? 'selected' : ''; ?>>
                                                    Active
                                                </option>
                                                <option value="2"
                                                    <?php echo isset($filters['status']) && ($filters['status'] == 2) ? 'selected' : ''; ?>>
                                                    Graduated
                                                </option>
                                                <option value="3"
                                                    <?php echo isset($filters['status']) && ($filters['status'] == 3) ? 'selected' : ''; ?>>
                                                    Dropped
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Batch</label>
                                            <select prompt="Select Batch" class="form-control st_filter"
                                                    required="required" name="batch_no" onchange="student_filters()">
                                                <option value="">All</option>
                                                <?php $priorGroup = "";
                                                foreach ($batches

                                                as $batch){ ?>
                                                <?php if ($batch["session"] != $priorGroup){ ?>
                                                <optgroup label="<?php echo $batch['session']; ?>">
                                                    <?php } ?>
                                                    <option value="<?php echo $batch['id']; ?>"<?php echo isset($filters['batch_no']) && ($filters['batch_no'] == $batch['id']) ? 'selected' : ''; ?> >
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select class="form-control st_filter" name="course" onchange="student_filters()">
                                                <option value="">All</option>
                                                <?php foreach ($subjects as $subject): ?>
                                                    <option value="<?php echo $subject['id'] ?>"
                                                        <?php echo isset($filters['course']) && ($filters['course'] == $subject['id']) ? 'selected' : ''; ?>><?php echo $subject['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control st_filter" name="gender" onchange="student_filters()">
                                                <option value="">Please select</option>
                                                <option value="Male"<?php echo isset($filters['gender']) && ($filters['gender'] == 'Male') ? 'selected' : ''; ?>>
                                                    Male
                                                </option>
                                                <option value="Female"<?php echo isset($filters['gender']) && ($filters['gender'] == 'Female') ? 'selected' : ''; ?>>
                                                    Female
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Student Category</label>
                                            <select class="form-control st_filter">
                                                <option value="">All</option>
                                                <option value="3">Islamiya</option>
                                                <option value="1">hostal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Fee Balance</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select class="form-control st_filter" name="fee_paid_filter">
                                                        <option value="greater"<?php echo isset($filters['fee_paid_filter']) && ($filters['fee_paid_filter']=='greater') ? 'selected' : ''; ?>>&gt;</option>
                                                        <option value="less"<?php echo isset($filters['fee_paid_filter']) && ($filters['fee_paid_filter']=='less') ? 'selected' : ''; ?>>&lt;</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control st_filter" value="<?php echo isset($filters['fee_paid']) ? $filters['fee_paid'] : ''; ?>"
                                                       aria-label="Text input with dropdown button" name="fee_paid" onchange="student_filters()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date Admitted</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control st_filter" id="admit_date"
                                                   name="admit_date" onchange="student_filters()"
                                                   value="<?php echo isset($filters['admit_date']) ? $filters['admit_date'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date of Birth</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control st_filter" id="st_dob" onchange="student_filters()"
                                                   name="dob" value="<?php echo isset($filters['dob']) ? $filters['dob'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary btn-md" id="filter" onclick="return resetForm()">
                                                <i class="fa fa-refresh"></i>Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                                class="fa fa-print"></i>Print PDF
                                    </button>
                                </div>
                            </div>
                            <hr>
<<<<<<< HEAD
                            <table id="student-b-table" class="table table-bordered table-striped" width="100%">
=======
                            <table id="student-b-table" class="table table-bordered table-striped">
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="visibility">Address</th>
                                    <th>Adm. Date</th>
                                    <th>Batch</th>
                                    <th class="visibility">Blood grp.</th>
                                    <th class="visibility">Course set</th>
                                    <th class="visibility">Date left</th>
                                    <th class="">D.O.B</th>
                                    <th class="visibility">Due fees</th>
                                    <th class="">Email</th>
                                    <th class="visibility">Last Updated</th>
                                    <th class="visibility">Mobile</th>
                                    <th class="visibility">Nationality</th>
                                    <th class="visibility">Phone</th>
                                    <th class="visibility">Reg. started</th>
                                    <th class="visibility">Religion</th>
                                    <th class="visibility">Wallet bal.</th>
                                    <th data-orderable="false">Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($students as $student) { ?>
                                    <tr>
                                        <td>
                                            <?php if(($role!='Finance') || $user_data['name']=='admin'): ?>
                                                <a class="prof-link std_profile"
                                                   data-student-id = "<?php echo $student['student_id']; ?>"
                                                   data-href="<?php echo site_url('students/profile/') . $student['student_id'] ?>">
                                                   <?php echo $student['surname'] . ', ' . $student['first_name'] ?></a>
                                            <?php else: ?>
                                                <?php echo $student['surname'] . ', ' . $student['first_name'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="visibility">
                                            <?php echo $student['address_line']; ?>
                                        </td>
                                        <td>
                                            <?php echo date('F d, Y', strtotime($student['admission_date'])) ?>
                                        </td>
                                        <td>
                                            <?php echo $student['code'] . '-' . $student['arm'] . '(' . $student['session'] . ')' ?>
                                        </td>
                                        <td class="">
                                            <?php echo $student['blood_group']; ?>
                                        </td>
                                        <td class="visibility"></td>
                                        <td class="visibility"></td>
                                        <td class="">
                                            <?php echo $student['date_of_birth']; ?>
                                        </td>
                                        <td class="visibility"></td>
                                        <td class="">
                                            <?php echo $student['email']; ?>
                                        </td>
                                        <td class="visibility">
                                            <?php echo $student['updated']; ?>
                                        </td>
                                        <td class="visibility">
                                            <?php echo $student['mobile_phone']; ?>
                                        </td>
                                        <td class="visibility">
                                            <?php echo $student['nationality']; ?>
                                        </td>
                                        <td class="visibility">
                                            <?php echo $student['phone']; ?>
                                        </td>
                                        <td class="visibility"></td>
                                        <td class="visibility"> <?php echo $student['religion']; ?> </td>
                                        <td class="visibility"></td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="<?php echo "s".$student['student_id']; ?>" name="<?php echo "s".$student['student_id']; ?>"
                                                       type="checkbox" class="select-student"
                                                       data-student-id = "<?php  echo $student['student_id'];  ?>"
                                                       data-action="<?php echo site_url('students/select_student') ?>" />
                                                <label for="<?php  echo "s".$student['student_id'];  ?>" class="label-info switch"></label>
                                            </div>
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Student List PDF options</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="inst_item_form_modal" method="post" role="form" target="_blank"
                          action="<?php echo base_url(); ?>students/createPdf" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="" class="form-control" placeholder="Student List" maxlength="50">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Check All:&nbsp;<input type="checkbox" class="checkbox" id="checkAll"/></label>
                                      </div>
                                </div>
                                <hr>
                                <div class="col-md-12 mb-3">
                                    <h5>Fields to show</h5>
                                </div>
                                <div class="col-md-5 offset-md-1">
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="address_line" name="student_fields[]">Address</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="batch_no" name="student_fields[]">Batch</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="date_of_birth" name="student_fields[]">Date of birth</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="email" name="student_fields[]">Email</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="mobile_phone" name="student_fields[]">Mobile phone</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="phone" name="student_fields[]">Phone</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="religion" name="student_fields[]">Religion</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="admission_date" name="student_fields[]">Admission date</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="blood_group" name="student_fields[]">Blood group</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="nationality" name="student_fields[]">Nationality</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="created" name="student_fields[]">Registration started</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="field_to_show" value="" name="student_fields[]">Wallet balance</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-danger waves-effect waves-light"
                                        id="generate_pdf_student">Generate PDF</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function () {

        $("#checkAll").change(function () {
            $(".field_to_show:checkbox").prop('checked', $(this).prop("checked"));
        });


        $('#st_dobd').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        }).on("change", function() {
            $('#st_dob').hide();
                student_filters();
                return;
        });

    });
    $(function() {
        $('#toggle-event').change(function() {
            $('#console-event').html('Toggle: ' + $(this).prop('checked'))
        });
    });
    
    function resetForm() {
        $('.st_filter').val('');
        student_filters();
    }

</script>