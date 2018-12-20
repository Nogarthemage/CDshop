<?php if($isAdmin){ ?>
<div class="bar">
	 <div class="callout primary">
	<div class="row">
		  <div class="medium-12 columns">
					This is an admin bar
		  </div>
	</div>
	 </div>
</div>
<?php } ?>


<?php if($isUserLoggedIn){ ?>
	<div class="bar">
		<div class="row">
			  <div class="medium-6 columns">
				  <ul class="menu">
					 <li><a href="/">CDSHOP</a></li>
				   </ul>
			  </div>
			  <div class="medium-6 columns text-right">
				  <ul class="menu">
					 <li><a href="shoppingcart.php"><i class="fas fa-shopping-cart"></i> Shoppingcart</a></li>
					 <li><a href="profile.php">Profile</a></li>
					 <li><a href="logout.php">Logout</a></li>
				   </ul>
			  </div>
		</div>
	</div>

	<div class="row">
		   <div class="large-12 columns">
				  <div class="callout primary">
						 Welcome to the webshop <?php echo $firstname ?>!!
				  </div>
		   </div>
	</div>

<?php }else{ ?>
  <div class="bar">
	  <div class="row">
			<div class="medium-6 columns">
				<ul class="menu">
				   <li><a href="/">CDSHOP</a></li>
				 </ul>
			</div>
			<div class="medium-6 columns text-right">
				<ul class="menu">
				   <li><a href="login.php">Login</a></li>
				   <li><a href="register.php">Register</a></li>
				 </ul>
			</div>
	  </div>
  </div>
<?php } ?>
