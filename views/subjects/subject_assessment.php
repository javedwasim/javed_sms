<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Subject Assessments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">assessment</li>
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
                            <h3 class="card-title">Subjects</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-condensed">
                                        <tbody>
                                        <tr>
                                            <td class="field-label">Student Name</td>
                                            <td class="field-value"><?php echo isset($student['st_name'])?$student['st_name']:$student['first_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="field-label">Session</td>
                                            <td class="field-value" id="filter_session">
                                                <?php echo !empty($filter['session'])?$filter['session']:"All"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field-label">Batch</td>
                                            <td class="field-value"><?php echo isset($student['batch'])?$student['batch']:'('.$student['arm'].' '.$student['session'].')'; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="field-label">Term</td>
                                            <td class="field-value" id="filter_term">
                                                <?php echo !empty($filter['term'])?$filter['term']:"All"; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <form rol="form" style="width: 100%;" id="sbj_asses_filter_form">
                                         <div class="row">
                                            <div class="col-md-4">
                                                <label>Session</label>
                                                <select class="form-control" name="session" onchange="return filter_session(this.value)">
                                                    <option value="">Please select</option>
                                                    <?php foreach ($academic_sessions as $session): ?>
                                                        <option value="<?php echo $session['name'] ?>"
                                                            <?php echo !empty($filter)&&($filter['session']==$session['name'])?'selected':''; ?>>
                                                            <?php echo $session['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Term</label>
                                                <select name="term" class="form-control" onchange="return filter_term(this.value)">
                                                    <option value="">Please select</option>
                                                    <option value="1"
                                                        <?php echo !empty($filter)&&($filter['term']==1)?'selected':''; ?>>First Term</option>
                                                    <option value="2"
                                                        <?php echo !empty($filter)&&($filter['term']==2)?'selected':''; ?>>Second Term</option>
                                                    <option value="3"
                                                        <?php echo !empty($filter)&&($filter['term']==3)?'selected':''; ?>>Third Term</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mt-3">
                                                    <button type="button" class="btn btn-primary btn-md" id="assessment_filter">
                                                        <i class="fa fa-search"></i>Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table id="sbj_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Assessment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($assessments as $assessment): ?>
                                    <tr>
                                        <td><?php echo $assessment['name']; ?></td>
                                        <td>
                                            <?php $subject_score = explode(',',$assessment['subject_score']); ?>
                                            <?php foreach ($subject_score as $score): ?>
                                                <?php $nscore = explode('/',$score);?>
                                                <div class="student-assessment-score">
                                                    <span class="sas-wrapper" title="<?php echo $nscore[4].' '.$nscore[0]; ?> (<?php echo $nscore[1]; ?>)">
                                                      <span class="score-textify">
                                                          <span class="score"><?php echo $nscore[2]; ?></span> / <?php echo $nscore[3]; ?>
                                                      </span>
                                                    </span>
                                                </div>
                                            <?php endforeach;?>
                                        </td>
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

    function filter_session(val) {
        $('#filter_session').text(val);
        return false
    }
    function filter_term(val) {
        $('#filter_term').text(val);
        return false;
    }

</script>