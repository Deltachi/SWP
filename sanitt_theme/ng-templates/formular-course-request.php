		<!-- Anmeldeformular -->
		<div id="request-course-window" class="overlay-window">
			<div id="request-course-container" class="overlay-container">
				<div class="inner">
					<ng-form id="request-course-form" name="requestForm" class="overlay-form">
						<input name="register-reset" type="reset" ng-click="resetForm('#request-course-window');" value="Zurück">
						<h3>Angebotsanfrage für eine Schulung</h3>
						<table>
							<tbody>
								<tr class="">
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr class="padding-top heading nowrap border-bottom">
									<td>Beschreiben Sie Ihre Wunschschulung:</td>
									<td> </td>
									<td> </td>
								</tr>
								<tr class="padding-top">
									<td class="vertical-align-top"><label>Schulungsthema:</label></td>
									<td>
										<textarea rows="5" name="request_course_data_topic" placeholder="Bitte benennen Sie hier möglichst genau das gewünschte Schulungsthema, gerne mit Ihrer individuellen Agenda." ng-model="request_data.course_data.topic" required></textarea>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_course_data_topic.$valid}"></div></td>
								</tr>
								<tr>
									<td class="vertical-align-top"><label>Seminarinhalte:</label></td>
									<td>																				
										<textarea ng-if="request_data.course_type == 'business'" rows="8" name="request_course_data_contents" placeholder="Bitte geben Sie möglichst genau an, welche Vorkenntnisse die Teilnehmer in dem angefragten Gebiet haben, damit wir das Angebot genau auf die Teilnehmer zuschneiden können." ng-model="request_data.course_data.contents" required></textarea>
										<textarea ng-if="request_data.course_type != 'business'" rows="8" name="request_course_data_contents" placeholder="Bitte geben Sie möglichst genau an, welche Vorkenntnisse Sie in dem angefragten Gebiet haben, damit wir das Angebot genau auf Sie zuschneiden können." ng-model="request_data.course_data.contents" required></textarea>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_course_data_contents.$valid}"></div></td>
								</tr>
								<tr class="padding-bottom">
									<td><label>Wunschtermin: </label></td>
									<td>
										<div class="my-input-group">
											<input name="request_course_data_date1" type="text" id="request_datepicker1" ng-model="request_data.course_data.date1" class="multi w40" required>
											<div class="addon multi w20">bis</div>
											<input name="request_course_data_date2" type="text" id="request_datepicker2" ng-model="request_data.course_data.date2" class="multi w40" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_course_data_date1.$valid && requestForm.request_course_data_date2.$valid}"></div></td>
								</tr>
								<tr class="padding-bottom">
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="request_course_type" ng-model="request_data.course_type" value="business" ng-init="request_data.course_type = 'business'">
												<span class="radio-value" aria-hidden="true"></span>
											Geschäftskunde &nbsp;
											</span>
										</label>
									</td>
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="request_course_type" ng-model="request_data.course_type" value="private">
												<span class="radio-value" aria-hidden="true"></span>
											Privatkunde &nbsp;
											</span>
										</label>
									</td>
									<td></td>
								</tr>
								<tr class="padding-top heading border-bottom">
									<td>Seminarort:</td>
									<td></td>
									<td></td>
								</tr>
								
								<tr class="padding-top" ng-if="request_data.course_type == 'business'">
									<td><label>Unternehmen: </label></td>
									<td><input type="text" name="request_customer_business" ng-model="request_data.customer.business" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_business.$valid}"></div></td>
								</tr>
								<tr class="">
									<td><label>Straße / Nr.: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="request_customer_street_name" ng-model="request_data.customer.street.name" class="multi w70" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="request_customer_street_number" ng-model="request_data.customer.street.number" class="multi w25" ng-pattern="/^[\da-zA-Z]*$/" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_street_name.$valid && requestForm.request_customer_street_number.$valid}"></div></td>
								</tr>
								<tr class="">
									<td><label>PLZ / Ort: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="request_customer_city_plz" ng-model="request_data.customer.city.plz" class="multi w25" ng-pattern="/^[\d-]*$/" ng-minlength="5" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="request_customer_city_name" ng-model="request_data.customer.city.name" class="multi w70" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_city_plz.$valid && requestForm.request_customer_city_name.$valid}"></div></td>
								</tr>
								
								<tr class="padding-top heading nowrap border-bottom">
									<td>Ansprechpartner vor Ort:</td>
									<td></td>
									<td></td>
								</tr>
								<tr class="">
									<td><label>Anrede: </label></td>
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="request_customer_gender" ng-model="request_data.customer.gender" value="female" ng-init="request_data.customer.gender = 'female'">
												<span class="radio-value" aria-hidden="true"></span>
											Frau &nbsp;
											</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="request_customer_gender" ng-model="request_data.customer.gender" value="male">
												<span class="radio-value" aria-hidden="true"></span>
											Herr 
											</span>
										</label>
									</td>
									<td></td>
								</tr>
								<tr class="">
									<td><label>Titel: </label></td>
									<td><input type="text" name="request_customer_title" ng-model="request_data.customer.title"></td>
									<td></td>
								</tr>
								<tr class="">
									<td><label>Vorname: </label></td>
									<td><input type="text" name="request_customer_firstname" ng-model="request_data.customer.firstname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_firstname.$valid}"></div></td>
								</tr>
								<tr class="">
									<td><label>Nachname: </label></td>
									<td><input type="text" name="request_customer_lastname" ng-model="request_data.customer.lastname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_lastname.$valid}"></div></td>
								</tr>
								<tr>
									<td><label>Telefon: </label></td>
									<td>
										<input type="text" name="request_customer_phone" ng-model="request_data.customer.phone" ng-pattern="/^[\d- ]*$/" ng-minlength="4" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_phone.$valid}"></div></td>
								</tr>
								<tr class="border-bottom padding-bottom">
									<td><label>Email: </label></td>
									<td>
										<input type="email" name="request_customer_email" ng-model="request_data.customer.email" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_customer_email.$valid}"></div></td>
								</tr>
								<tr class="padding-bottom">
									<td><label>Anzahl der Teilnehmer: </label></td>
									<td>
										<input type="number" name="request_course_members" ng-model="request_data.course_members" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : requestForm.request_course_members.$valid}"></div></td>
								</tr>
								<tr class="border-bottom padding-bottom">
									<td><label>Inklusive Schulungsunterlagen: </label></td>
									<td>
										<label>
											<span class="checkbox">
												<input type="checkbox" name="request_course_material" ng-model="request_data.course_data.material">
												<span class="checkbox-value" aria-hidden="true"></span>
												<small class="text-muted"><span ng-if="request_data.course_data.material">Ja </span><span ng-if="!request_data.course_data.material">Nein </span></small>
											</span>
										</label>
									</td>
									<td></td>
								</tr>
								<tr class="padding-bottom">
									<td class="vertical-align-top">Bemerkungen: </td>
									<td>
										<textarea rows="3" name="request_customer_message" placeholder="Ihre Nachricht..." ng-model="request_data.customer.message"></textarea>
									</td>
									<td></td>
								</tr>


							</tbody>
						</table>
						<input name="register-submit" type="submit" ng-click="submitFormRequest(requestForm.$valid);" value="Seminar anfragen" ng-disabled="!requestForm.$valid">
						<input name="register-reset" type="reset" ng-click="resetForm('#request-course-window');" value="Zurück">
					</ng-form>
				</div>
			</div>
			<div id="confirmation-container-request" class="overlay-container confirmation-container">
				<div class="inner">
					<h2 style="padding-bottom: 20px;">
						Vielen Dank für Ihre Anfrage zum Seminar: <br>
						<strong>{{request_data.course_data.topic}}</strong>
					</h2>
					<p>Wir werden uns umgehend mit Ihnen in Verbindung setzen.
					Bei Rückfragen stehen wir Ihnen unter folgenden Kontaktdaten jederzeit gerne zur Verfügung:</p>
					<p>
						Tel: 05251 54 32 86 (?)<br>
						Mail: pruefungszentrum@sanitt.de (?)
					</p>
					
					
					<h3>Mit freundlichen Grüßen <br>
					Ihr [SAN]ITT[ - Team</h3>
					<button class="close-confirmation" ng-click="resetForm('#request-course-window',true);">Fenster schließen</button>
				</div>
			</div> <!-- #confirmation-container -->
		</div> <!-- #request-course-window -->
		