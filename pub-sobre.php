<?php
  require "header2.php";
?>
  <title> ROP | Sistema HcA </title>
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"-->
  <link rel="stylesheet" href="css/infostyle.css">

<main>
  <div class="info">
    <h1>O projeto</h1>
    <br><br><br><br>


    <form action="teste.php" method="post">
      <div id="example-6" class="content">
      	<div class="row">
      		<div class="col-md-12"><button type="button" id="btnAdd-6" class="btn btn-primary">Add Employee</button></div>
      	</div>
      	<div class="row group">
      		<div class="col-md-2">
      			<div class="form-group">
      				<label>Name<input class="form-control" class="form-control" type="text" name="user_name[]"></label>
      			</div>
      		</div>
      		<div class="col-md-2">
      			<label>Gender
      			<select name="user_gender[]" class="form-control">
      				<option value="">Please select..</option>
      				<option value="male">Male</option>
      				<option value="female">Female</option>
      			</select>
      			</label>
      		</div>
      		<div class="col-md-4">
      			<div class="col-md-2">
      				<div class="radio">
      					<label><input type="radio" name="user_role[0]" value="manager"> Manager </label>
      				</div>
      				<div class="radio">
      					<label><input type="radio" name="user_role[0]" value="editor"> Editor </label>
      				</div>
      				<div class="radio">
      					<label class="checkbox-inline"><input type="radio" name="user_role[0]" value="writer"> Writer </label>
      				</div>
      			</div>
      		</div>
      		<div class="col-md-3">
      			<button type="button" class="btn btn-danger btnRemove">Remove</button>
      		</div>
      	</div>
      </div>

      <button class="btn" type="submit" name="teste-submit">TESTE!</button>
    </form>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- jQuery Multifield -->
    <script src="js/jquery.multifield.min.js"></script>
    <script>
      $('#example-6').multifield({
      	section: '.group',
      	btnAdd:'#btnAdd-6',
      	btnRemove:'.btnRemove',
      });
    </script>

    <!-- Place this tag right after the last button or just before your close body tag. -->
    <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>

  </div>
</main>
