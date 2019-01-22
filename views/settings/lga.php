<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Origin List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">lga</li>
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
                    <div id="class_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="class_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Origins</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#origin_add"><i class="fa fa-plus"></i>Add Origin</a>
                                </div>
                            </div>
                            <table id="class-table" class="table table-bordered table-striped datatables">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th data-orderable="false" style="width: 9%;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($origins as $origin) { ?>
                                    <tr>
                                        <td><?php echo $origin['name']; ?></td>
                                        <td><?php echo $origin['state_name'];?></td>
                                        <td>
                                            <a class="edit-origin btn btn-info btn-xs" href="javascript:void(0)"
                                               data-value="<?php echo $origin['id']; ?>"><i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                            <a class="delete-origin btn btn-danger btn-xs" href="#"
                                               data-href="<?php echo site_url('general_setting/delete_origin/').$origin['id'] ?>"><i class="fa fa-trash icon-margin" title="Delete"></i></a>
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
<div class="modal fade" id="origin_add"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="edit-modal-body">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Save Origin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="origin_form" method="post" role="form"
                      data-action="<?php echo site_url('general_setting/add_origin') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text"  name="name" id="city_name" class="form-control validate" placeholder="City Name">
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" name="state_id" id="state_id">
                                <option value="">Select a state</option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="save_origin" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add Origin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#class-table').DataTable();

        $('#origin_add').on('hidden.bs.modal', function () {
            $('#state_id').val('');
            $('#city_name').val('');
            $('#city_id').val('');
        });
    });
</script>