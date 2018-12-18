<?php
$user_data = $this->session->userdata('userdata');
$user_name = $user_data['name'];
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Subject List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">subjects</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Subject Filter</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form rol="form" style="width: 100%;" id="batch_subject_form">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Batch</label>
                                                    <select prompt="Select Batch" class="form-control st_filter"
                                                            required="required" name="batch_no">
                                                        <option value="0">Please select</option>
                                                        <?php $priorGroup = "";
                                                        foreach ($batches

                                                        as $batch){ ?>
                                                        <?php if ($batch["session"] != $priorGroup){ ?>
                                                        <optgroup label="<?php echo $batch['session']; ?>">
                                                            <?php } ?>
                                                            <option value="<?php echo $batch['id']; ?>"<?php echo isset($batch_no) && ($batch_no == $batch['id']) ? 'selected' : ''; ?> >
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
                                            <div class="col-md-4">
                                                <div class="form-group mt-3">
                                                    <button type="button" class="btn btn-primary btn-md" id="filter" onclick="return batch_filter()">
                                                        <i  class="fa fa-search"></i>View Subjects</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($user_name) && ($user_name=='admin')): ?>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#new_subject">
                                    <i class="fa fa-plus"></i>Subject
                                </button>

                                <button type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#new_group">
                                    <i class="fa fa-plus"></i>New Elective Group
                                </button>
                            </div>
                        <?php endif; ?>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                <i class="fa fa-book"></i>Core Subjects
                            </button>
                            <table id="subject" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Batch</th>
                                    <th>Max-Weekly Classes</th>
                                    <th>Employees</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($core_subjects as $detail): ?>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)"
                                                   data-href="<?php echo site_url('subjects/subject_detail/').$detail['id']; ?>"
                                                   class="link prof-link" id="sbj_detail_view"><?php echo $detail['subject_name']; ?></a>
                                            </td>
                                            <td><?php echo $detail['arm'].'('.$detail['c_name'].$detail['session'].')'; ?></td>
                                            <td><?php echo $detail['max_weekly_class']; ?></td>
                                            <td><?php echo $detail['emp_count']; ?></td>
                                            <td>
                                                <?php if(isset($user_name) && ($user_name=='admin')): ?>
                                                    <a class="btn btn-light btn-xs"
                                                       href="javascript:void(0)"
                                                       data-batch-id="<?php echo $detail['batch_id']; ?>"
                                                       data-action="<?php echo site_url()."subjects/assigned_employees/".$detail['id'];  ?>"
                                                       data-href="<?php echo $detail['id']; ?>">
                                                       Assign Employee<i class="fa fa-user" title="Assign Employee"></i></a>
                                                    <a class="edit_subject btn btn-info btn-xs"
                                                       href="javascript:void(0)"
                                                       data-batch-id="<?php echo $detail['batch_id']; ?>"
                                                       data-href="<?php echo $detail['id']; ?>">
                                                       <i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                                    <a href="javascript:void(0)" data-href="<?php echo site_url('subjects/delete/').$detail['id']; ?>"
                                                        class="btn btn-danger btn-xs waves-effect waves-light delete_subject_detail">
                                                        <i class="fa fa-trash icon-margin"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-book"></i>Elective Subjects
                            </button>
                            <table id="subject" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Batch</th>
                                    <th>Max-Weekly Classes</th>
                                    <th>Employees</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($elective_subjects as $detail): ?>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0)"
                                               data-href="<?php echo site_url('subjects/subject_detail/').$detail['id']; ?>"
                                               class="link prof-link" id="sbj_detail_view"><?php echo $detail['subject_name']; ?></a>
                                        </td>
                                        <td><?php echo $detail['arm'].'('.$detail['c_name'].$detail['session'].')'; ?></td>
                                        <td><?php echo $detail['max_weekly_class']; ?></td>
                                        <td><?php echo $detail['emp_count']; ?></td>
                                        <td>
                                            <?php if(isset($user_name) && ($user_name=='admin')): ?>
                                                <a class="btn btn-light btn-xs"
                                                   href="javascript:void(0)"
                                                   data-batch-id="<?php echo $detail['batch_id']; ?>"
                                                   data-action="<?php echo site_url()."subjects/assigned_employees/".$detail['id'];  ?>"
                                                   data-href="<?php echo $detail['id']; ?>">
                                                    Assign Employee<i class="fa fa-user" title="Assign Employee"></i></a>
                                                <a class="edit_subject btn btn-info btn-xs"
                                                   href="javascript:void(0)"
                                                   data-batch-id="<?php echo $detail['batch_id']; ?>"
                                                   data-href="<?php echo $detail['id']; ?>">
                                                   <i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                                <a href="javascript:void(0)" data-href="<?php echo site_url('subjects/delete/').$detail['id']; ?>"
                                                   class="btn btn-danger btn-xs waves-effect waves-light delete_subject_detail">
                                                   <i class="fa fa-trash icon-margin"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="new_subject" tabindex="-1" role="dialog" aria-labelledby="new_subject_label"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 font-weight-bold" style="text-align: center">Subject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="batch_form" method="post" role="form"  data-action="<?php echo site_url('subjects/save') ?>" enctype="multipart/form-data">
                    <div class="modal-body edit_subject_body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Subject base</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" name="subject_id" required>
                                    <option value="">Please Select</option>
                                    <?php foreach ($subjects as $subject): ?>
                                        <option value="<?php echo $subject['id'] ?>"><?php echo $subject['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Max weekly classes</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="max_weekly_class" name="max_weekly_class" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Elective group</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="elective_group_id">
                                    <option value="">Please Select</option>
                                    <?php foreach ($groups as $group): ?>
                                        <option value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Batches</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="batch_id">
                                    <option value="">Please Select</option>
                                    <?php foreach ($batches as $batch):$session = $batch['session']; ?>
                                        <option value="<?php echo $batch['id'] ?>"><?php echo $batch['code'].'-'.$batch['arm']."($session)"; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12" style="text-align: center">
                            <button type="submit" class="btn btn-primary" id="save_subject">
                                <i class="fa fa-plus"></i>Save Subject
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="new_group" tabindex="-1" role="dialog" aria-labelledby="new_group_label"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Elective Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elective_subject_form" method="post" role="form"  data-action="<?php echo site_url('subjects/save_elective_group') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Name<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="elective_group" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="save_elective_group">
                            <i class="fa fa-floppy-o"></i>Create Elective group
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assign_employee_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Roles</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="assign_employee_form" method="post" role="form"
                          data-action="<?php echo site_url('subjects/assign_employees') ?>"
                          enctype="multipart/form-data">

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
                                    <button type="button" id="add_subject_role" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i>Add Role</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="assign_employee" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus fa-floppy-o"></i>Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {

            $('#batch').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            $('#new_subject').on('hidden.bs.modal', function () {
                $('#subject_id').val('');
                $('#max_weekly_class').val('');
                $('#elective_group_id').val('');
                $('#batch_id').val('');
            });

        });

        $('#add_subject_role').click(function () {
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
                '<select id="employee" name="role[]" class="form-control">' +
                '<option selected="">Please Select</option>' +
                '<option value="1">Class Teacher</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group col-md-4">' +
                '<a class="btn btn-danger btn-sm remove_button" href="#"><i class="fa fa-trash"></i></a>' +
                '</div></div>';

            $('.assign_employee').append(fieldHTML); //Add field html
        });
        $(document.body).on('click', '.btn-light', function(){
            $.ajax({
                url: $(this).attr('data-action'),
                type: 'post',
                cache: false,
                success: function(response) {
                    if (response.success) {
                        $('#assign_employee_form')[0].reset();
                        $('.assign_employee').empty();
                        $('.assign_employee').append(response.subject_html);
                        $('#assign_employee_modal').modal('show');
                    } else {
                        toastr["error"](response.message);
                    }
                }
            });
            return false;
        });
        //Once remove button is clicked
        $('.assign_employee').on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).closest(".form-row").remove();
        });

    </script>
</div>
