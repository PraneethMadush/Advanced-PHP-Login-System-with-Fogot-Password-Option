<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration and Login System with PHP and MySQL by Praneeth Madush</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" 	type="text/css" media="all">
</head>
<body>
    <h1>USER REGISTRATION AND LOGIN SYSTEM BY PRANEETH MADUSH</h1>
	<div class="container">
        <?php
			if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
				include 'user.php';
				$user = new User();
				$conditions['where'] = array(
					'id' => $sessData['userID'],
				);
				$conditions['return_type'] = 'single';
				$userData = $user->getRows($conditions);
		?>
        <h2>Welcome <?php echo $userData['first_name']; ?>!</h2>
        <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
		<div class="regisFrm">
			<p><b>Name: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
            <p><b>Email: </b><?php echo $userData['email']; ?></p>
            <p><b>Phone: </b><?php echo $userData['phone']; ?></p>
		</div>
        <?php }else{ ?>
		<h2>Login to Your Account</h2>
        <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
		<div class="regisFrm">
			<form action="userAccount.php" method="post">
				<input type="email" name="email" placeholder="EMAIL" required="">
				<input type="password" name="password" placeholder="PASSWORD" required="">
				<div class="send-button">
					<input type="submit" name="loginSubmit" value="LOGIN">
				</div>
				<a href="forgotPassword.php">Forgot password?</a>
			</form>
            <p>Don't have an account? <a href="registration.php">Register</a></p>
		</div>
        <?php } ?>
	</div>
</body>
</html>