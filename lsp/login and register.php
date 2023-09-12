<?php 

session_start();

	include('connection.php');
	include('functions.php');


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: home.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="C.png" type="image/x-icon">
    
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn"  onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <img src="fb.png">
                <img src="tw.png">
                <img src="gp.png">
            </div>
            <form id="login" class="input-group">
                <input type="text" class="input-field" placeholder="User Id" required>
                <input type="text" class="input-field" placeholder="Enter Password" required>
                <input type="checkbox" class="chech-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn"><a href="Beranda.html" style="text-decoration: none;">Log in</a></button>
                <div class="admin">
                    <a href="admin.login.html">Admin</a>
                </div>
            </form>

            <form id="register" class="input-group">
                <input type="text" class="input-field" placeholder="User Id" required>
                <input type="email" class="input-field" placeholder="Email" required>
                <input type="text" class="input-field" placeholder="Enter Password" required>
                <input type="checkbox" class="chech-box"><span>I agree to the terms & conditions</span>
                <button type="submit" class="submit-btn">Register</button>
            </form>
        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }

    </script>
</body>
</html>