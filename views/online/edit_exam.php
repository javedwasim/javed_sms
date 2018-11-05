<form id="edit_exam_form" method="post" role="form"
      data-action="<?php echo site_url('online_test/add_exam') ?>" enctype="multipart/form-data">
    <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $exam['id']; ?>">
    <div class="modal-body">
        <div id="add-form-panel" class="panel panel-default">
            <div class="panel-body">
                <!-- Some hidden fields -->
                <div class="form-group">
                    <label>Examination Name<span class="required-field">*</span></label>
                    <input autocomplete="off" name="exam_name" type="text" placeholder="Enter exam name"
                           value="<?php echo isset($exam['exam_name'])?$exam['exam_name']:''; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label>Select Subject<span style="color: red;">*</span></label>
                    <select  id="subject_id_1" name="subject_id" class="form-control m-b">
                        <option value="">Select Course First</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo $subject['id'] ?>"
                                <?php echo ($subject['id']==$exam['subject_id'])?'selected':'' ;?>><?php echo $subject['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Exam Date<span style="color: red;">*</span></label>
                    <input autocomplete="off" name="exam_date" id="exam_edit_date" type="text" value="<?php echo date('Y-m-d',strtotime($exam['exam_date'])); ?>"
                           placeholder="Enter exam date" class="form-control">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Start Time<span style="color: red;">*</span></label>
                            <input  name="start_time" id="start_time" type="text"
                                    value="<?php echo date('h:i:a',strtotime($exam['start_time'])); ?>"
                                    placeholder="09:00:am" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>End Time<span style="color: red;">*</span></label>
                            <input  name="end_time" id="end_time" type="text" value="<?php echo date('h:i:a',strtotime($exam['end_time'])); ?>"
                                    placeholder="12:00:pm" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>No. Of Questions<span style="color: red;">*</span></label>
                    <input autocomplete="off" name="no_of_question" type="number" value="<?php echo $exam['no_of_question']; ?>"
                           placeholder="Enter how many questions will be displayed?" class="form-control">
                </div>
                <div class="form-group">
                    <label>Marks Per Question<span style="color: red;">*</span></label>
                    <input autocomplete="off" name="marks_per_question" type="number" value="<?php echo $exam['marks_per_question']; ?>"
                           placeholder="Enter marks per question" class="form-control">
                </div>
                <div class="form-group">
                    <label>Exam Duration(In minutes)<span style="color: red;">*</span></label>
                    <input autocomplete="off" name="duration" type="number" value="<?php echo $exam['duration']; ?>"
                           placeholder="Enter exam duration in minutes" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="update_exam" class="btn btn-sm btn-success pull-right add-btn"><i class="fa fa-plus"></i>Update Exam</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#exam_edit_date').datepicker({format: 'yyyy-mm-dd'});
    });
</script>