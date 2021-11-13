<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/jobs">Jobs</a></li>
    <li class="active"><a href="">Edit Job</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Job</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/jobs/<?php echo htmlspecialchars( $job["job_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="job_title">Title</label>
              <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo htmlspecialchars( $job["job_title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="100" required>
            </div>
            <div class="form-group">
              <label for="min_salary">Minimum salary</label>
              <input type="number" class="form-control" id="min_salary" name="min_salary" value="<?php echo htmlspecialchars( $job["min_salary"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>
            <div class="form-group">
              <label for="max_salary">Maximum salary</label>
              <input type="number" class="form-control" id="max_salary" name="max_salary" value="<?php echo htmlspecialchars( $job["max_salary"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->