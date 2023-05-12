<?php
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['personal'])){
        $personal = mysqli_real_escape_string($con, $_POST['personal']);

        $personal = base64_encode($personal);

        $password = mysqli_real_escape_string($con, $_POST['password']);

        if(empty($personal)){
            array_push($errors,"Username is requried");
        }
        if(empty($password)){
            array_push($errors,"Password is requried");
        }

        if(count($errors)==0){
            $password = md5($password);

            $query = "SELECT * FROM user WHERE personal = '$personal' AND password = '$password'";
            $result = mysqli_query($con,$query);


            if(mysqli_num_rows($result)==1){

                $row = mysqli_fetch_array($result);

                $premission = $row['premission'];


            switch ($premission){
                    case 'Admin':
                        $_SESSION['personal_admin'] = ($row['personal']);
                        $_SESSION['premission'] = $row['premission'];
                        $_SESSION['prefix_name_A'] = $row['prefix_name'];
                        $_SESSION['premission_A'] = $row['premission'];
                        $_SESSION['fname_A'] = $row['fname'];
                        $_SESSION['lname_A'] = $row['lname'];
                        header('location: admin/home.php');
                        break;
                    case 'Member':
                        $_SESSION['personal'] = ($row['personal']);
                        $_SESSION['premission'] = $row['premission'];
                        $_SESSION['fname'] = $row['fname'];
                        $_SESSION['lname'] = $row['lname'];
                        header('location: homepage_log.php');
                        break;

                }

            }else{
                array_push($errors,"Wrong Errors!!!");
                $_SESSION['error']= "รหัสบัตรประชาชน หรือ รหัสผ่านไม่ถูกต้อง";
                header('location: login.php');
            }
        }
    }
?>