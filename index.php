<?php 
session_start();

// Turn off all error reporting
// error_reporting(0);
include 'dbConnection.php';
$updateFlag = false;
$fname = "";
    $lname = "";
    $email = "";
$ob = new Mydb('php_crud');
$allData = $ob->selectAll('user_details');
// var_dump();
if(isset($_POST['save'])){
    $post = $_POST;
    $ob->connect();
    $sql = 'INSERT INTO user_details (fname,lname,email) VALUE ("'.$post["firstName"].'","'.$post["lastName"].'","'.$post["userEmail"].'")';
    // $oP = mysqli_query($ob->conObject,$sql)
    if(mysqli_query($ob->conObject,$sql)){
        echo "<script>alert('Data Inserted');</script>";
    }
    header('location:index.php');
}
if(isset($_GET['edit'])){
    $fname = "";
    $lname = "";
    $email = "";
    $row = mysqli_fetch_array($allData,MYSQLI_ASSOC);

    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $updateFlag = true;
    $buttonUpdate = "Update";
    
}
if(isset($_POST['update'])){
    $updateData = $_POST;
    $update = 'UPDATE user_details SET fname = "'.$updateData['firstName'].'",lname = "'.$updateData['lastName'].'",email = "'.$updateData['userEmail'].'" WHERE id = "'.$updateData["id"].'"';
    if(mysqli_query($ob->conObject,$update)){
        echo "<script>alert('Data Udated');</script>";
    }
    header('location:index.php');
    
}
if(isset($_GET['delete'])){
    $sql = 'DELETE FROM user_details WHERE id = "'.$_GET['delete'].'"';
    if(mysqli_query($ob->conObject,$sql)){
        echo "<script>alert('Data Deleted');</script>";   
    }
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .table-data tr td ,thead{
            text-align:center;
        }
        .detail-form{
            box-shadow: 0px 0px 10px 2px rgba(220,40,60,0.75);
            -webkit-box-shadow: 0px 0px 10px 2px rgba(220,40,60,0.75);
            -moz-box-shadow: 0px 0px 10px 2px rgba(220,40,60,0.75);
            background: darkorange;
            padding: 20px;
            border-radius: 2%;
        }
    </style>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-3">
                        <h2>Simple CRUD Operation in PHP</h2>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-4  mt-4">
                    <form action="" method="post" class=" m-auto detail-form">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="firstName" value="<?php echo $fname ?>" class="form-control" id="" required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>" class="form-control" id="" >
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lastName" value="<?php echo $lname ?>" class="form-control" id="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="userEmail" value="<?php echo $email ?>" class="form-control"
                                id="" required>
                        </div>
                        <div class="form-group mb-0">
                            <?php if($updateFlag){ ?>
                            <input type="submit" class="btn btn-success " name="update" value="Update">
                            <?php }else{ ?>
                            <input type="submit" class="btn btn-primary" name="save" value="Submit">
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-4">
        <!-- display data -->
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-data">
                        <thead>
                            <th>Sr.no</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php if($allData){ while($row = mysqli_fetch_assoc($allData)){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><a href="http://localhost/php_crud/?edit=<?php echo $row['id']; ?>"
                                        class="btn btn-warning m-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> <a
                                        href="http://localhost/php_crud/?delete=<?php echo $row['id']; ?>"
                                        class="btn btn-danger m-1"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
                            </tr>
                            <?php  } }else{ ?>
                            <tr>
                                <td colspan="5">No Records Found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>
</body>

</html>
<script>
< script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" > < /> <
    script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" >
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</script>