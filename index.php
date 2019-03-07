<?php
session_start();

require_once "dbfunctions/db.php";

?>

<?php include "includes/header.php"?>

		<!--banner-->
		<div class="banner-w3">
			<div class="demo-1">            
				<div id="example1" class="core-slider core-slider__carousel example_1">
					<div class="core-slider_viewport">
						<div class="core-slider_list">
							<div class="core-slider_item">
								<img src="images/b1.jpg" class="img-responsive" alt="">
							</div>
							 <div class="core-slider_item">
								 <img src="images/b2.jpg" class="img-responsive" alt="">
							 </div>
							<div class="core-slider_item">
								  <img src="images/b3.jpg" class="img-responsive" alt="">
							</div>
							<div class="core-slider_item">
								  <img src="images/b4.jpg" class="img-responsive" alt="">
							</div>
						 </div>
					</div>
					<div class="core-slider_nav">
						<div class="core-slider_arrow core-slider_arrow__right"></div>
						<div class="core-slider_arrow core-slider_arrow__left"></div>
					</div>
					<div class="core-slider_control-nav"></div>
				</div>
			</div>
			<link href="css/coreSlider.css" rel="stylesheet" type="text/css">
			<script src="js/coreSlider.js"></script>
			<script>
			$('#example1').coreSlider({
			  pauseOnHover: false,
			  interval: 3000,
			  controlNavEnabled: true
			});

			</script>

		</div>	
		<!--banner-->
			<!--content-->
		<div class="content">
			<!--banner-bottom-->
				<div class="ban-bottom-w3l">
					<div class="container">
						<div class="col-md-6 ban-bottom">
							<div class="ban-top">
								<img src="images/p1.jpg" class="img-responsive" alt=""/>
								<div class="ban-text">
									<h4>Men’s Clothing</h4>
								</div>
								<div class="ban-text2 hvr-sweep-to-top">
									<h4>50% <span>Off/-</span></h4>
								</div>
							</div>
						</div>
						<div class="col-md-6 ban-bottom3">
							<div class="ban-top">
								<img src="images/p2.jpg" class="img-responsive" alt=""/>
								<div class="ban-text1">
									<h4>Women's Clothing</h4>
								</div>
							</div>
							<div class="ban-img">
								<div class=" ban-bottom1">
									<div class="ban-top">
										<img src="images/p3.jpg" class="img-responsive" alt=""/>
										<div class="ban-text1">
											<h4>T - Shirt</h4>
										</div>
									</div>
								</div>
								<div class="ban-bottom2">
									<div class="ban-top">
										<img src="images/p4.jpg" class="img-responsive" alt=""/>
										<div class="ban-text1">
											<h4>Hand Bag</h4>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			<!--banner-bottom-->
			<!--new-arrivals-->
				<div class="new-arrivals-w3agile">
					<div class="container">
						<h2 class="tittle">New Arrivals</h2>
						<div class="arrivals-grids">
                            <!-- begin products loop -->
                            <?php
                            $sql = "SELECT * FROM `items` ORDER BY itemID DESC LIMIT 4";
                            $result = dbconnect()->query($sql);
                            while ($row = $result->fetch_array()) {
                                ?>
                                <!-- main products -->
                                <div class="col-md-3 product-tab-grid simpleCart_shelfItem" style="margin-bottom: 10px;">
                                    <div class="grid-arr">
                                        <div  class="grid-arrival">
                                            <figure>
                                                <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal<?php echo $row['itemID'] ?>">
                                                    <div class="grid-img">
                                                        <img  src="admin/uploads/<?php echo $row['itemImage'] ?>" class="img-responsive" alt="">
                                                    </div>
                                                    <div class="grid-img">
                                                        <img  src="admin/uploads/<?php echo $row['itemImage'] ?>" class="img-responsive"  alt="">
                                                    </div>
                                                </a>
                                            </figure>
                                        </div>
                                        <div class="women">
                                            <h6><a href="#" data-toggle="modal" data-target="#myModal<?php echo $row['itemID'] ?>"><?php echo $row['itemName'] ?></a></h6>
                                            <p><em class="item_price">¢<?php echo $row['itemPrice'] ?></em></p>
                                            <form method="post" action="sys/cart.php">
                                                <div class="row">
                                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                                        <input type="hidden" name="qty" value="1"/>
                                                        <input type="hidden" name="price" value="<?php echo $row['itemPrice'] ?>" class="form-control"/>
                                                        <input type="hidden" name="id" value="<?php echo $row['itemID'] ?>" class="form-control"/>
                                                        <input type="hidden" name="date" value="<?php echo date("Y-m-d") ?>"/>
                                                    </div>
                                                </div>
                                                <button name="addtocart" class="my-cart-b item_add">Add To Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php  }?>


                            <!-- end products loop -->
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			<!--new-arrivals-->


			<div class="latest-w3">
				<div class="container">
					<h3 class="tittle1">Latest Fashion Trends</h3>
					<div class="latest-grids">
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="images/l1.jpg" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Men</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="images/l2.jpg" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Shoes</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="images/l3.jpg" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Women</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="latest-grids">
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="images/l4.jpg" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Watch</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="images/l5.jpg" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Bag</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="images/l6.jpg" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Cameras</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<!--content-->

        <?php include "includes/footer.php"?>