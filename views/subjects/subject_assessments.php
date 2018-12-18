<table id="batch" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Abbrev.</th>
        <th>Name</th>
        <th>P.Pnts</th>
        <th>E.Pnts</th>
        <th>Due Date</th>
        <th>Category</th>
        <th>Pb.Scores?</th>
        <th>FG?</th>
        <th style="width: 9%">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($assessments as $assessment): ?>
        <tr>
            <td><?php echo $assessment['abbreviation'] ?></td>
            <td><?php echo $assessment['assessment_name']; ?></td>
            <td><?php echo $assessment['points']; ?></td>
            <td><?php echo $assessment['extra_points']; ?></td>
            <td><?php echo date('F j, Y',strtotime($assessment['due_date'])) ; ?></td>
            <td><?php echo $assessment['cate_name']; ?></td>
            <td>
                <label class="switch">
                    <input class="update_check"  data-update="publish"  type="checkbox" data-subject-id = "<?php echo $assessment['id']; ?>"
                        <?php echo ($assessment['publish_score']==1)?'checked':''; ?>>
                    <span class="slider round"></span>
                </label>

            </td>
            <td>
                <label class="switch">
                    <input type="checkbox"  data-update="grade" data-subject-id = "<?php echo $assessment['id']; ?>" class="update_check" <?php echo ($assessment['include_final_grade']==1)?'checked':''; ?>>
                    <span class="slider round"></span>
                </label>
            </td>
            <td>
                <a class="btn btn-xs btn-info edit_assessment" data-href="<?php echo base_url()."subjects/edit_assessment/".$assessment['id']; ?>">
                    <i class="fa fa-edit icon-margin" title="edit"></i>
                </a>
                <a class="btn btn-xs btn-danger delete-assessment" data-assessment-id = "<?php echo $assessment['id']; ?>"
                   data-subject-detail-id="<?php echo $assessment['subject_detail_id']; ?>"
                   data-href="<?php echo base_url()."subjects/delete_assessment"; ?>">
                    <i class="fa fa-trash icon-margin" title="delete"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
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
</script>
