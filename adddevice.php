<?php include("adminLoginCheck.php");?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
</head>

<body>
<?php include("header.php"); ?>
<div class="container">
 <div class="row">
  <div class="col-md-12 body">
    <div class="row">
      <form class="form-horizontal" id="adddevice">
      <fieldset>

      <!-- Form Name -->
      <legend>Add New User's Device</legend>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="username">Username</label>
        <div class="col-md-4">
            <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required="">
        </div>
        <label class="control-label text-danger" id="usererr" ></label>
      </div>

      <!-- Password input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="password">Password</label>
        <div class="col-md-4">
          <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
        </div>
        <label class="control-label text-danger" id="passerr" ></label>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="email"></label>
        <div class="col-md-4">
        <input id="email" name="email" type="text" placeholder="e-mail" class="form-control input-md">

        </div>
        <label class="control-label text-danger" id="emailerr" ></label>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="devicename">Device Name</label>
        <div class="col-md-4">
        <input id="devicename" name="devicename" type="text" placeholder="" class="form-control input-md">
        </div>
         <label class="control-label text-danger" id="devicenameerr" ></label>
      </div>

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="periv">Select Basic</label>
        <div class="col-md-4">
          <select id="periv" name="periv" class="form-control">
            <option value="1">Admin</option>
            <option value="2">Celint</option>
          </select>
        </div>
        <label class="control-label text-danger" id="periverr" ></label>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="add">Add</label>
        <div class="col-md-4">
          <button id="add" type="button" name="add" onclick="adddevice()" class="btn btn-primary">Add </button>
        </div>
      </div>

      </fieldset>
      </form>

    </div>
  </div>
 </div>
</div>
<?php include("footer.php"); ?>
<script>
function adddevice(){
  $.ajax({
     url:"script/_adddevice.php",
     type:"post",
     data: $("#adddevice" ).serialize(),
     beforeSend:function(){
       $("#usererr").text("");
       $("#passerr").text("");
       $("#devicenameerr").text("");
       $("#periverr").text("");
     },
     success:function(res){
     console.log(res);
     if(res.success != 1){
       $("#usererr").text(res.user);
       $("#passerr").text(res.pass);
       $("#devicenameerr").text(res.devicename);
       $("#periverr").text(res.periv);
     }else{
       $("#usererr").text("");
       $("#passerr").text("");
       $("#devicenameerr").text("");
       $("#periverr").text("");
       alert("New user and device added");
     }

     },
     error:function(e){
      console.log(e);
     }
  });
}
</script>
</body>

</html>
