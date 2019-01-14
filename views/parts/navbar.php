<?php
$user_data = $this->session->userdata('userdata');
$user_name = $user_data['name'];
$profile_employee_id = $this->session->userdata('profile_employee_id');
$profile_student_id = $this->session->userdata('profile_student_id');
$role = $user_data['role'];
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
   <ul class="navbar-nav ml-auto">
    <li class="dropdown user user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if(isset($photo) && !empty($photo)): ?>
                <img src="<?php echo base_url().$photo; ?>"
                     width="25" height="25" class="img-circle" alt="User Image">
            <?php else: ?>
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png"
                     class="user-image" alt="User Image">
            <?php endif; ?>
            <span class="hidden-xs docName"><?php echo $user_name; ?> Isms</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <?php if(isset($photo) && !empty($photo)): ?>
                    <img src="<?php echo base_url().$photo; ?>"
                         class="img-circle" alt="User Image">
                <?php else: ?>
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png"
                         class="user-image" alt="User Image">
                <?php endif; ?>
                <p style="color: #0c0c0c">Welcome! <?php echo $user_name; ?></p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <?php if($user_name == 'admin'): ?>
                        <a href="<?php echo base_url('dashboard/profile'); ?>" data-toggle="modal" data-target="#adminChangePwd"
                           class="btn btn-primary btn-flat" style="font-size: 13px">Change Pwd</a>
                    <?php elseif(!empty($role)):?>
                        <a href="javascript:void(0)"
                           data-href="<?php echo site_url('employee/profile/') . $profile_employee_id; ?>"
                           class="btn btn-primary btn-flat prof-link emp_profile">Profile</a>
                    <?php elseif(!empty($profile_student_id)):?>
                        <a href="javascript:void(0)"
                           data-href="<?php echo site_url('students/profile/') . $profile_student_id; ?>"
                           class="btn btn-primary btn-flat prof-link std_profile">Profile</a>
                    <?php else:?>
                        <a href="javascript:void(0)"
                           data-href="<?php echo site_url('guardians/guardian_profile/') . $profile_employee_id; ?>"
                           class="btn btn-primary btn-flat prof-link student-guardian">Profile</a>
                    <?php endif; ?>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url('dashboard/logout'); ?>" class="btn btn-primary btn-flat">Sign out</a>
                </div>
            </li>
        </ul>
    </li>
  </ul>
</nav>
  <!-- /.navbar -->