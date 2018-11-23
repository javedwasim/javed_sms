<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Class Set</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">class_set</li>
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
                            <h3 class="card-title">Class Set</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="class-table" class="table table-bordered table-striped datatables">
                                <thead>
                                <tr>
                                    <th>Academic Session</th>
                                    <th>Class</th>
                                    <th data-orderable="false" style="width: 30%;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($batches as $batch) { ?>
                                        <tr>
                                            <td><?php echo $batch['session']; ?></td>
                                            <td><?php echo $batch['class_name']; ?></td>
                                            <td>
                                                <a class="edit-domain btn btn-info btn-xs"
                                                   data-session="<?php echo $batch['session']; ?>"
                                                   data-course-id="<?php echo $batch['course_id']; ?>"
                                                   href="javascript:void();">
                                                   <i class="fa fa-gear icon-margin" title="Edit learning domain"></i>Edit Domain</a>
                                                <a class="edit-class btn btn-info btn-xs"
                                                   data-value="<?php echo $batch['id']; ?>" href="javascript:void();">
                                                   <i class="fa fa-gear icon-margin" title="Edit learning domain"></i>Assign Employee</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
<!-- /.content -->
<div class="modal fade" id="domain_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#class-table').DataTable();
    });
</script>