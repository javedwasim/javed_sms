<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Subject</h1>
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
                    <div id="class_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="class_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Subjects</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#subject_add"><i class="fa fa-plus"></i>Add Subject</a>
                                </div>
                            </div>
                            <table id="class-table" class="table table-bordered table-striped datatables">
                                <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Course Name</th>
                                    <th data-orderable="false"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($subjects as $subject) { ?>
                                    <tr>
                                        <td><?php echo $subject['subject_name']; ?></td>
                                        <td><?php echo $subject['course_name']; ?></td>
                                        <td>
                                            <a class="edit-exam-subject btn btn-info btn-xs"
                                               href="#" data-abbreviation="<?php echo $subject['id'] ?>"
                                               data-action="<?php echo site_url('online_test/edit_exam_subjects') ?>"
                                               data_course_id="<?php echo $subject['course_id']; ?>"
                                               data_subject_id="<?php echo $subject['id']; ?>"><i class="fa fa-edit" title="Edit" style="margin-right: 0px"></i></a>
                                            <a class="delete-exam-subject btn btn-danger btn-xs" href="#"
                                               data-href="<?php echo site_url('online_test/delete_subject/').$subject['id'] ?>"><i class="fa fa-trash" title="Delete" style="margin-right: 0px"></i></a>
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
</div>
<!-- /.content -->
<div class="modal fade" id="subject_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Subject(s)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="subject_form_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="subject_form_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div id="form_container">
                <form id="subject_form" method="post" role="form"
                      data-action="<?php echo site_url('online_test/add_exam_subjects') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select Course<span style="color: red;">*</span></label>
                            <select class="form-control" name="course_id">
                                <option value="">Select An Option</option>
                                <?php foreach($classes as $class): ?>
                                    <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject Name<span style="color: red;">*</span></label>
                            <input autocomplete="off" name="subject_name" type="text" placeholder="Enter subject name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" id="save_exam_subject" class="btn btn-sm btn-success pull-right add-btn"><i class="fa fa-plus"></i> Add Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="subject_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Subject(s)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="subject_form_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="subject_form_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div id="edit_subject_container">

            </div>
        </div>
    </div>
</div>
