<section id="projects">
	<div class="box">
		<div class="img-container">
		<a href="?inversis/show"><img src="img/inversis.jpg" alt="inversis"></a>
		</div>
		<div class="project-container">
			<h2>Inversis Project</h2>
		</div>
	</div>
	<div class="box">
		<div class="img-container">
				<?php 
				
				if (isset($_SESSION["logued_user"])) {
				   echo '<a href="?guestbook/form"><img src="img/guestbook.png" alt="guestbook"></a>';
				} else {
				    echo '<img src="img/guestbook.png" alt="guestbook">';
				}
				
				?>
		</div>
		<div class="project-container">
				<?php 
				
				if (isset($_SESSION["logued_user"])) {
				   echo '<div><h2>GuestBook Project</h2><i class="fas fa-lock-open"></i></div>';
				} else {
				    echo '<div><h2>GuestBook Project</h2><i class="fas fa-lock"></i></div>';
				}
				
				?>
		</div>
	</div>
</section>