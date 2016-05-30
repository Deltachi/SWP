			<div class="title">
				<div class="title-logo">
					<!-- get svg-code for animation (siehe index.js -> TimelineMax) -->
					<sanitt-logo ng-if="activeTab == 'index'"></sanitt-logo>	
					<a href="/"><img ng-if="activeTab != 'index'" ng-src="{{wp_templateUrl}}/images/content/sanitt_logo.svg" alt=""></a>
				</div>
			</div>
			<!-- Navigationsleiste, die durch index.js unsichbar gemacht wird 
			(fixe Navbar -> weiter unten im Dokument wird sichbar gemacht), nachdem 111px (über das Logo hinaus-) gescrollt wird -->
			<nav id="main-navigation">
				<div class="container">
					<ul class="navigation-bar">
						<li class="item" ng-class="activeTab == 'index' ? 'active-page':''"><a href="/"><img ng-src="{{wp_templateUrl}}/images/icons/house.svg" alt=""></a></li>
						<li class="item toggleable" ng-class="tabContains('it-services',activeTab) == true ? 'active-page':''"><a>IT-Services <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_down.svg" alt=""></a>
							<ul>
								<li class="item" ng-class="activeTab == 'softwaretest' 	? 'active-page':''"><a href="/softwaretest/">Softwaretest</a></li>
								<li class="item" ng-class="activeTab == 'testmanagement' 	? 'active-page':''"><a href="/testmanagement/">Testmanagement</a></li>
								<li class="item toggleable" ng-class="tabContains('it-schulungen',activeTab) == true || activeTab == 'it-schulungen' 	? 'active-page':''"><a href="/it-schulungen/">IT-Schulungen  <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_right.svg" alt=""></a>
									<ul>
										<li class="item" ng-class="activeTab == 'raumvermietung' ? 'active-page':''"><a href="/raumvermietung/">Raumvermietung</a></li>
									</ul>
								</li>
								<li class="item" ng-class="activeTab == 'webprogrammierung' ? 'active-page':''"><a href="/webprogrammierung/">Webprogrammierung</a></li>
								<li class="item" ng-class="activeTab == 'it-support' 		? 'active-page':''"><a href="/it-support/">IT-Support</a></li>
								<li class="item toggleable" ng-class="tabContains('it-personaldienstleistungen',activeTab) == true || activeTab == 'it-personaldienstleistungen' ? 'active-page':''"><a href="/it-personaldienstleistungen/">IT-Personaldienstleistungen <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_right.svg" alt=""></a>
									<ul>
										<li class="item" ng-class="activeTab == 'contracting' 				? 'active-page':''"><a href="/contracting/">Contracting</a></li>
										<li class="item" ng-class="activeTab == 'arbeitnehmerueberlassung' 	? 'active-page':''"><a href="/arbeitnehmerueberlassung/">Arbeitnehmerüberlassung</a></li>
										<li class="item" ng-class="activeTab == 'personalvermittlung' 		? 'active-page':''"><a href="/personalvermittlung/">Personalvermittlung</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="item toggleable" ng-class="tabContains('it-pz',activeTab) == true ? 'active-page':''"><a>IT-Prüfungszentrum <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_down.svg" alt=""></a>
							<ul style="min-width: 179px;">
								<li class="item toggleable" ng-class="tabContains('istqb',activeTab) == true || activeTab == 'istqb' ? 'active-page':''"><a href="/istqb/">ISTQB<!--  <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_right.svg" alt=""> --></a>
									<!-- <ul>
										<li class="item"><a href="/">Anmeldung</a></li>
										<li class="item" ng-class="activeTab == 'lehrplaene' ? 'active-page':''"><a href="/lehrplaene/">Downloadbereich</a></li>
									</ul> -->
								</li>
								<li class="item toggleable" ng-class="tabContains('isaqb',activeTab) == true || activeTab == 'isaqb' ? 'active-page':''"><a href="/isaqb/">iSAQB<!--  <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_right.svg" alt=""> --></a>
									<!-- <ul>
										<li class="item"><a href="/">Anmeldung</a></li>
										<li class="item"><a href="/">Downloadbereich</a></li>
									</ul> -->
								</li>
							</ul>
						</li>
						<li class="item toggleable" ng-class="tabContains('karriere',activeTab) == true ? 'active-page':''"><a>Karriere <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_down.svg" alt=""></a>
							<ul>
								<li class="item" ng-class="activeTab == 'stellenangebote' 		? 'active-page':''"><a href="/interne-stellenangebote/">Interne Stellenangebote</a></li>
								<li class="item" ng-class="activeTab == 'young-professionals' 	? 'active-page':''"><a href="/young-professionals/">Young-Professionals</a></li>
								<li class="item" ng-class="activeTab == 'it-projektboerse' 		? 'active-page':''"><a href="/it-stellenboerse/">IT-Stellenbörse</a></li>
								<!-- <li class="item" ng-class="activeTab == 'initiativbewerbung' 	? 'active-page':''"><a href="/initiativbewerbung/">Initiativbewerbung</a></li> -->
							</ul>
						</li>
						<li class="item toggleable" ng-class="tabContains('unternehmen',activeTab) == true ? 'active-page':''"><a>Unternehmen <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_down.svg" alt=""></a>
							<ul>
								<li class="item" ng-class="activeTab == 'about' 				? 'active-page':''"><a href="/about/">Wer wir sind</a></li>
								<li class="item" ng-class="activeTab == 'team' 		? 'active-page':''"><a href="/team/">Das Team</a></li>
								<li class="item" ng-class="activeTab == 'kooperationspartner'	? 'active-page':''"><a href="/kooperationspartner/">Kooperationspartner</a></li>
								<!-- <li class="item" ng-class="activeTab == 'referenzen' 			? 'active-page':''"><a href="/referenzen/">Referenzen</a></li> -->
								<li class="item toggleable" ng-class="tabContains('referenzen',activeTab) == true || activeTab == 'referenzen' 	? 'active-page':''"><a href="/referenzen/">Referenzen  <img class="glyphicon" ng-src="{{wp_templateUrl}}/images/icons/chevron_right.svg" alt=""></a>
									<ul>
										<li class="item" ng-class="activeTab == 'referenzen-projekte' ? 'active-page':''"><a href="/referenzen-projekte/">Projekte</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="item" ng-class="activeTab == 'contact' ? 'active-page':''"><a href="contact/">Kontakt</a></li>
						<li><form class="search" action="/"><input type="text" name="s" placeholder="Suche..."><input type="image" ng-src="{{wp_templateUrl_lupe}}" name="confirm"></form></li>
					</ul>
				</div>
			</nav>
