<!DOCTYPE html>
	<head>
		<title><?= ucwords($data['title']) ?></title>
        <link href="<?= base_url('assets/images/favicon.ico') ?>" type="image/x-icon" rel="shortcut icon">
		<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/fontawesome/font-awesome.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <!-- lookup -->
      <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/css/lookup/bootstrap-select.css">
        
        
	</head>
	<body>
    
    <?php //echo $this->session->userdata('reveral_id'); ?>
		
		<!--<header>
        
			<div class="logo-header">
				<div class="logos">
                	<img src="<?= base_url() ?>assets/img/logo.png">
                </div>
				<span class="slogan">"You Only Live Once, but if you do it right, once is enough."</span><br>
                <span class="slogan-by">By Mae West</span>
			</div>
		
		</header>-->
        
        
        <div id="slider1_container" style="position: relative; margin: 0 auto;
        top: 0px; left: 0px; width: 1300px; height: 350px; overflow: hidden;">
       
        <!-- Slides Container -->
        <div data-u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1300px;
            height: 350px; overflow: hidden;">
            
            <?php
            $q_slider = mysql_query("select * from sliders order by slider_id desc");
			while($r_slider = mysql_fetch_array($q_slider)){
			?>
            <div>
               <img data-u="image" src="<?= base_url() ?>assets/images/slider/<?= $r_slider['slider_img'] ?>" alt="" style="vertical-align:top !important;"/>
                <div class="logo_slider">
                	<img src="<?= base_url() ?>assets/img/logo.png">
                </div>
                <div class="desc_slider">
                        <div><strong><span class="title"><?= $r_slider['slider_name'] ?></span></strong><br>
                        <?= $r_slider['slider_desc'] ?>
                        </div>
                </div>
            </div>
            
        	<?php
			}
			?>
            
            
           
            
        </div>
                
        <!--#region Bullet Navigator Skin Begin -->
        <!-- bullet navigator container 
        <div data-u="navigator" class="jssorb21">
            <!-- bullet navigator item prototype 
            <div data-u="prototype"></div>
        </div>-->
        <!--#endregion Bullet Navigator Skin End -->

        <!--#region Arrow Navigator Skin Begin -->
        <!-- Arrow Left -->
        <span data-u="arrowleft" class="jssora21l">
        </span>
        <!-- Arrow Right -->
        <span data-u="arrowright" class="jssora21r">
        </span>
		</div>
		
<!-- navigation -->
			 <nav class="navbar navbar-custom">
				<div class="container">
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						<a class="navbar-brand navbar-brand-logo" href="http://www.creative-tim.com">
									  </a>
						</div>
						<div id="navbar" class="collapse navbar-collapse">				
						  <ul class="nav navbar-nav">
							  <li><a href="<?=site_url('home')?>"><span>Home</span></a></li>
							  <li><a href="<?=site_url('marketing')?>"><span>Marketing & business plan</span></a></li>
							  <li><a href="<?=site_url('register')?>"><span>Join us / Register</span></a></li>
							  <li><a href="<?=site_url('testimonial')?>"><span>Testimonials</span></a></li>
							  <li><a href="<?=site_url('about_us')?>"><span>About us</span></a></li>
							  <li><a href="<?=site_url('contact_us')?>"><span>Contact us</span></a></li>
                              <!--<li><a href="#<? //=site_url('news')?>"><span>News</span></a></li>-->
						  </ul>
						</div><!--/.nav-collapse -->
				   </div>
			  </nav>


   