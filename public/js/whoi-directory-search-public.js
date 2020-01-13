(function( $ ) {
    /**
     * The file is enqueued from public/class-whoi-directory-search-public.php.
	 */

    $(function() {
        var urlParams = new URLSearchParams(window.location.search);

        if ( urlParams.has('staffSearch') ) {
            let searchTerms = urlParams.get('staffSearch');
            let searchDept = urlParams.get('searchDept');
            let searchBuilding = urlParams.get('searchBuilding');
            let searchMailstop = urlParams.get('searchMailstop');
            let searchPhone = urlParams.get('searchPhone');
            let searchPosition = urlParams.get('searchPosition');
            $('#user_search_terms').val(searchTerms);
            $('#search_dept').val(searchDept);
            $('#search_building').val(searchBuilding);
            $('#search_mail_stop').val(searchMailstop);
            $('#search_phone').val(searchPhone);
            $('#search_position').val(searchPosition);
        }

        if( $('#user_search_terms').val() || $('#search_dept').val() || $('#search_building').val() || $('#search_mail_stop').val() || $('#search_phone').val() || $('#search_position').val() ) {
            searchDirectory();
        }
        // Clear the search form
        $( '#clear-search-btn' ).click(function() {
            $('#user_search_terms').val('');
            $('#search_dept').val('');
            $('#search_building').val('');
            $('#search_mail_stop').val('');
            $('#search_phone').val('');
            $('#search_position').val('');
            $('#whoi-directory-search-results').empty();
            // remove sessionStorage items to clear history
            sessionStorage.removeItem('staffSearch');
            sessionStorage.removeItem('searchDept');
            sessionStorage.removeItem('searchBuilding');
            sessionStorage.removeItem('searchMailstop');
            sessionStorage.removeItem('searchPhone');
            sessionStorage.removeItem('searchPosition');
            // Reset the URI without page reload
            var uri = window.location.toString();
        	if (uri.indexOf("?") > 0) {
        	    var clean_uri = uri.substring(0, uri.indexOf("?"));
        	    window.history.replaceState({}, document.title, clean_uri);
        	}
        });

        // Submit the search form
        $('#whoi-directory-search-form').submit( function( event ) {
            event.preventDefault(); // Prevent the default form submit.
            $('#whoi-directory-search-results').empty(); // Clear previous results
            searchDirectory();
        });

        function searchDirectory() {
            // Set up form data for API request
            var formType = $('#form_type').val();
            var searchTerms = $('#user_search_terms').val();
            var searchDept = $('#search_dept').val();
            var searchBuilding = $('#search_building').val();
            var searchPhone = $('#search_phone').val();
            var searchPosition = $('#search_position').val();
            var searchMailstop = $('#search_mail_stop').val();

            if ( searchTerms || searchDept || searchBuilding || searchPhone || searchPosition || searchMailstop ) {
                var data = {user_search_terms: searchTerms, search_dept: searchDept, search_building: searchBuilding, search_position: searchPosition, search_phone: searchPhone, search_mail_stop: searchMailstop, form_type: formType} ;
                // Set sessionStorage variable to track the search terms for Back buttons
                sessionStorage.setItem('formType', formType);
                sessionStorage.setItem('staffSearch', searchTerms);
                sessionStorage.setItem('searchDept', searchDept);
                sessionStorage.setItem('searchBuilding', searchBuilding);
                sessionStorage.setItem('searchPosition', searchPosition);
                sessionStorage.setItem('searchMailstop', searchMailstop);
                sessionStorage.setItem('searchPhone', searchPhone);

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
                      if (data) {

                          if (formType == 'advanced') {
                              var tableHeader = '<th>Name</th> <th>Position</th> <th>Phone</th> <th>Department</th> <th>Location</th> <th>Mail Stop</th>';
                          } else {
                              var tableHeader = '<th>Name</th> <th>Position</th> <th>Department</th> <th>Location</th>';
                          }

                          var tableOutput = `
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          ${tableHeader}
                                      </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                              </table>
                          `
                          $('#whoi-directory-search-results').append( tableOutput );

                          var results = $.parseJSON(data);

                          $.each(results, function(key, value) {
                                if (formType == 'advanced') {
                                    var userOutput = `
                                        <tr class="directory-search-result">
                                            <td><a id="profile-link" href="/profile/${value.username}/">${value.first_name} ${value.last_name}</a></td>
                                            <td>${value.hr_job_title}</td>
                                            <td>${value.office_phone}</td>
                                            <td>${value.department}</td>
                                            <td>${value.building}</td>
                                            <td>${value.mail_stop}</td>
                                        </tr>
                                    `
                                } else {
                                    var userOutput = `
                                        <tr class="directory-search-result">
                                            <td><a id="profile-link" href="/profile/${value.username}/">${value.first_name} ${value.last_name}</a></td>
                                            <td>${value.hr_job_title}</td>
                                            <td>${value.department}</td>
                                            <td>${value.building}</td>
                                        </tr>
                                    `
                                }
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
        }
   });

})( jQuery );
