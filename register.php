<?php 
 
include 'dbconn/dbconn.php';
 

 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
$email = "";
 $usernames = "";
 $usernameserr = "";
 $password = "";
 $cpassword = "";
 $emailerr = "";
 $passerr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['username']))
    {
        $usernames =  test_input($_POST["username"]);
    }else
    {
        $usernameserr = "Username Kosong";
    }
 
        if(!empty($_POST['email']))
        {
            $email = test_input($_POST['email']);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $emailerr = "Format Email salah";
            }
        }else
        {
            $emailerr = "email kosong";
        }
        if(!empty($_POST['password']))
        {
            $password = test_input($_POST['password']);
            $cpassword = test_input($_POST['cpassword']);
            if($password != $cpassword)
            {
                $passerr = "password tidak sesuai";
            }
        }
  
 
    if (!empty($usernames) and !empty($password) and !empty($email) and empty($emailerr) and empty($passerr)) {
        $sql = "SELECT * FROM akun WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO akun (user_name, email, password)
                    VALUES ('$usernames', '$email', '$password')";
            $result = $conn->query($sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!');window.location = 'index.php'</script>";
                $username = "";
                $email = "";
            
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } 
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title> Register</title>
</head>
<body>
    <div class="container">
        <form action="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" class="login-email" >
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $usernames; ?>" > <?php echo $usernameserr; ?>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>"> <?php echo $emailerr; ?>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>"><?php echo $passerr; ?>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $cpassword; ?>">
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Anda sudah punya akun? <a href="index.php">Login </a></p>
        </form>
    </div>
</body>
</html>