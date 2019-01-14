<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Exam</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Student Exam</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-inline" id="get_exam_question" method="post" role="form"
                                  data-action="<?php echo site_url('online_test/get_exam_questions') ?>" enctype="multipart/form-data">
                                <div class="form-group mx-sm-3 mb-2">
                                    <label>Select Exam<span style="color: red;">*</span> &nbsp;</label>
                                    <select name="exam_id" class="form-control m-b">
                                        <option value="">Select an exam</option>
                                        <?php foreach ($examinations as $examination): ?>
                                            <option value="<?php echo $examination['id']; ?>"><?php echo $examination['exam_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button id="select_exam_questions" type="submit" class="btn btn-sm btn-primary pull-right get-btn"><i class="fa fa-search"></i> Get Questions</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="exam_question_container"></div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>