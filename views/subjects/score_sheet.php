<table class="table table-bordered nowrap responsive table-info">
    <thead>
    <tr>
        <th rowspan="2" style="background-color: #31bc86; color: #fff"><strong>Name</strong></th>
        <?php $score_detail = explode(',',$score_term);
        foreach ($score_detail as $detail):  ?>
            <th style="background-color: #31bc86;color: #fff"><strong><?php echo $detail; ?></strong></th>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php $points = explode(',',$score_points); foreach ($points as $point):; ?>
            <th class="bg-gray-light"><strong><?php echo $point; ?></strong></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($score_sheet as $sheet): //$rpoints  = explode(',',$sheet['obtain_score']); ?>
        <tr>
            <th scope="row"><code><?php echo $sheet['surname'].", ".$sheet['first_name'].".".$sheet['last_name']; ?></code></th>
            <td class="is-visible" contenteditable="true"
                onBlur="saveToDatabase(this,
                    '<?php echo $sheet['student_id']; ?>',
                    '<?php echo $sheet['subj_detail_id']; ?>',
                    '<?php echo $sheet['bacth_id']; ?>',
                    '<?php echo isset($score_detail[0])?$score_detail[0]:''; ?>',
                    '<?php echo isset($points[0])?$points[0]:''; ?>')"
                onClick="showEdit(this);">
                <?php echo isset($sheet['first_value'])?$sheet['first_value']:''; ?>
            </td>
            <td class="is-visible" contenteditable="true"
                onBlur="saveToDatabase(this,
                    '<?php echo $sheet['student_id']; ?>',
                    '<?php echo $sheet['subj_detail_id']; ?>',
                    '<?php echo $sheet['bacth_id']; ?>',
                    '<?php echo isset($score_detail[1])?$score_detail[1]:''; ?>',
                    '<?php echo isset($points[1])?$points[1]:''; ?>')"
                onClick="showEdit(this);">
                <?php echo isset($sheet['second_value'])?$sheet['second_value']:''; ?>
            </td>
            <td class="is-visible" contenteditable="true"
                onBlur="saveToDatabase(this,
                    '<?php echo $sheet['student_id']; ?>',
                    '<?php echo $sheet['subj_detail_id']; ?>',
                    '<?php echo $sheet['bacth_id']; ?>',
                    '<?php echo isset($score_detail[2])?$score_detail[2]:''; ?>',
                    '<?php echo isset($points[2])?$points[2]:''; ?>')"
                onClick="showEdit(this);">
                <?php echo isset($sheet['third_value'])?$sheet['third_value']:''; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>