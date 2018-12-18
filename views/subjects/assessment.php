<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Assessments | (<?php echo isset($student['st_name'])?$student['st_name']:$student['first_name']; ?>)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">fees</li>
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
                            <h3 class="card-title">Assessments</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form rol="form" style="width: 100%;" id="assessment_filter_form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <select class="form-control" name="subject">
                                                <option value="">Please select</option>
                                                <?php foreach ($subjects as $subject): ?>
                                                    <option value="<?php echo $subject['id'] ?>"<?php echo !empty($filter)&&($filter['subject']==$subject['id'])?'selected':''; ?>>
                                                        <?php echo $subject['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Academic Session</label>
                                        <select class="form-control" name="session">
                                            <option value="">Please select</option>
                                            <?php foreach ($academic_sessions as $session): ?>
                                                <option value="<?php echo $session['name'] ?>"
                                                    <?php echo !empty($filter)&&($filter['session']==$session['name'])?'selected':''; ?>>
                                                    <?php echo $session['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Term</label>
                                        <select name="term" id="term" class="form-control">
                                            <option value="">Please select</option>
                                            <option value="1"
                                                <?php echo !empty($filter)&&($filter['term']==1)?'selected':''; ?>>First Term</option>
                                            <option value="2"
                                                <?php echo !empty($filter)&&($filter['term']==2)?'selected':''; ?>>Second Term</option>
                                            <option value="3"
                                                <?php echo !empty($filter)&&($filter['term']==3)?'selected':''; ?>>Third Term</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-primary btn-md" id="subj_filter">
                                                <i class="fa fa-search"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="sbj_table" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Score</th>
                                    <th>Assessment</th>
                                    <th>Due date</th>
                                    <th>Subject</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($assessments as $assessment): ?>
                                    <tr>
                                        <td><div class="assessment-score"><span class="score"><?php echo $assessment['score']; ?></span> / <?php echo $assessment['points']; ?></div></td>
                                        <td><?php echo $assessment['assessment_name']; ?></td>
                                        <td><?php echo date('F j, Y',strtotime($assessment['due_date'])); ?></td>
                                        <td><?php echo $assessment['name']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function () {
        $("#sbj_table").DataTable({
            "scrollX": true
        });

        $('#date_payment').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#due_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#due_dt').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#date_created').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('.select2').select2();

    });
    function add_payment(value) {
        var base_url = $('#base').val();
        $.ajax({
            url: base_url+'fee_management/get_batch_students',
            data: {batch_id:value},
            type: 'post',
            cache: false,
            success: function (response) {
                if (response.employee_html != '') {
                    $('.batch-students').empty();
                    $('.batch-students').append(response);
                }
            }
        });
    }

</script>