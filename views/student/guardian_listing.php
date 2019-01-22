<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Search</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">guardian search</li>
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
                            <h3 class="card-title">Guardians</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form rol="form" style="width: 100%;" id="guardian_form_filters" >
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Search</label>
                                            <input type="text" name="search-guardian" class="form-control"
                                                   value="<?php echo isset($filters['search-guardian']) ? $filters['search-guardian'] : ''; ?>"
                                                   onchange="guardian_filters()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status"
                                                    onchange="guardian_filters()">
                                                <option value="">Please select</option>
                                                <option value="1">Active</option>
                                                <option value="-99999">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" onchange="guardian_filters()">
                                                <option value="">Please select</option>
                                                <option value="male"<?php echo isset($filters['gender']) && (($filters['gender'] == 'male')) ? 'selected' : ''; ?>>Male</option>
                                                <option value="female"<?php echo isset($filters['gender']) && (($filters['gender'] == 'female')) ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date Added</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="created_at" onchange="guardian_filters()"
                                                   name="created_at" value="<?php echo isset($filters['created_at'])? $filters['created_at'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#student_guardian_model">
                                <i class="fa fa-user-plus"></i>Create New Guardian</a>

                            <table id="guardian-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Ward</th>
                                    <th> Activated at</th>
                                    <th data-orderable="false">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($guardians as $guardian) { ?>
                                    <tr>
                                        <td>
                                            <a class="prof-link student-guardian"
                                               data-href="<?php echo site_url('guardians/guardian_profile/') . $guardian['guardian_id'] ?>">
                                                <?php echo $guardian['surname'] . ', ' . $guardian['first_name'] . '(' . $guardian['guardian_id'] . ')' ?></a>
                                        </td>
                                        <td><?php echo $guardian['st_name']; ?></td>
                                        <td><?php echo $guardian['activated_at'] ?></td>
                                        <td><a href="#" class="btn btn-primary btn-xs"><i class="fa fa-user-plus"></i>Select</a></td>
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
    <!-- Modal -->
    <div class="modal fade" id="student_guardian_model" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <form id="create_guardian_form" method="post" role="form" enctype="multipart/form-data" action="<?php echo site_url('guardians/add_new_guardian') ?>"
                  data-action="<?php echo site_url('guardians/add_new_guardian') ?>">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Guardian</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Personal Details</h5>
                                <hr>

                                <div class="row">
                                    <?php if ($guardian_fields['title']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" maxlength="15" name="title"/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Surname<code>*</code></label>
                                            <input type="text" class="form-control" maxlength="15" name="surname" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name<code>*</code></label>
                                            <input type="text" class="form-control" maxlength="20" name="first_name"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle name</label>
                                            <input type="text" class="form-control" maxlength="20" name="middle_name"/>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-4">-->
<!--                                        <div class="form-group">-->
<!--                                            <label>Last name</label>-->
<!--                                            <input type="text" class="form-control"  name="last_name" />-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <?php if ($guardian_fields['mobile_phone']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile phone</label>
                                                <input type="number" id="guardian_mobile_phone" class="form-control" maxlength="15" name="mobile_phone"/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($guardian_fields['phone']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="number" id="guardian_phone" maxlength="15" class="form-control" name="phone"/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($guardian_fields['email']) { ?>
                                        <div class="col-md-4">
                                            <label>Email<code>*</code></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control myTextInput" maxlength="30" name="email" required/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($guardian_fields['gender']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">Please select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($guardian_fields['photo']) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Choose File</label>
                                                <input type="file" style="margin-top: 10px;" name="photo" id="guardian_file">
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Student<span style="color: red;">*</span></label>
                                            <select class="form-control" name="student_id" required>
                                                <option value="">Select a student</option>
                                                <?php foreach ($students as $student): ?>
                                                    <option value="<?php echo $student['student_id']; ?>"><?php echo $student['surname']." ".$student['first_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <h5>Wards</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship with student</label>
                                            <input type="text" class="form-control" name="relation_with_student" maxlength="20"/>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="emergency_contact" class="col-form-label">Emergency contact?</label>
                                            <input type="checkbox" value="1" name="emergency_contact" class="form-control validate" >

                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="is_authorized" class="col-form-label">Authorized to pick up?</label>
                                            <input type="checkbox" value="1"  name="is_authorized" class="form-control validate" >

                                        </div>
                                    </div>
                                </div>
                                <?php if ($guardian_fields['address']) { ?>
                                    <h5>Contact Address</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control" name="country" id="nationality">
                                                    <option value="">Please Select</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?php echo $country['id'] ?>"><?php echo $country['country_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="state" id="country_states">
                                                    <option value="">Please Select</option>
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                                                    <?php  endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" maxlength="20" name="city"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address line</label>
                                                <textarea class="form-control" maxlength="120" rows="3"
                                                          name="address_line"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>L.G.A</label>
                                                <select class="form-control" name="lga" id="lga_of_origin">
                                                    <option value="">Please Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="save_student_guardians" class="btn btn-primary" id="save-guardian">
                            <i class="fa fa-plus fa-cli"></i>Add Guardian</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <!-- /.content -->
    <?php $message = $this->session->flashdata('success'); if(!empty($message)): ?>
        <script>
            $(document).ready(function(){
                toastr["success"]('<?php echo trim($message); ?>');
            });
        </script>
    <?php endif; ?>
    <?php $message = $this->session->flashdata('error'); if(!empty($message)): ?>
        <script>
            $(document).ready(function(){
                toastr["error"]("<?php echo trim($message); ?>");
            });
        </script>
    <?php endif; ?>
</div>


<script>
    $(document).ready(function(){
        $('#created_at').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#emp-li-doj').datepicker({
            format: 'yyyy-mm-dd'
        });
    });

    function guardian_filters(){
        $.ajax({
            url: '/isms/guardians/guardian_filters',
            data: $('#guardian_form_filters').serialize(),
            type: 'post',
            cache: false,
            success: function(response) {
                if(response.guardian_html != ''){
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.guardian_html);
                    $('#guardian-table').DataTable();
                    $('.select2').select2();
                    $('#title').html('Guardian Listing | ISMS');

                }
            }
        });
    }

    $("#nationality").change(function () {
        var country = $('#nationality').val();
        $.ajax({
            url: '/isms/students/get_state/'+country,
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('#country_states').empty();
                    $('#country_states').append(response.states_html);
                } else {
                    toastr["warning"](response.message);
                }
            }
        });
    });

    $("#country_states").change(function () {
        var state = $('#country_states').val();
        $.ajax({
            url: '/isms/students/get_origin/'+state,
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('#lga_of_origin').empty();
                    $('#lga_of_origin').append(response.origin_html);
                } else {
                    toastr["warning"](response.message);
                }
            }
        });
    });

    $('input.myTextInput').on('input',function(e){
        var base_url = $('#base').val();
        var email = $('.myTextInput').val();
        $.ajax({
            url: base_url+'guardians/validate_email',
            data:{email:email},
            type: 'post',
            cache: false,
            success: function(response) {
                if (response.success) {
                    toastr["error"](response.message);
                }
            }
        });
    });

</script>