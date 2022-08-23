 <!--Insert Data-->
 <?php 
                    include("config/db.php");

                    if(isset($_POST['Add'])){
                        $name = $_POST['name'];
                        $gender = $_POST['gender'];
                        $dob = $_POST['dob'];
                        $phone = $_POST['phone'];
                        $address = $_POST['address'];
                        
                        //Photo
                        if(empty($_FILES['photo']['name'])){
                            $photos = "User1.png";
                        }
                        else{
                            $photos = $_FILES['photo']['name'];
                        }

                        date_default_timezone_set('Asia/Bangkok');
                        $created_at = date('Y/m/d h:i:s a', time());
                        $updated_at = date('Y/m/d h:i:s a', time());
                        $status = 1;

                        if(empty($name) || empty($gender) || empty($dob) || empty($address)){
                            echo'
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <strong>Message!</strong> Please input a correct data.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';
                        }else{

                            $sql = $con->prepare("INSERT INTO tbl_students(stu_name, gender, dob, phone, address, created_at, updated_at, photo, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $sql->bindParam(1, $name);
                            $sql->bindParam(2, $gender);
                            $sql->bindParam(3, $dob);
                            $sql->bindParam(4, $phone);
                            $sql->bindParam(5, $address);
                            $sql->bindParam(6, $created_at);
                            $sql->bindParam(7, $updated_at);
                            $sql->bindParam(8, $photos);
                            $sql->bindParam(9, $status);

                            if($sql->execute()){
                                echo'
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <strong>Message!</strong> Insert Data success. Now you can back.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                            }else{
                                echo'
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Message!</strong> Error Insert Data, Some data is already exsit.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                            }

                            //Photos ::: Coppy photo to Folder Photos
                            $location = "./Images/".basename($_FILES['photo']['name']);
                            move_uploaded_file($_FILES['photo']['tmp_name'], $location);
                            
                            //header("location: Student_Info.php");
                        }
                    }
                ?>