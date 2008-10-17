<?php
/** 
*
* acp_garage [Greek]
*
* @package language
* @version $Id: garage.php 588 2008-10-10 chrizathens $
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
	'ACP_GARAGE_SETTINGS'						=> 'Γενικές Ρυθμίσεις',
	'ACP_GARAGE_SETTINGS_EXPLAIN'				=> 'Ρυθμίσεις Γκαράζ phpBB',
	'ACP_GARAGE_GENERAL_CONFIG' 				=> 'Γενικές ρυθμίσεις',
	'ACP_GARAGE_MENU_CONFIG' 					=> 'Ρυθμίσεις μενού',
	'ACP_GARAGE_INDEX_CONFIG' 					=> 'Ρυθμίσεις αρχικής σελίδας',
	'ACP_GARAGE_IMAGE_CONFIG' 					=> 'Ρυθμίσεις εικόνων',
	'ACP_GARAGE_QUARTERMILE_CONFIG' 			=> 'Ρυθμίσεις χρόνου 0-400μ.',
	'ACP_GARAGE_DYNORUN_CONFIG' 				=> 'Ρυθμίσεις δυναμομετρήσεων',
	'ACP_GARAGE_TRACK_CONFIG'					=> 'Ρυθμίσεις χρόνου πίστας',
	'ACP_GARAGE_INSURANCE_CONFIG' 				=> 'Ρυθμίσεις Ασφαλειών',
	'ACP_GARAGE_BUSINESS_CONFIG' 				=> 'Ρυθμίσεις επιχειρήσεων',
	'ACP_GARAGE_VEHICLE_RATING_CONFIG'			=> 'Ρυθμίσεις αξιολόγησης οχημάτων',
	'ACP_GARAGE_GUESTBOOK_CONFIG'				=> 'Ρυθμίσεις Guestbook',
	'ACP_GARAGE_PRODUCT_CONFIG'					=> 'Ρυθμίσεις προϊόντων',
	'ENABLE_QUARTERMILE' 						=> 'Ενεργοποίηση χρόνου 0-400μ.',
	'ENABLE_QUARTERMILE_EXPLAIN' 				=> 'Αυτό θα επιτρέπει στα μέλη να προσθέτουν δεδομένα για χρόνο 0-400μ. στα οχήματά τους',
	'ENABLE_QUARTERMILE_APPROVAL' 				=> 'Έγκριση χρόνου 0-400μ.',
	'ENABLE_QUARTERMILE_APPROVAL_EXPLAIN' 		=> 'Αυτό θα απαιτεί να εγκριθούν πρώτα οι χρόνοι 0-400μ. πριν εμφανιστούν στον πίνακα του Γκαράζ.',
	'ENABLE_QUARTERMILE_IMAGE_REQUIRED' 		=> 'Απαιτείται εικόνα για το χρόνο 0-400μ.',
	'ENABLE_QUARTERMILE_IMAGE_REQUIRED_EXPLAIN' => 'Αυτό θα απαιτεί όλοι οι χρόνοι κάτω από ένα όριο να απαιτούν και την ύπαρξη εικόνας.',
	'QUARTERMILE_IMAGE_REQUIRED_LIMIT' 			=> 'Όριο για απαίτηση εικόνας για το χρόνο 0-400μ.',
	'QUARTERMILE_IMAGE_REQUIRED_LIMIT_EXPLAIN' 	=> 'Αυτός είναι ο χρόνος για 0-400μ. κάτω από τον οποίο θα απαιτείται να ανέβει και μια εικόνα για την υποβολή στο Γκαράζ.',
	'ENABLE_DYNORUN' 							=> 'Ενεργοποίηση Δυναμομετρήσεων',
	'ENABLE_DYNORUN_EXPLAIN' 					=> 'Αυτό θα επιτρέπει στα μέλη να προσθέτουν δυναμομέτρηση στα οχήματά τους',
	'ENABLE_DYNORUN_APPROVAL' 					=> 'Έγκριση δυναμομέτρησης',
	'ENABLE_DYNORUN_APPROVAL_EXPLAIN' 			=> 'Αυτό θα απαιτεί να εγκριθούν πρώτα οι δυναμομετρήσεις πριν εμφανιστούν στον πίνακα του Γκαράζ.',
	'ENABLE_DYNORUN_IMAGE_REQUIRED' 			=> 'Απαιτείται εικόνα για τη δυναμομέτρηση',
	'ENABLE_DYNORUN_IMAGE_REQUIRED_EXPLAIN' 	=> 'Αυτό θα απαιτεί όλες οι δυναμομετρήσεις πάνω από ένα όριο να απαιτούν και εικόνα.',
	'DYNORUN_IMAGE_REQUIRED_LIMIT' 				=> 'Όριο για απαίτηση εικόνας για τη δυναμομέτρηση',
	'DYNORUN_IMAGE_REQUIRED_LIMIT_EXPLAIN' 		=> 'Αυτή είναι η ιπποδύναμη πάνω από την οποία θα απαιτείται εικόνα ώστε να υποβληθεί η δυναμομέτρηση στο Γκαράζ.',
	'ENABLE_INSURANCE' 							=> 'Ενεργοποίηση Ασφαλειών',
	'ENABLE_INSURANCE_EXPLAIN' 					=> 'Αυτό θα επιτρέπει στα μέλη να προσθέτουν δεδομένα για την ασφάλιση των οχημάτων τους',
	'ENABLE_INSURANCE_SEARCH' 					=> 'Ενεργοποίηση αναζήτησης στις ασφάλειες',
	'ENABLE_INSURANCE_SEARCH_EXPLAIN' 			=> 'Αυτό θα επιτρέπει την ύπαρξη αναζήτησης στα δεδομένα ασφάλισης.',
	'BUSINESS_APPROVAL' 						=> 'Οι επιχειρήσεις χρειάζονται έγκριση',
	'BUSINESS_APPROVAL_EXPLAIN' 				=> 'Αυτό θα απαιτεί οι επιχειρήσεις που προστίθονται να εγκριθούν πρώτα από κάποιον συντονιστή ή διαχειριστή πριν εμφανιστούν.',
	'RATING_PERMANENT' 							=> 'Μόνιμες αξιολογήσεις',
	'RATING_PERMANENT_EXPLAIN' 					=> 'Σας επιτρέπει να ορίσετε ότι η αρχική αξιολόγηση δεν θα μπορεί να αλλαχτεί.',
	'RATING_ALWAYS_UPDATEABLE' 					=> 'Αξιολογήσεις μπορούν να ενημερωθούν',
	'RATING_ALWAYS_UPDATEABLE_EXPLAIN' 			=> 'Αν οι αξιολογήσεις δεν είναι μόνιμες, αυτό σας επιτρέπει να ορίσετε αν οι αξιολογήσεις μπορούν να αλλάξουν οποιαδήποτε στιγμή, ή μόνο αν το όχημα έχει ενημερωθεί μετά από την τελευταία αξιολόγηση.',
	'RATING_MINIMUM_REQUIRED' 					=> 'Ελάχιστες απαιτούμενες αξιολογήσεις',
	'RATING_MINIMUM_REQUIRED_EXPLAIN' 			=> 'Το ελάχιστο νούμερο των απαιτούμενων αξιολογήσεων.',
	'ENABLE_IMAGES' 							=> 'Ενεργοποίηση εικόνων',
	'ENABLE_IMAGES_EXPLAIN' 					=> 'Ενεργοποίηση εικόνων ώστε να χρησιμοποιούνται σαν κουμπιά στο Γκαράζ.',
	'ENABLE_VEHICLE_IMAGES' 					=> 'Ενεργοποίηση εικόνων οχημάτων',
	'ENABLE_VEHICLE_IMAGES_EXPLAIN' 			=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν και εικόνες στα οχήματα.',
	'ENABLE_MODIFICATION_IMAGES' 				=> 'Ενεργοποίηση εικόνων μετατροπών',
	'ENABLE_MODIFICATION_IMAGES_EXPLAIN' 		=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν και εικόνες στις μετατροπές τους.',
	'ENABLE_QUARTERMILE_IMAGES' 				=> 'Ενεργοποίηση εικόνων χρόνου 0-400μ.',
	'ENABLE_QUARTERMILE_IMAGES_EXPLAIN' 		=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν και εικόνες στους χρόνους 0-400μ.',
	'ENABLE_DYNORUN_IMAGES' 					=> 'Ενεργοποίηση εικόνων δυναμομετρήσεων',
	'ENABLE_DYNORUN_IMAGES_EXPLAIN' 			=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν και εικόνες στις δυναμομετρήσεις.',
	'ENABLE_LAP_IMAGES' 						=> 'Ενεργοποίηση εικόνων γύρου πίστας',
	'ENABLE_LAP_IMAGES_EXPLAIN' 				=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν και εικόνες στους γύρους πίστας.',
	'ENABLE_UPLOADED_IMAGES' 					=> 'Ενεργοποίηση ανεβάσματος εικόνων',
	'ENABLE_UPLOADED_IMAGES_EXPLAIN' 			=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν και εικόνες στα αντικείμενα που επιτρέπεται.',
	'ENABLE_REMOTE_IMAGES' 						=> 'Ενεργοποίηση απομακρυσμένων εικόνων',
	'ENABLE_REMOTE_IMAGES_EXPLAIN' 				=> 'Αυτό θα επιτρέπει σε μέλη με τα ανάλογα δικαιώματα να προσθέτουν υπερσύνδεσμο για εικόνες στα αντικείμενα που επιτρέπεται.',
	'REMOTE_TIMEOUT' 							=> 'Εξάντληση χρόνου στις απομακρυσμένες εικόνες',
	'REMOTE_TIMEOUT_EXPLAIN' 					=> 'Χρόνος σε δευτερόλεπτα που το Γκαράζ θα προσπαθεί να κατεβάσει κάποια απομακρυσμένη εικόνα και να δημιουργήσει μικρογραφία της.',
	'ENABLE_MODIFICATION_GALLERY' 				=> 'Ενεργοποίηση φωτοθήκης Μετατροπών',
	'ENABLE_MODIFICATION_GALLERY_EXPLAIN' 		=> 'Αυτό θα εμφανίζει ένα σύνολο από εικόνες μετατροπών κατά την προβολή του οχήματος.',
	'ENABLE_QUARTERMILE_GALLERY' 				=> 'Ενεργοποίηση φωτοθήκης Χρόνου 0-400μ.',
	'ENABLE_QUARTERMILE_GALLERY_EXPLAIN' 		=> 'Αυτό θα εμφανίζει ένα σύνολο από εικόνες χρόνου 0-400μ. κατά την προβολή του οχήματος.',
	'ENABLE_DYNORUN_GALLERY' 					=> 'Ενεργοποίηση φωτοθήκης Δυναμομετρήσεων',
	'ENABLE_DYNORUN_GALLERY_EXPLAIN' 			=> 'Αυτό θα εμφανίζει ένα σύνολο από εικόνες δυναμομετρήσεων κατά την προβολή του οχήματος.',
	'ENABLE_LAP_GALLERY'	 					=> 'Ενεργοποίηση φωτοθήκης Γύρου πίστας',
	'ENABLE_LAP_GALLERY_EXPLAIN'	 			=> 'Αυτό θα εμφανίζει ένα σύνολο από εικόνες γύρου πίστας κατά την προβολή του οχήματος.',
	'GALLERY_LIMIT' 							=> 'Όριο Φωτοθήκης',
	'GALLERY_LIMIT_EXPLAIN' 					=> 'Όριο στον αριθμό των εικόνων που θα εμφανίζεται σε κάθε ενεργοποιημένη φωτοθήκη.',
	'IMAGE_MAX_SIZE' 							=> 'Μέγιστο Μέγεθος εικόνας',
	'IMAGE_MAX_SIZE_EXPLAIN' 					=> 'Το μέγιστο μέγεθος σε kilobytes για ανέβασμα εικόνας.',
	'IMAGE_MAX_RESOLUTION' 						=> 'Μέγιστη Ανάλυση εικόνας',
	'IMAGE_MAX_RESOLUTION_EXPLAIN' 				=> 'Η μέγιστη ανάλυση σε πίξελ για ανέβασμα εικόνας.',
	'THUMBNAIL_RESOLUTION' 						=> 'Ανάλυση Μικρογραφιών',
	'THUMBNAIL_RESOLUTION_EXPLAIN'				=> 'Η ανάλυση των δημιουργημένων μικρογραφιών.',
	'ENABLE_BROWSE_MENU' 						=> 'Ενεργοποίηση Μενού περιήγησης',
	'ENABLE_BROWSE_MENU_EXPLAIN' 				=> 'Η επιλογή για περιήγηση θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_SEARCH_MENU' 						=> 'Ενεργοποίηση Μενού αναζήτησης',
	'ENABLE_SEARCH_MENU_EXPLAIN' 				=> 'Η επιλογή για αναζήτηση θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_INSURANCE_REVIEW_MENU' 				=> 'Ενεργοποίηση επισκόπησης Ασφαλειών',
	'ENABLE_INSURANCE_REVIEW_MENU_EXPLAIN' 		=> 'Η επιλογή για επισκόπηση ασφαλειών θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_GARAGE_REVIEW_MENU' 				=> 'Ενεργοποίηση επισκόπησης Γκαράζ',
	'ENABLE_GARAGE_REVIEW_MENU_EXPLAIN' 		=> 'Η επιλογή για επισκόπηση του Γκαράζ θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_SHOP_REVIEW_MENU' 					=> 'Ενεργοποίηση επισκόπησης καταστημάτων',
	'ENABLE_SHOP_REVIEW_MENU_EXPLAIN' 			=> 'Η επιλογή για επισκόπηση των καταστημάτων θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_QUARTERMILE_MENU' 					=> 'Ενεργοποίηση Μενού Χρόνου 0-400μ.',
	'ENABLE_QUARTERMILE_MENU_EXPLAIN' 			=> 'Η επιλογή για το χρόνο 0-400μ. θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_DYNORUN_MENU' 						=> 'Ενεργοποίηση μενού δυναμομετρήσεων',
	'ENABLE_DYNORUN_MENU_EXPLAIN' 				=> 'Η επιλογή για τον πίνακα δυναμομετρήσεων θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_LAP_MENU' 							=> 'Ενεργοποίηση μενού γύρου πίστας',
	'ENABLE_LAP_MENU_EXPLAIN' 					=> 'Η επιλογή για τον τον γύρο πίστας θα εμφανίζεται στο κεντρικό μενού.',
	'ENABLE_GARAGE_HEADER' 						=> 'Ενεργοποίηση Γκαράζ στην κεφαλίδα',
	'ENABLE_GARAGE_HEADER_EXPLAIN' 				=> 'Η επιλογή για το Γκαράζ θα εμφανίζεται στην κεφαλίδα του φόρουμ.',
	'ENABLE_QUARTERMILE_HEADER' 				=> 'Ενεργοποίηση χρόνου 0-400μ. στην κεφαλίδα',
	'ENABLE_QUARTERMILE_HEADER_EXPLAIN' 		=> 'Η επιλογή για το χρόνο 0-400μ. θα εμφανίζεται στην κεφαλίδα του φόρουμ.',
	'ENABLE_DYNORUN_HEADER' 					=> 'Ενεργοποίηση Δυναμομετρήσεων στην κεφαλίδα',
	'ENABLE_DYNORUN_HEADER_EXPLAIN' 			=> 'Η επιλογή για τον πίνακα δυναμομετρήσεων θα εμφανίζεται στην κεφαλίδα του φόρουμ.',
	'ENABLE_FEATURED_VEHICLE' 					=> 'Ενεργοποίηση προβαλλόμενου οχήματος',
	'ENABLE_FEATURED_VEHICLE_EXPLAIN' 			=> 'Ένα όχημα θα εμφανίζεται στην αρχική του Γκαράζ. Το όχημα θα επιλέγεται με βάση τα παρακάτω κριτήρια.',
	'ENABLE_NEWEST_VEHCILE' 					=> 'Ενεργοποίηση νεώτερων οχημάτων', 
	'ENABLE_NEWEST_VEHCILE_EXPLAIN' 			=> 'Εμφάνιση του πεδίου "Νεότερα Οχήματα" στην αρχική του Γκαράζ.', 
	'NEWEST_VEHICLE_LIMIT' 						=> 'Όριο για νεότερα οχήματα',
	'NEWEST_VEHICLE_LIMIT_EXPLAIN' 				=> 'Ο αριθμός των νεότερων οχημάτων που θα εμφανίζεται στο πεδίο "Νεότερα Οχήματα".',
	'ENABLE_UPDATED_VEHICLE' 					=> 'Ενεργοποίηση ενημερωμένων οχημάτων',
	'ENABLE_UPDATED_VEHICLE_EXPLAIN' 			=> 'Εμφάνιση του πεδίου "Ενημερωμένα Οχήματα" στην αρχική του Γκαράζ.',
	'UPDATED_VEHICLE_LIMIT' 					=> 'Όριο για ενημερωμένα οχήματα',
	'UPDATED_VEHICLE_LIMIT_EXPLAIN' 			=> 'Ο αριθμός των ενημερωμένων οχημάτων που θα εμφανίζεται στο πεδίο "Ενημερωμένα Οχήματα".',
	'ENABLE_NEWEST_MODIFICATION' 				=> 'Ενεργοποίηση νεότερων μετατροπών',
	'ENABLE_NEWEST_MODIFICATION_EXPLAIN' 		=> 'Εμφάνιση του πεδίου "Νεότερες Μετατροπές" στην αρχική του Γκαράζ.',
	'NEWEST_MODIFICATION_LIMIT' 				=> 'Όριο για νεότερες μετατροπές',
	'NEWEST_MODIFICATION_LIMIT_EXPLAIN' 		=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Νεότερες Μετατροπές".',
	'ENABLE_UPDATED_MODIFICATION' 				=> 'Ενεργοποίηση ενημερωμένων μετατροπών',
	'ENABLE_UPDATED_MODIFICATION_EXPLAIN' 		=> 'Εμφάνιση του πεδίου "Ενημερωμένες Μετατροπές" στην αρχική του Γκαράζ.',
	'UPDATED_MODIFICATION_LIMIT' 				=> 'Όριο για ενημερωμένες μετατροπές',
	'UPDATED_MODIFICATION_LIMIT_EXPLAIN' 		=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Ενημερωμένες Μετατροπές".',
	'ENABLE_MOST_MODIFIED' 						=> 'Ενεργοποίηση περισσότερων μετατροπών',
	'ENABLE_MOST_MODIFIED_EXPLAIN' 				=> 'Εμφάνιση του πεδίου "Περισσότερες Μετατροπές" στην αρχική του Γκαράζ.',
	'MOST_MODIFIED_LIMIT' 						=> 'Όριο για περισσότερες μετατροπές',
	'MOST_MODIFIED_LIMIT_EXPLAIN' 				=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Περισσότερες Μετατροπές".',
	'ENABLE_MOST_SPENT' 						=> 'Ενεργοποίηση περισσότερα που ξοδεύτηκαν',
	'ENABLE_MOST_SPENT_EXPLAIN' 				=> 'Εμφάνιση του πεδίου "Περισσότερα χρήματα που ξοδεύτηκαν" στην αρχική του Γκαράζ.',
	'MOST_SPENT_LIMIT' 							=> 'Όριο για περισσότερα που ξοδεύτηκαν',
	'MOST_SPENT_LIMIT_EXPLAIN' 					=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Περισσότερα χρήματα που ξοδεύτηκαν".',
	'ENABLE_MOST_VIEWED' 						=> 'Ενεργοποίηση περισσότερες προβολές',
	'ENABLE_MOST_VIEWED_EXPLAIN' 				=> 'Εμφάνιση του πεδίου "Περισσότερες Προβολές" στην αρχική του Γκαράζ.',
	'MOST_VIEWED_LIMIT' 						=> 'Όριο για περισσότερες προβολές',
	'MOST_VIEWED_LIMIT_EXPLAIN' 				=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Περισσότερες Προβολές".',
	'ENABLE_LAST_COMMENTED' 					=> 'Ενεργοποίηση τελευταία σχολιασμένα',
	'ENABLE_LAST_COMMENTED_EXPLAIN' 			=> 'Εμφάνιση του πεδίου "Τελευταία σχολιασμένα" στην αρχική του Γκαράζ.',
	'LAST_COMMENTED_LIMIT' 						=> 'Όριο για τελευταία σχολιασμένα',
	'LAST_COMMENTED_LIMIT_EXPLAIN' 				=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Τελευταία σχολιασμένα".',
	'ENABLE_TOP_DYNORUN' 						=> 'Ενεργοποίηση Κορυφαίων δυναμομετρήσεων',
	'ENABLE_TOP_DYNORUN_EXPLAIN' 				=> 'Εμφάνιση του πεδίου "Κορυφαίες Δυναμομετρήσεις" στην αρχική του Γκαράζ.',
	'TOP_DYNORUN_LIMIT' 						=> 'Όριο για κορυφαίες δυναμομετρήσεις',
	'TOP_DYNORUN_LIMIT_EXPLAIN' 				=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Κορυφαίες Δυναμομετρήσεις".',
	'ENABLE_TOP_QUARTERMILE' 					=> 'Ενεργοποίηση Κορυφαίων χρόνων 0-400μ.',
	'ENABLE_TOP_QUARTERMILE_EXPLAIN' 			=> 'Εμφάνιση του πεδίου "Κορυφαίοι Χρόνοι 0-400μ." στην αρχική του Γκαράζ.',
	'TOP_QUARTERMILE_LIMIT' 					=> 'Όριο για κορυφαίοι χρόνοι 0-400μ.',
	'TOP_QUARTERMILE_LIMIT_EXPLAIN' 			=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Κορυφαίες Χρόνοι 0-400μ.".',
	'ENABLE_TOP_RATING' 						=> 'Ενεργοποίηση Κορυφαίων αξιολογήσεων',
	'ENABLE_TOP_RATING_EXPLAIN' 				=> 'Εμφάνιση του πεδίου "Κορυφαίες Αξιολογήσεις" στην αρχική του Γκαράζ.',
	'TOP_RATING_LIMIT' 							=> 'Όριο για κορυφαίες αξιολογήσεις', 
	'TOP_RATING_LIMIT_EXPLAIN' 					=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Κορυφαίες Αξιολογήσεις".', 
	'VEHICLES_PER_PAGE' 						=> 'Οχήματα ανά σελίδα',
	'VEHICLES_PER_PAGE_EXPLAIN' 				=> '',
	'YEAR_RANGE_BEGINNING' 						=> 'Αρχή περιοχής έτους', 
	'YEAR_RANGE_BEGINNING_EXPLAIN' 				=> 'Αυτό είναι το μικρότερο έτος που θέλετε να υπάρχει σαν επιλογή για ένα νέο όχημα. Μορφή ΕΕΕΕ', 
	'YEAR_RANGE_END' 							=> 'Τέλος περιοχής έτους',
	'YEAR_RANGE_END_EXPLAIN' 					=> 'Αριθμός ετών από το τρέχον έτος για το τελεταίο έτος που θέλετε να εμφανίζεται για ένα νέο όχημα. Ορίζοντας έναν θετικό ακέραιο αριθμό, το νούμερο θα προστεθεί στο τρέχον έτος. Ορίζοντας έναν αρνητικό ακέραιο αριθμό, το νούμερο θα αφαιρεθεί από το τρέχον έτος.',
	'USER_SUBMIT_MAKE' 							=> 'Υποβολή μάρκας από μέλη',
	'USER_SUBMIT_MAKE_EXPLAIN' 					=> 'Επιτρέπει στα μέλη να υποβάλλουν νέες μάρκες οχημάτων.',
	'USER_SUBMIT_MODEL' 						=> 'Υποβολή μοντέλων από μέλη',
	'USER_SUBMIT_MODEL_EXPLAIN' 				=> 'Επιτρέπει στα μέλη να υποβάλλουν νέα μοντέλα',
	'USER_SUBMIT_BUSINESS' 						=> 'Υποβολή επιχειρήσεων από μέλη',
	'USER_SUBMIT_BUSINESS_EXPLAIN' 				=> 'Επιτρέπει στα μέλη να υποβάλλουν νέες επιχειρήσεις',
	'ENABLE_LATESTMAIN_VEHICLE' 				=> 'Ενεργοποίηση Τελευταία οχήματα',
	'ENABLE_LATESTMAIN_VEHICLE_EXPLAIN' 		=> 'Ενεργοποίηση εμφάνισης του πεδίου "Τελευταία Ενημερωμένα Οχήματα" σε όλες τις σελίδες',
	'LATESTMAIN_VEHCILE_LIMIT' 					=> 'Όριο για Τελευταία οχήματα',
	'LATESTMAIN_VEHCILE_LIMIT_EXPLAIN' 			=> 'Ο αριθμός των οχημάτων που θα εμφανίζεται στο πεδίο "Τελευταία Ενημερωμένα Οχήματα" σε όλες τις σελίδες',
	'GARAGE_DATE_FORMAT' 						=> 'Μορφή Ημερομηνίας',
	'GARAGE_DATE_FORMAT_EXPLAIN' 				=> 'Η μορφή της ημερομηνίας που θα χρησιμοποιείται για την προβολή των οχημάτων στο Γκαράζ.',
	'PROFILE_INTEGRATION' 						=> 'Δημιουργία προφίλ',
	'PROFILE_INTEGRATION_EXPLAIN' 				=> 'Προβολή μικρογραφιών για όλες τις εικόνες του οχήματος αντί για την προβαλλόμενη εικόνα',
	'ENABLE_GUESTBOOK' 							=> 'Ενεργοποίηση Guestbook',
	'ENABLE_GUESTBOOK_EXPLAIN' 					=> 'Ενεργοποίηση του συστήματος guestbook, που θα επιτρέψει στα μέλη με τα σωστά δικαιώματα να υποβάλλουν σχόλια για οχήματα.',
	'FEATURED_VEHICLE_ID' 						=> 'ID Προβαλλόμενου οχήματος', 
	'FEATURED_VEHICLE_ID_EXPLAIN' 				=> 'Εισάγετε ένα ID οχήματος για να εμφανίζεται σαν προβαλλόμενο όχημα.', 
	'FEATURED_FROM_BLOCK' 						=> 'Προβαλλόμενο όχημα από πεδίο', 
	'FEATURED_FROM_BLOCK_EXPLAIN' 				=> 'Επιλέξτε ένα πεδίο της αρχικής σελίδας από το οποίο θα επιλεγεί το προβαλλόμενο όχημα. Η κορυφαία καταχώρηση θα είναι η προβαλλόμενη.', 
	'RANDOM'									=> 'Τυχαίο',
	'FROM_BLOCK'								=> 'Από πεδίο',
	'BY_VEHICLE_ID'								=> 'Από ID οχήματος',
	'FEATURED_VEHICLE_DESCRIPTION' 				=> 'Περιγραφή του προβαλλόμενου οχήματος',
	'FEATURED_VEHICLE_DESCRIPTION_EXPLAIN' 		=> 'Εισάγετε μια περιγραφή που θα φαίνεται για το προβαλλόμενο όχημα.',
	'INTEGRATE_MEMBERLIST' 						=> 'Ενσωμάτωση Λίστας μελών',
	'INTEGRATE_MEMBERLIST_EXPLAIN' 				=> 'Προβολή κουμπιού Γκαράζ για μέλη με οχήματα.',
	'INTEGRATE_PROFILE' 						=> 'Ενσωμάτωση προφίλ',
	'INTEGRATE_PROFILE_EXPLAIN' 				=> 'Προβολή πληροφοριών του κύριου οχήματος στο προφίλ του μέλους.',
	'INTEGRATE_VIEWTOPIC' 						=> 'Ενσωμάτωση στην προβολή απαντήσεων',
	'INTEGRATE_VIEWTOPIC_EXPLAIN' 				=> 'Προβολή συνδέσμου για το κύριο όχημα των μελών και κουμπί για το Γκαράζ για τα μέλη με οχήματα.',
	'PENDING_PM_NOTIFY' 						=> 'ΠΜ για αντικείμενα σε αναμονή',
	'PENDING_PM_NOTIFY_EXPLAIN' 				=> 'Μέλη που είναι εξουσιοδοτημένα να συντονίζουν το Γκαράζ, θα λαμβάνουν ΠΜ αν υπάρχουν αντικείμενα σε αναμονή για έγκριση.',
	'PENDING_EMAIL_NOTIFY' 						=> 'Email για αντικείμενα σε αναμονή',
	'PENDING_EMAIL_NOTIFY_EXPLAIN' 				=> 'Μέλη που είναι εξουσιοδοτημένα να συντονίζουν το Γκαράζ, θα λαμβάνουν Μυνήματα ηλετρ. Ταχυδρομείου αν υπάρχουν αντικείμενα σε αναμονή για έγκριση.',
	'PENDING_PM_NOTIFY_OPTOUT' 					=> 'Επιλογή ΠΜ για αντικείμενα σε αναμονή',
	'PENDING_PM_NOTIFY_OPTOUT_EXPLAIN' 			=> 'Μέλη που είναι εξουσιοδοτημένα να συντονίζουν το Γκαράζ, μπορούν να επιλέξουν μέσα από το προφίλ τους αν θέλουν να λαμβάνουν ΠΜ σε περίπτωση που υπάρχει κάποιο αντικείμενο σε αναμονή για έγκριση.',
	'PENDING_EMAIL_NOTIFY_OPTOUT' 				=> 'Επιλογή email για αντικείμενα σε αναμονή',
	'PENDING_EMAIL_NOTIFY_OPTOUT_EXPLAIN' 		=> 'Μέλη που είναι εξουσιοδοτημένα να συντονίζουν το Γκαράζ, μπορούν να επιλέξουν μέσα από το προφίλ τους αν θέλουν να λαμβάνουν Μύνημα Ηλ. Ταχυδρομείου σε περίπτωση που υπάρχει κάποιο αντικείμενο σε αναμονή για έγκριση.',
	'ENABLE_VEHICLE_APPROVAL' 					=> 'Ενεργοποίηση έγκρισης οχημάτων',
	'ENABLE_VEHICLE_APPROVAL_EXPLAIN' 			=> 'Τα οχήματα θα απαιτούν έγκριση από κάποιον συντονιστή πριν εμφανιστούν στο Γκαράζ.',
	'ENABLE_GUESTBOOK_COMMENT_APPROVAL' 		=> 'Ενεργοποίηση έγκρισης σχολίων του Guestbook',
	'ENABLE_GUESTBOOK_COMMENT_APPROVAL_EXPLAIN' => 'Τα σχόλια θα απαιτούν έγκριση από κάποιον συντονιστή πριν εμφανιστούν.',
	'GARAGE_INDEX_COLUMNS'						=> 'Στήλες στην αρχική σελίδα',
	'GARAGE_INDEX_COLUMNS_EXPLAIN'				=> 'Το νούμερο των στηλών που θα εμφανίζονται στην αρχική σελίδα.',
	'ENABLE_USER_INDEX_COLUMNS'					=> 'Ενεργοποίηση των στηλών για το μέλος',
	'ENABLE_USER_INDEX_COLUMNS_EXPLAIN'			=> 'Επιτρέπει στα μέλη να υπερπηδούν το προκαθορισμένο του πίνακα.',
	'ENABLE_GUESTBOOK_BBCODE'					=> 'Ενεργοποίηση BBCode στο Guestbook',
	'ENABLE_GUESTBOOK_BBCODE_EXPLAIN'			=> 'Επιτρέπει στα μέλη να χρησιμοποιούν BBCode όταν αφήνουν σχόλια στο guestbook.',
	'ENABLE_USER_SUBMIT_PRODUCT'				=> 'Υποβολή προϊόντων από μέλη',
	'ENABLE_USER_SUBMIT_PRODUCT_EXPLAIN'		=> 'Επιτρέπει στα μέλη να υποβάλλουν νέα προϊόντα.',
	'ENABLE_PRODUCT_APPROVAL' 					=> 'Ενεργοποίηση έγκρισης προϊόντων',
	'ENABLE_PRODUCT_APPROVAL_EXPLAIN' 			=> 'Τα προϊόντα θα πρέπει να εγκριθούν πρώτα από κάποιον συντονιστή πριν εμφανιστούν.',
	'ENABLE_PRODUCT_SEARCH' 					=> 'Ενεργοποίηση αναζήτησης προϊόντων',
	'ENABLE_PRODUCT_SEARCH_EXPLAIN' 			=> 'Να επιτρέπεται η αναζήτηση ανά προϊόν  &amp; κατασκευαστή.',


	'ENABLE_TRACKTIME'							=> 'Ενεργοποίηση Χρόνων πίστας',
	'ENABLE_TRACKTIME_EXPLAIN'					=> 'Ενεργοποίηση Χρόνων πίστας',
	'ENABLE_LAP_APPROVAL'						=> 'Ενεργοποίηση έγκρισης γύρου',
	'ENABLE_LAP_APPROVAL_EXPLAIN'				=> 'Ενεργοποιεί την ύπαρξη για έγκριση γύρου πίστας',
	'ENABLE_TRACK_APPROVAL'						=> 'Ενεργοποίηση έγκρισης πίστας',
	'ENABLE_TRACK_APPROVAL_EXPLAIN'				=> 'Ενεργοποίηση έγκρισης πίστας',
	'ENABLE_USER_ADD_LAP'						=> 'Υποβολή πιστών από μέλη',
	'ENABLE_USER_ADD_LAP_EXPLAIN' 				=> 'Ενεργοποίηση προσθήκης νέων πιστών από μέλη',


//LOG Messages Keys
	'LOG_GARAGE_CONFIG_GENERAL'					=> '<strong>Άλλαξε τις Γενικές Ρυθμίσεις του Γκαράζ</strong>',
	'LOG_GARAGE_CONFIG_MENU'					=> '<strong>Άλλαξε τις Ρυθμίσεις Μενού του Γκαράζ</strong>',
	'LOG_GARAGE_CONFIG_INDEX'					=> '<strong>Άλλαξε τις Ρυθμίσεις Αρχικής σελίδας του Γκαράζ</strong>',
	'LOG_GARAGE_CONFIG_IMAGES'					=> '<strong>Άλλαξε τις Ρυθμίσεις Εικόνων του Γκαράζ</strong>',
	'LOG_GARAGE_CONFIG_QUARTERMILE'				=> '<strong>Άλλαξε τις Ρυθμίσεις Χρόνων 0-400μ. του Γκαράζ</strong>',
	'LOG_GARAGE_CONFIG_DYNORUN'					=> '<strong>Άλλαξε τις Ρυθμίσεις Δυναμομετρήσεων του Γκαράζ</strong>',
	'LOG_GARAGE_CONFIG_TRACK'					=> '<strong>Άλλαξε τις Ρυθμίσεις πιστών &amp; γύρων πίστας</strong>',
	'LOG_GARAGE_CONFIG_INSURANCE'				=> '<strong>Άλλαξε τις Ρυθμίσεις Ασφαλειών</strong>',
	'LOG_GARAGE_CONFIG_BUSINESS'				=> '<strong>Άλλαξε τις Ρυθμίσεις Επιχειρήσεων</strong>',
	'LOG_GARAGE_CONFIG_RATING'					=> '<strong>Άλλαξε τις Ρυθμίσεις Αξιολόγησης</strong>',
	'LOG_GARAGE_CONFIG_GUESTBOOK'				=> '<strong>Άλλαξε τις Ρυθμίσεις του guestbook</strong>',
	'LOG_GARAGE_CONFIG_PRODUCT'					=> '<strong>Άλλαξε τις Ρυθμίσεις Προϊόντων</strong>',
	'LOG_GARAGE_CONFIG_SERVICE'					=> '<strong>Άλλαξε τις Ρυθμίσεις Σέρβις</strong>',
	'LOG_GARAGE_CONFIG_BLOG'					=> '<strong>Άλλαξε τις Ρυθμίσεις blog του Γκαράζ</strong>',

	'NAME' 										=> 'Όνομα',
	'BROWSE' 									=> 'Περιήγηση',

//Added For RC5
	'No_Orphaned_Files' 						=> 'Φαίνεται πως δεν έχετε ορφανά αρχεία',
	'Orphaned_Files_Removed' 					=> 'Τα ορφανά αρχεία αφαιρέθηκαν',
	'No_Orphaned_Files_Selected'				=> 'Δεν επιλέχτηκαν ορφανά αρχεία, οπότε δεν αφαιρέθηκε κανένα ;)',
	'Rebuild_Thumbnails_Complete' 				=> 'Η επαναδημιουργία όλων των μικρογραφιών ολοκληρώθηκε',
	'Permissions_Updated' 						=> 'Τα δικαιώματα του Γκαράζ ενημερώθηκαν.',
	'Shop' 										=> 'Κατάστημα',
	'Processing_Attach_ID' 						=> 'Επεξεργασία id_επισυναπτόμενου: ',
	'Remote_Image' 								=> 'Απομακρυσμένη εικόνα: ',
	'File_Name' 								=> 'όνομα_αρχείου: ',
	'Temp_File_Name' 							=> 'προσωρινό_όνομα_αρχείου: ',
	'Rebuilt' 									=> 'Επαναδημιουργία: ',
	'Thumb_File' 								=> 'Αρχείο μικρογραφίας: ',
	'Source_File' 								=> 'Αρχείο πηγής: ',
	'File_Does_Not_Exist' 						=> 'ΣΦΑΛΜΑ -- Το απομακρυσμένο αρχείο δεν υπάρχει!',
	'Source_Unavailable' 						=> 'Η επαναδημιουργία απέτυχε - η πηγαία εικόνα δεν είναι διαθέσιμη: ',
	'No_Source_File' 							=> 'Η δημιουργία μικρογραφίας απέτυχε - Δεν υπάρχει πηγαίο αρχείο :',
	'Started_At' 								=> 'Ξεκινήσαμε στις : ',
	'Ended_At' 									=> 'Τελειώσαμε στις : ',
	'Have_Done' 								=> 'Έχουμε κάνει : ',
	'Need_To_Process' 							=> 'Πρέπει να επεξεργαστούμε συνολικά : ',
	'Log_To' 									=> 'Θα δημιουργηθεί αρχείο καταγραφής σε: ',
	'Out_Of' 									=> 'Από',
	'Kbytes' 									=> 'kbytes',

	'PERMANENT' 								=> 'Μόνιμο',
	'NON_PERMANENT'								=> 'Όχι μόνιμο',
	'ENABLE_WATERMARK'							=> 'Ενεργοποίηση υδατογραφήματος',
	'ENABLE_WATERMARK_EXPLAIN'					=> 'Ενεργοποίηση εμφάνισης υδατογραφήματος στις εικόνες',
	'WATERMARK_TYPE'							=> 'Τύπος υδατογραφήματος',
	'WATERMARK_TYPE_EXPLAIN'					=> 'Το μόνιμο θα σώσει το αυθεντικό αρχείο με το υδατογράφημα. Το όχι μόνιμο θα αφήσει το αρχείο στην αρχική του μορφή.',
	'WATERMARK_SOURCE'							=> 'Αρχείο υδατογραφήματος',
	'WATERMARK_SOURCE_EXPLAIN'					=> 'Το αρχείο που θα χρησιμοποιείται για το υδατογράφημα.',

	//CATEGORY KEYS
	'CREATE_CATEGORY'							=> 'Δημιουργία κατηγορίας',
	'CATEGORY_SETTINGS'							=> 'Ρυθμίσεις κατηγορίας',
	'CATEGORY_DELETE'							=> 'Διαγραφή κατηγορίας',
	'CATEGORY_UPDATE'							=> 'Ενημέρωση κατηγορίας',
	'CATEGORY_DELETED'							=> 'Η κατηγορία διαγράφηκε',
	'CATEGORY_UPDATED'							=> 'Η κατηγορία ενημερώθηκε',
	'CATEGORY_DELETE_EXPLAIN'					=> 'Η παρακάτω φόρμα σας επιτρέπει να διαγράψετε μια κατηγορία μετατροπών. Μπορείτε να αποφασίσετε που θα μετακινήσετε όλες τις μετατροπές που περιέχει ως τώρα.',
	'CATEGORY_UPDATE_EXPLAIN'					=> 'Η παρακάτω φόρμα σας επιτρέπει να ενημερώσετε μια κατηγορία μετατροπών.',
	'CATEGORY_NAME'								=> 'Όνομα κατηγορίας',
	'DELETE_ALL_MODIFICATIONS'					=> 'Διαγραφή όλων των μετατροπών',
	'MOVE_MODIFICATIONS_TO'						=> 'Μετακίνηση μετατροπών σε',
	'NO_DESTINATION_CATEGORY'					=> 'Δεν επιλέχτηκε κατηγορία προορισμού',
	'NO_CATEGORY'								=> 'Η κατηγορία δεν υπάρχει',
	'CATEGORY_NAME_EMPTY'						=> 'Δεν εισάγατε όνομα κατηγορίας',
	'GARAGE_CAT_TITLE' 							=> 'Διαχείριση κατηγοριών του Γκαράζ',
	'GARAGE_CAT_EXPLAIN' 						=> 'Σε αυτή την οθόνη μπορείτε να διαχειριστείτε τις κατηγορίες σας: δημιουργία, αλλαγή, διαγραφή.',

	//QUOTA KEYS
	'QUOTA_TITLE'								=> 'Διαχείριση ορίων',
	'QUOTA_EXPLAIN'								=> 'Αυτή η σελίδα διαχειρίζεται τα όρια για το πόσα οχήματα και εικόνες μπορεί να έχει ένα μέλος.<br /><br />Τα προκαθορισμένα όρια είναι οι τιμές που θα πάρει κάθε χρήστης ο οποίος έχει κάποιες προσβάσεις που επηρεάζονται από τα όρια, εκτός και αν είναι σε κάποια ομάδα στην οποία θα τεθούν όρια παρακάτω.',
	'GROUP_QUOTA_EXPLAIN'						=> 'Οι ομάδες εμφανίζονται εδώ μόνο αν τους έχουν δωθεί δικαιώματα τα οποία τους επιτρέπουν να δημιουργήσουν αντικείμενα τα οποία είναι διαχειρίσιμα μέσω των ορίων. Αν μια ομάδα στην οποία θέλετε να θέσετε όρια δεν υπάρχει σε αυτή τη λίστα, πρέπει πρώτα να της δώσετε τα απαραίτητα δικαιώματα από την διαχείριση προσβάσεων.',
	'REMOTE'									=> 'Απομακρυσμένο',
	'UPLOADED'									=> 'Ανεβασμένο',
	'DEFAULT_QUOTA'								=> 'Προκαθορισμένο όριο',
	'GROUP_QUOTA'								=> 'Όριο ομάδων',
	'VEHICLE_QUOTA'								=> 'Όριο οχημάτων',
	'UPLOAD_IMAGE_QUOTA'						=> 'Όριο ανεβασμένων εικόνων',
	'REMOTE_IMAGE_QUOTA'						=> 'Όριο απομακρυσμένων εικόνων',
	'ENABLE_GROUP_VEHICLE_QUOTA'				=> 'Ενεργοποίηση ορίου οχημάτων',
	'ENABLE_GROUP_IMAGES_QUOTA'					=> 'Ενεργοποίηση ορίου εικόνων',
	'QUOTAS_UPDATED'							=> 'Τα όρια ενημερώθηκαν',
	'EMPTY_DEFAULT_QUOTA'						=> 'Δεν ορίστηκε προκαθορισμένη τιμή ορίου για όλα τα πεδία',
	'EMPTY_GROUP_VEHICLE_QUOTA'					=> 'Δεν εισάγατε όριο οχημάτων για μια ομάδα που επιλέξατε',
	'EMPTY_GROUP_IMAGE_QUOTA'					=> 'Δεν εισάγατε όριο εικόνων για μια ομάδα που επιλέξατε',

	//TOOLS KEYS
	'TOOLS_TITLE' 								=> 'Διαχείριση εργαλείων του Γκαράζ',
	'TOOLS_EXPLAIN' 							=> 'Από αυτή την οθόνη μπορείτε να χρησιμοποιήσετε κάποια εργαλεία του Γκαράζ.',
	'TOOLS_REBUILD' 							=> 'Επαναδημιουργία όλων των μικρογραφιών',
	'TOOLS_IMAGES_PER_CYCLE' 					=> 'Εικόνες ανά κύκλο',
	'TOOLS_IMAGES_PER_CYCLE_EXPLAIN'			=> 'Αριθμός εικόνων προς επεξεργασία ανά κύκλο για διαχείριση της λειτουργίας του επεξεργαστή',
	'TOOLS_CREATE_LOG' 							=> 'Δημιουργία αρχείου καταγραφής',
	'TOOLS_CREATE_LOG_EXPLAIN' 					=> 'Δημιουργία ενός αρχείου καταγραφής με λεπτομέρειες για κάθε λειτουργία',
	'TOOLS_ORPHANED_TITLE' 						=> 'Εύρεση/Μετακίνηση ορφανών αρχείων',
	'TOOLS_ORPHANED_EXPLAIN' 					=> 'Αυτό το εργαλείο χρησιμοποιείται για να εντοπίσει όποια περιττά αρχεία είχε κάποτε δημιουργήσει το Γκαράζ. Αυτά τα περιττά αρχεία ίσως είναι αποτέλεσμα κάποιας χειροκίνητης εργασίας στη βάση δεδομένων, κάποιας αποτυχημένης εκτέλεσης του εργαλείου επαναδημιουργίας το οποίο μπορεί να απέτυχε πριν ολοκληρωθεί, ή κάποιας σημαντικής αναβάθμισης στο Γκαράζ. Κάτω από κανονικές συνθήκες, θα πρέπει να μην υπάρχουν ορφανά αρχεία.<br /><br />Σε πρώτη φάση αυτό το εργαλείο θα ψάξει μόνο για τα αρχεία, δεν θα εφαρμοστεί καμία ενέργεια εκτός και αν στην επόμενη φάση επικυρώσετε αυτά που θα βρεθούν.',
	'PER_CYCLE' 								=> 'ανά κύκλο',
	'TOOLS_LOG_FILE' 							=> 'Όνομα αρχείου καταγραφής ',
	'TOOLS_LOG_FILE_EXPLAIN' 					=> 'Το όνομα του αρχείου καταγραφής που θα δημιουργηθεί',


	//BUSINESS KEYS
	'GARAGE_BUSINESS_TITLE' 					=> 'Διαχείριση επιχειρήσεων του Γκαράζ',
	'GARAGE_BUSINESS_EXPLAIN' 					=> 'Σε αυτή την οθόνη μπορείτε να διαχειριστείτε τις επιχειρήσεις: δημιουργία, επεξεργασία, διαγραφή.',
	'EDIT_BUSINESS'								=> 'Επεξεργασία επιχείρησης',
	'CREATE_BUSINESS'							=> 'Δημιουργία επιχείρησης',
	'BUSINESS_CREATED'							=> 'Η επιχείρηση δημιουργήθηκε',
	'BUSINESS_UPDATE'							=> 'Ενημέρωση επιχείρησης',
	'BUSINESS_UPDATE_EXPLAIN'					=> 'Η παρακάτω φόρμα σας επιτρέπει να προσαρμόσετε αυτή την επιχείρηση όπως θέλετε.',
	'BUSINESS_UPDATED'							=> 'Η επιχείρηση ενημερώθηκε',
	'BUSINESS_DELETE'							=> 'Διαγραφή επιχείρησης',
	'BUSINESS_DELETE_EXPLAIN'					=> 'Η παρακάτω φόρμα σας επιτρέπει να διαγράψετε μια επιχείρηση. Μπορείτε να αποφασίσετε που θα μετακινήσετε τα αντικείμενα που σχετίζονται με αυτήν. Όπου η επιχείρηση είναι πολλών τύπων, θα έχετε πολλαπλές επιλογές.',
	'BUSINESS_DELETED'							=> 'Η επιχείρηση διαγράφηκε',
	'BUSINESS_SETTINGS'							=> 'Ρυθμίσεις επιχείρησης',
	'BUSINESS_NAME' 							=> 'Όνομα επιχείρησης',
	'BUSINESS_ADDRESS'							=> 'Διεύθυνση',
	'BUSINESS_TELEPHONE'						=> 'Αριθμός τηλεφώνου',
	'BUSINESS_FAX'								=> 'Αριθμός Φαξ',
	'BUSINESS_WEBSITE'							=> 'Ιστοσελίδα',
	'BUSINESS_EMAIL'							=> 'Διεύθυνση ηλεκτρονικού ταχυδρομείου',
	'BUSINESS_OPENING_HOURS'					=> 'Ώρες λειτουργίας',
	'BUSINESS_TYPE'								=> 'Τύπος',
	'BUSINESS_NAME_EMPTY'						=> 'Το όνομα της επιχείρησης είναι άδειο',
	'INSURANCE'									=> 'Ασφαλιστική εταιρία',
	'GARAGE'									=> 'Συνεργείο',
	'RETAIL'									=> 'Κατάστημα',
	'PRODUCT_MANUFACTURER'						=> 'Κατασκευαστής προϊόντων',
	'MANUFACTURER'								=> 'Κατασκευαστής',
	'DYNOCENTRE'								=> 'Δυναμόμετρο',
	'DELETE_ALL_PREMIUMS'						=> 'Διαγραφή όλων των ασφαλειών από την ασφαλιστική',
	'MOVE_PREMIUMS_TO'							=> 'Μετακίνηση των ασφαλειών σε',
	'DELETE_ALL_DYNORUNS'						=> 'Διαγραφή όλων των δυναμομετρήσεων από το δυναμόμετρο',
	'MOVE_DYNORUNS_TO'							=> 'Μετακίνηση των δυναμομετρήσεων σε',
	'DELETE_BOUGHT_MODIFICATIONS'				=> 'Διαγραφή των μετατροπών που αγοράστηκαν από την επιχείρηση',
	'DELETE_INSTALLED_MODIFICATIONS'			=> 'Διαγραφή των μετατροπών που εγκαταστάθηκαν από την επιχείρηση',
	'DELETE_MADE_MODIFICATIONS'					=> 'Διαγραφή των μετατροπών που κατασκευάστηκαν από την επιχείρηση',

	//MAKE & MODEL KEYS
	'MODELS_TITLE' 								=> 'Διαχείριση για Μάρκες &amp; Μοντέλα του Γκαράζ',
	'MODELS_EXPLAIN' 							=> 'Σε αυτή την οθόνη μπορείτε να διαχειριστείτε τα μοντέλα  &amp; τις μάρκες των οχημάτων του Γκαράζ: προσθήκη, αλλαγή, διαγραφή.',
	'CREATE_MAKE'								=> 'Δημιουργία μάρκας',
	'CREATE_MODEL'								=> 'Δημιουργία Μοντέλου',
	'MAKE_INDEX'								=> 'Λίστα με τις Μάρκες',
	'DELETE_ALL_VEHICLES'						=> 'Διαγραφή όλων των μοντέλων &amp; οχημάτων',
	'MAKE'										=> 'Μάρκα',
	'MAKE_DELETE'								=> 'Διαγραφή μάρκας',
	'MAKE_DELETED'								=> 'Η μάρκα διαγράφηκε',
	'MAKE_DELETE_EXPLAIN'						=> 'Η παρακάτω φόρμα σας επιτρέπει να διαγράψετε μια μάρκα. Μπορείτε να αποφασίσετε που θέλετε να μετακινήσετε τα αντικείμενα σχετικά με αυτήν.',
	'MOVE_VEHICLES_TO'							=> 'Μετακίνηση όλων των μοντέλων &amp; οχημάτων σε',
	'MODEL'										=> 'Μοντέλο',
	'MODEL_DELETE'								=> 'Διαγραφή μοντέλου',
	'MODEL_DELETED'								=> 'Το μοντέλο διαγράφηκε',
	'MODEL_DELETE_EXPLAIN'						=> 'Η παρακάτω φόρμα σας επιτρέπει να διαγράψετε ένα μοντέλο. Μπορείτε να αποφασίσετε που θέλετε να μετακινήσετε τα αντικείμενα σχετικά με αυτό.',
	'MAKE_EXISTS'								=> 'Η μάρκα υπάρχει ήδη',
	'MODEL_EXISTS'								=> 'Το μοντέλο υπάρχει ήδη σε αυτήν τη μάρκα',
	'MAKE_NAME_EMPTY'							=> 'Δεν εισάγατε όνομα μάρκας',
	'MODEL_NAME_EMPTY'							=> 'Δεν εισάγατε όνομα μοντέλου',
	'MAKE_UPDATE'								=> 'Ενημέρωση μάρκας',
	'MAKE_UPDATED'								=> 'Η μάρκα ενημερώθηκε',
	'MAKE_UPDATE_EXPLAIN'						=> 'Η παρακάτω φόρμα σας επιτρέπει να ενημερώσετε αυτή τη μάρκα',
	'MAKE_SETTINGS'								=> 'Ρυθμίσεις μάρκας',
	'MODEL_UPDATE'								=> 'Ενημέρωση μοντέλου',
	'MODEL_UPDATED'								=> 'Το μοντέλο ενημερώθηκε',
	'MODEL_UPDATE_EXPLAIN'						=> 'Η παρακάτω φόρμα σας επιτρέπει να ενημερώσετε αυτό το μοντέλο',
	'MODEL_SETTINGS'							=> 'Ρυθμίσεις μοντέλου',

	//PRODUCT KEYS
	'MANUFACTURER_TITLE'						=> 'Διαχείριση προϊόντων Γκαράζ',
	'MANUFACTURER_EXPLAIN'						=> 'Από αυτή την οθόνη μπορείτε να διαχειριστείτε τα προϊόντα: προσθήκη, αλλαγή, διαγραφή. Οι κατασκευαστές είναι επιχειρήσεις τις οποίες μπορτείτε να διαχειριστείτε από τη διαχείριση επιχειρήσεων.',
	'MANUFACTURER_INDEX'						=> 'Λίστα κατασκευαστών',
	'CREATE_PRODUCT'							=> 'Δημιουργία προϊόντος',
	'PRODUCTS_TITLE'							=> 'Διαχείριση προϊόντων του Γκαράζ',
	'PRODUCT_EXPLAIN'							=> 'Σε αυτή την οθόνη μπορείτε να προσθέσετε, να επεξεργαστείτε, να διαγράψετε, να εγκρίνετε, ή να απορρίψετε προϊόντα',
	'PRODUCT_SETTINGS'							=> 'Ρυθμίσεις προϊόντος',
	'PRODUCT'									=> 'Προϊόν',
	'PRODUCT_CREATED'							=> 'Το προϊόν δημιουργήθηκε',
	'PRODUCT_UPDATED'							=> 'Το προϊόν ενημερώθηκε',
	'PRODUCT_UPDATE'							=> 'Ενημέρωση προϊόντος',
	'PRODUCT_UPDATE_EXPLAIN'					=> 'Η παρακάτω φόρμα σας επιτρέπει να παραμετροποιήσετε αυτό το προϊόν',
	'CATEGORY'									=> 'Κατηγορία',
	'SELECT_CATEGORY'							=> 'Επιλέξτε κατηγορία',
	'SELECT_MANUFACTURER'						=> 'Επιλέξτε κατασκευαστή',
	'PRODUCT_DELETE'							=> 'Διαγραφή προϊόντος',
	'PRODUCT_DELETED'							=> 'Το προϊόν διαγράφηκε',
	'PRODUCT_DELETE_EXPLAIN'					=> 'Η παρακάτω φόρμα σας επιτρέπει να διαγράψετε ένα προϊόν. Μπορείτε να αποφασίσετε που θέλετε να μετακινήσετε τα αντικείμενα σχετικά με αυτό.',


	//TRACK KEYS
	'GARAGE_TRACK_TITLE'						=> 'Διαχείριση πιστών του Γκαράζ',
	'CREATE_TRACK'								=> 'Δημιουργία πίστας',
	'GARAGE_TRACK_EXPLAIN'						=> 'Σε αυτή την οθόνη μπορείτε να διαχειριστείτε τις πίστες: προσθήκη, τροποποίηση, διαγραφή.',
	'TRACK_UPDATE'								=> 'Ενημέρωση πίστας',
	'TRACK_UPDATE_EXPLAIN'						=> 'Η παρακάτω φόρμα σας επιτρέπει να επεξεργαστείτε την πίστα',
	'TRACK_SETTINGS'							=> 'Ρυθμίσεις πίστας',
	'TRACK_NAME'								=> 'Όνομα πίστας',
	'TRACK_LENGTH'								=> 'Μήκος',
	'SELECT_MILEAGE_UNIT'						=> 'Επιλογή χιλιομετρητή',
	'TRACK_DELETE'								=> 'Διαγραφή πίστας',
	'TRACK_DELETE_EXPLAIN'						=> 'Η παρακάτω φόρμα σας επιτρέπει να επεξεργαστείτε μια πίστα. Μπορείτε να αποφασίσετε τι θα κάνετε με τα αντικείμενα που σχετίζονται με αυτήν.',
	'DELETE_ALL_LAPS'							=> 'Διαγραφή όλων των γύρων πίστας από την πίστα',
	'MOVE_LAPS_TO'								=> 'Μετακίνηση γύρων πίστας σε',
	'TRACK_CREATED'								=> 'Η πίστα δημιουργήθηκε',
	'TRACK_UPDATED'								=> 'Η πίστα ενημερώθηκε',
	'TRACK_NAME_EMPTY'							=> 'Το όνομα πίστας είναι άδειο',
	'TRACK_DELETED'								=> 'Η πίστα διαγράφηκε',
	''											=> '',

	//
	'GARAGE_CUSTOM_FIELDS'						=> 'Προσαμοσμένα πεδία Γκαράζ',

	'ACP_MANAGE_QUOTAS'							=> 'Διαχείριση ορίων',
	'ACP_MANAGE_BUSINESS'						=> 'Διαχείριση επιχειρήσεων',
	'ACP_MANAGE_CATEGORY'						=> 'Διαχείριση κατηγοριών',
	'ACP_MANAGE_PRODUCTS'						=> 'Διαχείριση προϊόντων',
	'ACP_MANAGE_TRACKS'							=> 'Διαχείριση πιστών',
	'ACP_MANAGE_CATEGORY'						=> 'Διαχείριση κατηγοριών',
	'ACP_MANAGE_MAKES_MODELS'					=> 'Διαχείριση Μάρκες και μοντέλα',

	//Added For B4
	'DEFAULT_MAKE' 								=> 'Προκαθορισμένη Μάρκα',
	'DEFAULT_MAKE_EXPLAIN' 						=> 'Αυτή η μάρκα θα φαίνεται εξ\' ορισμού στην λίστα του "Προσθήκη οχήματος".',
	'DEFAULT_MODEL' 							=> 'Προκαθορισμένο Μοντέλο',
	'DEFAULT_MODEL_EXPLAIN' 					=> 'Αυτό το μοντέλο θα φαίνεται εξ\' ορισμού στην λίστα του "Προσθήκη οχήματος".',
	'VEHICLES_PER_PAGE_EXPLAIN' 				=> 'Ο αριθμός των οχημάτων που θα φαίνονται σε μια σελίδα.',
	'ENABLE_TOP_LAP' 							=> 'Ενεργοποίηση κορυφαίου γύρου πίστας',
	'ENABLE_TOP_LAP_EXPLAIN' 					=> 'Εμφανίζει το πεδίο "Γρηγορότερος γύρος πίστας" στην αρχική του Γκαράζ.',
	'TOP_LAP_LIMIT' 							=> 'Όριο για κορυφαίο γύρο πίστας',
	'TOP_LAP_LIMIT_EXPLAIN' 					=> 'Ο αριθμός των οχημάτων που θα φαίνονται στο πεδίο "Γρηγορότερος γύρος πίστας".',
	'ACP_GARAGE_SERVICE_CONFIG' 				=> 'Ρυθμίσεις Σέρβις',
	'ACP_GARAGE_BLOG_CONFIG' 					=> 'Ρυθμίσεις Blog',
	'ENABLE_SERVICE' 							=> 'Ενεργοποίηση Σέρβις',
	'ENABLE_SERVICE_EXPLAIN' 					=> 'Ενεργοποίηση Σέρβις',
	'ENABLE_BLOG' 								=> 'Ενργοποίηση Blog',
	'ENABLE_BLOG_EXPLAIN' 						=> 'Επιτρέπει στα μέλη να προσθέτουν ένα blog στα οχήματά τους.',
	'ENABLE_BLOG_BBCODE' 						=> 'Ενεργοποίηση BBCode στο blog ',
	'ENABLE_BLOG_BBCODE_EXPLAIN' 				=> 'Επιτρέπει την χρήση του BBcode στα blogs.',
	'ACP_MANAGE_QUOTAS' 						=> 'Διαχείριση ορίων',
	'ACP_MANAGE_PRODUCTS' 						=> 'Διαχείριση προϊόντων',
	'ACP_MANAGE_MAKES_MODELS' 					=> 'Διαχείριση για Μάρκες &amp; Μοντέλα',
	'ACP_MANAGE_BUSINESS' 						=> 'Διαχείριση επιχειρήσεων',
	'ACP_MANAGE_CATEGORY' 						=> 'Διαχείριση κατηγοριών',
	'EDIT_PRODUCT' 								=> 'Επεξεργασία προϊόντος',
	'SELECT_MANUFACTURER' 						=> 'Επιλέξτε κατασκευαστή',
	'ACP_MANAGE_TRACKS' 						=> 'Διαχείριση πιστών',
	'EDIT_TRACK' 								=> 'Επεξεργασία πίστας',
	'ADD_INSURANCE' 							=> 'Προσθήκη ασφάλειας',
	'GARAGE_ORPHANS_TITLE' 						=> 'Εντοπιστής ορφανών αρχείων',
	'GARAGE_ORPHANS_EXPLAIN' 					=> 'Παρακάτω είναι όλα τα ορφανά αρχεία που βρέθηκαν. Ενα ορφανό αρχείο είναι ένα αρχείο που υπάρχει στον σκληρό δίσκο, αλλά δεν υπάρχει πλέον στη βάση δεδομένων.<br />Παρακαλώ τσεκάρετε όσα ορφανά αρχεία θέλετε να διαγράψετε.<br /><br /><b>Αυτή η λειτουργία είναι μη-αναστρέψιμη!  Αν επιλέξετε να αφαιρέσετε τα ορφανά αρχεία, αυτά θα διαγραφούν για πάντα.</b>',
	'REMOVE_SELECTED_ORPHANS' 					=> 'Μετακίνηση των επιλεγμένων ορφανών αρχείων',
	'MOVE_PRODUCT_TO'							=> 'Μετακίνηση προϊόντων σε',
	'DELETE_MADE_PRODUCTS'						=> 'Διαγραφή προϊόντων που κατασκευάστηκαν από την επιχείριση. (Σημ.: Διαγράφει και τις σχετικές μετατροπές)',
	'ENABLE_BLOG_SMILIES' 						=> 'Ενεργοποίηση εικονιδίων στα Blog',
	'ENABLE_BLOG_SMILIES_EXPLAIN' 				=> 'Ενεργοποιεί την χρήση εικονιδίων στα blogs.',
	'ENABLE_BLOG_URL' 							=> 'Ενεργοποίηση ανάλυσης URL',
	'ENABLE_BLOG_URL_EXPLAIN' 					=> 'Ενεργοποιεί την αυτόματη ανάλυση των URL μέσα στα blogs.',
	'ENABLE_MAKE_APPROVAL' 						=> 'Ενεργοποίηση έγκρισης μάρκας',
	'ENABLE_MAKE_APPROVAL_EXPLAIN' 				=> 'Οι μάρκες απαιτούν έγκριση από συντονιστή πριν εμφανιστούν στη λίστα.',
	'ENABLE_MODEL_APPROVAL' 					=> 'Ενεργοποίηση έγκρισης μοντέλων',
	'ENABLE_MODEL_APPROVAL_EXPLAIN'				=> 'Τα μοντέλα απαιτούν έγκριση από συντονιστή πριν εμφανιστούν στη λίστα.',
	'ENABLE_GUESTBOOK_SMILIES' 					=> 'Ενεργοποίηση εικονιδίων στο Guestbook',
	'ENABLE_GUESTBOOK_SMILIES_EXPLAIN' 			=> 'Ενεργοποίηση χρήσης εικονιδίων στα σχόλια του guestbook.',
	'ENABLE_GUESTBOOK_URL' 						=> 'Ενεργοποίηση ανάλυσης URLs',
	'ENABLE_GUESTBOOK_URL_EXPLAIN' 				=> 'Ενεργοποίηση ανάλυσης URLs στα σχόλια του guestbook.',

));

?>
