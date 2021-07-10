<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');
    $conn = getConnection ();
    $sql="SELECT * FROM `user` WHERE `user_type` = 'mangr'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo ("
            <li class='list-group-item'>
    <div class='row'>
        <div class='col-xl-1 col-lg-1'>
            ".$row["user_id"]."
        </div>
        <div class='col-xl-2 col-lg-2'>
            ".$row["user_name"]."
        </div>
        <div class='col-xl-3 col-lg-3'>
            ".$row["user_fname"]." ".$row["user_lname"]."
        </div>
        <div class='col-xl-2 col-lg-2'>
            ".$row["user_tp"]."
        </div>
        <div class='col-xl-3 col-lg-3'>
            ".$row["user_email"]."
        </div>
        <div class='col-xl-1 col-lg-1'>
            <button type='button' class='btn btn-circle btn-primary btn-sm' data-toggle='modal' data-target='#edit_supplier'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-circle btn-danger btn-sm' data-toggle='modal' data-target='#delete_confirm' onclick='setsupid".$row["user_id"]."()'><i class='fas fa-trash'></i></button>
            <script>
                function setsupid".$row["user_id"]."() {
                    document.getElementById('selectedToDel').innerHTML = ".$row["user_id"].";
                }
            </script>
        </div>
        <div class='modal' id='edit_supplier'>
            <div class='modal-dialog modal-dialog-scrollable modal-dialog-centered'>
                <div class='modal-content'>                                      
                    <!-- Modal body -->
                    <div class='modal-body'>
                        <!-- Nested Row within Card Body -->
                        <div class='row'>
                            <div class='col-lg-12'>
                                <div class='p-5'>
                                    <div class='text-center'>
                                        <h1 class='h4 text-gray-900 mb-4'>Reset Password?</h1>
                                        <p>You are about to reset selected manager's password. It will replace with a random password and you can copy it here.</p>
                                    </div>
                                    <form class='user'>
                                        <div class='form-group row'>
                                        <div class='col-sm-6 mb-3 mb-sm-0'>
                                            <button type='button' class='btn btn-danger btn-user btn-block mb-3' onclick='loadDoc()'>
                                                <i class='fas fa-file-import fa-fw'></i> Reset<span id='save-btn-spinner' class='spinner-border-sm'></span>
                                            </button>
                                        </div>
                                        <div class='col-sm-6'>
                                            <button type='reset' class='btn btn-secondary btn-user btn-block mb-3' data-dismiss='modal'>
                                                <i class='fas fa-backspace fa-fw'></i> Cancel
                                            </button>
                                        </div>
                                        </div>
                                        <div id='demo'></div>
                                    </form>
                                </div>
                            </div>
                        </div>       
                    </div>
                </div>
            </div>
        </div>
        <div class='modal' id='delete_confirm'>
            <div class='modal-dialog modal-dialog-scrollable modal-dialog-centered'>
              <div class='modal-content'>                                      
                    <!-- Modal body -->
                    <div class='modal-body'>
                        <!-- Nested Row within Card Body -->
                        <div class='row'>           
                            <div class='col-lg-12'>
                                <div class='p-5'>
                                    <div class='text-center'>
                                        <h1 class='h4 text-gray-900 mb-4'>Are you sure?</h1>
                                        <p>You are about to permanantly delete a record..!</p>
                                    </div>
                                    <form class='user'>
                                        <div class='form-group row'>
                                            <div class='col-sm-6 mb-3 mb-sm-0'>
                                                <button type='button' class='btn btn-secondary btn-user btn-block mb-3' data-dismiss='modal'>
                                                    <i class='fas fa-file-import fa-fw'></i> Cancel <span id='save-btn-spinner' class='spinner-border-sm'></span>
                                                </button>
                                            </div>
                                            <div class='col-sm-6'>
                                                <button type='reset' class='btn btn-danger btn-user btn-block mb-3' onclick='callDelete()'>
                                                    <i class='fas fa-backspace fa-fw'></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
  </li>
            ");
        }
    } else {
        echo "0 results";
    }
    #test
?>