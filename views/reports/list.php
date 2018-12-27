<?php $userdata = $this->session->userdata('userdata'); $role = $userdata['role']; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Report Card Groups</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">report</li>
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
                            <h3 class="card-title">Report Card </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (!empty($rights[0]['other_rights']) || ($userdata['name'] == 'admin')) : ?>
                                        <button type="button" class="btn btn-primary"
                                            data-toggle="modal" data-target="#report_card_modal" id="batch_list">
                                            <i class="fa fa-plus"></i>Add Report Card Group</button>
                                    <?php elseif(isset($student['surname'])): ?>
                                        <h3 class="card-title"><?php echo $student['surname'].' '.$student['first_name'].'('.$student['username'].')'; ?></h3>
                                    <?php endif; ?>
                                    <div id="std_subjects_report_container">
                                        <table id="batch" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Class Set</th>
                                                <th>Type</th>
                                                <th>For</th>
                                                <th>Published</th>
                                                <th>Status</th>
                                                <?php if(isset($student['surname']) || $userdata['name']=='admin'): ?>
                                                    <th>Actions</th>
                                                <?php endif; ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php  foreach ($reports as $report):  ?>
                                                <?php
                                                    if($report['report_card_group_for']=='first_term'){
                                                        $term_id = 1;
                                                    }elseif($report['report_card_group_for']=='second_term'){
                                                        $term_id = 2;
                                                    }elseif($report['report_card_group_for']=='third_term'){
                                                        $term_id = 3;
                                                    }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php if($userdata['name'] == 'admin'): ?>
                                                            <a data-href="<?php echo site_url('reportcard/get_class_set_student');?>"
                                                               data-class-set-id="<?php echo $report['course_set_id']; ?>"
                                                               data-term="<?php echo $report['report_card_group_for']; ?>"
                                                               class="link prof-link" id="class_set_students"><?php echo $report['name']; ?></a>
                                                        <?php elseif(!isset($student['surname'])): ?>
                                                            <a data-href="<?php echo site_url('reportcard/get_guardian_student');?>"
                                                               data-class-set-id="<?php echo $report['course_set_id']; ?>"
                                                               data-term="<?php echo $report['report_card_group_for']; ?>"
                                                               data-user-name="<?php echo $userdata['name']; ?>"
                                                               class="link prof-link" id="class_set_grd"><?php echo $report['name']; ?></a>
                                                        <?php else: ?>
                                                            <?php echo $report['name']; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo $report['session'].' '.$report['name']; ?></td>
                                                    <td><?php echo $report['report_type']; ?></td>
                                                    <td><?php echo $report['report_card_group_for']; ?></td>
                                                    <td><?php echo $report['published']==1?'Yes':'No'; ?></td>
                                                    <td><?php echo $report['status']==1?"Ready":"Queue"; ?></td>
                                                    <?php if (!empty($rights[0]['other_rights']) || ($userdata['name'] == 'admin')) : ?>
                                                        <td>
                                                            <a class="btn btn-info btn-xs edit-card-group"
                                                               data-href = '<?php echo site_url("Reportcard/edit/").$report['id'];  ?>'>
                                                                <i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                                            <a class="btn btn-danger btn-xs delete-card-group"
                                                               data-href = '<?php echo site_url("Reportcard/delete/").$report['id'];  ?>'><i class="fa fa-trash icon-margin" title="Delete"></i></a>
                                                        </td>
                                                    <?php elseif(isset($student['surname'])): ?>
                                                        <td>
                                                            <a class="btn btn-info btn-xs std-subject-report"
                                                               data-term-id = '<?php echo $term_id;  ?>'
                                                               data-href = '<?php echo $student['student_id'];  ?>'>
                                                               <i class="fa fa-line-chart icon-margin" title="View Detail"></i>Open</a>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="report_card_modal" tabindex="-1" role="dialog" aria-labelledby="new_batch_label"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 font-weight-bold" style="text-align: center">Report Card Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="report_form_container">
                    <form id="report_card_group_form" method="post" role="form"  data-action="<?php echo site_url('reportcard/save') ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-5 col-form-label">Name<span style="color: red">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course_set_id" class="col-sm-5 col-form-label">Class Set<span style="color: red">*</span></label>
                                <div class="col-sm-7">
                                    <?php $report = isset($report['course_set_id'])?$report['course_set_id']:''; ?>
                                    <select class="form-control" name="course_set_id" id="course_set_id">
                                        <option value="">Please Select</option>
                                        <?php foreach ($class_set as $set): ?>
                                            <option value="<?php echo $set['id']; ?>"<?php echo $set['id'] == $report?'selected':''; ?>><?php echo $set['session'].' '.$set['code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="form-group row">-->
<!--                                <label for="report_card_template_id" class="col-sm-5 col-form-label">Template</label>-->
<!--                                <div class="col-sm-7">-->
<!--                                    <select class="form-control" name="report_card_template_id" id="report_card_template_id">-->
<!--                                        <option value="">Please Select</option>-->
<!--                                        --><?php //foreach ($reportes as $report): ?>
<!--                                            <option value="--><?php //echo $report['id'] ?><!--">--><?php //echo $report['session'].' '.$report['code'] ?><!--</option>-->
<!--                                        --><?php //endforeach; ?>
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="form-group row">
                                <label for="report_type" class="col-sm-5 col-form-label">Report type<span style="color: red">*</span></label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="report_type" id="report_type">
                                        <option value="">Please select</option>
                                        <option value="progress">Progress</option>
                                        <option value="final">Final</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="report_card_group_for" class="col-sm-5 col-form-label">For<span style="color: red">*</span></label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="report_card_group_for" id="report_card_group_for">
                                        <option value="">Please select</option>
                                        <option value="first_term">First term</option>
                                        <option value="second_term">Second term</option>
                                        <option value="third_term">Third term</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12" style="text-align: center">
                                <button type="submit" class="btn btn-primary" id="save_report_card_group">
                                    <i class="fa fa-plus"></i>Add Report Card Group
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

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
</div>
