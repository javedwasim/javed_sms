<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Question & Answer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">question</li>
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
                            <h3 class="card-title">Question & Answer</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#exam_question"><i class="fa fa-plus"></i>Add Question & Answer</a>
                                </div>
                            </div>
                            <table id="class-table" class="table table-bordered table-striped datatables">
                                <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer Options</th>
                                    <th>Correct Answer</th>
                                    <th>Exam</th>
                                    <th data-orderable="false" style="width: 9%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($questions as $question) { ?>
                                    <tr>
                                        <td><?php echo $question['question']; ?></td>
                                        <td><?php echo $question['answer_options']; ?></td>
                                        <td><?php echo $question['correct_answer_value']; ?></td>
                                        <td><?php echo $question['exam_name']; ?></td>
                                        <td>
                                            <a class="edit-exam-question btn btn-info btn-xs"
                                               href="#" data_question_id="<?php echo $question['id'] ?>"
                                               data-action="<?php echo site_url('online_test/edit_exam_question/').$question['id'] ?>"><i class="fa fa-edit" title="Edit" style="margin-right: 0px;"></i></a>
                                            <a class="delete-exam-question btn btn-danger btn-xs" href="#"
                                               data-href="<?php echo site_url('online_test/delete_exam_question/').$question['id'] ?>"><i class="fa fa-trash" title="Delete" style="margin-right: 0px;"></i></a>
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
<div class="modal fade" id="exam_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Question</h4>
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
                <form id="exam_question_form" method="post" role="form"
                      data-action="<?php echo site_url('online_test/add_question') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="add-form-panel" class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Select Exam<span style="color: red;">*</span></label>
                                    <select class="form-control" name="exam_id">
                                        <option value="">Select An Option</option>
                                        <?php foreach ($examinations as $examination): ?>
                                            <option value="<?php echo $examination['id']; ?>"><?php echo $examination['exam_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Question<span style="color: red;">*</span></label>
                                    <input autocomplete="off" type="text" placeholder="Enter the question" name="question" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Answer option 1<span style="color: red;">*</span></label>
                                    <input autocomplete="off" type="text" name="answer_option[]" placeholder="Enter answer option 1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Answer option 2<span style="color: red;">*</span></label>
                                    <input autocomplete="off" type="text" name="answer_option[]" placeholder="Enter answer option 2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Answer option 3<span style="color: red;">*</span></label>
                                    <input autocomplete="off" type="text" name="answer_option[]" placeholder="Enter answer option 3" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Answer option 4<span style="color: red;">*</span></label>
                                    <input autocomplete="off" type="text" name="answer_option[]" placeholder="Enter answer option 4" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Correct Answer<span style="color: red;">*</span></label>
                                    <div class="radio">
                                        <label><input type="radio" name="correct_ans" value="1">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="correct_ans" value="2">Option 2</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="correct_ans" value="3">Option 3</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="correct_ans" value="4">Option 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" id="save_question" class="btn btn-primary pull-right add-btn"><i class="fa fa-plus"></i>Add Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_exam_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Question</h4>
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
            <div id="exam_question_container">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#exam_date').datepicker({format: 'yyyy-mm-dd'});
        $('.datatables').DataTable();
    });
</script>
