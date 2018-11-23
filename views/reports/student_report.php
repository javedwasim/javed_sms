<?php $userdata = $this->session->userdata('userdata'); $role = $userdata['role']; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Report Card <?php echo $batch['class_name'].' '.$batch['session']; ?></h1>
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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Report Card</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group row">
                        <input type="hidden" name="term_id" id="term_id" value="<?php echo isset($term_id)?$term_id:''; ?>">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Select Student</label>
                        <div class="col-sm-7">
                            <select class="form-control select2" name="student_batch_id" id="student_batch_id" onchange="student_report()">
                                <option value="">Please Select</option>
                                <?php foreach ($students as $student): ?>
                                    <option value="<?php echo $student['student_id'] ?>"><?php echo $student['surname'].' '.$student['first_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="container" id="student_info">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div  id="std_sbj_report"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function student_report(){
            var student_id = $('#student_batch_id').val();
            var term_id = $('#term_id').val();
            var base_url = $('#base').val();
            $.ajax({
                url: base_url+'reportcard/get_student_subjects_report',
                data: {student_id:student_id,term_id:term_id},
                type: 'post',
                cache: false,
                success: function(response) {
                    if(response.result_html != ''){
                        $('#std_sbj_report').empty();
                        $('#std_sbj_report').append(response.result_html);
                        $('#student_info').empty();
                        $('#student_info').append(response.student_info);
                    }
                }
            });

            return false;
        }
        $(function () {
            $('.select2').select2();
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
