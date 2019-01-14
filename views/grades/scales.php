<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Grade Scales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">grade/scale</li>
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
                    <div id="assessment_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="assessment_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grade Scale</h3>
                        </div>
                        <div class="container ">
                            <div class="row" style="margin-top: 25px">
                                <div class="col-sm-3">
                                    <label for="status">Status</label>
                                    <select name="grade_scale_status" id="grade_scale_status" class="form-control grade_scale">
                                        <option value="">Please Select</option>
                                        <option value="active"
                                            <?php echo isset($filter['grade_scale_status'])&&($filter['grade_scale_status']=='active')?'selected':''; ?>>Active</option>
                                        <option value="retire"
                                            <?php echo isset($filter['grade_scale_status'])&&($filter['grade_scale_status']=='retire')?'selected':''; ?>>Retire</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="status">Type</label>
                                    <select name="grade_scale_type" id="grade_scale_type" class="form-control grade_scale">
                                        <option value="">Please Select</option>
                                        <option value="behavioural"
                                            <?php echo isset($filter['grade_scale_type'])&&($filter['grade_scale_type']=='behavioural')?'selected':''; ?>>Behavioural</option>
                                        <option value="cognitive"
                                            <?php echo isset($filter['grade_scale_type'])&&($filter['grade_scale_type']=='retire')?'cognitive':''; ?>>Cognitive</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#add_scale">
                                        <i class="fa fa-plus"></i>New Scale</a>

                                </div>
                            </div>

                            <table id="account-table" class="table table-bordered table-striped  dataTable no-footer" width="100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th data-orderable="false" style="width: 15%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($scales as $scale){ ?>
                                        <tr>
<<<<<<< HEAD
                                            <td><a class="grade_scale_levels link prof-link" href="javascript:void(0)"
                                                   data-action="<?php echo site_url('grade_scale/grade_scales_level/').$scale['id']; ?>"
=======
                                            <td><a class="grade_scale_levels link prof-link"
                                                   href="<?php echo site_url('grade_scale/grade_scales_level/').$scale['id']; ?>"
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
                                                   data-href="<?php echo $scale['id']; ?>"><?php echo $scale['name']; ?></a></td>
                                            <td><?php echo $scale['type']; ?></td>
                                            <td><?php echo $scale['description']; ?></td>
                                            <td><?php echo $scale['status']; ?></td>
                                            <td>
                                                <a class="edit_grade_scale btn btn-info btn-xs"
                                                   data-name="<?php echo $scale['name']; ?>"
                                                   href="javascript:void(0)"
                                                   data-type="<?php echo $scale['type'] ?>"
                                                   data-status="<?php echo $scale['status'] ?>"
                                                   data-href="<?php echo $scale['id']; ?>"><i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                                <?php if($scale['status']=='active'){ ?>
                                                    <a class="retire-grade-scale btn btn-warning btn-xs" href="#"
                                                       data-href="<?php echo site_url('grade_scale/retire_scale/').$scale['id'] ?>">
                                                      <i class="fa fa-archive icon-margin" title="Retire"></i></a>
                                                <?php } ?>

                                                <a class="delete-grade-scale btn btn-danger btn-xs" href="#"
                                                   data-href="<?php echo site_url('grade_scale/delete_scale/').$scale['id'] ?>">
                                                    <i class="fa fa-trash icon-margin" title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {

            $("#account-table").DataTable({});

            /* Custom filtering function which will search data in column four between two values */

            var table =$('.datatables').DataTable({"scrollX": true});

            $('#status').on('change', function(){
                table
                    .column(3)
                    .search(this.value)
                    .draw();

            });

            $('#type').on('change', function(){
                if(this.value == 'all'){
                    table
                        .search( '' )
                        .columns().search( '' )
                        .draw();
                }else{
                    table
                        .column(1)
                        .search(this.value)
                        .draw();
                }
            });
        });
    </script>
</div>
<!-- /.content -->
<div class="modal fade" id="add_scale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">New Grade Scale</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="grade_scale_add_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="grade_scale_add_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form id="grade_scale_add_form" method="post" role="form"
                      data-action="<?php echo site_url('grade_scale/add_scale') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Grade scale type:</label>
                        <select class="custom-select custom-select-lg mb-3" name="type">
                            <option selected="selected" value="cognitive">Cognitive</option>
                            <option value="behavioural">Behavioural</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="save_scale" type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Scale</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_scale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Grade Scale</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="grade_scale_add_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="grade_scale_add_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="modal-body edit-modal-body">

            </div>
        </div>
    </div>
</div>
