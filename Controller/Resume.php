<?php
	
require_once '../Model/Client.php';
require_once '../Persistance/ClientDaoImp.php';
require_once '../Persistance/BookDaoImp.php';
require_once '../vendor/autoload.php';

class Resume{
	
	
	public function getHeader($level,$mode='index'){
		
		global $cl;
		global $cdi;
		global $bdi;
		global $client;
		
		if(strcmp(trim($level),'User')==0){
		echo "<header id=\"HRnavbar\" class=\"navbar navbar-inverse navbar-fixed-top\"
		style=\"background-color: #373c40;\">
		<div class=\"navbar-header\">
			<a class=\"navbar-brand\" href=\"\" id=\"logo\"><b><span
					class=\"glyphicon glyphicon-book\"></span><span
					class=\"dancing-script\"> ReadingFun</span></b> </a>
			<!-- this section is used when we surf the website with a phone or a device smaller than our pc ! -->
			<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\"
				data-target=\"#menuportable\">
				<span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span
					class=\"icon-bar\"></span> <span class=\"icon-bar\"></span>
			</button>
		</div>
		<div class=\"collapse navbar-collapse\" id=\"menuportable\">";
		
		
		if (isset ( $_SESSION ['client'] )) {
			
			$cl = $_SESSION ['client'];
			$cdi = new ClientDaoImp ( $GLOBALS['entityManager'] );
			$bdi = new BookDaoImp ( $GLOBALS['entityManager'] );
			$client = $cdi->getClientById ( $cl->getId () );
		
			echo "<div class=\"dropdown btn navbar-btn pull-right\">
  			<a id=\"dLabel\" class=\"simple\" data-target=\"#\" href=\"#\" data-toggle=\"dropdown\" style=\"color:white;text-decoration:none;\" aria-haspopup=\"true\" role=\"button\" aria-expanded=\"false\">
    		<span class=\"marck-script\">&nbsp;<span class=\"glyphicon glyphicon-user \"></span><span class=\"marck-script\"> " . $client->getName () . "<span></span>
    		<span class=\"caret\"></span>
  			</a>
		
  			<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">
    		<li><a href=\"homeClient.php\"><span class=\"glyphicon glyphicon-book\"></span> <span class=\"marck-script\">Book Store</span></a></li>
			  <li><a href=\"clientCart.php\"><span class=\" glyphicon glyphicon-shopping-cart\"></span> <span class=\"marck-script\">Shoping cart</span></a></li>
			  <li><a href=\"clientProfile.php\"><span class=\" glyphicon glyphicon-cog\"></span> <span class=\"marck-script\">Account settings</span></a></li>
		      <li role=\"presentation\" class=\"divider\"></li>
		      <li><a id=\"logOut\" onclick=\"disconnect()\"><span class=\"glyphicon glyphicon-share-alt\"></span> <span class=\"marck-script\">Logout</span></a></li>
  			</ul>
			</div>";
		
			echo "<div class=\"navbar-btn pull-right\"><a href=\"clientCart.php\" style=\"color:white;margin-right:5px;\">  <span class=\"badge navbar-btn\"><span class=\"glyphicon glyphicon-shopping-cart\"><span> " . $client->getNumberOrders () . " </span></a></div>";
		} else {
			// this means not registered
			echo "
			<div class=\"loginGround\">
			<button class=\"btn btn-success navbar-btn navbar-right\"
			style=\"margin-right: 2px;\" data-toggle=\"modal\"
			data-target=\"#registerModal\">
			Register <span class=\"glyphicon glyphicon-pencil\"></span>
			</button>
			
			<button class=\"btn btn-primary navbar-btn navbar-right\"
			style=\"margin-right: 2px;\" data-toggle=\"modal\"
			data-target=\"#loginModal\">
			Log in <span class=\"glyphicon glyphicon-user\"></span>
			</button>
			</div>";
		}
			if(strcmp(trim($mode),'index') === 0){
			echo "<ul class=\"nav navbar-nav\">
					<li><a href=\"#feedback\">Feedback</a></li>
					<li><a href=\"#gallery\">Gallery</a></li>
					<li><a href=\"#best\">Best sells</a></li>
				</ul>";
			}else{
				echo "<ul class=\"nav navbar-nav\">
				<li><a href=\"#\"><span class=\"glyphicon glyphicon-education\"></span>
						About us</a></li>
				<li><a href=\"#\"><span class=\"glyphicon glyphicon-comment\"></span>
						Contact us</a></li>
				</ul>";
			}		
			echo "</div>
				  </header>";
		}else if(strcmp(trim($level),'Admin')==0){
			
			echo "<header id=\"HRnavbar\" class=\"navbar navbar-inverse navbar-fixed-top\"
			style=\"background-color: #373c40; margin-bottom: 0.1px;\"
			role=\"banner\">
		<div class=\"navbar-header\">
			<a class=\"navbar-brand\" href=\"index.php\"><b><span
					class=\"glyphicon glyphicon-book\"></span><span
					class=\"dancing-script\"> ReadingFun</span></b></a>
			<!-- this section is used when we surf the website with a phone or a device smaller than our pc ! -->
			<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\"
				data-target=\"#menuportable\">
				<span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span
					class=\"icon-bar\"></span> <span class=\"icon-bar\"></span>
			</button>
		</div>
		<!-- end navbar-header-->

		<div class=\"collapse navbar-collapse\" id=\"menuportable\">
			<!-- something should be done over here ! -->
		";	
		if (isset ( $_SESSION ['client'] )) {
			
			$cl = $_SESSION ['client'];
			$cdi = new ClientDaoImp ( $GLOBALS['entityManager'] );
			$client = $cdi->getClientById ( $cl->getId () );
			$bdi = new BookDaoImp ( $GLOBALS['entityManager'] );
			
			echo "\"<div class=\"dropdown btn navbar-btn pull-right\">
  			<a id=\"dLabel\" class=\"simple\" data-target=\"#\" href=\"#\" data-toggle=\"dropdown\" style=\"color:white;text-decoration:none;\" aria-haspopup=\"true\" role=\"button\" aria-expanded=\"false\">
    		<span class=\"marck-script\">&nbsp;<span class=\"glyphicon glyphicon-user\"></span> " . $client->getName () . "</span>
    		<span class=\"caret\"></span>
  			</a>

  			<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dLabel\">
		      <li><a id=\"logOut\" onclick=\"disconnect()\"><span class=\"glyphicon glyphicon-share-alt\"></span> <span class=\"marck-script\">Logout</span></a></li>
  			</ul>
			</div>";
		}
			echo "</div>
					</header>";
		}
	
	}
	
