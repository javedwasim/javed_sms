<aside id="sidebar_aside" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- sidebar: style can be found in sidebar.less -->
    <!-- Brand Logo -->
        <?php $photo = $this->session->userdata('institution_detail');?>
        <?php if(!empty($photo)): ?>
            <a href="<?php echo base_url('students'); ?>" class="brand-link">
              <img src="<?php echo base_url()."assets/uploads/institution/".$photo['logo']; ?>"
                   alt="EILIT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light"><?php echo isset($photo['name'])?$photo['name']:''; ?></span>
            </a>
        <?php endif; ?>
    <div class="sidebar">
        <!-- search form -->
        <form  method="post" class="sidebar-form" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name="query" id="query" class="form-control nav-search" placeholder="Search...">
                <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
          <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu list" data-widget="treeview" role="menu" data-accordion="false">
           
        </ul>

    </nav>
    </div>
    <!-- /.sidebar -->
</aside>
<div id="content-wrapper">

