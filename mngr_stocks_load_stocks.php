<?php
    #Headers for accept requests from remote origin
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');
    $conn = getConnection ();

    #This script returns stock details to front-end when there is an Ajax request
    $sql = "SELECT stock_id,stock_item_name,stock_brand_name,supplier.sup_name,stock_man_year,stock_wsp,stock_quantity FROM `stock` LEFT JOIN supplier ON stock.stock_supplier_id = supplier.sup_id GROUP BY stock.stock_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo ("
            <li class='list-group-item'>
    <div class='row'>
        <div class='col-xl-1 col-lg-1'>
            ".$row["stock_id"]."
        </div>
        <div class='col-xl-2 col-lg-2'>
            ".$row["stock_item_name"]."
        </div>
        <div class='col-xl-2 col-lg-2'>
            ".$row["stock_brand_name"]."
        </div>
        <div class='col-xl-2 col-lg-2'>
            ".$row["sup_name"]."
        </div>
        <div class='col-xl-1 col-lg-1'>
            ".$row["stock_man_year"]."
        </div>
        <div class='col-xl-2 col-lg-2'>
            ".$row["stock_wsp"].".00
        </div>
        <div class='col-xl-1 col-lg-1'>
            ".$row["stock_quantity"]."
        </div>
        <div class='col-xl-1 col-lg-1'>
            <button type='button' class='btn btn-circle btn-primary btn-sm' data-toggle='modal' data-target='#edit_stock'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-circle btn-danger btn-sm' data-toggle='modal' data-target='#delete_confirm'><i class='fas fa-trash'></i></button>

            <!-- The Modal -->
            <div class='modal' id='edit_stock'>
    <div class='modal-dialog modal-dialog-scrollable modal-dialog-centered'>
      <div class='modal-content'>                                      
            <!-- Modal body -->
            <div class='modal-body'>
                           <!-- Nested Row within Card Body -->
                            <div class='row'>
                                
                                <div class='col-lg-12'>
                                    <div class='p-5'>
                                        <div class='text-center'>
                                            <h1 class='h4 text-gray-900 mb-4'>Modify Stock Details</h1>
                                        </div>
                                        <form class='user'>
                                            <div class='form-group'>
                                                <input type='text' class='form-control form-control-user' id='iname' placeholder='Item Name' name='itemName'>
                                            </div>
                                            <div class='form-group'>
                                                <input type='text' class='form-control form-control-user' id='bname' placeholder='Brand Name' name='brandName'>
                                            </div>
                                            <div class='form-group row'>
                                                            <div class='col-sm-6 mb-3 mb-sm-0'>
                                                            <select class='form-control form-control-user-dropdown' name='supId' id='supId'>
                                                            ");
                                                            
                                                        echo("
                                                            </select>    
                                                            </div>
                                                            <div class='col-sm-6'>
                                                                <select class='form-control form-control-user-dropdown' name='manYear' id='manYear'>
                                                                    <option value=''>Man. Year (Select One)</option>
                                                                    <option value='2015'>2015</option>
                                                                    <option value='2016'>2016</option>
                                                                    <option value='2017'>2017</option>
                                                                    <option value='2018'>2018</option>
                                                                    <option value='2019'>2019</option>
                                                                    <option value='2020'>2020</option>
                                                                    <option value='2021'>2021</option>
                                                                    <option value='2022'>2022</option>
                                                                    <option value='2023'>2023</option>
                                                                    <option value='2024'>2024</option>
                                                                    <option value='2025'>2025</option>
                                                                    <option value='2026'>2026</option>
                                                                    <option value='2027'>2027</option>
                                                                    <option value='2028'>2028</option>
                                                                    <option value='2029'>2029</option>
                                                                    <option value='2030'>2030</option>
                                                                  </select>
                                                            </div>
                                                        </div>
                                            <div class='form-group row'>
                                                <div class='col-sm-6 mb-3 mb-sm-0'>
                                                    <input type='text' class='form-control form-control-user' id='bname' placeholder='Whole Sale Price' name='brandName'>  
                                                </div>
                                                <div class='col-sm-6'>
                                                    <input type='text' class='form-control form-control-user' id='quantity' placeholder='Quantity' name='quantity'>
                                                </div>
                                            </div>
                                            <div class='form-group row'>
                                                <div class='col-sm-6 mb-3 mb-sm-0'>
                                                    <button type='button' class='btn btn-primary btn-user btn-block mb-3' onclick='loadDoc()'>
                                                        <i class='fas fa-file-import fa-fw'></i> Submit New Stock <span id='save-btn-spinner' class='spinner-border-sm'></span>
                                                    </button>
                                                </div>
                                                <div class='col-sm-6'>
                                                    <button type='reset' class='btn btn-danger btn-user btn-block mb-3' data-dismiss='modal'>
                                                        <i class='fas fa-backspace fa-fw'></i> Close
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
                                    <button type='reset' class='btn btn-danger btn-user btn-block mb-3'>
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
    </div>
</li>
            ");
        }
    } else {
        echo "0 results";
    } 
?>