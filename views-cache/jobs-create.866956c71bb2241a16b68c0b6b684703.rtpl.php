<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/jobs">Jobs</a></li>
    <li class="active"><a href="/jobs/create">Add New Job</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Job</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/jobs/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="job_title">Title</label>
              <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>
            <div class="form-group">
              <label for="min_salary">Minimum salary</label>
              <input type="text" class="form-control" id="min_salary" name="min_salary" required>
            </div>
            <div class="form-group">
              <label for="max_salary">Maximum salary</label>
              <input type="text" class="form-control" id="max_salary" name="max_salary" required>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Register</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->