<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Employee Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">employee</a></li>
                        <li class="breadcrumb-item active">category</li>
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
                    <div id="employee_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="employee_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Employee Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#employee_category_add"><i class="fa fa-plus"></i>New Employee Category</a>
                                </div>
                            </div>
                            <table id="employee-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th data-orderable="false" style="width: 9%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($categories as $category) { ?>
                                    <tr>
                                        <td><?php echo $category['category']; ?></td>
                                        <td><?php echo $category['role_name']; ?></td>
                                        <td>
                                            <a class="edit-employee-category btn btn-info btn-xs" href="#" data-value="<?php echo $category['id']; ?>" data-href="<?php  echo site_url('employee_setting/edit_view/').$category['id']; ?>"><i class="fa fa-edit icon-margin" title="Edit"></i></a>
                                            <a class="delete-employee-category btn btn-danger btn-xs" href="#" data-href="<?php echo site_url('employee_setting/delete_category/').$category['id'] ?>"><i class="fa fa-trash icon-margin" title="Delete"></i></a>
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
<div class="modal fade" id="employee_category_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">New Employee Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="employee_cat_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="employee_cat_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <form id="employee_cat_form" method="post" role="form" data-action="<?php echo site_url('employee_setting/add_employee_category') ?>" enctype="multipart/form-data">
                <div class="modal-body mx-3">
                    <div class="md-form mb-6">
                        <input type="text" id="category_name" name="category" class="form-control validate" placeholder="Category Name">
                    </div>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-6">
                        <select class="form-control" name="role_id">
                            <option value="">Select a role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button id="save_employee_category" type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i>Create Employee Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="employee_category_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Employee Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="employee_cat_update_error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div id="employee_cat_update_success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <div id="employee_category_edit_form">
                <form id="employee_cat_update" method="post" role="form" data-action="<?php echo site_url('employee_setting/update_employee_category') ?>" enctype="multipart/form-data">
                    <input type="hidden" id="category_id" name="category_id">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-6">
                            <input type="text" id="category_name_update" name="category" class="form-control validate" placeholder="Category Name">
                        </div>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-6">
                            <select class="form-control" name="role_id">
                                <option value="">Select a role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="update_employee_category" type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o"></i> Update Employee Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#employee-table").DataTable({ });

    });
</script>