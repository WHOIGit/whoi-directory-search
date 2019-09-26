(function( $ ) {
	'use strict';

    /**
     * The file is enqueued from public/class-whoi-directory-search-public.php.
	 */

    $(function() {
        // Clear the search form
        $( '#clear-search-btn' ).click(function() {
            $('#user_search_terms').val('');
            $('#department_search').val('');
            $('#whoi-directory-search-results').empty();
            // remove sessionStorage items to clear history
            sessionStorage.removeItem('staffSearch');
            sessionStorage.removeItem('searchDept');
            // Reset the URI without page reload
            var uri = window.location.toString();
        	if (uri.indexOf("?") > 0) {
        	    var clean_uri = uri.substring(0, uri.indexOf("?"));
        	    window.history.replaceState({}, document.title, clean_uri);
        	}
        });

        // Load the profile page with javascript to keep it out of browser History
        $('#whoi-directory-search-results').on('click', '#profile-link', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            console.log(url);
            window.location.replace(url);
        });

        // Submit the search form
        $('#whoi-directory-search-form').submit( function( event ) {

            event.preventDefault(); // Prevent the default form submit.

            $('#whoi-directory-search-results').empty(); // Clear previous results

            // Set up form data for API request
            var searchTerms = $('#user_search_terms').val();
            var searchDept = $('#department_search').val();



            if ( searchTerms || searchDept ) {
                var data = {user_search_terms: searchTerms, search_dept: searchDept} ;
                // Set sessionStorage variable to track the search terms for Back buttons
                sessionStorage.setItem('staffSearch', searchTerms);
                sessionStorage.setItem('searchDept', searchDept);

                fetch('https://directory.whoi.edu/wp-json/whoi_directory/v1/users/search/', {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers:{
                            'Content-Type': 'application/json'
                        },
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
                      if (data) {

                          var tableOutput = `
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Name</th> <th>Position</th> <th>Department</th> <th>Location</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                              </table>
                          `
                          $('#whoi-directory-search-results').append( tableOutput );

                          var results = $.parseJSON(data);

                          $.each(results, function(key, value) {
                                console.log(value);
                                var userOutput = `
                                    <tr class="directory-search-result">
                                        <td><a id="profile-link" href="/profile/${value.username}/">${value.first_name} ${value.last_name}</a></td>
                                        <td>${value.hr_job_title}</td>
                                        <td>${value.department}</td>
                                        <td>${value.building}</td>
                                    </tr>
                                `
                                $('#whoi-directory-search-results tbody').append( userOutput );
                          });
                      } else {
                          $('#whoi-directory-search-results').append( '<h4>No users were found matching your search criteria.</h4>' );
                      }

                  })
                  .catch(error => console.error('Error:', error));
            } else {
                $('#whoi-directory-search-results').append( '<h4>Please enter a search term or select a department.</h4>' );
            }

       });
   });

})( jQuery );
