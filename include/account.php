  <?php
    if (isset($_GET['control'])) {
        $control = $_GET['control'];
    }

    if (isset($_SESSION['userName'])) {
        $name = $_SESSION['userName'];
        $id = $_SESSION['userID'];
        $sql_getUser = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");
        $fetch_getUser = mysqli_fetch_array($sql_getUser);
    ?>
      <div class="index-cart">
          <a class="a-indexCart" href="index.php">
              <i style="padding:5px;" class="fa fa-home"></i>Home
              <span class="slider"></span>
          </a>

          <span>/</span>
          <span>Your Account</span>
      </div>
      <div style="padding-bottom:60px;" class="container">
          <h2 style="padding:10px;">Your Account</h2>
          <hr>
          <div class="row mb-3" style="align-items: unset;">
              <div class="col-md-8 themed-grid-col">
                  <h3 style="margin-bottom: 10px;">Orders</h3>
                  <?php
                    $accountID = $_SESSION['userID'];
                    $i = 1;
                    $sql_selectTransaction = mysqli_query($conn, "SELECT * FROM transaction WHERE user_id = '$accountID' GROUP BY transaction_code ORDER BY date ASC");
                    $sql_countTransaction = mysqli_num_rows($sql_selectTransaction);
                    if ($sql_countTransaction > 0) {
                    ?>
                      <div>
                          <table style="border:1px solid grey; width: 100%;" class="table table-bordered">
                              <thead class="thead-dark">
                                  <tr>
                                      <th style="background-color: unset; color:black;">Ordinal</th>
                                      <th style="background-color: unset; color:black;">Order Code</th>
                                      <th style="background-color: unset; color:black; width:20%;">Total Price(With tax and shipping)</th>
                                      <th style="background-color: unset; color:black; width:15%;">Date</th>
                                      <th style="background-color: unset; color:black;">EDD</th>
                                      <th style="background-color: unset; color:black;">Status</th>

                                      <th style="background-color: unset; color:black; text-align:left; width:10%;"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                    while ($row_selectTransaction = mysqli_fetch_array($sql_selectTransaction)) {
                                    ?>
                                      <tr>
                                          <th style="background-color: unset; color:black;"><?php echo $i ?></th>
                                          <td><?php echo $row_selectTransaction['transaction_code'] ?></td>
                                          <td><?php echo '$' . number_format($row_selectTransaction['total_price'], 2) ?></td>
                                          <td><?php echo $row_selectTransaction['date'] ?></td>
                                          <?php
                                            $status = "";
                                            if ($row_selectTransaction['status'] == '0') {
                                                $status = 'Unprocessed';
                                            } else {
                                                $status = 'Processed';
                                            }
                                            ?>
                                          <td><?php echo date('Y-m-d', strtotime($row_selectTransaction['date'] . ' + 5 days')) ?></td>
                                          <td><?php echo $status ?></td>
                                          <td style="text-align: left;">
                                              <a class="hova" style="color:#007bff; font-size:16px;" href="?control=login&code=<?php echo $row_selectTransaction['transaction_code'] ?>">View Details</a>
                                          </td>
                                      </tr>
                                  <?php
                                        $i++;
                                    }
                                    ?>
                              </tbody>
                          </table>

                          <?php
                            if (isset($_GET['code'])) {
                                $code = $_GET['code'];
                            ?>
                              <div style="margin-top: 30px;">
                                  <h3 style="margin-bottom: 10px;">Order Detail</h3>
                                  <table style="border:1px solid grey; width: 100%;" class="table table-bordered">
                                      <thead class="thead-dark">
                                          <tr>
                                              <th style="background-color: unset; color:black;">Ordinal</th>
                                              <th style="background-color: unset; color:black;">Order Code</th>
                                              <th style="background-color: unset; color:black;">Product name</th>
                                              <th style="background-color: unset; color:black;">Quantity</th>
                                              <th style="background-color: unset; color:black;">Subtotal</th>
                                              <th style="background-color: unset; color:black;text-align:left;">Date</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                            $i = 1;
                                            $sql_detailTransaction = mysqli_query($conn, "SELECT * FROM transaction, product WHERE transaction.product_id = product.product_id AND transaction_code = '$code'");
                                            while ($row_detailTransaction = mysqli_fetch_array($sql_detailTransaction)) {
                                            ?>
                                              <tr>
                                                  <th style="background-color: unset; color:black;"><?php echo $i ?></th>
                                                  <td><?php echo $row_detailTransaction['transaction_code'] ?></td>
                                                  <td><?php echo $row_detailTransaction['product_name'] ?></td>
                                                  <td><?php echo $row_detailTransaction['quantity'] ?></td>
                                                  <td><?php echo '$' . number_format($row_detailTransaction['product_price'] * $row_detailTransaction['quantity'], 2) ?></td>
                                                  <td style="text-align:left;"><?php echo $row_detailTransaction['date'] ?></td>
                                              </tr>
                                          <?php
                                                $i++;
                                            }
                                            ?>
                                      </tbody>
                                  </table>
                              </div>
                          <?php
                            }
                            ?>
                      </div>
                  <?php
                    } else {
                    ?>
                      You don't have any orders yet
                  <?php
                    }
                    ?>
              </div>

              <div class="col-md-4 themed-grid-col">
                  <h3 style="margin-bottom: 10px;">Account information</h3>
                  <p style="color:black;"> <?php echo $name ?></p>
                  <p class="pdt-10" style="color:black;"><?php echo $fetch_getUser['phone'] ?></p>
                  <p class="pdt-10" style="color:black;"><?php echo $fetch_getUser['address'] ?></p>
              </div>
          </div>
      </div>

      <?php

    } else {
        if ($control == 'login') {
        ?>

          <?php
            if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                $sql_selectUsers = mysqli_query($conn, "SELECT * FROM users 
      WHERE email = '$email' AND password = '$password'");
                $row_login = mysqli_fetch_array($sql_selectUsers);
                $sql_countSelectUsers = mysqli_num_rows($sql_selectUsers);

                if ($sql_countSelectUsers > 0) {
                    if ($row_login['active'] != 0) {
                        $_SESSION['userName'] = $row_login['username'];
                        $_SESSION['userID'] = $row_login['user_id'];
            ?>
                      <script>
                          //   alert("Login successfully");
                          window.location.replace("index.php");
                      </script>
          <?php
                    } else {
                        $alert = '<p class="account-p">Your account has been locked, please contact admin for more information.</p>';
                    }
                } else {
                    $alert = '<p class="account-p">Your email or password was entered incorrectly.</p>';
                }
            }
            ?>
          <!--account page-->
          <div class="account-page">
              <div class="container">
                  <div class="row">
                      <div class="col-2">
                          <img src="images/mauanhb.png" width="30000px">
                      </div>
                      <div class="col-2">
                          <div class="form-container">
                              <div class="form-btn">
                                  <span>Login</span>
                                  <!-- <span onclick="register()">Register</span> -->
                                  <hr id="Indicator">
                              </div>
                              <form id="LoginForm" action="" method="POST">
                                  <?php
                                    if (isset($alert)) {
                                        echo $alert;
                                    }
                                    ?>
                                  <input type="email" name="email" placeholder="Email address" required oninvalid="setCustomValidity('Please enter a valid email')" oninput="setCustomValidity('')">
                                  <input type="password" name="password" placeholder="Password" required oninvalid="setCustomValidity('Please enter your password')" oninput="setCustomValidity('')">
                                  <button type="submit" name="login" class="btn">Login</button>
                                  <a href="">Forgot password</a>
                                  <div style="padding: 8px;">
                                      <p class="p-newCus">New to Graceful? </p>
                                      <a class="p-newCus a-newCus" href="?control=register"> Start here <i class="fa fa-caret-right"></i></a>
                                  </div>

                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php
        } elseif ($control == 'register') {
            if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {
                $sql_resetAI = mysqli_query($conn, "ALTER TABLE users AUTO_INCREMENT = 0");
                $email = $_POST['email'];
                $sql_searchDupEmail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
                $sql_countDupEmail = mysqli_num_rows($sql_searchDupEmail);
                if ($sql_countDupEmail > 0) {
                    $alertDupEmail = '<p class="account-p">It looks like you\'re already a Member.<a href=?control=login class="a-newCus"> Login</a></p>';
                } else {
                    $sql_resetAI = mysqli_query($conn, "ALTER TABLE users AUTO_INCREMENT = 0");
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $password = md5($_POST['password']);
                    $sql_selectUsers = mysqli_query($conn, "INSERT INTO users(username, phone, email, password, active) 
                values('$name', '$phone', '$email', '$password','1')");
            ?>
                  <script>
                      alert("Register Successfully");
                      window.location.replace("?control=login");
                  </script>
          <?php
                }
            }
            ?>
          <div class="account-page">
              <div class="container">
                  <div class="row">
                      <div class="col-2">
                          <img src="images/mauanhb.png" width="30000px">
                      </div>
                      <div class="col-2">
                          <div class="form-container">
                              <div class="form-btn">
                                  <span>Register</span>
                                  <!-- <span onclick="register()">Register</span> -->
                                  <hr id="Indicator">
                              </div>
                              <form  id="RegForm" action="?control=register" method="POST">
                                  <!-- pattern="^\d{10}$|^(\(\d{3}\)\s*)?\d{3}[\s-]?\d{4}$" -->
                                  <input type="text" name="name" placeholder="Name" required oninvalid="setCustomValidity('Please enter your name')" oninput="setCustomValidity('')">
                                  <input type="phone" name="phone" placeholder="Phone Number" oninvalid="setCustomValidity('Please enter a valid phone number')" oninput="setCustomValidity('')">
                                  <input type="email" name="email" placeholder="Email" required oninvalid="setCustomValidity('Please enter a valid email')" oninput="setCustomValidity('')">
                                  <?php
                                    if (isset($alertDupEmail)) {
                                        echo $alertDupEmail;
                                    }
                                    ?>
                                  <input type="password" name="password" id="password" placeholder="Password" required oninvalid="setCustomValidity('Please enter your password')" oninput="setCustomValidity('')">
                                  <input type="password" name="reEnterPass" id="reEnterPass" placeholder="Re-enter password" required oninvalid="setCustomValidity('Please enter your password again')" oninput="setCustomValidity('')">
                                  <div id="textPass"></div>
                                  <div><input type="submit" class="btn" onsubmit="return checkForTheCondition();"></input></div>
                                  
                                  <div style="padding: 8px;">
                                      <p class="p-newCus">Already have an account? </p>
                                      <a class="p-newCus a-newCus" href="?control=login">Login <i class="fa fa-caret-right"></i></a>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <script>
              function checkForTheCondition() {
                  var password = document.getElementById('password');
                  var reEnterPass = document.getElementById('reEnterPass');

                  if (password.value == reEnterPass.value) {
                      return true;
                  } else {
                      return false;
                  }
              }
              addText = document.getElementById('textPass');

              $(function() {
                  $('#RegForm').submit(function() {
                      if (!checkForTheCondition()) {
                          //alert message here
                          addText.innerHTML = '<p class="account-p">Password must match!.</p>';
                          return false; //This will stop the form from being submitted.
                      }
                      return true;
                  });
              });
          </script>
  <?php
        }
    }
    ?>