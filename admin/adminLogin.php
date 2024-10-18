<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
</head>
<body>
    <form method="post">
        <div class="">
            <h2>Admin Login</h2>
            <table>
                <tr>
                    <td><lable for="adminUsername">Username :</lable></td>
                    <td><input type="text"name="adminUsername"></td>
                </tr>
                <tr>
                    <td><lable for="adminPassword">Password :</lable></td>
                    <td><input type="password"name="adminPassword"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="login">Login</button></td>
                </tr>
            </table>
        </div>
    </form>



    <?php
        include 'dbConnect.php';
        if (isset($_POST['login'])) {
            $username=$_POST['adminUsername'];
            $password=$_POST['adminPassword'];

            $sql="SELECT * FROM admin WHERE adminUsername='$username' && adminPassword='$password'";
            $result=mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)>0)
            {
                header('location:admin.php')   ;         
            }
            else{
                echo "Error";
            }
        }
        
    ?>
</body>
</html>