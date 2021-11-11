<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/employees">Employees</a></li>
    <li class="active"><a href="">Edit Employee</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-name">Edit Employee</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/employees/<?php echo htmlspecialchars( $employee["employee_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="fist_name">Fist name</label>
                  <input type="text" class="form-control" id="fist_name" name="fist_name" value="<?php echo htmlspecialchars( $employee["fist_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="last_name">Last name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars( $employee["last_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars( $employee["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="phone_number">Phone number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars( $employee["phone_number"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="hire_date">Hire date</label>
                  <input type="date" class="form-control" id="hire_date" name="hire_date" value="<?php echo htmlspecialchars( $employee["hire_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="salary">Salary</label>
                  <input type="text" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars( $employee["salary"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="job_id">Job</label>
                  <input type="text" class="form-control" id="job_id" name="job_id" onchange="search(this.value, 'jobs');" value="<?php echo htmlspecialchars( $employee["job_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="job_name">Name</label>
                  <input type="text" class="form-control" id="job_name" value="<?php echo htmlspecialchars( $employee["job_title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="department_id">Department</label>
                  <input type="text" class="form-control" id="department_id" name="department_id" onchange="search(this.value, 'departments');" value="<?php echo htmlspecialchars( $employee["department_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="department_name">Name</label>
                  <input type="text" class="form-control" id="department_name" value="<?php echo htmlspecialchars( $employee["fist_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $employee["department_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
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