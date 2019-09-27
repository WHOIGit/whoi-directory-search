<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.whoi.edu
 * @since      1.0.0
 *
 * @package    Whoi_Directory_Search
 * @subpackage Whoi_Directory_Search/public/partials
 */

 // Generate a custom nonce value.
$whoi_directory_search_nonce = wp_create_nonce( 'whoi_directory_search_nonce' );

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="whoi-directory-search-form-container">

		<form action="" method="post" id="whoi-directory-search-form" >


			<input type="hidden" name="action" value="whoi_directory_search_form_response">
			<input type="hidden" name="whoi_directory_search_nonce" value="<?php echo $whoi_directory_search_nonce ?>" />

            <select name="department_search" id="department_search">
                <option value="">Select a Department</option>
                <option value="ACADEMIC PROGRAMS OFFICE">Academic Programs Office</option>
                <option value="ADMINISTRATION">Administration</option>
                <option value="ADV">Advancement</option>
                <option value="APPLIED OCEAN PHYSICS &amp; ENGINEERING">Applied Ocean Physics &amp; Engineering</option>
                <option value="BIOLOGY">Biology</option>
                <option value="COMMUNICATIONS">Communications</option>
                <option value="DEVELOPMENT">Development</option>
                <option value="DISTRIBUTION">Distribution</option>
                <option value="ENVIRONMENTAL HEALTH &amp; SAFETY">Environmental Health &amp; Safety</option>
                <option value="FACILITIES">Facilities</option>
                <option value="FINANCE AND ACCOUNTING">Finance And Accounting</option>
                <option value="GEOLOGY &amp; GEOPHYSICS">Geology &amp; Geophysics</option>
                <option value="GRANTS AND CONTRACTS">Grants And Contracts</option>
                <option value="GRAPHICS">Graphics</option>
                <option value="HUMAN RESOURCES">Human Resources</option>
                <option value="INFORMATION SERVICES">Information Services</option>
                <option value="LIBRARY">Library</option>
                <option value="MARINE CHEMISTRY &amp; GEOCHEMISTRY">Marine Chemistry &amp; Geochemistry</option>
                <option value="MARINE POLICY CENTER">Marine Policy Center</option>
                <option value="OFFICE FOR TECHNOLOGY TRANSFER">Office For Technology Transfer</option>
                <option value="OPERATIONAL SCIENTIFIC SERVICES">Operational Scientific Services</option>
                <option value="PHYSICAL OCEANOGRAPHY">Physical Oceanography</option>
                <option value="R/V ATLANTIS">R/V Atlantis</option>
                <option value="R/V NEIL ARMSTRONG">R/V Neil Armstrong</option>
                <option value="SHIP OPERATIONS">Ship Operations</option>
        </select>

            <input type="text" id="user_search_terms" name="user_search_terms" maxlength="50" placeholder="Enter any part of a name">
            <button type="submit" id="search-btn-submit" class="button button-primary"><i class="fas fa-search"></i></button>

            <div id="clear-srch">
                <a href="#" id="clear-search-btn">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    <div id="clear-srch-text">Clear</div>
                </a>
            </div>
      </form>

</div>

<div id="whoi-directory-search-feedback"></div>

<div id="whoi-directory-search-results"></div>

<script>

(function( $ ) {
	'use strict';

    $(document).on('ready', function () {
        var urlParams = new URLSearchParams(window.location.search);

        if ( urlParams.has('staffSearch') ) {
            let searchTerms = urlParams.get('staffSearch');
            let searchDept = urlParams.get('searchDept');

            $('#user_search_terms').val(searchTerms);
            $('#department_search').val(searchDept);
            $('#search-btn-submit').click();

        }
    });
})( jQuery );
</script>
