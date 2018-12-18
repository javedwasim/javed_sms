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
                        <li class="breadcrumb-item active">Examination</li>
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
                            <h3 class="card-title">Examinations</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#exam_add"><i class="fa fa-plus"></i>Add Exam</a>
                                </div>
                            </div>
                            <table id="exam-table" class="table table-bordered table-striped datatables">
                                <thead>
                                <tr>
                                    <th>Exam</th>
                                    <th>Course</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Questions</th>
                                    <th>Marks/Que</th>
                                    <th>Duration</th>
                                    <th data-orderable="false" style="width: 10%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($examinations as $examination) { ?>
                                    <tr>
                                        <td><?php echo $examination['exam_name']; ?></td>
                                        <td><?php echo $examination['class_name']; ?></td>
                                        <td><?php echo $examination['subject_name']; ?></td>
                                        <td><?php echo date('F j, Y',strtotime($examination['exam_date'])); ?></td>
                                        <td><?php echo date("h:i:a",strtotime($examination['start_time'])).'-'.date("h:i:a",strtotime($examination['end_time'])); ?></td>
                                        <td><?php echo $examination['no_of_question']; ?></td>
                                        <td><?php echo $examination['marks_per_question']; ?></td>
                                        <td><?php echo $examination['duration']." minutes"; ?></td>
                                        <td>
                                            <a class="edit-exam btn btn-info btn-xs"
                                               href="#" data_exam_id="<?php echo $examination['id'] ?>"
                                               data-action="<?php echo site_url('online_test/edit_exam') ?>"
                                               data_course_id="<?php echo $examination['course_id']; ?>"
                                               data_subject_id="<?php echo $examination['subject_id']; ?>"><i class="fa fa-edit" title="Edit" style="margin-right: 0px;"></i></a>
                                            <a class="delete-exam btn btn-danger btn-xs" href="#"
                                               data-href="<?php echo site_url('online_test/delete_exam/').$examination['id'] ?>"><i class="fa fa-trash" title="Delete" style="margin-right: 0px;"></i></a>
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
<div class="modal fade" id="exam_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Exam</h4>
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
                <form id="exam_form" method="post" role="form"
                      data-action="<?php echo site_url('online_test/add_exam') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="add-form-panel" class="panel panel-default">
                            <div class="panel-body">
                                <!-- Some hidden fields -->
                                <div class="form-group">
                                    <label>Examination Name<span class="required-field">*</span></label>
                                    <input autocomplete="off" name="exam_name" type="text" placeholder="Enter exam name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Select Subject<span style="color: red;">*</span></label>
                                    <select  id="subject_id_1" name="subject_id" class="form-control m-b">
                                        <option value="">Select subject</option>
                                        <?php foreach ($subjects as $subject): ?>
                                            <option value="<?php echo $subject['id'] ?>"><?php echo $subject['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Exam Date<span style="color: red;">*</span></label>
                                    <input autocomplete="off" name="exam_date" id="exam_date" type="text" placeholder="Enter exam date" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Start Time<span style="color: red;">*</span></label>
                                            <input  name="start_time" id="start_time" type="time" placeholder="09:00:am" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>End Time<span style="color: red;">*</span></label>
                                            <input  name="end_time" id="end_time" type="time" placeholder="12:00:pm" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No. Of Questions<span style="color: red;">*</span></label>
                                    <input autocomplete="off" name="no_of_question" type="number" placeholder="Enter how many questions will be displayed?" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Marks Per Question<span style="color: red;">*</span></label>
                                    <input autocomplete="off" name="marks_per_question" type="number" placeholder="Enter marks per question" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Exam Duration(In minutes)<span style="color: red;">*</span></label>
                                    <input autocomplete="off" name="duration" type="number" placeholder="Enter exam duration in minutes" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" id="save_exam" class="btn btn-primary pull-right add-btn"><i class="fa fa-plus"></i> Add Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_exam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Save Exam</h4>
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
            <div id="edit_form_container">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#exam_date').datepicker({format: 'yyyy-mm-dd'});
        $('#exam-table').DataTable();
    });
</script>
