<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Listing Events</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Events</li>
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
                            <h3 class="card-title">Events</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-8">
                                    <a href="javascript:void(0)" data-href="<?php echo base_url()."calendar/add_event_view"; ?>" class="btn btn-primary add-calendar-eveent">
                                        <i class="fa fa-plus"></i>Add Event
                                    </a>
                                </div>
                            </div>
                            <table id="events_table" class="table table-bordered table-striped nowrap"
                                   style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Starts</th>
                                    <th>Ends</th>
                                    <th>Is holiday</th>
                                    <th>Is common</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($events as $event): ?>
                                        <tr>
                                            <td><?php echo $event['title']; ?></td> 
                                            <td><?php echo date('F j, Y',strtotime($event['start'])); ?></td>
                                            <td><?php echo date('F j, Y',strtotime($event['end'])); ?></td>
                                            <td><?php echo $event['is_holiday']==1?'Yes':'No'; ?></td> 
                                            <td><?php echo $event['is_common']==1?'Yes':'No'; ?></td> 
                                            <td>
                                                <a href="javascript:void(0)" data-href="<?php echo base_url()."calendar/edit_view/".$event['id']; ?>" class="btn btn-info btn-xs add-calendar-eveent">
                                                    <i class="fa fa-edit icon-margin" title="Edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" data-href="<?php echo site_url('calendar/delete'); ?>" data-event-id="<?php echo $event['id']; ?>"
                                                   class="btn btn-danger btn-xs waves-effect waves-light delete-event">
                                                   <i class="fa fa-trash icon-margin"  title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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

<script>
    $(document).ready(function(){
        
        <?php if (!empty($this->session->flashdata('errors'))) { ?>
            toastr["warning"]('<?php echo $this->session->flashdata('errors'); ?>');
        <?php }elseif(!empty($this->session->flashdata('success'))){ ?>
            toastr["success"]('<?php echo $this->session->flashdata('success'); ?>');
        <?php } ?>
	
	    $("#events_table").DataTable({});
    });
</script>