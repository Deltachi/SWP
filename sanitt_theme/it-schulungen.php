<?php
/*
Template Name: IT-Schulungen
*/
?>
<?php get_header(); ?>
	<div ng-controller="courseCtrl">

		<section class="content">
			<article class="welcome" ng-controller="animationCtrl">
				<div class="container">
					<div class="col-md-12">
						<h2 class="animate"><strong>Effizienter Arbeiten</strong></h2>
						<h2 class="animate padding-after">durch IT-Schulungen der [SAN]ITT[ Information Technology Trainings </h2>
					</div>
					<div class="col-md-5 col-sm-5">
						<p>Wir bieten Ihnen IT-Kurse für Unternehmen und Privatleute an. Die Seminare werden individuell auf Ihre Bedürfnisse abgestimmt und lassen jederzeit Luft für Fragen und Diskussionen. Die Voraussetzung für eine optimale IT-Schulung ist eine kompetente und umfassende Beratung - vor, während und nach dem Seminar. Nur so kann garantiert werden, dass die Inhalte unserer IT-Kurse genau Ihren Vorstellungen entsprechen.</p>
					</div>
					<div class="col-md-7 col-sm-7">
						<p>Lernen Sie den routinierten Umgang mit dem Computer zur effektiven Bearbeitung privater und beruflicher Aufgaben. Wir bieten Ihnen eine breite Palette an individuellen Schulungsthemen - hierbei spielen für uns inhaltliche Flexibilität und Methodik eine große Rolle. Mit unseren IT-Schulungen, die als Individualschulungen oder als Schulungskurse für Gruppen organisiert werden, bieten wir Ihnen auf jede Branche angepasste Schulungsmaßnahmen.</p>
					</div>
				</div>
			</article>
			<article>
				<div class="container">
					<div class="col-md-6 col-sm-6">
						<h3>IT-Schulungen für Privatkunden</h3>
						<hr>
						<p>Unsere IT-Schulungen richten sich sowohl an Privatkunden als auch an Unternehmen. Für Privatpersonen bieten wir z.B. Computerschulungen für Anfänger und Fortgeschrittene an. Wir schneiden Ihren Kurs speziell auf Ihre Wünsche und Bedürfnisse zu.</p>
					</div>
					<div class="col-md-6 col-sm-6">
						<h3>IT-Schulungen für Unternehmen</h3>
						<hr>
						<p>Im Rahmen unserer Firmenschulungen bieten wir Ihnen eine qualifizierte Weiterbildung für Mitarbeiter und Selbstständige in jedem Bereich bzw. in jeder Branche. Firmenschulungen und individuelle IT-Trainings planen wir nach Ihren inhaltlichen und terminlichen Anforderungen. Ihre Firmenschulung kann bei uns oder als Inhouse-Schulung stattfinden.</p>
					</div>
				</div>
				<div class="container">
					<div class="col-md-12">
						<h3>Nachstehend finden Sie eine Auswahl möglicher Themengebiete:</h3>
						<hr>
					</div>
					<!-- Template for courses created for angular repeat function -->
					<div ng-repeat="course in courses" id="{{course.id}}" class="col-md-12">
						<button class="collapse-btn" ng-class="{collapsed:!$first}" ng-click="toggleCollapse(course.id);"><strong>{{course.name}}</strong> Schulungen <img class="glyphicon" src="images/icons/chevron_down.svg" alt=""></button>
						<p class="text-muted" style="padding-top: 10px;"><small>{{course.description}}</small></p>
						<div class="collapseable" ng-class="{collapsed:!$first}">
							<ng-form name="form_{{course.id}}" action="submit">
								<div class="list col-md-4 col-sm-4">
									<h3>Wählen Sie einen Kurs:</h3>
									<ul style="list-style: none;">
										<li ng-repeat="item in course.list">
											<label for="{{course.id}}-{{$index}}">
												<input id="{{course.id}}-{{$index}}" type="radio" ng-model="$parent.course.active" name="{{course.id}}-selected" ng-value="$index">
												{{item.name}}<br>
											</label>	
										</li>
									</ul>
								</div>
								<div class="details col-md-8 col-sm-8">
									<div class="col-md-12">
										<h2>{{course.list[course.active].name}}</h2>
									</div>
									<div class="details col-md-5 col-sm-5">
										<div class="card" ng-style="{'background-color': course.list[course.active].color }" >
											<h1 style="color:white; position: absolute; margin: 0; padding: 0; font-size: 330%; font-weight: 700; top:50%; left:50%; transform: translate(-50%,-50%);">
												<strong>{{course.list[course.active].shortcut}}</strong>
											</h1>
										</div>
									</div>
									<div class="details col-md-7 col-sm-7">
										<p>Sie haben <strong>{{course.list[course.active].name}}</strong> als Kurs ausgewählt.</p>
										<p class="text-muted">
											<small>{{course.list[course.active].details}}</small>
										</p>
									</div>
								</div>
								<input type="submit" class="submit" value="ANMELDEN" ng-click="openForm(course.name, course.active);">
							</ng-form>
						</div>
						<hr>
					</div>
				</div>
				<div id="caution1" class="container">
					<div class="caution animate col-md-12" style="margin-top: 25px; border: 1px solid rgb(200,200,200); background-color: rgb(230,230,230); border-radius: 8px; padding: 15px; text-align: center;">
						<div><strong>Haben Sie nichts passendes gefunden?</strong> Gerne unterbreiten wir Ihnen ein Angebot zu Ihrem firmenindividuellen Seminar oder Einzelschulung. <br> Schicken Sie uns doch eine <button ng-click="openRequest();">Angebotsanfrage</button> .</div> 
						
					</div>
				</div>
			</article>
		</section>
		

		<!-- OVERLAY Formulare die eingeblendet werden, sobald der User auf einen der Anmeldebuttons klickt -->
		<formular-course-default></formular-course-default>
		<formular-course-request></formular-course-request>
	</div>

<?php get_footer(); ?>