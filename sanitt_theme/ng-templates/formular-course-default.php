		<!-- Anmeldeformular -->
		<div id="register-window" class="overlay-window">
			<div id="register-container" class="overlay-container">
				<div class="inner">
					<ng-form id="register-form" name="registerForm" class="overlay-form">
						<input name="register-reset" type="reset" ng-click="resetForm('#register-window');" value="Zurück">
						<table>
							<tbody>
								<tr class="heading">
									<td><strong>Seminaranfrage</strong></td>
									<td> </td>
									<td> </td>
								</tr>
								<tr class="padding-top heading border-bottom">
									<td>Kurs wählen:</td>
									<td> </td>
									<td> </td>
								</tr>
								<tr class="padding-top">
									<td><label>Programm: {{register_data.course_data.topic}}</label></td>
									<td>
										<select name="course_data_topic" ng-model="register_data.course_data.topic" ng-init="register_data.course_data.topic = activeTopic">
											<option ng-repeat="topic in courses" value="{{topic.name}}" ng-selected="activeTopic == 'topic.name'">{{topic.name}}</option>
										</select>
									</td>
									<td></td>
								</tr>
								<tr>
									<td><label>Thema: {{courses[activeTopic].list[courses[activeTopic].active].name}}</label></td>
									<td>																				
										<select name="course_data_name" ng-model="register_data.course_data.name">
											<option ng-repeat="course in courses[activeTopic].list" value="{{course.name}}" ng-selected="courses[activeTopic].list[courses[activeTopic].active].name == 'course.name'">{{course.name}} (Testwert: {{course.name == courses[activeTopic].list[courses[activeTopic].active].name}})</option>
										</select>
									</td>
									<td></td>
								</tr>
								<tr class="padding-bottom">
									<td><label>Wunschtermin: </label></td>
									<td>
										<div class="my-input-group">
											<input name="course_data_date1" type="text" id="register_datepicker1" ng-model="register_data.course_data.date1" class="multi w40" required>
											<div class="addon multi w20">bis</div>
											<input name="course_data_date2" type="text" id="register_datepicker2" ng-model="register_data.course_data.date2" class="multi w40" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_data_date1.$valid && registerForm.course_data_date2.$valid}"></div></td>
								</tr>
								<tr class="padding-top heading border-bottom">
									<td>Privat- / Geschäftskunde</td>
									<td></td>
									<td></td>
								</tr>
								<tr class="padding-bottom">
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="course_type" ng-model="register_data.course_type" value="business" ng-init="register_data.course_type = 'business'">
												<span class="radio-value" aria-hidden="true"></span>
											Geschäftskunde &nbsp;
											</span>
										</label>
									</td>
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="course_type" ng-model="register_data.course_type" value="private">
												<span class="radio-value" aria-hidden="true"></span>
											Privatkunde &nbsp;
											</span>
										</label>
									</td>
									<td></td>
								</tr>
								<tr class="padding-top" ng-init="register_data.course_members.push({'gender':'female'})">
									<td><button ng-click="register_data.course_members.push({'gender':'female'})"><strong>Teilnehmer hinzufügen</strong></button></td>
									<td>(Aktuell: {{register_data.course_members.length}} Teilnehmer) <br> <a class="pointer" ng-click="register_data.course_members.pop()">Letzten Teilnehmer entfernen</a> </td>
									<td></td>
								</tr>
								<tr class="padding-top heading border-bottom" ng-repeat-start="member in register_data.course_members">
									<td>{{$index + 1}}. Teilnehmer /-in</td>
									<td> </td>
									<td> </td>
								</tr>
								<tr>
									<td><label>Anrede: </label></td>
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="course_members_{{$index}}_gender" ng-model="register_data.course_members[$index].gender" value="female">
												<span class="radio-value" aria-hidden="true"></span>
												Frau &nbsp;
											</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="course_members_{{$index}}_gender" ng-model="register_data.course_members[$index].gender" value="male">
												<span class="radio-value" aria-hidden="true"></span>
												Herr 
											</span>
										</label>	
									</td>
									<td></td>
								</tr>
								<tr>
									<td><label>Titel: </label></td>
									<td><input type="text" name="course_members_{{$index}}_title" ng-model="register_data.course_members[$index].title"></td>
									<td></td>
								</tr>
								<tr>
									<td><label>Vorname: </label></td>
									<td><input type="text" name="course_members_{{$index}}_firstname" ng-model="register_data.course_members[$index].firstname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_members_{{$index}}_firstname.$valid}"></div></td>
								</tr>
								<tr>
									<td><label>Nachname: </label></td>
									<td><input type="text" name="course_members_{{$index}}_lastname" ng-model="register_data.course_members[$index].lastname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_members_{{$index}}_lastname.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'private'">
									<td><label>Straße / Nr.: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="course_members_{{$index}}_street_name" ng-model="register_data.course_members[$index].street.name" class="multi w70" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="course_members_{{$index}}_street_number" ng-model="register_data.course_members[$index].street.number" class="multi w25" ng-pattern="/^[\da-zA-Z]*$/" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_members_{{$index}}_street_name.$valid && registerForm.course_members_{{$index}}_street_number.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'private'">
									<td><label>PLZ / Ort: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="course_members_{{$index}}_city_plz" ng-model="register_data.course_members[$index].city.plz" class="multi w25" ng-pattern="/^[\d-]*$/" ng-minlength="5" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="course_members_{{$index}}_city_name" ng-model="register_data.course_members[$index].city.name" class="multi w70" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_members_{{$index}}_city_plz.$valid && registerForm.course_members_{{$index}}_city_name.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'private'">
									<td><label>Telefon: </label></td>
									<td>
										<input type="text" name="course_members_{{$index}}_phone" ng-model="register_data.course_members[$index].phone" ng-pattern="/^[\d- ]*$/" ng-minlength="4" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_members_{{$index}}_phone.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'private'">
									<td><label>Email: </label></td>
									<td>
										<!-- <div class="my-input-group"> -->
											<!-- <input type="text" name="course_members_{{$index}}_email_prefix" ng-model="register_data.course_members_{{$index}}.email.prefix" class="multi w60" required> -->
											<!-- <div class="addon multi w10">@</div> -->
											<!-- <input type="text" name="course_members_{{$index}}_email_provider" ng-model="register_data.course_members_{{$index}}.email.provider" class="multi w30" required> -->
										<!-- </div> -->
										<input type="email" name="course_members_{{$index}}_email" ng-model="register_data.course_members[$index].email" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.course_members_{{$index}}_email.$valid}"></div></td>
								</tr>
								<tr class="padding-bottom" ng-repeat-end><td></td><td></td><td></td></tr>
								<tr class="padding-top heading border-bottom" ng-if="register_data.course_type == 'business'">
									<td>Besteller /-in</td>
									<td></td>
									<td></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Anrede: </label></td>
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="customer_gender" ng-model="register_data.customer.gender" value="female" ng-init="register_data.customer.gender = 'female'">
												<span class="radio-value" aria-hidden="true"></span>
											Frau &nbsp;
											</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="customer_gender" ng-model="register_data.customer.gender" value="male">
												<span class="radio-value" aria-hidden="true"></span>
											Herr 
											</span>
										</label>
									</td>
									<td></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Titel: </label></td>
									<td><input type="text" name="customer_title" ng-model="register_data.customer.title"></td>
									<td></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Vorname: </label></td>
									<td><input type="text" name="customer_firstname" ng-model="register_data.customer.firstname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_firstname.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Nachname: </label></td>
									<td><input type="text" name="customer_lastname" ng-model="register_data.customer.lastname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_lastname.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Unternehmen: </label></td>
									<td><input type="text" name="customer_business" ng-model="register_data.customer.business" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_business.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Straße / Nr.: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="customer_street_name" ng-model="register_data.customer.street.name" class="multi w70" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="customer_street_number" ng-model="register_data.customer.street.number" class="multi w25" ng-pattern="/^[\da-zA-Z]*$/" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_street_name.$valid && registerForm.customer_street_number.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>PLZ / Ort: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="customer_city_plz" ng-model="register_data.customer.city.plz" class="multi w25" ng-pattern="/^[\d-]*$/" ng-minlength="5" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="customer_city_name" ng-model="register_data.customer.city.name" class="multi w70" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_city_plz.$valid && registerForm.customer_city_name.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'">
									<td><label>Telefon: </label></td>
									<td>
										<input type="text" name="customer_phone" ng-model="register_data.customer.phone" ng-pattern="/^[\d- ]*$/" ng-minlength="4" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_phone.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.course_type == 'business'" class="padding-bottom">
									<td><label>Email: </label></td>
									<td>
										<!-- <div class="my-input-group"> -->
											<!-- <input type="text" name="customer_email_prefix" ng-model="register_data.customer.email.prefix" class="multi w60" required> -->
											<!-- <div class="addon multi w10">@</div> -->
											<!-- <input type="text" name="customer_email_provider" ng-model="register_data.customer.email.provider" class="multi w30" required> -->
										<!-- </div> -->
										<input type="email" name="customer_email" ng-model="register_data.customer.email" required>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_email.$valid}"></div></td>
								</tr>
								<tr class="padding-bottom border-top">
									<td class="vertical-align-top">Bemerkungen: </td>
									<td>
										<textarea rows="3" name="customer_message" placeholder="Ihre Nachricht..." ng-model="register_data.customer.message"></textarea>
									</td>
									<td></td>
								</tr>
								<tr class="padding-top heading border-bottom">
									<td>Abweichende Rechnungsanschrift</td>
									<td><button ng-click="register_data.alternative_billing = !register_data.alternative_billing;" ng-init="register_data.alternative_billing=false"><span ng-hide="register_data.alternative_billing">Aufklappen</span><span ng-show="register_data.alternative_billing">Zuklappen</span></button></td>
									<td></td>
								</tr>
								<tr ng-if="register_data.alternative_billing">
									<td><label>Anrede: </label></td>
									<td>
										<label>
											<span class="radio">
												<input type="radio" name="billing_gender" ng-model="register_data.billing.gender" value="female" ng-init="register_data.billing.gender = 'female'">
												<span class="radio-value" aria-hidden="true"></span>
											Frau &nbsp;
											</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="billing_gender" ng-model="register_data.billing.gender" value="male">
												<span class="radio-value" aria-hidden="true"></span>
											Herr 
											</span>
										</label>
									</td>
									<td></td>
								</tr>
								<tr ng-if="register_data.alternative_billing">
									<td><label>Titel: </label></td>
									<td><input type="text" name="billing_title" ng-model="register_data.billing.title"></td>
									<td></td>
								</tr>
								<tr ng-if="register_data.alternative_billing">
									<td><label>Vorname: </label></td>
									<td><input type="text" name="billing_firstname" ng-model="register_data.billing.firstname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.billing_firstname.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.alternative_billing">
									<td><label>Nachname: </label></td>
									<td><input type="text" name="billing_lastname" ng-model="register_data.billing.lastname" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.billing_lastname.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.alternative_billing && register_data.course_type == 'business'">
									<td><label>Unternehmen: </label></td>
									<td><input type="text" name="billing_business" ng-model="register_data.billing.business" required></td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.billing_business.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.alternative_billing">
									<td><label>Straße / Nr.: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="billing_street_name" ng-model="register_data.billing.street.name" class="multi w70" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="billing_street_number" ng-model="register_data.billing.street.number" class="multi w25" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.billing_street_name.$valid && registerForm.billing_street_number.$valid}"></div></td>
								</tr>
								<tr ng-if="register_data.alternative_billing">
									<td><label>PLZ / Ort: </label></td>
									<td>
										<div class="my-input-group">
											<input type="text" name="billing_city_plz" ng-model="register_data.billing.city.plz" class="multi w25" required>
											<div class="addon multi w5">&nbsp;</div>
											<input type="text" name="billing_city_name" ng-model="register_data.billing.city.name" class="multi w70" required>
										</div>
									</td>
									<td><div class="pflichtfeld" ng-class="{valid : registerForm.billing_city_plz.$valid && registerForm.billing_city_name.$valid}"></div></td>
								</tr>
							</tbody>
						</table>
						<input name="register-submit" type="submit" ng-click="submitForm(registerForm.$valid);" value="Seminar anfragen" ng-disabled="!registerForm.$valid">
						<input name="register-reset" type="reset" ng-click="resetForm('#register-window');" value="Zurück">
						<div class="g-recaptcha" data-sitekey="my_key"></div>
						<img id="cmdSubmit" src="SubmitBtn.png" alt="Submit Form" style="cursor:pointer;" />
					</ng-form>
				</div>
			</div>
			<div id="confirmation-container" class="overlay-container">
				<div class="inner">
					<h2 style="padding-bottom: 20px;">
						Vielen Dank für Ihre Anfrage zum Seminar: <br>
						<strong>{{register_data.course_data.name}}</strong>
					</h2>
					<p>Wir werden uns umgehend mit Ihnen in Verbindung setzen.
					Bei Rückfragen stehen wir Ihnen unter folgenden Kontaktdaten jederzeit gerne zur Verfügung:</p>
					<p>
						Tel: 05251 54 32 86 (?)<br>
						Mail: pruefungszentrum@sanitt.de (?)
					</p>
					
					
					<h3>Mit freundlichen Grüßen <br>
					Ihr [SAN]ITT[ - Team</h3>
					<button class="close-confirmation" ng-click="resetForm('#register-window',true);">Fenster schließen</button>
				</div>
			</div> <!-- #confirmation-container -->
		</div><!-- #register window -->
		