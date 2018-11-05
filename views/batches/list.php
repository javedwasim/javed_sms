<?php $userdata = $this->session->userdata('userdata'); $role = $userdata['role']; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Batch List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">batches</li>
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
                    <div id="batches_error" style="display: none;" class="alert alert-danger alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="batches_success" style="display: none;" class="alert alert-success alert-dismissible"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Batches</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (!empty($rights[0]['other_rights']) || ($userdata['name'] == 'admin')) { ?>
                                        <button type="button" class="btn btn-primary"
                                                data-toggle="modal" data-target="#new_batch" id="batch_list">
                                            <i class="fa fa-plus"></i>New Batch 
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-primary"
                                                onclick="notification();">
                                            <i class="fa fa-plus"></i>New Batch
                                        </button>
                                    <?php } ?>

                                    <table id="batch" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Students</th>
                                            <th style="width: 9%">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($role!='Subject Teacher'): foreach ($batches as $batch): $session = $batch['session']; ?>
                                            <tr>
                                                <td>
                                                    <?php if ($userdata['name'] == 'admin') { ?>
                                                        <a href="<?php echo site_url('batches/demographics/') . $batch['id']; ?>" class="link prof-link">
                                                            <?php echo $batch['code'] . '-' . $batch['arm'] . "($session)"; ?></a>
                                                    <?php } elseif(($userdata['name'] != 'admin') && !empty($rights[0]['other_rights'])) { ?>
                                                        <?php if($batch['employee_id']>0){ ?>
                                                            <a href="<?php  echo site_url('batches/demographics/') . $batch['id']; ?>" class="link prof-link">
                                                                <?php echo $batch['code'] . '-' . $batch['arm'] . "($session)"; ?></a>
                                                        <?php } else { ?>
                                                            <a href="<?php  echo site_url('batches/demographics/') . $batch['id']; ?>" class="link prof-link">
                                                                <?php echo $batch['arm']; ?></a>
                                                        <?php } ?>
                                                    <?php } else{ ?>
                                                        <a href="<?php echo site_url('batches/demographics/') . $batch['id']; ?>" class="link prof-link">
                                                            <?php echo $batch['code'] . '-' . $batch['arm'] . "($session)"; ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $batch['student_count']; ?></td>
                                                <td>
                                                    <?php if (!empty($rights[0]['other_rights']) || ($userdata['name'] == 'admin')) { ?>
                                                        <a class="edit-batch btn btn-info btn-xs"
                                                           data-session = "<?php echo $session; ?>"
                                                           data-class= "<?php echo $batch['course_id']; ?>"
                                                           href="javascript:void(0)"
                                                           data-batch-id="<?php echo $batch['id']; ?> ?>"
                                                           data-href="<?php echo site_url('batches/edit/') . $batch['id']; ?>">
                                                           <i class="fa fa-edit icon-margin"  title="Edit"></i></a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-info btn-xs" onclick="notification();">
                                                            Edit<i class="fa fa-edit" title="Edit"></i></a>
                                                    <?php } ?>
                                                    <?php if ($userdata['name'] == 'admin') { ?>
                                                        <a href="javascript:void(0)" data-href="<?php echo site_url('batches/delete/') . $batch['id']; ?>" class="btn btn-danger btn-xs waves-effect waves-light delete-batch">
                                                            <i class="fa fa-trash icon-margin"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="new_batch" tabindex="-1" role="dialog" aria-labelledby="new_batch_label"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 font-weight-bold" style="text-align: center">New Batch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="batch_form" method="post" role="form"  data-action="<?php echo site_url('batches/save') ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Arm<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="arm" name="arm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="course_id">
                                        <option value="">Please Select</option>
                                        <?php foreach ($classes as $class): ?>
                                            <option value="<?php echo $class['id'] ?>"><?php echo $class['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Academic session</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="session">
                                        <option value="">Please Select</option>
                                        <?php foreach ($sessions as $session): ?>
                                            <option value="<?php echo $session['name'] ?>"><?php echo $session['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12" style="text-align: center">
                                <button type="submit" class="btn btn-primary" id="save_batch">
                                    <i class="fa fa-plus"></i>Add Batch
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
        });
        function notification() {
            toastr["error"]('You are not authorized for this action!');
        }
    </script>
</div>
