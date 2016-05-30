	<fixed-navbar active-tab="<?php echo the_field('active_page'); ?>"></fixed-navbar>		
	<section class="footer">
		<!-- <my-footer></my-footer> -->
		<div class="pre-footer">
				<div class="container">
					<div class="col-md-5">
						<p class="text">Besuchen Sie uns in folgenden sozialen Netzwerken:</p>
					</div>
					<div class="col-md-7 banners">
						<a class="banner" href="https://www.facebook.com/Sanitt-162282240792281/" target="_blank" style="background-color: #3B5994;left: 10px">
							<img ng-src="<?php echo get_template_directory_uri(); ?>/images/icons/facebook.svg" alt="facebook-icon">
							<p>Folgen Sie uns auf <br> <strong>Facebook</strong></p>
						</a>
						<a class="banner" href="http://linkedin.com" target="_blank" style="background-color: #0080C3;left: 168px">
							<img ng-src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedIn.svg" alt="linkedIn-icon">
							<p>Folgen Sie uns auf <br> <strong>LinkedIn</strong></p>
						</a>
						<a class="banner" href="https://www.xing.com/companies/%5Bsan%5Ditt%5Binformationtechnologytrainings" target="_blank" style="background-color: #126567;left: 326px">
							<img ng-src="<?php echo get_template_directory_uri(); ?>/images/icons/xing.svg" alt="xing-icon">
							<p>Folgen Sie uns auf <br> <strong>Xing</strong></p>
						</a>
					</div>
					<div class="no-banners">
						<a href="https://www.facebook.com/Sanitt-162282240792281/" style="color: #3B5994; font-weight: 700;">Folgen Sie uns auf Facebook</a>
						<br>
						<a href="http://linkedin.com" style="color: #0080C3; font-weight: 700;">Folgen Sie uns auf LinkedIn</a>
						<br>
						<a href="https://www.xing.com/companies/%5Bsan%5Ditt%5Binformationtechnologytrainings" style="color: #126567; font-weight: 700;">Folgen Sie uns auf Xing</a>
						<br><br>
					</div>
				</div>
			</div>
			<div class="main-footer">
				<div class="container">
					<!-- <div class="footer-column col-md-4 col-sm-12">
						<h3>Leistungen</h3>
						<p>[Placeholder]</p>
					</div> -->
					<div class="footer-column col-md-6 col-sm-6">
						<h3>Schnellkontakt</h3>
						<!-- <form action="">
							<input type="text" name="name" placeholder="Name">
							<div class="spacer"></div>
							<input type="text" name="mail" placeholder="IhreMail@beispiel.de">
							<div class="spacer"></div>
							<textarea rows="3" name="message" placeholder="Ihre Nachricht..."></textarea>
							<div class="spacer"></div>
							<input type="submit" class="submit" value="ABSENDEN">
						</form> -->

						<?php echo do_shortcode( '[contact-form-7 id="193" title="Kontakt Formular 1"]' ); ?>
					</div>
					<div class="footer-column col-md-6 col-sm-6">
						<h3>Kontakt</h3>
						<table>
							<tbody>
								<tr>
									<td>[SAN]ITT[ Information Technology Trainings</td>
								</tr>
								<tr>
									<td>Dessauer Straße 10</td>
								</tr>
								<tr>
									<td>33106 Paderborn</td>
								</tr>
								<tr>
									<td>Tel.: 05251 / 54 32 86</td>
								</tr>
								<tr>
									<td>Fax: 05251 / 54 32 85</td>
								</tr>
								<tr>
									<td>E-Mail: <a href="mailto:info@sanitt.de">info@sanitt.de</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="post-footer">
				<p>Copyright © 2016 sanitt.de. Alle Rechte vorbehalten.</p>
				<a href="/impressum">Impressum</a> &nbsp;
				<!-- <a href="/disclaimer">Haftungsausschluss</a> -->
			</div>
	</section>
	<?php wp_footer(); //Crucial footer hook! ?>
	</body>
</html>