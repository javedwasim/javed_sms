<?php $userdata = $this->session->userdata('userdata');  $role = $userdata['role']; ?>
<div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr><th colspan="6"><h3 style="text-align: center">Score Sheet</h3></th></tr>
                <tr>
                    <th>Subjects</th>
<<<<<<< HEAD
                    <th scope="col">1st</th>
                    <th scope="col">2nd</th>
                    <th scope="col">Final</th>
=======
                    <th scope="col">Final</th>
                    <th scope="col">2nd</th>
                    <th scope="col">1st</th>
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
                    <th scope="col">Total</th>
                    <th scope="col">Subject Teachers</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($subjects as $subject): $score = explode(',',$subject['st_score']); ?>
                <tr>
                    <th scope="row"><?php echo $subject['sbj_name']; ?></th>
<<<<<<< HEAD
                    <td><?php echo isset($score[2])?$score[2]:'EX'; ?></td>
                    <td><?php echo isset($score[1])?$score[1]:'EX'; ?></td>
                    <td><?php echo isset($score[0])&&!empty($score[0])?$score[0]:'EX'; ?></td>
=======
                    <td><?php echo isset($score[0])&&!empty($score[0])?$score[0]:'EX'; ?></td>
                    <td><?php echo isset($score[1])?$score[1]:'EX'; ?></td>
                    <td><?php echo isset($score[2])?$score[2]:'EX'; ?></td>
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
                    <td><?php echo isset($score[0])&&isset($score[1])&&isset($score[2])?$score[0]+$score[1]+$score[2]:'EX'; ?></td>
                    <td><?php echo $subject['subject_teacher']; ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<div class="clearfix"></div>
<hr>

<div id="report_comment_container">
    <div class="row">
        <div class="table-responsive col-md-12">
            <table class="comment-table table table-striped table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Principal's comment —  </th>
                    <?php if($userdata['name']=='admin'): ?>
                        <th>
                            <a data-disable-with="Please wait..." class="btn btn-xs edit"
                               data-remote="true" href="javascript:void(0)" onclick="showModal('principal');">
                                <i class="fa fa-edit"></i> Edit</a></th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td colspan="2" id="comment-field-1"><?php echo isset($comment['principal']['comment'])?$comment['principal']['comment']:''; ?></td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive col-md-12">
            <table class="comment-table table table-striped table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Class Teacher's comment — <?php echo isset($class_teacher['employees'])?$class_teacher['employees']:''; ?> </th>
                    <?php if($userdata['name']=='admin'): ?>
                        <th>
                            <a data-disable-with="Please wait..." class="btn btn-xs edit"
                               data-remote="true" href="javascript:void(0)" onclick="showModal('teacher');">
                                <i class="fa fa-edit"></i> Edit</a></th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td colspan="2" id="comment-field-3"><?php echo isset($comment['teacher']['comment'])?$comment['teacher']['comment']:''; ?></td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>


<div class="clearfix"></div>
<hr>
<?php
    $student_score = json_decode($behaviour_score['student_behavioural_score'],true);
    unset($student_score['student_id']);
    unset($student_score['grade_scale_id']);
    unset($student_score['term_id']);
?>
<?php if(!empty($student_score)):  ?>
    <div class="row">
        <div class="table-responsive col-md-7">
            <table id="batch" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="2"><h3 style="text-align: center">Behaviour Report</h3></th>
                </tr>
                <tr>
                    <th>Affective</th>
                    <th>Grade</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($student_score as $key=>$value): ?>
                    <tr>
                        <th><?php echo ucfirst($key); ?></th>
                        <?php foreach($scale as $s): ?>
                            <?php if($s['id'] == $value): ?>
                                <th><?php echo $s['name']; ?></th>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="table-responsive col-md-5">
            <table id="batch" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th colspan="2"><h3 style="text-align: center">Attendance Report</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Present</td><td><?php echo $attendance_record['present'] ?></td></tr>
                    <tr><td>Absent</td><td><?php echo $attendance_record['absent'] ?></td></tr>
                    <tr><td>Late</td><td><?php echo $attendance_record['late'] ?></td></tr>
<<<<<<< HEAD
                    <tr><th>Percentage</th><td><?php echo round($attendance_record['present']/($attendance_record['late']+$attendance_record['absent']+$attendance_record['present'])*100).'%'; ?></td></tr>
=======
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<script>
    function showModal(role){
        $('#add_report_comment').modal('show');
        $('#commented_by').val(role);
    }
</script>

