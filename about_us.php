<?php
  include('./views/header.php');
?>

<div class="container my-4">
	<div class="row text-center">
		<h1 class="fw-bolder text-decoration-underline mb-3">COME TO BOHOL</h1>
		<div class='mx-auto mb-4' style='width: max-content;'>
			<img width='700px' class='img-fluid border border-3 border-dark rounded' src='https://lh3.googleusercontent.com/rbW7zm8WuNorHaNmTR7WpJzJB4TpimWQFflltplO5q_PQ6eUk4MyFvIFKJjIRpzbKc7D5bOtb796cQYnZiko=w2940-h6366-rw'>
		</div>
		<p class="fs-5">
			Come To Bohol is the ultimate virtual tourist guide.
			<br />
			It is where you can find the best place to buy souvenirs,
			cozy place to stay, and to find the highlights of Bohol.
		</p>
	</div>
</div>

<hr />

<div class="container">
	<div class="d-flex flex-column justify-content-center text-center">
		<h2 class='fw-bolder text-decoration-underline'>About Us </h2>
		<p class='fs-5'>
			“At Come To Bohol, we think that travel opens the mind of people.
			It opens the mind to new views, cultures and ways of thinking.
			This is why we aspire to show the convenient, affordable, and available
			way of travelling in Bohol."
		</p>
	</div>
</div>

<hr class='mb-4' />

<div class="container mt-4">
	<div class="row">
		<div class="col-md-6">
			<h4>
				It was a collaborative effort of imaginative Mapua Makati students who
				shared their favorite local hangouts. Their guides were beautifully designed
				from scratch and packed with excellent tips so that travelers could experience
				any town like a local. If you prefer shops, cocktail bars or dive bars, fresh
				food, galleries or street art, we've got you covered.
			</h4>
		</div>
		<div class="col-md-6">
			<h4>
				Come To Bohol caters to clients from both communities and individuals. At very
				competitive rates, we give full local soil arrangements. Known for its skilled
				and reliable operation.
			</h4>
		</div>
	</div>
</div>

<hr />

<div class="container">
	<div class="row my-4 text-center">
		<h2 class='fw-bolder text-decoration-underline'>Our Team</h2>
	</div>

	<div class="row">
		<?php
			$team_members = [
				'Jeffrey Miraflores',
				'Jeptha Mathan Espanola',
				'John Wendell Maranan',
				'Michael Rafael Dela Cruz',
				'Josh Millard Odicta'
			];
			foreach($team_members as $member) {
		?>
			<div class='col-md-4'>
				<h3> <?php echo htmlspecialchars($member) ?> </h3>
				<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry.
					Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
					when an unknown printer took a galley of type and scrambled it to make a type
					specimen book. It has survived not only five centuries, but also the leap into
					electronic typesetting, remaining essentially unchanged. It was popularised in
					the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
					and more recently with desktop publishing software like Aldus PageMaker including
					versions of Lorem Ipsum.
				</p>
			</div>
		<?php } ?>
	</div>
</div>

<?php
  include('./views/footer.php');
?>
