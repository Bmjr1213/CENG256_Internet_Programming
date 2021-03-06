<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Admin Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
        <link href="admin.css" rel="stylesheet">
        <!-- font awesome icons -->
        <script src="https://kit.fontawesome.com/18de49befa.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>

        <style>
            form .error {
                color: #ffff;
            }

            .rectangle {
                height: 575px;
                width: 450px;
                background-color: dimgray;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);
            }

            .button {
                background-color: deepskyblue;
                border: none;
                color: white;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
            }

            .buttonBlue:hover {
                background-color: white;
                color: deepskyblue;
            }
        </style>
    </head>

    <body>

        <?php
        $restaurant_error = $product_id_error = $product_name_error = $product_desc_error = "";
        $restaurant_id = $product_id = $product_name = $product_desc = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["restaurant_id"])) {
                $restaurant_error = "Restaurant ID is required!";
            } else {
                $restaurant_id = test_input($_POST["restaurant_id"]);
                if (!preg_match("/^\d+$/", $restaurant_id)) {
                    $restaurant_error = " Must contain only numbers!";
                }
            }

            if (empty($_POST["product_id"])) {
                $product_id_error = "Product ID is required!";
            } else {
                $product_id = test_input($_POST["product_id"]);
                if (!preg_match("/^\d+$/", $product_id)) {
                    $product_id_error = " Must contain only numbers!";
                }
            }

            if (empty($_POST["product_name"])) {
                $product_name_error = "Product name is required!";
            } else {
                $product_name = test_input($_POST["product_name"]);
            }

            if (empty($_POST["product_desc"])) {
                $product_desc_error = "Product description is required!";
            } else {
                $product_desc = test_input($_POST["product_desc"]);
            }

            if ($restaurant_error == "" && $product_id_error == "" && $product_name_error == "" && $product_desc_error == "")
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $restaurant_id = $_POST['restaurant_id'];
                $product_desc = $_POST['product_desc'];

                $dbc = mysqli_connect('localhost', 'admin', 'password', 'whoops') or die ("Could not Connect! \n");

                $sql = "INSERT INTO product VALUES ('$product_id','$product_name','$restaurant_id', '$product_desc');";

                echo "Connection established. \n";

                $result = mysqli_query($dbc, $sql) or die("Error Querying Database");

                mysqli_close();
                header('Location: /project/admin_page.php');
                echo "Successful entry!\n";
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <header>
            <nav>
                <div class="responsive_menu_div" onclick="menuButton()">
                    <div id="bar_icon_div">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
                <ul class="nav_ul">
                    <li><a id="logo" href="home_page.html">whoops!</a></li>
                    <li><a href="information_page.html">Information</a></li>
                    <li><a href="about_US.html">About Us</a></li>
                    <li><a href="feedback_page.html">Feedback</a></li>
                    <li id="login_li"><a href="loginPHP.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <center>
                <br><br>
                <h1>Admin Page</h1>
                <p>If you would like to add a product please complete the form below.</p>
                <br>
                <div class="container">
                    <div class="rectangle">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                            <label for="product_id" id="product_id_label"><span class="feedText"> Product ID <span class="redText">*<?php echo $product_id_error; ?></span></span></label>
                            <input type="text" class="text-line" id="product_id" placeholder="Enter Product ID..." name="product_id" size="45" value="<?php echo $product_id;?>">

                            <label for="product_name" id="product_name_label"><span class="feedText">Product Name<span class="redText">*<?php echo $product_name_error; ?></span></span></label>
                            <input type="text" class="text-line" id="product_name" placeholder="Enter Product Name..." name="product_name" size="45" value="<?php echo $product_name;?>">

                            <label for="restaurant_id" id="restaurant_id_label"><span class="feedText">Restaurant ID<span class="redText">*<?php echo $restaurant_error; ?></span></span></label>
                            <input type="text" class="text-line" id="restaurant_id" placeholder="Enter Restaurant ID..." name="restaurant_id" size="45" value="<?php echo $restaurant_id;?>">

                            <label for="product_desc"><span class="feedText">Product Description</span></label><br>
							
                            <textarea style="max-width:400px" rows="5" placeholder="Type your description here..." name="product_desc" id="product_desc"><?php echo $product_desc; ?></textarea><br></br>

                            <button type="submit" class="button buttonBlue" id="submit_btn" value="Send" style="font-family: 'Lato', sans-serif;"><b>Submit</b></button>
                        </form>
                    </div>
                    <br><br><br>
                </div>

            </center>


        </main>
        <footer>
            <!--A copyright in the footer with the student names and id numbers-->
        </footer>
    </body>

</html>