<?php 
 
include 'dbconn/dbconn.php';

 
session_start();
if(isset($_SESSION["username"]))
{
    header("location:Tampil.php");
}
$email = $password = $emailerr = $passworderr = $errorverifi = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($_POST["email"]))
    {
        $email = test_input($_POST["email"]);
        if(!filter_var($email))
        {
            $emailerr = "format email salah";

        }

    }else
    {
        $emailerr = "kosong emailnya";
    }
    if(!empty($_POST["password"]))
    {
        $password = test_input($_POST["password"]);
       

    }else
    {
        $passworderr = "Password Kosong";
    }
    $sql = "SELECT * FROM akun WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['user_name'];
        header("Location: Tampil.php");
    }else
    {
        $errorverifi = "ada salah email/pass";
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
 
    <title>Login Page</title>
</head>
<body>
    <div class="alert alert-warning" role="alert">
    </div>
 
    <div class="container">
       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p> 
            <div class="input-group"> 
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>">  <?php echo $emailerr;?>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>"> <?php echo $passworderr; ?>
            </div>
          
            <div class="input-group"> <?php echo $errorverifi; ?>
                <button name="submit" class="btn">Login</button> 
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>