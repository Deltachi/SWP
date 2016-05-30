		<!-- Anmeldeformular -->
		<div id="register-window" class="overlay-window">
			<div class="fullsize-container" style="position: absolute; top:0; left: 0; width:100%;">
				<div class="abort-panel" style="position: absolute; top:0; left: 0; height: 100%; width:100%; background: transparent;" ng-click="resetForm('#register-window');">
				
				</div> <!-- .abort-panel -->
				<div id="register-container" class="overlay-container">
					<div class="inner">
						<ng-form id="register-form" name="registerForm" class="overlay-form">
							<input class="upper-reset" name="register-reset" type="reset" ng-click="resetForm('#register-window');" value="Zurück">
							<table>
								<tbody>
									<tr class="heading nowrap border-bottom">
										<td><strong>Prüfungsanmeldung</strong><br>{{exams[activeExam].name}}</td>
										<td> </td>
										<td> </td>
									</tr>
									<tr class="padding-top">
										<td><label>Prüfung:</label></td>
										<td>
											<select name="exam_data_name" ng-model="register_data.exam_data.name" ng-init="register_data.exam_data.name = exams[activeExam].version[0].name" class="dropdown-chevron">
												<option ng-repeat="exam in exams[activeExam].version" value="{{exam.name}}" ng-selected="register_data.exam_data.name == exam.name">{{exam.name}}</option>
											</select>
										</td>
										<td></td>
									</tr>
									<tr ng-if="exams[activeExam].requirements">
										<td class="vertical-align-top">
											<strong>Hinweis:</strong><br>
										</td>
										<!-- Hinweise Agile Tester -->
										<td colspan="2" ng-if="activeExam == 'CAT'">
											<div><small>
												Bei der Anmeldung für eine CTFL-Agile-Tester-Prüfung  bitten wir um Zusendung folgender Nachweise <br> 
												in einer gut lesbaren Kopie im PDF-Format an: <strong>pruefungszentrum@sanitt.de</strong> <br>
												<ul>
													<li>Zusendung einer Kopie des Foundation Level Zertifikates</li>
													<li>Zusendung des unterschriebenen Antrags im PDF-Format: <a href="/downloads/pdf/istqb/FO_CT_005_1_3_Antragsformular.pdf" target="_blank">Antragsformular</a></li>
												</ul>
											</small></div>
										</td>
										<!-- Hinweise CAST-Prüfung -->
										<td colspan="2" ng-if="activeExam == 'CAST'">
											<div><small>
												Bei der Anmeldung für eine CAST-Prüfung  bitten wir um Zusendung folgender Nachweise <br> 
												in einer gut lesbaren Kopie im PDF-Format an: <strong>pruefungszentrum@sanitt.de</strong> <br>
												<ul>
													<li>Zusendung einer Kopie des Foundation Level Zertifikates</li>
													<li>Zusendung des unterschriebenen Antrags im PDF-Format: <a href="/downloads/pdf/istqb/FO_CT_005_1_3_Antragsformular.pdf" target="_blank">Antragsformular</a></li>
												</ul>
											</small></div>
										</td>
										<!-- Hinweise für alle CTAL Module -->
										<td colspan="2" ng-if="activeExam.indexOf('CTAL') > -1">
											<div><small>
												Bei einer CTAL-Prüfung bitten wir um Zusendung folgender Nachweise <br> 
												in einer gut lesbaren Kopie im PDF-Format an: <strong>pruefungszentrum@sanitt.de</strong> <br>
												<ul>
													<li>Zusendung des unterschriebenen Antrags im PDF-Format: <a href="/downloads/pdf/istqb/Antrag.pdf" target="_blank">Antragsformular</a></li>
													<li>Beim erstmaligen Ablegen: Zusendung einer Kopie des Foundation Level Zertifikates + Nachweis über 18-monatige Praxiserfahrung.</li>
													<li>Bei einer bereits bestandenen CTAL-Prüfung: Zusendung einer Kopie des CTAL-Zertifikates.</li>
												</ul>
											</small></div>
										</td>
									</tr>
									<tr class="padding-bottom">
										<td><label>Wunschtermin: </label></td>
										<td>
											<input name="exam_data_date1" type="text" id="istqb_datepicker1" ng-model="register_data.exam_data.date1"  required>
										</td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.exam_data_date1.$valid}"></div></td>
									</tr>
									<tr class="padding-bottom">
										<td><label>Gewünschte Uhrzeit: </label></td>
										<td>
											<input id="istqb_timepicker1" type="text" name="exam_data_time1" ng-model="register_data.exam_data.time1" required />
										</td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.exam_data_time1.$valid}"></div></td>
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
													<input type="radio" name="exam_type" ng-model="register_data.exam_type" value="business" ng-init="register_data.exam_type = 'business'">
													<span class="radio-value" aria-hidden="true"></span>
												Geschäftskunde &nbsp;
												</span>
											</label>
										</td>
										<td>
											<label>
												<span class="radio">
													<input type="radio" name="exam_type" ng-model="register_data.exam_type" value="private">
													<span class="radio-value" aria-hidden="true"></span>
												Privatkunde &nbsp;
												</span>
											</label>
										</td>
										<td></td>
									</tr>
									
									<!-- TEILNEHMERLISTE -->
									<tr class="padding-top" ng-init="register_data.exam_members.push({'gender':'female','student':'false','timebonus':'false'})">
										<td><button ng-click="register_data.exam_members.push({'gender':'female','student':'false','timebonus':'false'})"><strong>Teilnehmer hinzufügen</strong></button></td>
										<td>(Aktuell: {{register_data.exam_members.length}} Teilnehmer) <br> <a class="pointer" ng-click="removeLastMember();">Letzten Teilnehmer entfernen</a> </td>
										<td></td>
									</tr>
									<tr class="padding-top heading border-bottom" ng-repeat-start="member in register_data.exam_members">
										<td>{{$index + 1}}. Teilnehmer /-in</td>
										<td> </td>
										<td> </td>
									</tr>
									<tr>
										<td><label>Anrede: </label></td>
										<td>
											<label>
												<span class="radio">
													<input type="radio" name="exam_members_{{$index}}_gender" ng-model="register_data.exam_members[$index].gender" value="female">
													<span class="radio-value" aria-hidden="true"></span>
													Frau &nbsp;
												</span>
											</label>
											<label>
												<span class="radio">
													<input type="radio" name="exam_members_{{$index}}_gender" ng-model="register_data.exam_members[$index].gender" value="male">
													<span class="radio-value" aria-hidden="true"></span>
													Herr 
												</span>
											</label>	
										</td>
										<td></td>
									</tr>
									<tr>
										<td><label>Titel: </label></td>
										<td><input type="text" name="exam_members_{{$index}}_title" ng-model="register_data.exam_members[$index].title"></td>
										<td></td>
									</tr>
									<tr>
										<td><label>Vorname: </label></td>
										<td><input type="text" name="exam_members_{{$index}}_firstname" ng-model="register_data.exam_members[$index].firstname" required></td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_firstname.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Nachname: </label></td>
										<td><input type="text" name="exam_members_{{$index}}_lastname" ng-model="register_data.exam_members[$index].lastname" required></td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_lastname.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Straße / Nr.: </label></td>
										<td>
											<div class="my-input-group">
												<input type="text" name="exam_members_{{$index}}_street_name" ng-model="register_data.exam_members[$index].street.name" class="multi w70" required>
												<div class="addon multi w5">&nbsp;</div>
												<input type="text" name="exam_members_{{$index}}_street_number" ng-model="register_data.exam_members[$index].street.number" class="multi w25" ng-pattern="/^[\da-zA-Z]*$/" required>
											</div>
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_street_name.$valid && registerForm.exam_members_{{$index}}_street_number.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>PLZ / Ort: </label></td>
										<td>
											<div class="my-input-group">
												<input type="text" name="exam_members_{{$index}}_city_plz" ng-model="register_data.exam_members[$index].city.plz" class="multi w25" ng-pattern="/^[\d-]*$/" ng-minlength="5" required>
												<div class="addon multi w5">&nbsp;</div>
												<input type="text" name="exam_members_{{$index}}_city_name" ng-model="register_data.exam_members[$index].city.name" class="multi w70" required>
											</div>
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_city_plz.$valid && registerForm.exam_members_{{$index}}_city_name.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Geburtstag: </label></td>
										<td>
											<input type="text" name="exam_members_{{$index}}_birthday" ng-model="register_data.exam_members[$index].birthday" required>
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_birthday.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Geburtsort: </label></td>
										<td>
											<input type="text" name="exam_members_{{$index}}_birthplace" ng-model="register_data.exam_members[$index].birthplace" required>
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_birthplace.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Telefon: </label></td>
										<td>
											<input type="text" name="exam_members_{{$index}}_phone" ng-model="register_data.exam_members[$index].phone" ng-pattern="/^[\d- ]*$/" ng-minlength="4" ng-required="!register_data.exam_members[$index].mobile">
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_phone.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Mobil: </label></td>
										<td>
											<input type="text" name="exam_members_{{$index}}_mobile" ng-model="register_data.exam_members[$index].mobile" ng-pattern="/^[\d- ]*$/" ng-minlength="4" ng-required="!register_data.exam_members[$index].phone">
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_mobile.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Email: </label></td>
										<td>
											<input type="email" name="exam_members_{{$index}}_email" ng-model="register_data.exam_members[$index].email" required>
										</td>
										<td><!-- <div class="pflichtfeld" ng-class="{valid : registerForm.exam_members_{{$index}}_email.$valid}"></div> --></td>
									</tr>
									<tr>
										<td><label>Sind Sie Student? </label></td>
										<td>
											<label>
												<span class="radio">
													<input type="radio" name="exam_members_{{$index}}_student" ng-model="register_data.exam_members[$index].student" value="false">
													<span class="radio-value" aria-hidden="true"></span>
													Ich bin kein Student &nbsp;
												</span>
											</label>
											<label>
												<span class="radio">
													<input type="radio" name="exam_members_{{$index}}_student" ng-model="register_data.exam_members[$index].student" value="true">
													<span class="radio-value" aria-hidden="true"></span>
													Ich bin Student 
												</span>
											</label>	
										</td>
										<td></td>
									</tr>
									<tr class="padding-bottom" ng-repeat-end><td></td><td></td><td></td></tr>

									<!-- BESTELLER / -IN -->
									<tr class="padding-top heading border-bottom" ng-if="register_data.exam_type == 'business'">
										<td>Besteller /-in</td>
										<td></td>
										<td></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'">
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
									<tr ng-if="register_data.exam_type == 'business'">
										<td><label>Titel: </label></td>
										<td><input type="text" name="customer_title" ng-model="register_data.customer.title"></td>
										<td></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'">
										<td><label>Vorname: </label></td>
										<td><input type="text" name="customer_firstname" ng-model="register_data.customer.firstname" required></td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_firstname.$valid}"></div></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'">
										<td><label>Nachname: </label></td>
										<td><input type="text" name="customer_lastname" ng-model="register_data.customer.lastname" required></td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_lastname.$valid}"></div></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'">
										<td><label>Unternehmen: </label></td>
										<td><input type="text" name="customer_business" ng-model="register_data.customer.business" required></td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_business.$valid}"></div></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'">
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
									<tr ng-if="register_data.exam_type == 'business'">
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
									<tr ng-if="register_data.exam_type == 'business'">
										<td><label>Telefon: </label></td>
										<td>
											<input type="text" name="customer_phone" ng-model="register_data.customer.phone" ng-pattern="/^[\d- ]*$/" ng-minlength="4" required>
										</td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_phone.$valid}"></div></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'">
										<td><label>Mobil: </label></td>
										<td>
											<input type="text" name="customer_mobile" ng-model="register_data.customer.mobile" ng-pattern="/^[\d- ]*$/" ng-minlength="4" ng-required="!register_data.customer.phone">
										</td>
										<td><div class="pflichtfeld" ng-class="{valid : registerForm.customer_mobile.$valid}"></div></td>
									</tr>
									<tr ng-if="register_data.exam_type == 'business'" class="padding-bottom">
										<td><label>Email: </label></td>
										<td>
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
									<!-- ABWEICHENDE RECHNUNGSANSCHRIFT -->
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
									<tr ng-if="register_data.alternative_billing && register_data.exam_type == 'business'">
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
							<div class="button-row">
								<input name="register-submit" type="submit" ng-click="submitForm(registerForm.$valid);" value="Prüfung anmelden" ng-disabled="!registerForm.$valid">
								<input name="register-reset" type="reset" ng-click="resetForm('#register-window');" value="Zurück">
							</div>
						</ng-form>
					</div> <!-- .inner -->
				</div> <!-- #register-container -->
				<div id="confirmation-container" class="overlay-container confirmation-container">
					<div class="inner">
						<h2 style="padding-bottom: 20px;">
							Vielen Dank für Ihre Anmeldung zur Prüfung: <br>
							<strong>{{register_data.exam_data.super}}</strong>
						</h2>
						<p>Wir werden uns umgehend mit Ihnen in Verbindung setzen.
						Bei Rückfragen stehen wir Ihnen unter folgenden Kontaktdaten jederzeit gerne zur Verfügung:</p>
						<p>
							Tel: 05251 54 32 86<br>
							Mail: <a href="mailto:pruefungszentrum@sanitt.de">pruefungszentrum@sanitt.de</a>
						</p>
						
						
						<h3>Mit freundlichen Grüßen <br>
						Ihr [SAN]ITT[ - Team</h3>
						<button class="close-confirmation" ng-click="resetForm('#register-window',true);">Fenster schließen</button>
					</div>
				</div> <!-- #confirmation-container -->
				
			</div> <!-- .fullsize-container -->
		</div> <!-- #register-window -->
		