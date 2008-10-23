<?php
/** 
*
* acp_garage [Dutch]
*
* @package language translated by Roblom from www.deCRXgarage.nl
* @version $Id: garage.php 419 2007-05-22 14:41:58Z poyntesm $
* @copyright (c) 2005 phpBB Garage
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_GARAGE_SETTINGS'						=> 'Garage instellingen',
	'ACP_GARAGE_SETTINGS_EXPLAIN'				=> 'phpBB Garage instellingen',
	'ACP_GARAGE_GENERAL_CONFIG' 				=> 'Algemene configuratie',
	'ACP_GARAGE_MENU_CONFIG' 					=> 'Menu configuratie',
	'ACP_GARAGE_INDEX_CONFIG' 					=> 'Instellingen index pagina',
	'ACP_GARAGE_IMAGE_CONFIG' 					=> 'Afbeelding configuratie',
	'ACP_GARAGE_QUARTERMILE_CONFIG' 			=> '&frac14; mijl configuratie',
	'ACP_GARAGE_DYNORUN_CONFIG' 				=> 'Dynorun configuratie',
	'ACP_GARAGE_TRACK_CONFIG'					=> 'Rondetijden configuratie',
	'ACP_GARAGE_INSURANCE_CONFIG' 				=> 'Verzekeringen configuratie',
	'ACP_GARAGE_BUSINESS_CONFIG' 				=> 'Bedrijven configuratie',
	'ACP_GARAGE_VEHICLE_RATING_CONFIG'			=> 'Voertuig stemmen configuratie',
	'ACP_GARAGE_GUESTBOOK_CONFIG'				=> 'Gastenboek configuratie',
	'ACP_GARAGE_PRODUCT_CONFIG'					=> 'Produkt configuratie',
	'ENABLE_QUARTERMILE' 						=> '&frac14; mijl inschakelen',
	'ENABLE_QUARTERMILE_EXPLAIN' 				=> 'Dit geeft gebruikers de mogelijkheid om &frac14; mijl gegevens toe te voegen aan hun voertuigen.',
	'ENABLE_QUARTERMILE_APPROVAL' 				=> '&frac14; mijl goedkeuren',
	'ENABLE_QUARTERMILE_APPROVAL_EXPLAIN' 		=> 'Dit zorgt ervoor dat een nieuwe &frac14; mijl tijd eerst goedgekeurd moet worden door een moderater voordat hij word toegevoegd aan het voertuig.',
	'ENABLE_QUARTERMILE_IMAGE_REQUIRED' 		=> '&frac14; mijl afbeelding verplicht',
	'ENABLE_QUARTERMILE_IMAGE_REQUIRED_EXPLAIN'	=> 'Dit zorgt ervoor dat bij alle tijden die onder de limiet (zie hieronder) komen een afbeelding verplicht is.',
	'QUARTERMILE_IMAGE_REQUIRED_LIMIT' 			=> '&frac14; mijl afbeelding verplicht limiet',
	'QUARTERMILE_IMAGE_REQUIRED_LIMIT_EXPLAIN'	=> 'Alle &frac14; mijl tijden die onder deze limiet komen dienen verplicht een afbeelding te plaatsen.',
	'ENABLE_DYNORUN' 							=> 'Dynorun inschakelen',
	'ENABLE_DYNORUN_EXPLAIN' 					=> 'Dit geeft gebruikers de mogelijkheid om dynorun gegevens toe te voegen aan hun voertuigen.',
	'ENABLE_DYNORUN_APPROVAL' 					=> 'Dynorun goedkeuren',
	'ENABLE_DYNORUN_APPROVAL_EXPLAIN' 			=> 'Dit zorgt ervoor dat een nieuwe dynorun eerst goedgekeurd moet worden door een moderater voordat hij word toegevoegd aan het voertuig.',
	'ENABLE_DYNORUN_IMAGE_REQUIRED' 			=> 'Dynorun afbeelding verplicht',
	'ENABLE_DYNORUN_IMAGE_REQUIRED_EXPLAIN' 	=> 'Dit zorgt ervoor dat dynoruns die boven de limiet (zie hieronder) komen een afbeelding verplicht is.',
	'DYNORUN_IMAGE_REQUIRED_LIMIT' 				=> 'Dynorun afbeelding verplicht limiet',
	'DYNORUN_IMAGE_REQUIRED_LIMIT_EXPLAIN' 		=> 'Bij een dynorun met een vermogen hoger dan dit aantal pk\'s moet verplicht een afbeelding worden geplaatst.',
	'ENABLE_INSURANCE' 							=> 'Verzekering inschakelen',
	'ENABLE_INSURANCE_EXPLAIN' 					=> 'Dit geeft gebruikers de mogelijkheid om verzekerings gegevens toe te voegen aan hun voertuigen.',
	'ENABLE_INSURANCE_SEARCH' 					=> 'Verzekering zoekfunctie inschakelen',
	'ENABLE_INSURANCE_SEARCH_EXPLAIN' 			=> 'Dit zorgt ervoor dat gebruikers de mogelijkheid hebben om te zoeken in de verzekeringen sectie.',
	'BUSINESS_APPROVAL' 						=> 'Bedrijven goedkeuring',
	'BUSINESS_APPROVAL_EXPLAIN' 				=> 'Dit zorgt ervoor dat nieuwe bedrijven eerst goedgekeurd moeten worden door een moderater voordat ze worden toegevoegd aan de database.',
	'RATING_PERMANENT' 							=> 'Stem is definitief',
	'RATING_PERMANENT_EXPLAIN' 					=> 'Dit zorgt ervoor dat alle stemmen een definitieve niet te wijzigen waarde is.',
	'RATING_ALWAYS_UPDATEABLE' 					=> 'Stemmen ten alle tijden te wijzigen',
	'RATING_ALWAYS_UPDATEABLE_EXPLAIN' 			=> 'Dit zorgt ervoor dat als stemmen niet definitief zijn deze altijd gewijzigd kan worden of alleen nadat het betreffende voertuig is gewijzigd.',
	'RATING_MINIMUM_REQUIRED' 					=> 'Minimaal aantal benodigde stemmen',
	'RATING_MINIMUM_REQUIRED_EXPLAIN' 			=> 'Dit is het minimale aantal stemmen dat nodig is voordat hij word weergegeven.',
	'ENABLE_IMAGES' 							=> 'Afbeeldingen inschakelen',
	'ENABLE_IMAGES_EXPLAIN' 					=> 'Toon afbeeldingen die gebruikt worden voor buttons in de garage.',
	'ENABLE_VEHICLE_IMAGES' 					=> 'Voertuig afbeeldingen inschakelen',
	'ENABLE_VEHICLE_IMAGES_EXPLAIN' 			=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om afbeeldingen aan voertuigen toe te voegen.',
	'ENABLE_MODIFICATION_IMAGES' 				=> 'Modifcatie afbeeldingen inschakelen',
	'ENABLE_MODIFICATION_IMAGES_EXPLAIN' 		=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om afbeeldingen aan modifcaties toe te voegen.',
	'ENABLE_QUARTERMILE_IMAGES' 				=> '&frac14; mijl afbeeldingen inschakelen',
	'ENABLE_QUARTERMILE_IMAGES_EXPLAIN' 		=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om afbeeldingen aan &frac14; mijl tijden toe te voegen.',
	'ENABLE_DYNORUN_IMAGES' 					=> 'Dynorun afbeeldingen inschakelen',
	'ENABLE_DYNORUN_IMAGES_EXPLAIN' 			=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om afbeeldingen aan dynoruns toe te voegen.',
	'ENABLE_LAP_IMAGES' 						=> 'Rondetijden afbeeldingen inschakelen',
	'ENABLE_LAP_IMAGES_EXPLAIN' 				=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om afbeeldingen aan rondetijden toe te voegen.',
	'ENABLE_UPLOADED_IMAGES' 					=> 'Upload  afbeeldingen inschakelen',
	'ENABLE_UPLOADED_IMAGES_EXPLAIN' 			=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om afbeeldingen te uploaden bij items die dit toestaan.',
	'ENABLE_REMOTE_IMAGES' 						=> 'Gelinkte afbeeldingen inschakelen',
	'ENABLE_REMOTE_IMAGES_EXPLAIN' 				=> 'Dit geeft gebruikers met de juiste rechten de mogelijkheid om gelinkte afbeeldingen toe te voegen aan items die dit toestaan.',
	'REMOTE_TIMEOUT' 							=> 'Gelinkte afbeeldingen timeout',
	'REMOTE_TIMEOUT_EXPLAIN' 					=> 'Tijd in seconden die de phpBB Garage zal proberen de gelinkte afbeelding te downloaden om er een tumbnail van te maken.',
	'ENABLE_MODIFICATION_GALLERY' 				=> 'Modificatie gallerij inschakelen',
	'ENABLE_MODIFICATION_GALLERY_EXPLAIN' 		=> 'Toont een verzameling afbeeldingen van modificaties tijdens het bekijken van een voertuig.',
	'ENABLE_QUARTERMILE_GALLERY' 				=> '&frac14; mijl gallerij inschakelen',
	'ENABLE_QUARTERMILE_GALLERY_EXPLAIN' 		=> 'Toont een verzameling afbeeldingen van &frac14; mijl runs tijdens het bekijken van een voertuig.',
	'ENABLE_DYNORUN_GALLERY' 					=> 'Dynorun gallerij inschakelen',
	'ENABLE_DYNORUN_GALLERY_EXPLAIN' 			=> 'Toont een verzameling afbeeldingen van dynorun tijdens het bekijken van een voertuig.',
	'ENABLE_LAP_GALLERY'	 					=> 'Rondetijden gellerij inschakelen',
	'ENABLE_LAP_GALLERY_EXPLAIN'	 			=> 'Toont een verzameling afbeeldingen van rondetijden tijdens het bekijken van een voertuig.',
	'GALLERY_LIMIT' 							=> 'Gallerij limiet',
	'GALLERY_LIMIT_EXPLAIN' 					=> 'Het maximale aantal afbeeldingen die getoond worden in elke ingeschakelde gallerij.',
	'IMAGE_MAX_SIZE' 							=> 'Maximale afbeelding bestandsgrootte',
	'IMAGE_MAX_SIZE_EXPLAIN' 					=> 'Het maximaal aantal kilobtyes dat een geuploade afbeelding mag zijn.',
	'IMAGE_MAX_RESOLUTION' 						=> 'Maximale afbeelding resolutie',
	'IMAGE_MAX_RESOLUTION_EXPLAIN' 				=> 'De maximale resolutie in pixels dat een geuploaden afbeelding mag zijn.',
	'THUMBNAIL_RESOLUTION' 						=> 'Thumbnail resolutie',
	'THUMBNAIL_RESOLUTION_EXPLAIN'				=> 'De resolutie van een aangemaakte thumbnail.',
	'ENABLE_BROWSE_MENU' 						=> 'Verkenner menu inschakelen',
	'ENABLE_BROWSE_MENU_EXPLAIN' 				=> 'Het tabblad Verkennen is zichtbaar in het hoofdmenu.',
	'ENABLE_SEARCH_MENU' 						=> 'Zoeken menu inschakelen',
	'ENABLE_SEARCH_MENU_EXPLAIN' 				=> 'Het tabblad Zoeken is zichtbaar in het hoofdmenu.',
	'ENABLE_INSURANCE_REVIEW_MENU' 				=> 'Verzekeringen menu inschakelen',
	'ENABLE_INSURANCE_REVIEW_MENU_EXPLAIN' 		=> 'Het tabblad Verzekeringen is zichtbaar in het hoofdmenu.',
	'ENABLE_GARAGE_REVIEW_MENU' 				=> 'Garage bedrijven menu inschakelen',
	'ENABLE_GARAGE_REVIEW_MENU_EXPLAIN' 		=> 'Het tabblad Garage bedrijven is zichtbaar in het hoofdmenu',
	'ENABLE_SHOP_REVIEW_MENU' 					=> 'Winkels &amp Bedrijven menu inschakelen',
	'ENABLE_SHOP_REVIEW_MENU_EXPLAIN' 			=> 'Het tabblad Winkels &amp Bedrijven is zichtbaar in het hoofdmenu.',
	'ENABLE_QUARTERMILE_MENU' 					=> '&frac14; mijl menu inschakelen',
	'ENABLE_QUARTERMILE_MENU_EXPLAIN' 			=> 'Het tabblad &frac14; mijl is zichtbaar in het hoofdmenu.',
	'ENABLE_DYNORUN_MENU' 						=> 'Dynorun menu inschakelen',
	'ENABLE_DYNORUN_MENU_EXPLAIN' 				=> 'Het tabblad Dynorun is zichtbaar in het hoofdmenu.',
	'ENABLE_LAP_MENU' 							=> 'Rondetijden menu inschakelen',
	'ENABLE_LAP_MENU_EXPLAIN' 					=> 'Het tabblad Rondetijden is zichtbaar in het hoofdmenu.',
	'ENABLE_GARAGE_HEADER' 						=> 'Garage link in forumhoofd',
	'ENABLE_GARAGE_HEADER_EXPLAIN' 				=> 'Een link naar de Garage is zichtbaar in het forumhoofd (menu rechts boven).',
	'ENABLE_QUARTERMILE_HEADER' 				=> '&frac14; mijl link in forumhoofd',
	'ENABLE_QUARTERMILE_HEADER_EXPLAIN' 		=> 'Een link naar de &frac14; mijl is zichtbaar in het forumhoofd (menu rechts boven).',
	'ENABLE_DYNORUN_HEADER' 					=> 'Dynorun link in forumhoofd',
	'ENABLE_DYNORUN_HEADER_EXPLAIN' 			=> 'Een link naar de Dynoruns is zichtbaar in het forumhoofd (menu rechts boven).',
	'ENABLE_FEATURED_VEHICLE' 					=> 'Uitgelicht voertuig inschakelen',
	'ENABLE_FEATURED_VEHICLE_EXPLAIN' 			=> 'Een voertuig word weergegeven op de indexpagina. Welk voertuig word weergegeven word mede bepaald door onderstaande instellingen.',
	'ENABLE_NEWEST_VEHCILE' 					=> 'Nieuwste voertuig inschakelen', 
	'ENABLE_NEWEST_VEHCILE_EXPLAIN' 			=> 'Toon het \'Nieuwste voertuig\' blok op de indexpagina.', 
	'NEWEST_VEHICLE_LIMIT' 						=> 'Nieuwste voertuig limiet',
	'NEWEST_VEHICLE_LIMIT_EXPLAIN' 				=> 'Het aantal voertuigen dat word weergegeven in het \'Nieuwste voertuig\' blok.',
	'ENABLE_UPDATED_VEHICLE' 					=> 'Laatst bijgewerkt inschakelen',
	'ENABLE_UPDATED_VEHICLE_EXPLAIN' 			=> 'Toon het \'Laatst bijgewerkt\' blok op de indexpagina.',
	'UPDATED_VEHICLE_LIMIT' 					=> 'Laatst bijgewerkt limiet',
	'UPDATED_VEHICLE_LIMIT_EXPLAIN' 			=> 'Het aantal voertuigen dat word weergegeven in het \'Laatst bijgewerkt\' blok.',
	'ENABLE_NEWEST_MODIFICATION' 				=> 'Nieuwste modificatie inschakelen',
	'ENABLE_NEWEST_MODIFICATION_EXPLAIN' 		=> 'Toon het \'Nieuwste modificatie\' blok op de indexpagina.',
	'NEWEST_MODIFICATION_LIMIT' 				=> 'Nieuwste modificatie limiet',
	'NEWEST_MODIFICATION_LIMIT_EXPLAIN' 		=> 'Het aantal voertuigen dat word weergegeven in het \'Nieuwste modificatie\' blok.',
	'ENABLE_UPDATED_MODIFICATION' 				=> 'Bijgewerkte modificaties inschakelen',
	'ENABLE_UPDATED_MODIFICATION_EXPLAIN' 		=> 'Toon het \'Bijgewerkte modificatie\' blok op de indexpagina.',
	'UPDATED_MODIFICATION_LIMIT' 				=> 'Bijgewerkte modificaties limiet',
	'UPDATED_MODIFICATION_LIMIT_EXPLAIN' 		=> 'Het aantal voertuigen dat word weergegeven in het \'Bijgewerkte modificatie\' blok.',
	'ENABLE_MOST_MODIFIED' 						=> 'Meeste modificaties inschakelen',
	'ENABLE_MOST_MODIFIED_EXPLAIN' 				=> 'Toon het \'Meeste modificaties\' blok op de indexpagina.',
	'MOST_MODIFIED_LIMIT' 						=> 'Meeste modificaties limiet',
	'MOST_MODIFIED_LIMIT_EXPLAIN' 				=> 'Het aantal voertuigen dat word weergegeven in het \'Meeste modificaties\' blok.',
	'ENABLE_MOST_SPENT' 						=> 'Meest uitgegeven inschakelen',
	'ENABLE_MOST_SPENT_EXPLAIN' 				=> 'Toon het \'Meest uitgegeven\' blok op de indexpagina.',
	'MOST_SPENT_LIMIT' 							=> 'Meest uitgegeven limiet',
	'MOST_SPENT_LIMIT_EXPLAIN' 					=> 'Het aantal voertuigen dat word weergegeven in het \'Meest uitgegeven\' blok.',
	'ENABLE_MOST_VIEWED' 						=> 'Meest bekeken inschakelen',
	'ENABLE_MOST_VIEWED_EXPLAIN' 				=> 'Toon het \'Meest bekeken\' blok op de indexpagina.',
	'MOST_VIEWED_LIMIT' 						=> 'Meest bekeken limiet',
	'MOST_VIEWED_LIMIT_EXPLAIN' 				=> 'Het aantal voertuigen dat word weergegeven in het \'Meest bekeken\' blok.',
	'ENABLE_LAST_COMMENTED' 					=> 'Laatste commentaar inschakelen',
	'ENABLE_LAST_COMMENTED_EXPLAIN' 			=> 'Toon het \'Laatste commentaar\' blok op de indexpagina.',
	'LAST_COMMENTED_LIMIT' 						=> 'Laatste commentaar limiet',
	'LAST_COMMENTED_LIMIT_EXPLAIN' 				=> 'Het aantal voertuigen dat word weergegeven in het \'Laatste commentaar\' blok.',
	'ENABLE_TOP_DYNORUN' 						=> 'Hoogste dynorun inschakelen',
	'ENABLE_TOP_DYNORUN_EXPLAIN' 				=> 'Toon het \'Hoogste dynorun\' blok op de indexpagina.',
	'TOP_DYNORUN_LIMIT' 						=> 'Hoogste dynorun limiet',
	'TOP_DYNORUN_LIMIT_EXPLAIN' 				=> 'Het aantal voertuigen dat word weergegeven in het \'Hoogste dynorun\' blok.',
	'ENABLE_TOP_QUARTERMILE' 					=> 'Snelste &frac14; mijl',
	'ENABLE_TOP_QUARTERMILE_EXPLAIN' 			=> 'Toon het \'Snelste &frac14; mijl\' blok op de indexpagina.',
	'TOP_QUARTERMILE_LIMIT' 					=> 'Snelste &frac14; mijl limiet',
	'TOP_QUARTERMILE_LIMIT_EXPLAIN' 			=> 'Het aantal voertuigen dat word weergegeven in het \'Snelste &frac14; mijl\' blok.',
	'ENABLE_TOP_RATING' 						=> 'Hoogste waardering inschakelen',
	'ENABLE_TOP_RATING_EXPLAIN' 				=> 'Toon het \'Hoogste waardering\' blok op de indexpagina.',
	'TOP_RATING_LIMIT' 							=> 'Hoogste waardering limiet', 
	'TOP_RATING_LIMIT_EXPLAIN' 					=> 'Het aantal voertuigen dat word weergegeven in het \'Hoogste waardering\' blok.', 
	'VEHICLES_PER_PAGE' 						=> 'Voertuigen per pagina',
	'VEHICLES_PER_PAGE_EXPLAIN' 				=> 'Het aantal voertuigen dat per pagina getoond word.',
	'YEAR_RANGE_BEGINNING' 						=> 'Begin bouwjaar', 
	'YEAR_RANGE_BEGINNING_EXPLAIN' 				=> 'Dit is het eerste jaar dat word weergegeven in de bouwjaar selectielijst bij het aanmaken van een nieuw voertuig. Formaat EEJJ', 
	'YEAR_RANGE_END' 							=> 'Offset laatste bouwjaar',
	'YEAR_RANGE_END_EXPLAIN' 					=> 'Aantal jaren dat bij het aanmaken van een nieuw voertuig word opgeteld of afgetrokken bij het huidige jaar hierdoor word het nieuwste modeljaar gecre&eumlrd. Bij een positief getal word het getal bij het huidige jaar opgeteld, bij een negatief getal word het ervan af getrokken.',
	'USER_SUBMIT_MAKE' 							=> 'Gebruikers merk inzendingen',
	'USER_SUBMIT_MAKE_EXPLAIN' 					=> 'Mogen gebruikers nieuwe merken aanmaken?',
	'USER_SUBMIT_MODEL' 						=> 'Gebruikers model inzedingen',
	'USER_SUBMIT_MODEL_EXPLAIN' 				=> 'Mogen gebruikers nieuwe modellen aanmaken?',
	'USER_SUBMIT_BUSINESS' 						=> 'Bedrijven inzendingen inschakelen',
	'USER_SUBMIT_BUSINESS_EXPLAIN' 				=> 'Dit geeft gebruikers de mogelijkheid om nieuwe bedrijven toe te voegen aan de database.',
	'ENABLE_LATESTMAIN_VEHICLE' 				=> 'Laatst bijgewerkte voertuig lijst inschakelen',
	'ENABLE_LATESTMAIN_VEHICLE_EXPLAIN' 		=> 'Het blok met een lijst van de \'Laatst bijgewerkte\' voertuigen is zichtbaar op alle garage pagina\'s.',
	'LATESTMAIN_VEHCILE_LIMIT' 					=> 'Laatst bijgewerkte voertuigen limiet',
	'LATESTMAIN_VEHCILE_LIMIT_EXPLAIN' 			=> 'Het aantal voertuigen in de lijst met de \'Laatst bijgewerkte\' voertuigen',
	'GARAGE_DATE_FORMAT' 						=> 'Datum formaat',
	'GARAGE_DATE_FORMAT_EXPLAIN' 				=> 'Datum formaat dat gebruikt word om items weer te geven in de garage.',
	'PROFILE_INTEGRATION' 						=> 'Thumbnails profiel',
	'PROFILE_INTEGRATION_EXPLAIN' 				=> 'Toon tumbnails voor alle voertuig afbeeldingen in plaats van alleen de hoofdafbeelding.',
	'ENABLE_GUESTBOOK' 							=> 'Gastenboek inschakelen',
	'ENABLE_GUESTBOOK_EXPLAIN' 					=> 'Dit zorgt ervoor dat het gastenboek word weergegeven en gebruikers met de juiste rechten commentaar op voertuigen kunnen plaatsen.',
	'FEATURED_VEHICLE_ID' 						=> 'Uitgelicht voertuig ID', 
	'FEATURED_VEHICLE_ID_EXPLAIN' 				=> 'Geef een voertuig ID op welke weegegeven moet worden als \'Uitgelicht voertuig\'.', 
	'FEATURED_FROM_BLOCK' 						=> 'Uitgelicht voertuig van blok', 
	'FEATURED_FROM_BLOCK_EXPLAIN' 				=> 'Selecteer een keuzemogelijkheid om het uitgelichte voertuig soort te bepalen. De bovenste in de lijst is de huidige instelling.', 
	'RANDOM'									=> 'Willekeurig',
	'FROM_BLOCK'								=> 'Van blok',
	'BY_VEHICLE_ID'								=> 'Van voertuig ID',
	'FEATURED_VEHICLE_DESCRIPTION' 				=> 'Uitgelicht voertuig omschrijving',
	'FEATURED_VEHICLE_DESCRIPTION_EXPLAIN' 		=> 'Geef de titel wat het uitgelichte voertuig op. Dit word weergegeven bovenaan het betreffende blok.',
	'INTEGRATE_MEMBERLIST' 						=> 'Integreer in ledenlijst',
	'INTEGRATE_MEMBERLIST_EXPLAIN' 				=> 'Toon een garage button bij gebruikers die een voertuig in de garage hebben.',
	'INTEGRATE_PROFILE' 						=> 'Integreer in profiel',
	'INTEGRATE_PROFILE_EXPLAIN' 				=> 'Toon hoofd voertuig informatie in het gebruikers profiel.',
	'INTEGRATE_VIEWTOPIC' 						=> 'Integreer in viewtopic',
	'INTEGRATE_VIEWTOPIC_EXPLAIN' 				=> 'Toon een voertuig link en garage button voor gebruikers met een voertuig in de garage.',
	'PENDING_PM_NOTIFY' 						=> 'PB bericht bij items ter goedkeuring',
	'PENDING_PM_NOTIFY_EXPLAIN' 				=> 'Geautoriseerde moderaters van de garage ontvangen een PB bericht als bij nieuwe items ter goedkeuring.',
	'PENDING_EMAIL_NOTIFY' 						=> 'Email bericht bij items ter goedkeuring',
	'PENDING_EMAIL_NOTIFY_EXPLAIN' 				=> 'Geautoriseerde moderaters van de garage ontvangen een email bericht bij nieuwe items ter goedkeuring.',
	'PENDING_PM_NOTIFY_OPTOUT' 					=> 'PB bericht bij items ter goedkeuring uitschakelbaar',
	'PENDING_PM_NOTIFY_OPTOUT_EXPLAIN' 			=> 'Moderaters van de garage kunnen het ontvangen van PB berichten uitschakelen in hun UCP. Dit om mogelijk ongewenste berichten te voorkomen.',
	'PENDING_EMAIL_NOTIFY_OPTOUT' 				=> 'Email bericht bij items ter goedkeuring uitschakelbaar',
	'PENDING_EMAIL_NOTIFY_OPTOUT_EXPLAIN' 		=> 'Moderaters van de garage kunnen het ontvangen van email berichten uitschakelen in hun UCP. Dit om mogelijk ongewenste berichten te voorkomen.',
	'ENABLE_VEHICLE_APPROVAL' 					=> 'Voertuig goedkeuring inschakelen',
	'ENABLE_VEHICLE_APPROVAL_EXPLAIN' 			=> 'Voertuigen hebben goedkeuring nodig van een moderater voordat ze worden opgenomen in de openbare lijst.',
	'ENABLE_GUESTBOOK_COMMENT_APPROVAL' 		=> 'Gastenboek commentaar goedkeuring',
	'ENABLE_GUESTBOOK_COMMENT_APPROVAL_EXPLAIN' => 'Dit zorgt ervoor dat nieuwe commentaren eerst goedgekeurd moet worden door een moderater voordat ze worden toegevoegd aan de database.',
	'GARAGE_INDEX_COLUMNS'						=> 'Aantal kolommen op de indexpagina',
	'GARAGE_INDEX_COLUMNS_EXPLAIN'				=> 'Het aantal kolommen dat gebruikt word op de indexpagina.',
	'ENABLE_USER_INDEX_COLUMNS'					=> 'Gebruikers kolommen index inschakelen',
	'ENABLE_USER_INDEX_COLUMNS_EXPLAIN'			=> 'Gebruikers kunnen de standaard forum instellingen overrulen.',
	'ENABLE_GUESTBOOK_BBCODE'					=> 'Gastenboek BBCode inschakelen',
	'ENABLE_GUESTBOOK_BBCODE_EXPLAIN'			=> 'Dit geeft gebruikers de mogelijkheid om BBCodes te gebruiken in het gastenboek.',
	'ENABLE_USER_SUBMIT_PRODUCT'				=> 'Produkt inzendingen inschakelen',
	'ENABLE_USER_SUBMIT_PRODUCT_EXPLAIN'		=> 'Dit geeft gebruikers de mogelijkheid om nieuwe Producten toe te voegen aan de database.',
	'ENABLE_PRODUCT_APPROVAL' 					=> 'Produkt goedkeuring',
	'ENABLE_PRODUCT_APPROVAL_EXPLAIN' 			=> 'Dit zorgt ervoor dat nieuwe Producten eerst goedgekeurd moeten worden door een moderater voordat ze worden toegevoegd aan de database.',
	'ENABLE_PRODUCT_SEARCH' 					=> 'Produkt zoekfunctie inschakelen',
	'ENABLE_PRODUCT_SEARCH_EXPLAIN' 			=> 'Dit geeft gebruikers de mogelijkheid om te zoeken naar Producten &amp fabrikanten.',


	'ENABLE_TRACKTIME'							=> 'Rondetijden inschakelen',
	'ENABLE_TRACKTIME_EXPLAIN'					=> 'Dit geeft gebruikers de mogelijkheid om rondetijden toe te voegen aan hun voertuigen.',
	'ENABLE_LAP_APPROVAL'						=> 'Rondetijden goedkeuring',
	'ENABLE_LAP_APPROVAL_EXPLAIN'				=> 'Dit zorgt ervoor dat een rondetijd eerst goedgekeurd moet worden door een moderater voordat hij word toegevoegd aan het voertuig.',
	'ENABLE_TRACK_APPROVAL'						=> 'Circuit goedkeuring',
	'ENABLE_TRACK_APPROVAL_EXPLAIN'				=> 'Dit zorgt ervoor dat een nieuw circuits eerst goedgekeurd moet worden door een moderater voordat ze worden toegevoegd aan de database.',
	'ENABLE_USER_ADD_LAP'						=> 'Circuit inzendingen inschakelen',
	'ENABLE_USER_ADD_LAP_EXPLAIN' 				=> 'Dit geeft gebruikers de mogelijkheid om nieuwe circuits toe te voegen aan de database.',


//LOG Messages Keys
	'LOG_GARAGE_CONFIG_GENERAL'		=> '<strong>Wijzigingen aangebracht in Garage algemene instellingen</strong>',
	'LOG_GARAGE_CONFIG_MENU'		=> '<strong>Wijzigingen aangebracht in Garage menu instellingen</strong>',
	'LOG_GARAGE_CONFIG_INDEX'		=> '<strong>Wijzigingen aangebracht in Garage index pagina instellingen</strong>',
	'LOG_GARAGE_CONFIG_IMAGES'		=> '<strong>Wijzigingen aangebracht in Garage afbeelding instellingen</strong>',
	'LOG_GARAGE_CONFIG_QUARTERMILE'	=> '<strong>Wijzigingen aangebracht in Garage &frac14; mijl instellingen</strong>',
	'LOG_GARAGE_CONFIG_DYNORUN'		=> '<strong>Wijzigingen aangebracht in Garage dynorun instellingen</strong>',
	'LOG_GARAGE_CONFIG_TRACK'		=> '<strong>Wijzigingen aangebracht in Garage circuit en rondetijden instellingen</strong>',
	'LOG_GARAGE_CONFIG_INSURANCE'	=> '<strong>Wijzigingen aangebracht in Garage verzekerings instellingen</strong>',
	'LOG_GARAGE_CONFIG_BUSINESS'	=> '<strong>Wijzigingen aangebracht in Garage bedrijven instellingen</strong>',
	'LOG_GARAGE_CONFIG_RATING'		=> '<strong>Wijzigingen aangebracht in Garage waarderings instellingen</strong>',
	'LOG_GARAGE_CONFIG_GUESTBOOK'	=> '<strong>Wijzigingen aangebracht in Garage gastenboek instellingen</strong>',
	'LOG_GARAGE_CONFIG_PRODUCT'		=> '<strong>Wijzigingen aangebracht in Garage produkt instellingen</strong>',
	'LOG_GARAGE_CONFIG_SERVICE'		=> '<strong>Wijzigingen aangebracht in Garage service instellingen</strong>',
	'LOG_GARAGE_CONFIG_BLOG'		=> '<strong>Wijzigingen aangebracht in Garage blog instellingen</strong>',

	'NAME' 							=> 'Naam',
	'BROWSE' 						=> 'Verkennen',

//Added For RC5
	'NO_ORPHANED_FILES' 			=> 'Er zijn geen weesbestanden aangetroffen',
	'ORPHANED_FILES_REMOVED' 		=> 'Weesbestanden verwijdert',
	'NO_ORPHANED_FILES_SELECTED' 	=> 'Er zijn geen weesbestanden geselecteerd, daarom werd er ook niets verwijdert ;)',
	'REBUILD_THUMBNAILS_COMPLETE' 	=> 'Thumbnails opnieuw aanmaken afgerond',
	'PERMISSIONS_UPDATED' 			=> 'Garage permissies bijgewerkt.*** ONBEKEND IN MODS/GARAGE.PHP ***',
	'Shop' 							=> 'Winkel',
	'PROCESSING_ATTACH_ID' 			=> 'Verwerken attach_id: ',
	'REMOTE_IMAGE' 					=> 'Gelinkte afbeelding: ',
	'FILE_NAME' 					=> 'bestandsnaam: ',
	'TEMP_FILE_NAME' 				=> 'tmp_file_name: ',
	'REBUILT' 						=> 'Opnieuw gedaan: ',
	'THUMB_FILE' 					=> 'Thumb file: ',
	'SOURCE_FILE' 					=> 'Bronbestand: ',
	'FILE_DOES_NOT_EXIST' 			=> 'FOUT -- Gelinkt bestand bestaat niet!',
	'SOURCE_UNAVAILABLE' 			=> 'Opnieuw thumbnail aanmaken mislukt omndat het het bronbestand niet beschikbaar is: ',
	'NO_SOURCE_FILE' 				=> 'Het aanmaken van de volgende thumbnail is mislukt omdat er geen bronbestand is: ',
	'STARTED_AT' 					=> 'Begonnen bij: ',
	'ENDED_AT' 						=> 'Geeindigd bij: ',
	'HAVE_DONE' 					=> 'Totaal verwerkt: ',
	'NEED_TO_PROCESS' 				=> 'Totaal te verwerken aantal: ',
	'LOG_TO' 						=> 'Het logbestand word weggeschreven naar: ',
	'OUT_OF' 						=> 'van de',
	'KBYTES' 						=> 'kbytes',

	'PERMANENT' 					=> 'Permanent',
	'NON_PERMANENT'					=> 'Niet permanent',
	'ENABLE_WATERMARK'				=> 'Watermerk inschakelen',
	'ENABLE_WATERMARK_EXPLAIN'		=> 'Schakel het aanbrengen van watermerken van afbeeldingen in',
	'WATERMARK_TYPE'				=> 'Watermerk type',
	'WATERMARK_TYPE_EXPLAIN'		=> 'Permanent slaat het watermerk op in het originele bestand. Niet permanent laat het bestand in de originele staat.',
	'WATERMARK_SOURCE'				=> 'Watermerk bronbestand',
	'WATERMARK_SOURCE_EXPLAIN'		=> 'Bronbestand dat gebruikt word voor het watermerken',

//Categorieen
	'CREATE_CATEGORY'				=> 'Categorie aanmaken',
	'CATEGORY_SETTINGS'				=> 'Categorie instellingen',
	'CATEGORY_DELETE'				=> 'Categorie verwijderen',
	'CATEGORY_UPDATE'				=> 'Categorie bijwerken',
	'CATEGORY_DELETED'				=> 'Categorie verwijdert',
	'CATEGORY_UPDATED'				=> 'Categorie bijgewerkt',
	'CATEGORY_DELETE_EXPLAIN'		=> 'Hieronder kun je de categorie verwijderen. Tevens heb je de mogelijkheid om aan te geven waar de modificaties die in deze categorie staan naartoe verplaatst moeten worden.',
	'CATEGORY_UPDATE_EXPLAIN'		=> 'In dit venster kun je de gegevens van deze categorie aanpassen.',
	'CATEGORY_NAME'					=> 'Categorie naam',
	'DELETE_ALL_MODIFICATIONS'		=> 'Verwijder alle modificaties',
	'MOVE_MODIFICATIONS_TO'			=> 'Verplaats modificaties naar',
	'NO_DESTINATION_CATEGORY'		=> 'Geen bestemmingslocatie geselecteerd',
	'NO_CATEGORY'					=> 'Categorie bestaat niet',
	'CATEGORY_NAME_EMPTY'			=> 'Geen categorie naam opgegeven',
	'GARAGE_CAT_TITLE' 				=> 'Garage categorie&eumln beheer',
	'GARAGE_CAT_EXPLAIN' 			=> 'In dit venster kun je de categorie&eumln beheren: aanmaken, wijzigen, goedkeuren, afkeuren en verwijderen.',

	//QUOTA KEYS
	'QUOTA_TITLE'					=> 'Maximaal aantal beheer',
	'QUOTA_EXPLAIN'					=> 'Hieronder kun je instellen hoeveel voertuigen en afbeeldingen een gebruiker maximaal mag hebben.<br /><br />Standaard aantallen zijn de aantallen die betrekking hebben op permissies die aan een gebruiker worden gegeven, tenzij ze in een groep zitten die hieronder staat weergegeven.',
	'GROUP_QUOTA_EXPLAIN'			=> 'Hieronder worden alleen de groepen weergegeven die rechten hebben om items in de garage aan te maken waarop de in te stellen aantallen van toepassing zijn. Als een groep waarvan je de in te stellen aantallen wil wijzigen niet in de onderstaande lijst voorkomt, moet je de groep eerst in het permissies beheer de juiste rechten te geven.',
	'REMOTE'						=> 'Gelinkt',
	'UPLOADED'						=> 'Geuploade',
	'DEFAULT_QUOTA'					=> 'Standaard aantal',
	'GROUP_QUOTA'					=> 'Groeps aantal',
	'VEHICLE_QUOTA'					=> 'Maximaal aantal voertuigen',
	'UPLOAD_IMAGE_QUOTA'			=> 'Maximaal aantal geuploade afbeeldingen',
	'REMOTE_IMAGE_QUOTA'			=> 'Maximaal aantal gelinkte afbeeldingen',
	'ENABLE_GROUP_VEHICLE_QUOTA'	=> 'Voertuigen limiet inschakelen',
	'ENABLE_GROUP_IMAGES_QUOTA'		=> 'Afbeeldingen limiet inschakelen',
	'QUOTAS_UPDATED'				=> 'De limieten zijn bijgewerkt',
	'EMPTY_DEFAULT_QUOTA'			=> 'Er is geen standaard aantal opgegeven voor alle waarden',
	'EMPTY_GROUP_VEHICLE_QUOTA'		=> 'Het maximaal aantal voertuigen is niet opgegeven voor een geselecteerde groep.',
	'EMPTY_GROUP_IMAGE_QUOTA'		=> 'Het maximaal aantal afbeeldingen is niet opgegeven voor een geselecteerde groep.',

//Hulpmiddelen
	'TOOLS_TITLE' 					=> 'Garage hulpmiddelen beheer',
	'TOOLS_EXPLAIN' 				=> 'In dit venster kun je diverse garage hulpmiddelen uitvoeren.',
	'TOOLS_REBUILD' 				=> 'Alle thumbnails opnieuw aanmaken',
	'TOOLS_IMAGES_PER_CYCLE' 		=> 'Afbeeldingen per cyclus',
	'TOOLS_IMAGES_PER_CYCLE_EXPLAIN'=> 'Het aantal afbeeldingen dat verwerkt word per cylus om zo de CPU belasting te verminderen.',
	'TOOLS_CREATE_LOG' 				=> 'Logbestand aanmaken',
	'TOOLS_CREATE_LOG_EXPLAIN' 		=> 'Maak een gedetaileerd logbestand aan van de uitgevoerde actie.',
	'TOOLS_ORPHANED_TITLE' 			=> 'Vind/verwijder afbeelding weesbestanden',
	'TOOLS_ORPHANED_EXPLAIN' 		=> 'Dit hulpmiddel localiseerd afbeeldingen die de garage ooit heeft aangemaakt maar waarnaar niet meer naar gelinkt word. Deze weestbestanden kunnen het gevolg zijn van handmatige wijzigingen in de database, na het gebruik van een rebuilt tool of na een ingrijpende upgrade van de garage. Onder normale omstandigheden zouden er geen weesbestanden moeten zijn.<br /><br />De eerste stap van dit hulpmiddel is alleen zoeken naar de aanwezigheid van weesbestanden, hierop word nog geen actie uitgevoerd totdat je verder gaat met de daarop volgende stap.',
	'PER_CYCLE' 					=> 'Per cyclus',
	'TOOLS_LOG_FILE' 				=> 'Bestandsnaam logfile',
	'TOOLS_LOG_FILE_EXPLAIN' 		=> 'Bestandsnaam van de gedetaileerde logfile die word aangemaakt.',


	//BUSINESS KEYS
	'GARAGE_BUSINESS_TITLE' 		=> 'Garage bedrijven beheer',
	'GARAGE_BUSINESS_EXPLAIN' 		=> 'In dit venster kun je de bedrijven beheren: aanmaken, wijzigen, verwijderen.',
	'EDIT_BUSINESS'					=> 'Bewerk bedrijf',
	'CREATE_BUSINESS'				=> 'Bedrijf aanmaken',
	'BUSINESS_CREATED'				=> 'Bedrijf aangemaakt',
	'BUSINESS_UPDATE'				=> 'Bedrijf bijwerken',
	'BUSINESS_UPDATE_EXPLAIN'		=> 'In dit venster kun je de gegevens van dit bedrijf aanpassen.',
	'BUSINESS_UPDATED'				=> 'Bedrijf bijgewerkt',
	'BUSINESS_DELETE'				=> 'Verwijder bedrijf',
	'BUSINESS_DELETE_EXPLAIN'		=> 'Hieronder kun je het bedrijf verwijderen. Tevens heb je de mogelijkheid om aan te geven waar de hieraan gelinkte items naartoe verplaatst moeten worden. Als een bedrijf aan meerdere item soorten is gelinkt krijg je meerdere opties.',
	'BUSINESS_DELETED'				=> 'Bedrijf verwijdert',
	'BUSINESS_SETTINGS'				=> 'Instellingen bedrijven',
	'BUSINESS_NAME' 				=> 'Naam bedrijf',
	'BUSINESS_ADDRESS'				=> 'Adres',
	'BUSINESS_TELEPHONE'			=> 'Telefoon nummer',
	'BUSINESS_FAX'					=> 'Fax nummer',
	'BUSINESS_WEBSITE'				=> 'Website',
	'BUSINESS_EMAIL'				=> 'Email',
	'BUSINESS_OPENING_HOURS'		=> 'Openingstijden',
	'BUSINESS_TYPE'					=> 'Soort',
	'BUSINESS_NAME_EMPTY'			=> 'Naam bedrijf is leeg...',
	'INSURANCE'						=> 'Verzekeraar',
	'GARAGE'						=> 'Garage',
	'RETAIL'						=> 'Winkel',
	'PRODUCT_MANUFACTURER'			=> 'Produkt fabrikant',
	'MANUFACTURER'					=> 'Fabrikant',
	'DYNOCENTRE'					=> 'Dynocentrum',
	'DELETE_ALL_PREMIUMS'			=> 'Verwijder alle premies',
	'MOVE_PREMIUMS_TO'				=> 'Verplaats alle premies naar',
	'DELETE_ALL_DYNORUNS'			=> 'Verwijder alle dynoruns',
	'MOVE_DYNORUNS_TO'				=> 'Verplaats dynoruns naar',
	'DELETE_BOUGHT_MODIFICATIONS'	=> 'Verwijder modificaties die gekocht zijn bij dit bedrijf',
	'DELETE_INSTALLED_MODIFICATIONS'=> 'Verwijder modificaties die geinstalleerd zijn bij dit bedrijf',
	'DELETE_MADE_MODIFICATIONS'		=> 'Verwijder modificaties die gemaakt zijn door dit bedrijf',

//Merken & modellen
	'MODELS_TITLE' 					=> 'Garage Merken &amp Modellen beheer',
	'MODELS_EXPLAIN' 				=> 'Hieronder kun je je merken en modellen toevoegen, wijzigen, goedkeuren, afkeuren en verwijderen.',
	'CREATE_MAKE'					=> 'Merk aanmaken',
	'CREATE_MODEL'					=> 'Model aanmaken',
	'MAKE_INDEX'					=> 'Merken overzicht',
	'DELETE_ALL_VEHICLES'			=> 'Verwijder alle modellen en voertuigen',
	'MAKE'							=> 'Merk',
	'MAKE_DELETE'					=> 'Verwijder merk',
	'MAKE_DELETED'					=> 'Merk verwijdert',
	'MAKE_DELETE_EXPLAIN'			=> 'Hieronder kun je het merk verwijderen. Tevens heb je de mogelijkheid om aan te geven waar de hieraan gelinkte items naartoe verplaatst moeten worden.',
	'MOVE_VEHICLES_TO'				=> 'Verplaats alle modellen en voertuigen naar',
	'MODEL'							=> 'Model',
	'MODEL_DELETE'					=> 'Verwijder model',
	'MODEL_DELETED'					=> 'Model verwijdert',
	'MODEL_DELETE_EXPLAIN'			=> 'Hieronder kun je het model verwijderen. Tevens heb je de mogelijkheid om aan te geven waar de hieraan gelinkte items naartoe verplaatst moeten worden.',
	'MAKE_EXISTS'					=> 'Merk bestaat al reeds',
	'MODEL_EXISTS'					=> 'Het model van dit merk bestaat al reeds',
	'MAKE_NAME_EMPTY'				=> 'Geen merknaam opgegeven',
	'MODEL_NAME_EMPTY'				=> 'Geen modelnaam opgegeven',
	'MAKE_UPDATE'					=> 'Merk bijwerken',
	'MAKE_UPDATED'					=> 'Merk bijgewerkt',
	'MAKE_UPDATE_EXPLAIN'			=> 'Hieronder kun je de gegevens van dit merk wijzigen.',
	'MAKE_SETTINGS'					=> 'Instellingen merken',
	'MODEL_UPDATE'					=> 'Model bijwerken',
	'MODEL_UPDATED'					=> 'Model bijgewerkt',
	'MODEL_UPDATE_EXPLAIN'			=> 'Hieronder kun je de gegevens van dit model wijzigen.',
	'MODEL_SETTINGS'				=> 'Instellingen model',

//Producten
	'MANUFACTURER_TITLE'			=> 'Garage produkt beheer',
	'MANUFACTURER_EXPLAIN'			=> 'Hieronder kun je je merken en modellen toevoegen, wijzigen en verwijderen. Fabrikanten zijn bedrijven en worden dus beheerd via het bedrijven beheer.',
	'MANUFACTURER_INDEX'			=> 'Lijst fabrikanten',
	'CREATE_PRODUCT'				=> 'Produkt aanmaken',
	'PRODUCTS_TITLE'				=> 'Garage produkt beheer',
	'PRODUCT_EXPLAIN'				=> 'Hieronder kun je je Producten toevoegen, wijzigen, goedkeuren, afkeuren en verwijderen.',
	'PRODUCT_SETTINGS'				=> 'Instellingen Producten',
	'PRODUCT'						=> 'Produkt',
	'PRODUCT_CREATED'				=> 'Produkt aangemaakt',
	'PRODUCT_UPDATED'				=> 'Produkt bijgewerkt',
	'PRODUCT_UPDATE'				=> 'Produkt bijwerken',
	'PRODUCT_UPDATE_EXPLAIN'		=> 'Hieronder kun je de gegevens van het produkt wijzigen.',
	'CATEGORY'						=> 'Categorie',
	'SELECT_CATEGORY'				=> 'Selecteer een categorie',
	'SELECT_MANUFACTURER'			=> 'Selecteer fabrikant',
	'PRODUCT_DELETE'				=> 'Produkt verwijderen',
	'PRODUCT_DELETED'				=> 'Produkt verwijdert',
	'PRODUCT_DELETE_EXPLAIN'		=> 'Hieronder kun je het produkt verwijderen. Tevens heb je de mogelijkheid om aan te geven waar de hieraan gelinkte items naartoe verplaatst moeten worden.',


//Circuits
	'GARAGE_TRACK_TITLE'			=> 'Garage circuit beheer',
	'CREATE_TRACK'					=> 'Circuit aanmaken',
	'GARAGE_TRACK_EXPLAIN'			=> 'Hieronder kun je je circuits toevoegen, wijzigen, goedkeuren, afkeuren en verwijderen.',
	'TRACK_UPDATE'					=> 'Circuit bijwerken',
	'TRACK_UPDATE_EXPLAIN'			=> 'Hieronder kun je de gegevens van het circuit wijzigen.',
	'TRACK_SETTINGS'				=> 'Instellingen circuits',
	'TRACK_NAME'					=> 'Naam circuit',
	'TRACK_LENGTH'					=> 'Lengte',
	'SELECT_MILEAGE_UNIT'			=> 'Selecteer eenheid',
	'TRACK_DELETE'					=> 'Verijder circuit',
	'TRACK_DELETE_EXPLAIN'			=> 'Hieronder kun je het circuit verwijderen. Tevens heb je de mogelijkheid om aan te geven waar de hieraan gelinkte items naartoe verplaatst moeten worden.',
	'DELETE_ALL_LAPS'				=> 'Verwijder alle rondetijden',
	'MOVE_LAPS_TO'					=> 'Verplaats rondetijden naar',
	'TRACK_CREATED'					=> 'Circuit aangemaakt',
	'TRACK_UPDATED'					=> 'Circuit bijgewerkt',
	'TRACK_NAME_EMPTY'				=> 'De naam van het circuit is leeg.',
	'TRACK_DELETED'					=> 'Circuit verwijdert',
	''								=> '',

//
	'GARAGE_CUSTOM_FIELDS'			=> 'Garage custom fields *** ONBEKEND IN MODS/GARAGE.PHP ***',

	'ACP_MANAGE_QUOTAS'				=> 'Maximaal aantal beheer',
	'ACP_MANAGE_BUSINESS' 			=> 'Bedrijven configuratie',
	'ACP_MANAGE_CATEGORY'			=> 'Categorie&eumln beheer',
	'ACP_MANAGE_PRODUCTS'			=> 'Producten beheer',
	'ACP_MANAGE_TRACKS'				=> 'Circuit beheer',
	'ACP_MANAGE_CATEGORY'			=> 'Beheer categorie&eumln',
	'ACP_MANAGE_MAKES_MODELS'		=> 'Merken &amp Modellen beheer',

	//Added For B4
	'DEFAULT_MAKE' 						=> 'Standaard merk ID',
	'DEFAULT_MAKE_EXPLAIN'				=> 'Geeft standaard het merk weer dat dit ID nummer heeft.',
	'DEFAULT_MODEL' 					=> 'Standaard model ID',
	'DEFAULT_MODEL_EXPLAIN' 			=> 'Geeft standaard het model weer dat dit ID nummer heeft.',
	'VEHICLES_PER_PAGE_EXPLAIN' 		=> 'Het aantal voertuigen dat getoond word op een pagina.',
	'ENABLE_TOP_LAP' 					=> 'Snelste rondetijd inschakelen',
	'ENABLE_TOP_LAP_EXPLAIN'			=> 'Toon het \'Snelste rondetijd\' blok op de indexpagina.',
	'TOP_LAP_LIMIT' 					=> 'Snelste rondetijd limiet',
	'TOP_LAP_LIMIT_EXPLAIN' 			=> 'Het aantal voertuigen dat word weergegeven in het \'Snelste rondetijd\' blok.',
	'ACP_GARAGE_SERVICE_CONFIG' 		=> 'Service configuratie',
	'ACP_GARAGE_BLOG_CONFIG' 			=> 'Blog configuratie',
	'ENABLE_SERVICE' 					=> 'Service inschakelen',
	'ENABLE_SERVICE_EXPLAIN' 			=> 'Service inschakelen',
	'ENABLE_BLOG' 						=> 'Blog inschakelen',
	'ENABLE_BLOG_EXPLAIN' 				=> 'Dit geeft gebruikers de mogelijkheid om een blog toe te voegen aan hun voertuigen.',
	'ENABLE_BLOG_BBCODE' 				=> 'Blog BBCode inschakelen',
	'ENABLE_BLOG_BBCODE_EXPLAIN' 		=> 'Dit geeft gebruikers de mogelijkheid om BBCodes te gebruiken in een blog.',
	'EDIT_PRODUCT'						=> 'Produkt bewerken',
	'EDIT_TRACK'						=> 'Circuit bijwerken',
	'ADD_INSURANCE' 					=> 'Verzekering toevoegen',
	'GARAGE_ORPHANS_TITLE' 				=> 'Garage weesbestanden locator',
	'GARAGE_ORPHANS_EXPLAIN' 			=> 'Hieronder staan alle gevonden weesbestanden. Een weesbestand is een bestand dat bestaat op de server maar niet meer voorkomt in de database.<br />Vink alle weesbestanden aan die je wil verwijderen.<br /><br /><b>Deze actie kan <u>niet</u> ongedaan gemaakt worden!  Als je eenmaal een weesbestand hebt verwijdert is het voorgoed verdwenen.</b>',
	'REMOVE_SELECTED_ORPHANS' 			=> 'Verwijder geselecteerde weesbestanden.',
	'MOVE_PRODUCT_TO'					=> 'Verplaats Producten naar',
	'DELETE_MADE_PRODUCTS'				=> 'Verwijder producten gemaakt door dit bedrijf. (Opmerking: Verwijdert gelinkte modificaties)',
	'ENABLE_BLOG_SMILIES' 				=> 'Blog Smilies inschakelen',
	'ENABLE_BLOG_SMILIES_EXPLAIN' 		=> 'Het gebruik van smilies in blogs inschakelen.',
	'ENABLE_BLOG_URL' 					=> 'URL parsing inschakelen',
	'ENABLE_BLOG_URL_EXPLAIN' 			=> 'Het ontleden van URL in blogs inschakelen.',
	'ENABLE_MAKE_APPROVAL' 				=> 'Merk goedkeuring inschakelen',
	'ENABLE_MAKE_APPROVAL_EXPLAIN' 		=> 'Nieuwe merken hebben goedkeuring nodig van een moderater voordat ze worden toegevoegd aan de lijst.',
	'ENABLE_MODEL_APPROVAL' 			=> 'Model goedkeuring inschakelen',
	'ENABLE_MODEL_APPROVAL_EXPLAIN'		=> 'Nieuwe modellen hebben goedkeuring nodig van een moderater voordat ze worden toegevoegd aan de lijst.',
	'ENABLE_GUESTBOOK_SMILIES' 			=> 'Gastenboek smilies inschakelen',
	'ENABLE_GUESTBOOK_SMILIES_EXPLAIN' 	=> 'Het gebruik van smilies in gastenboek commentaren inschakelen.',
	'ENABLE_GUESTBOOK_URL' 				=> 'URL parsing inschakelen',
	'ENABLE_GUESTBOOK_URL_EXPLAIN' 		=> 'Het ontleden van URL in het gastenboek inschakelen.',
));

?>
