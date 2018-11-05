<?php  if(isset($std_results)): ?>
    <table id="std_result_table" class="table table-bordered table-striped nowrap"
           style="width: 100%;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Exam Name</th>
            <th>Total Questions</th>
            <th>Correct Answered</th>
            <th>Wrong Answered</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($std_results as $result):?>
            <tr>
                <td><strong><?php echo $result['student_id'];; ?></strong></td>
                <td><strong><?php echo $result['student_name']; ?></strong></td>
                <td><strong><?php echo $result['exam_name']; ?></strong></td>
                <td><span class="badge badge-primary" style="font-size: 12px"><?php echo $result['total_question']; ?></span></td>
                <td><span class="badge badge-success" style="font-size: 12px"><?php echo $result['correct_answers'] ?></span></td>
                <td><span class="badge badge-danger" style="font-size: 12px"><?php echo $result['total_question']-$result['correct_answers']; ?></span></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12">
            <table id="std_result_table" class="table table-bordered table-striped nowrap"
                   style="width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Exam Name</th>
                    <th>Total Questions</th>
                    <th>Correct Answered</th>
                    <th>Wrong Answered</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong><?php echo $student_id; ?></strong></td>
                    <td><strong><?php echo $student_name; ?></strong></td>
                    <td><strong><?php echo $exam_name; ?></strong></td>
                    <td><span class="badge badge-primary" style="font-size: 12px"><?php echo $total_question; ?></span></td>
                    <td><span class="badge badge-success" style="font-size: 12px"><?php echo $correct_answers ?></span></td>
                    <td><span class="badge badge-danger" style="font-size: 12px"><?php echo $total_question-$correct_answers ?></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<script>
    $(document).ready(function(){
        $("#std_result_table").DataTable({});
    });
</script>
