

<?php get_header(); ?>

<?php

if ( !empty( get_query_var( 'username' ) ) ) {
	$username = get_query_var( 'username' );

}

?>

<div class="fl-content-full container">
    <div id="breadcrumbs" data-swiftype-index="false">
        <nav role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs" itemprop="breadcrumb"><a href="https://www.whoi.edu">Home</a> /
            <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList"><meta name="numberOfItems" content="1"><meta name="itemListOrder" content="Ascending">
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="trail-item trail-end">
                    <a href="/directory/" itemprop="item"><span itemprop="name">Directory</span></a><meta itemprop="position" content="1">
                </li>
            </ul>
        </nav>
    </div>

	<div class="row">
		<div class="fl-content col-md-12">

            <div id="content" role="main" class="staff-profile">

                <article>
        			<header class="entry-header">
        				<h1 class="entry-title">Staff Profile</h1>
        			</header>

                    <div id="whoi-directory-profile"></div>

        		</article>
            </div>

		</div>
	</div>
</div>

<!-- Javascript to make API request to directory.whoi.edu -->
<script>
(function( $ ) {
	'use strict';
    // Get the userName var from the URL
    var pathArray = window.location.pathname.split('/');
    var userName = pathArray[2];

    // Fetch the user data from API
    fetch('https://directory.whoi.edu/wp-json/whoi_directory/v1/users/detail/' + userName, {
            method: 'GET',
        })
     .then(response => {
        if (response.ok) {
          return response.json() // parses JSON response into native Javascript objects
        } else {
            return Promise.reject({
              status: response.status,
              statusText: response.statusText
            })
        }
      })
      .then(data => {
          console.log(data);
          var results = $.parseJSON(data);

          $.each(results, function(key, value) {
                console.log(value);

                var output_photo = '';
                var output_cv = '';
                var output_site = '';
                var output_education = '';
                var working_title = '';
                var website = '';

                if (value.photo) {
                    var output_photo = `<img src="${value.photo.guid}" class="attachment-medium size-medium">`
                }

                if (value.vita) {
                    var output_cv = `<p class="cv"><a href="${value.vita.guid}" target="_blank">CV</a></p>`
                }

                if (value.labgroup_site) {
                    var output_site = `<p><strong>Lab/Group Site:</strong> <a href="${value.labgroup_site}" target="_blank">${value.labgroup_site}</a></p>`
                }

                if (value.education) {
                    var output_education = `<h3>Education</h3> ${value.education}`
                }

                if (value.working_title) {
                    var working_title = `<p>${value.working_title}</p>`
                }

                if (value.website) {
                    var website = `<p><strong>Website:</strong> <a href="${value.website}" target="_blank">${value.website}</a></p>`
                }

                const htmlOutput = `
                        <div class="staff-image">
                            ${output_photo}
                        </div>

                        <div class="staff-profile">
                            <h2 data-swiftype-name="title" data-swiftype-type="string">${value.first_name} ${value.last_name}</h2>
                            <p> ${value.hr_job_title}</p>
                            ${working_title}
                            <p>${value.department}</p>
                            <p><strong>Email:</strong> <a href="mailto:${value.user_email}">${value.user_email}</a></p>
                            <p><strong>Phone:</strong> ${value.office_phone}</p>
                            <p><strong>Address:</strong> ${value.building} ${value.office}, Mail Stop: ${value.mail_stop}</p>
                            ${output_cv}
                            ${website}
                            ${output_site}
                            ${output_education}
                            ${value.other_info}
                        </div>`;
                $('#whoi-directory-profile').html( htmlOutput );
            });
      })
      .catch(error => console.error('Error:', error));

      // Set up the Back button to return previous results
      var staffSearch = sessionStorage.getItem('staffSearch');
      var searchDept = sessionStorage.getItem('searchDept');

      if ( staffSearch || searchDept ) {
          var stateObj = {
              staffSearch: staffSearch,
              searchDept: searchDept,
          };

          history.pushState(stateObj, '', '');

          // remove sessionStorage items to clear history
          sessionStorage.removeItem('staffSearch');
          sessionStorage.removeItem('searchDept');

          $(window).bind("popstate", function(event) {
              location.replace( "/directory?staffSearch=" + encodeURI(stateObj.staffSearch) + "&searchDept=" +  encodeURI(stateObj.searchDept) );
          });
      }

})( jQuery );
</script>

<?php get_footer(); ?>
