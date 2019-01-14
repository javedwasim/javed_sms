<table class="table table-bordered nowrap responsive table-info">
    <thead>
    <tr>
        <th rowspan="2" style="background-color: #31bc86; color: #fff"><strong>Name</strong></th>
        <?php $score_detail = explode(',',$score_term);
        $assessment_id = explode(',',$asses_id);
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
    <?php foreach ($score_sheet as $sheet): $rpoints  = explode(',',$sheet['obtain_score']); ?>
        <tr>
            <th scope="row"><code><?php echo $sheet['surname'].", ".$sheet['first_name'].".".$sheet['last_name']; ?></code></th>
            <?php for($j=0;$j<count($score_detail);$j++){ ?>
                <td class="is-visible" contenteditable="true"
                    onBlur="saveToDatabase(this,
                            '<?php echo $sheet['student_id']; ?>',
                            '<?php echo $sheet['subj_detail_id']; ?>',
                            '<?php echo $sheet['bacth_id']; ?>',
                            '<?php echo isset($score_detail[$j])?$score_detail[$j]:''; ?>',
                            '<?php echo isset($points[$j])?$points[$j]:''; ?>',
                            '<?php echo isset($assessment_id[$j])?$assessment_id[$j]:''; ?>')"
                    onClick="showEdit(this);">
                    <?php //echo isset($sheet['first_value'])?$sheet['first_value']:''; ?>
                    <?php echo isset($rpoints[$j])?$rpoints[$j]:''; ?>
                </td>
            <?php } ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>