	public function getFooter(){
		
		echo "<footer class=\"bs-docs-footer\" style=\"background-color: #373c40;\">
	<div class=\"container\">
		<section style=\"color: white;\">
			<div class=\"col-xs-6 col-md-4\">
				<h4>Contact us</h4>
				<p class=\"footer-text\">Get in touch here if you have any queries or
					issues.</p>
			</div>
			<div class=\"col-xs-6 col-md-4\">
				<h4>Help & Support</h4>
				<p class=\"footer-text\">FAQs, order information, T&Cs, errata and
					code downloads.</p>
			</div>
			<div class=\"col-xs-6 col-md-4\" style=\"margin-bottom: 1%;\">
				<h4>Alerts & Offers</h4>
				<form class=\"form-inline\">
					<div class=\"form-group\">
						<input style=\"color: black;\" name=\"\"
							placeholder=\"enter your email adress\" />
						<button class=\"btn btn-primary \">
							<b>Submit</b>
						</button>
					</div>
				</form>
			</div>
		</section>
	</div>
	<div class=\"container\" style=\"color: white;\">
		<div class=\"col-sx-6 col-md-3\">
			<p class=\"footer-text\">© Packt Publishing Limited. All Rights
				Reserved</p>
		</div>
		<div class=\"col-sx-6 col-md-3\">
			<p class=\"footer-text\">View our Cookie Policy</p>
		</div>
		<div class=\"col-sx-6 col-md-3\">
			<p class=\"footer-text\">Our Privacy Policy</p>
		</div>
		<div class=\"col-sx-6 col-md-3\">
			<a href=\"\"><img alt=\"\" src=\"../images/youtube.png\"
				class=\"img-circle img-footer\"></a> <a href=\"\"><img alt=\"\"
				src=\"../images/facebook.png\" class=\"img-circle img-footer\"></a> <a
				href=\"\"><img alt=\"\" src=\"../images/twitter.png\"
				class=\"img-circle img-footer\"></a> <a href=\"\"><img alt=\"\"
				src=\"../images/g+.png\" class=\"img-circle img-footer\"></a>
		</div>
	</div>
</footer>";
		
	}
	
	
	
}












?>