<?php $user_data = $this->session->userdata('userdata'); $user_name = $user_data['name']; ?>
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
                <p>
                    Welcome! Admin
                </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="<?php echo base_url('dashboard/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url('dashboard/logout'); ?>" class="btn btn-default btn-flat">Sign
                        out</a>
                </div>
            </li>
        </ul>
    </li>
  </ul>
</nav>
  <!-- /.navbar -->