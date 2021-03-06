<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/employees">Employees</a></li>
    <li class="active"><a href="/employees/create">Add New Employee</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Employee</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/employees/create" method="post">
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="fist_name">Fist name</label>
                  <input type="text" class="form-control" id="fist_name" name="fist_name" maxlength="100" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="last_name">Last name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" maxlength="100" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" maxlength="120" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="phone_number">Phone number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" maxlength="15" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="hire_date">Hire date</label>
                  <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="salary">Salary</label>
                  <input type="text" class="form-control" id="salary" name="salary" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="job_id">Job</label>
                  <input type="text" class="form-control" id="job_id" name="job_id" onchange="search(this.value, 'jobs');" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="job_name">Name</label>
                  <input type="text" class="form-control" id="job_name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="department_id">Department</label>
                  <input type="text" class="form-control" id="department_id" name="department_id" onchange="search(this.value, 'departments');" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="department_name">Name</label>
                  <input type="text" class="form-control" id="department_name">
                </div>
              </div>
            </div>
            <div class="alert alert-danger alert-dismissible">
              <h4><strong>Attention: Fill in the fields below only if this employee is a system user</strong>, with this a user will be registered for the employee.</h4>
            </div>
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="login">Login</label>
                  <input type="text" class="form-control" id="login" name="login" maxlength="64">
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" maxlength="256">
                </div>
              </div>
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