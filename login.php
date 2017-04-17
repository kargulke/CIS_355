<?php  
     
    session_start(); 
     
    # include connection data and functions 
    require 'database.php'; 
     
    # if there was data passed, then verify password,  
    # otherwise do nothing (that is, just display html for login) 
	#var_dump($_POST);
	#var_dump($_GET);
	
	$event_id = null;
	if ( !empty($_POST['event_id'])) {
		$event_id = $_REQUEST['event_id'];
	}
	
    if ( !empty($_POST)) { 
        // keep track validation errors 
        $nameError = null; 
        $passwordError = null; 
         
        // keep track post values 
        $name = $_POST['member_username']; 
        $password = $_POST['member_password']; 
         
        // validate input 
        $valid = true; 
        if (empty($name)) { 
            $nameError = 'Please enter user name'; 
            $valid = false; 
        } 
         
        if (empty($password)) { 
            $passwordError = 'Please enter password'; 
            $valid = false; 
        }  
         
        // verify that password is correct for user name 
        if ($valid) { 
            $pdo = Database::connect(); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT * FROM Members WHERE member_username = ? LIMIT 1"; 
            $q = $pdo->prepare($sql); 
            $q->execute(array($name)); 
            $results = $q->fetch(PDO::FETCH_ASSOC); 
            if($results['member_password']==$password) { 
                $_SESSION['member_username'] = $name; 
                Database::disconnect(); 
				if($event_id == null){
					header("Location: index.php"); // redirect 
				}
			} 
            else { 
                $passwordError = 'Password is not valid'; 
                Database::disconnect(); 
            } 
        } 
    } # end if ( !empty($_POST)) 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<?php
	include 'class.php';
	objectClass::headerShort();
?>
<body> 
    <div class="container">      
        <div class="span10 offset1"> 
            <div class="row"> 
                <h3>Login</h3> 
            </div>         
            <form class="form-horizontal" action="login.php?event_id=<?php echo $event_id ?>" method="post">              
              <div class="control-group <?php echo !empty($nameError)?'error':'';?>"> 
                <label class="control-label">User Name</label> 
                <div class="controls"> 
                      <input name="member_username" type="text"  placeholder="<?php echo $event_id?>" value="<?php echo !empty($name)?$name:'';?>"> 
                      <?php if (!empty($nameError)): ?> 
                          <span class="help-inline"><?php echo $nameError;?></span> 
                      <?php endif; ?> 
                </div> 
              </div>                
              <div class="control-group <?php echo !empty($passwordError)?'error':'';?>"> 
                <label class="control-label">Password</label> 
                <div class="controls"> 
                      <input name="member_password" type="password" placeholder="password Address" value="<?php echo !empty($password)?$password:'';?>"> 
                      <?php if (!empty($passwordError)): ?> 
                          <span class="help-inline"><?php echo $passwordError;?></span> 
                      <?php endif;?> 
                </div> 
              </div>                
              <div class="form-actions"> 
                  <button type="submit" class="btn btn-success">Login</button> 
                  <a class="btn" href="index.php">Back</a> 
                </div>               
            </form>              
        </div>                  
    </div> <!-- /container -->      
  </body> 
</html> 