<div class="mx-2">

    <?php
    //LogedID
    $LogID = $_SESSION["Loged_id"];
    $status = 1;

    //Sql Select User Logedin
    $sql_select_logedin = $con->prepare("SELECT * FROM tbl_user WHERE tbl_user.status = ? 
    AND tbl_user.user_id = ?");

    $sql_select_logedin->bindParam(1, $status);
    $sql_select_logedin->bindParam(2, $LogID);

    $sql_select_logedin->execute();
    $row_select_logedin = $sql_select_logedin->fetch(PDO::FETCH_BOTH);

    $_SESSION['Loged_permission'] = $row_select_logedin['permission'];

    //Check if is true
    if ($row_select_logedin['permission'] == "Admin") {
        //Show User Info Logedin
    ?>
        <div class="alert alert-secondary" style="height: 75px;" role="alert">
            <div class="row">
                <div >
                    <a href="Users.php?ID=<?= $row_select_logedin['user_id'] ?>">
                        
                    </a>
                </div>
               
                <div class="col-auto mt-1 ml-4">
                    User : 
                    <strong class="text-success"><?= $row_select_logedin['user_fullname'] ?></strong><br>
                    <p>Permission : <span class="badge badge-pill badge-success"><?= $row_select_logedin['permission'] ?></span></p>
                </div>
            </div>     
        </div>
    <?php
    }else if($row_select_logedin['permission'] == "User"){
        ?>
        <div class="alert alert-secondary" style="height: 75px;" role="alert">
            <div class="row">
                <div>
                    <a href="Users.php?ID=<?= $row_select_logedin['user_id'] ?>">
                        
                    </a>
                </div>
               
                <div class="col-auto mt-1 ml-1">
                    User : 
                    <strong class="text-success"><?= $row_select_logedin['user_fullname'] ?></strong><br>
                    <p>Permission : <span style="color: white ;" class="badge badge-pill badge-warning"><?= $row_select_logedin['permission'] ?></span></p>
                </div>
            </div>     
        </div>
    <?php
    } else if($row_select_logedin['permission' == "Vendor"]){
        ?>
        <div class="alert alert-secondary" style="height: 75px;" role="alert">
            <div class="row">
                <div>
                    <a href="Users.php?ID=<?= $row_select_logedin['user_id'] ?>">
                        
                    </a>
                </div>
               
                <div class="col-auto mt-1 ml-1">
                    User : 
                    <strong class="text-success"><?= $row_select_logedin['user_fullname'] ?></strong><br>
                    <p>Permission : <span style="color: white ;" class="badge badge-pill badge-danger"><?= $row_select_logedin['permission'] ?></span></p>
                </div>
            </div>     
        </div>
    <?php
    } else {
        //session_destroy();
        unset($_SESSION['Loged_id']);
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Message!</strong> You are no permission to access this page! <br>
            Click other or refresh to exit.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        header("location: index.php");
    }
    ?>

</div>