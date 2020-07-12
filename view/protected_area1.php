<?php require_once "action.php"; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Material Bootstrap Wizard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<meta name="HandheldFriendly" content="true">

	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.png" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />


	<!-- CSS Files -->
	<link href="<?=$base_url;?>/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=$base_url;?>/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="<?=$base_url;?>/assets/css/custom.css" rel="stylesheet" />
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('<?=$base_url;?>/assets/img/wizard-book.jpg')">
	    <!--   Creative Tim Branding   -->
	    <a href="http://creative-tim.com">
	         <div class="logo-container">
	            <div class="logo">
	                <img src="<?=$base_url;?>/assets/img/new_logo.png">
	            </div>
	            <div class="brand">
	                Creative Tim
	            </div>
	        </div>
	    </a>

		<!--  Made With Material Kit  -->
		<a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard" class="made-with-mk">
			<div class="brand">MK</div>
			<div class="made-with">Made with <strong>Material Kit</strong></div>
		</a>

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="blue" id="wizard">
		                    <form action="" method="">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->
                                <div class="row">
                                    <div class="wizard-header col-md-9">
                                        <h3 class="wizard-title">
                                            Welcome to Your Evaluation
                                        </h3>
                                        <h5>This information will let us know more about you.</h5>
                                    </div>
                                    <div class="col-md-3  text-center">
                                        <div id="fluid-meter"></div>
                                    </div>
                                </div>
								<div class="wizard-navigation">
									<ul>
                                        <?php
                                            $categories_list = get_catagories_name();

                                            foreach ($categories_list as $id => $value) {
                                        ?>
                                                <li><a href="#<?=$id;?>" data-toggle="tab"><?=$value;?></a></li>
                                        <?php } ?>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
											<div class='vertical-align row'>
                                                <h5 class="text-center">Your Mastery Level :</h5>
												<div class="btns-pb">
                                                    <?php
                                                    $item_mastery_count = 1;
                                                    foreach ($item_mastery_level as $item) {
                                                        ?>
                                                        <label>
                                                            <input checked='' name='button-group' type='radio' value='item'>
                                                                <span class='btn-pb <?=($item_mastery_count == 1) ? "first" : "";?><?=($item_mastery_count == count($item_mastery_level)) ? "last" : "";?>'><?=$item;?></span>
                                                            </input>
                                                        </label>
                                                    <?php $item_mastery_count++; } ?>
                                                </div>
                                                <div class="row" style="margin-top: 20px"></div>
                                                <h5 class="text-center">Your Interest Level :</h5>
                                                <div class="btns-pb">
                                                    <?php
                                                    $item_interest_count = 1;
                                                    foreach ($item_interest_level as $item) {
                                                        ?>
                                                        <label>
                                                            <input checked='' name='button' type='radio' value='<?=$item;?>>'>
                                                            <span class='btn-pb <?=($item_interest_count == 1) ? "first" : "";?><?=($item_interest_count == count($item_interest_level)) ? "last" : "";?>'><?=$item;?></span>
                                                            </input>
                                                        </label>
                                                    <?php $item_interest_count++; } ?>
												</div>
											</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="captain">
		                            </div>
		                            <div class="tab-pane" id="description">
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' id="next-btn" class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
	                                    <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
										<div class="footer-checkbox">
											<div class="col-sm-12">
											  <!--<div class="checkbox">
												  <label>
													  <input type="checkbox" name="optionsCheckboxes">
												  </label>
												  Subscribe to our newsletter
											  </div>-->
										  </div>
										</div>
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->
		</div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/material-bootstrap-wizard">here.</a>
	        </div>
	    </div>
	</div>

</body>
	<!--   Core JS Files   -->
	<script src="<?=$base_url;?>/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="<?=$base_url;?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=$base_url;?>/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="<?=$base_url;?>/assets/js/material-bootstrap-wizard.js"></script>
	<script src="<?=$base_url;?>/assets/js/js-fluid-meter.js"></script>

	<!-- Custom JS -->
	<script src="<?=$base_url;?>/assets/js/custom.js"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="<?=$base_url;?>/assets/js/jquery.validate.min.js"></script>
</html>
