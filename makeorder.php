<?php
session_start();
include "dbfunctions/db.php";


?>
<?php include "includes/header.php"; ?>

    <!--banner-->
    <div class="banner1">
        <div class="container">
            <h3><a href="index.php">Home</a> / <span>Confirm Order</span></h3>
        </div>
    </div>
    <!--banner-->

<!-- content -->

    <?php
    if (!isset($_SESSION['username'])) {
        ?>

        <div class="content">
            <!--contact-->
            <div class="mail-w3ls">
                <div class="container">
                    <h2 class="tittle">Make Order</h2>
                    <div class="mail-grids">
                        <div class="mail-bottom">
                            <h4 class="title">Please Log in before proceeding...<a href="login.php">Login Here</a> </h4>
                        </div>
                    </div>
                </div>
            </div>
            <!--contact-->
        </div>

        <?php
    } else {

    ?>

        <div class="content">
            <!--contact-->
            <div class="mail-w3ls">
                <div class="container">
                    <h2 class="tittle">Make Order</h2>
                    <div class="mail-grids">
                        <div class="mail-bottom">
                            <h4>Please fill out the deatils below correctly!</h4>
                            <p style="color: red">
                                <b>Take Note!</b>  A unique reference code will be generated for your order. In making MTN mobile money payment,
                                use the generated reference code for validation or else your order will not be processed. THANK YOU
                            </p>
                            <br/>
                            <form action="sys/confirm.php" method="post">
                                <?php
                                $code = $_SESSION['code'];
                                $sql = "SELECT SUM(cart.total) AS `total` FROM `cart` WHERE cart.code = '$code'";
                                $run = dbconnect()->query($sql);
                                $result = $run->fetch_array();
                                ?>

                                <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']; ?>" />
                                <input type="hidden" name="total" value="<?php echo $result['total']; ?>" />
                                <input type="hidden"  name="code" value="<?php echo $code; ?>" />

                                <input type="text" placeholder="Full Name" name="fname" required>
                                <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>" required>
                                <input type="text" value="<?php echo $_SESSION['tel'] ?>" name="tel" required> <br/>
                                <input type="text" placeholder="Location" name="location" required style="margin-top: 15px;">

                                <textarea name="notes"></textarea>
                                <input type="submit" name="confirm" value="Submit" >
                                <input type="reset" value="Clear" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--contact-->
        </div>



    <?php } ?>


<!-- /content -->



<?php include "includes/footer.php"; ?>
