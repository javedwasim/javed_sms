<?php $this->load->view('parts/header'); ?>
<?php $this->load->view('parts/navbar'); ?>
<?php $this->load->view('parts/sidebar'); ?>
<?php if(isset($screen) && ($screen == 'student_profile')): ?>
    <?php $this->load->view('student/student_profile'); ?>
<?php elseif(isset($screen) && ($screen == 'guardian_profile')): ?>
    <?php $this->load->view('student/guardian_profile'); ?>
<?php else: ?>
    <?php $this->load->view('parts/student_listing'); ?>
<?php endif; ?>
<?php $this->load->view('parts/footer'); ?>