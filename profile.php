<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}

if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $username =  $_POST['name'];
    $password =  $_POST['pass'];
    $confirm =  $_POST['con'];

    if($password == $confirm ){
        $sql = "UPDATE user SET username = '$username'
                            ,  password = md5('$password')
                                    WHERE
                                id = '$id'";
        $result = mysqli_query($connect, $sql);
        header("location:profile.php");
     
                                                
    }
    else {
         
    }
    
}

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">User Proflie</li>
      </ol>
          <div class="row">
                <div class="col-xs12 col-lg-6 col-lg-offset-2 ">
                 <div class="panel panel-default">
                        <div class="panel-heading">
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit" aria-hidden="true"></i>Change Profile</button>
                <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i>Change Profile</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="">     
                                    <div class="form-group col-xs-6">
                                        <label for ="">Username:</label> 
                                        <input class="form-control"   required name="id" type="hidden" Value = "<?php echo $show ['id']?>">                                         
                                        <input class="form-control"   required name="name" type="text" Value = "<?php echo $show ['username']?>">          
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for ="">Password:</label>                                          
                                        <input class="form-control"   required name="pass" type="password" Value = "<?php echo $show ['password']?>">          
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for ="">Confirm Password:</label>                                          
                                        <input class="form-control"   required name="con" type="password" Value = "<?php echo $show ['password']?>">          
                                    </div>
                                        <div class="form-group col-xs-6">
                                            <label for ="">Position:</label>                                          
                                            <input class="form-control"   readonly name="position" type="text" Value = "<?php echo $show ['position']?>">          
                                        </div>
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type = "submit" Value = "Update" class = "btn btn-primary">
                            </div>
                       </form>
                  </div>
                  </div>
                   </div>
                <a href="dashboard.php" class="btn btn-sm btn-danger btn-flat pull-right"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        
                        </div>
                        <div class="panel-body">
                         <center><h2><i class="fa fa-user" aria-hidden="true">Profile</i></h2></center>
                            <div class="form-group">
                                 <h3>Username: <b><?php echo $show['username']?></b></h3>
                                  
                            </div>
                            <div class="form-group">
                                  <h3>Password: <b><?php echo $show['password']?></b></h3>
                              
                            </div>
                            <div class="form-group">
                                  <h3>Position: <b><?php echo $show['position']?></b></h3>
                              
                            </div>
                        </div>
                     </div>  
                </div>
          </div>
<?php include 'footer.php';?>