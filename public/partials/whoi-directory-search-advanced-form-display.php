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

<div class="whoi-directory-search-advanced-form-container">

		<form action="" method="post" id="whoi-directory-search-form" >

            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <input type="text" id="user_search_terms" name="user_search_terms" autofocus="autofocus" placeholder="Enter any part of a name">
                </div>
                <div class="col-md-4">
                  <input type = "text" name="search_phone" id="search_phone" size="30" placeholder="Phone"/>
                </div>
                <div class="col-md-4">
                  <input type="text" name="search_position" id="search_position" size="30" placeholder="Position"/>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                    <select name="search_dept" id="search_dept">
                        <option value="">Search by department</option>
                        <option value="ACADEMIC PROGRAMS OFFICE">Academic Programs Office</option>
                        <option value="ADMINISTRATION">Administration</option>
                        <option value="ADV">Advancement</option>
                        <option value="APPLIED OCEAN PHYSICS &amp; ENGINEERING">Applied Ocean Physics &amp; Engineering</option>
                        <option value="BIOLOGY">Biology</option>
                        <option value="COMMUNICATIONS">Communications</option>
                        <option value="CREATIVE SERVICES">Creative Services</option>
                        <option value="DEVELOPMENT">Development</option>
                        <option value="DISTRIBUTION">Distribution</option>
                        <option value="ENVIRONMENTAL HEALTH &amp; SAFETY">Environmental Health &amp; Safety</option>
                        <option value="FACILITIES">Facilities</option>
                        <option value="FINANCE AND ACCOUNTING">Finance And Accounting</option>
                        <option value="GEOLOGY &amp; GEOPHYSICS">Geology &amp; Geophysics</option>
                        <option value="GRANTS AND CONTRACTS">Grants And Contracts</option>
                        <option value="HUMAN RESOURCES">Human Resources</option>
                        <option value="INFORMATION SERVICES">Information Services</option>
                        <option value="INSTITUTION DIRECTORATE">Institution Directorate</option>
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
                </div>
                <div class="col-md-4">
                    <select name="search_building" id="search_building">
                      <option value="">Search by building</option>
                      <option value="6 Maury Lane">6 Maury Lane</option>
                      <option value="15 Carlson Lane">15 Carlson Lane</option>
                      <option value="38 Water St">38 Water St.</option>
                      <option value="49 School St.">49 School St.</option>
                      <option value="Bell">Bell</option>
                      <option value="Bigelow">Bigelow</option>
                      <option value="Blake">Blake</option>
                      <option value="Caryn">Caryn</option>
                      <option value="Carriage">Carriage</option>
                      <option value="Challenger">Challenger</option>
                      <option value="Challenger Annex">Challenger Annex</option>
                      <option value="Clark">Clark</option>
                      <option value="Clark South">Clark South</option>
                      <option value="Co-op">Co-op</option>
                      <option value="Crowell">Crowell</option>
                      <option value="Dyer\'s Dock Hangar">Dyer's Dock Hangar</option>
                      <option value="ESL">ESL</option>
                      <option value="Exhibit Center">Exhibit Center</option>
                      <option value="Fenno">Fenno</option>
                      <option value="Fye">Fye</option>
                      <option value="Bell (Graphics)">Bell (Graphics)</option>
                      <option value="GEOSECS">GEOSECS</option>
                      <option value="Iselin">Iselin</option>
                      <option value="L\'Hirondelle">L'Hirondelle</option>
                      <option value="LOSOS">LOSOS</option>
                      <option value="McLean">McLean</option>
                      <option value="Marine Research Facility">Marine Research Facility</option>
                      <option value="MIT">MIT</option>
                      <option value="Nobska">Nobska</option>
                      <option value="Quissett Facilities Building">Quissett Facilities Building</option>
                      <option value="Quisset Warehouse">Quisset Warehouse</option>
                      <option value="Redfield">Redfield</option>
                      <option value="Rinehart Coastal Research Center">Rinehart Coastal Research Center</option>
                      <option value="RTS - School Street">RTS - School Street</option>
                      <option value="Shiverick">Shiverick</option>
                      <option value="Smith">Smith</option>
                      <option value="Swift">Swift</option>
                      <option value="Vincent House">Vincent House</option>
                      <option value="USGS">USGS</option>
                      <option value="Walsh Cottage">Walsh Cottage</option>
                      <option value="Watson Building">Watson Building</option>
                  </select>
              </div>
              <div class="col-md-4">
                  <select name="search_mail_stop" id="search_mail_stop">
                      <option value="">Mail stop #:</option>
                      <option value="01">01 - Geosecs (Procurement)</option>
                      <option value="02">02 - CRL</option>
                      <option value="03">03 - Shipping& Receiving</option>
                      <option value="04">04 - Fye</option>
                      <option value="05">05 - Bell (Graphics)</option>
                      <option value="06">06 - Blake 1</option>
                      <option value="07">07 - Blake</option>
                      <option value="08">08 - McLean</option>
                      <option value="09">09 - Bigelow (4th floor)</option>
                      <option value="10">10 - Bigelow (3rd floor)</option>
                      <option value="11">11 - Bigelow (2nd floor)</option>
                      <option value="12">12 - Bigelow (1st floor)</option>
                      <option value="13">13 - Bigelow Ground</option>
                      <option value="14">14 - Challenger</option>
                      <option value="15">15 - Nobska (HR)</option>
                      <option value="16">16 - Co-op</option>
                      <option value="17">17 - Smith (3rd floor)</option>
                      <option value="18">18 - Smith (2nd floor)</option>
                      <option value="19">19 - Smith (1st floor)</option>
                      <option value="20">20 - Smith (Lobby)</option>
                      <option value="21">21 - Clark (3rd floor)</option>
                      <option value="22">22 - Clark (G&G)</option>
                      <option value="23">23 - Clark (1st floor)</option>
                      <option value="24">24 - Clark South (2nd floor)</option>
                      <option value="25">25 - Clark (4th floor)</option>
                      <option value="26">26 - Clark (Library)</option>
                      <option value="27">27 - Iselin (Port Office)</option>
                      <option value="28">28 - Iselin High Bay</option>
                      <option value="29">29 - Clark (PO)</option>
                      <option value="30">30 - Clark South (1st floor)</option>
                      <option value="31">31 - Clark (Academic Programs)</option>
                      <option value="32">32 - Redfield (3rd floor)</option>
                      <option value="33">33 - Redfield (2nd floor)</option>
                      <option value="34">34 - Redfield (1st floor)</option>
                      <option value="35">35 - ESL</option>
                      <option value="36">36 - Shiverick</option>
                      <option value="37">37 - Marine Operations</option>
                      <option value="38">38 - Swift</option>
                      <option value="39">39 - Fenno (1st floor)</option>
                      <option value="40">40 - Fenno</option>
                      <option value="40A">40A - Fenno (Directorate)</option>
                      <option value="41">41 - Crowell</option>
                      <option value="42">42 - Walsh Cottage</option>
                      <option value="43">43 - Geosecs (JGOFS & Property)</option>
                      <option value="44">44 - Caryn</option>
                      <option value="45">45 - Exhibit Center</option>
                      <option value="46">46 - Clark (IS)</option>
                      <option value="47">47 - Vincent House, 1st Floor</option>
                      <option value="48">48 - L'Hirondelle (Safety Office)</option>
                      <option value="49">49 - Carriage House</option>
                      <option value="50">50 - Marine Research Facility</option>
                      <option value="51">51 - Watson Building (1st floor)</option>
                      <option value="52">52 - Watson Building (2nd floor)</option>
                      <option value="53">53 - Vincent House</option>
                      <option value="54">54 - Bell</option>
                      <option value="56">56 - Dyer's Dock Hanger</option>
                      <option value="57">57 - LOSOS</option>
                      <option value="58">58 - 6 Maury Lane</option>
                      <option value="60">60 - LOSOS 1st Floor</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                  <input type="hidden" name="action" value="whoi_directory_search_form_response">
                  <input type="hidden" name="form_type" id="form_type" value="advanced">
      			  <input type="hidden" name="whoi_directory_search_nonce" value="<?php echo $whoi_directory_search_nonce ?>" />

                  <div class="advanced-search-btns">
                      <button type="submit" id="search-btn-submit" class="button button-primary">
                          <i class="fas fa-search"></i>
                          <div class="search-btn-text">Search</div>
                      </button>

                      <div id="clear-srch">
                          <a href="#" id="clear-search-btn">
                              <i class="fa fa-times-circle" aria-hidden="true"></i>
                              <div class="search-btn-text">Clear</div>
                          </a>
                      </div>
                  </div>
              </div>
            </div>


      </form>

</div>

<div id="whoi-directory-search-feedback"></div>

<div id="whoi-directory-search-results"></div>
