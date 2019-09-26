(function( $ ) {
	'use strict';

    /**
     * The file is enqueued from public/class-whoi-directory-search-public.php.
	 */
    $(function() {

        /**
         * function to create Fetch calls to search the directory
        */
        function postSearchData(url = '', data = {}, token) {
          // Default options are marked with *
            return fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, cors, *same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                redirect: 'follow', // manual, *follow, error
                referrer: 'no-referrer', // no-referrer, *client
                body: JSON.stringify(data), // body data type must match "Content-Type" header
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
             .catch(error => console.error('Error:', error));
        }
        /**
         * Directory search form actions
        */
        $( '#whoi-directory-search-form' ).submit( function( event ) {

            event.preventDefault(); // Prevent the default form submit.

            // serialize the form data
            var ajax_form_data = $("#whoi-directory-search-form").serialize();
            console.log(ajax_form_data);

            /**
             * Check if the JWT token is available and valid. If not, get new token from PHP function.
            */
            if (localStorage.getItem('token') === null) {
                // If no token, get token with PHP
                fetch(params.ajaxurl + '?action=whoi_directory_jwt_token_response', {
                        method: 'GET',
                        headers:{
                            'Content-Type': 'application/json'
                        },
                    })
                  .then(response => response.json())
                  .then(data => {
                      console.log(data.token);
                      localStorage.setItem('token', data.token);
                  })
                  .then(data => {
                      // get the JWT Token from localStorage
                      var token = localStorage.getItem('token');

                      postSearchData('https://directory.whoi.edu/wp-json/wp/v2/users/329?context=view', ajax_form_data, token)
                          .then(data => {
                              console.log(JSON.stringify(data));
                              $("#whoi-directory-search-feedback").html( "<h2>The request was successful </h2><br>" );
                              $("#whoi-directory-search-results").html( data.hr_first_name + data.hr_last_name );
                          })
                          .catch(error => console.error(error));
                  })
                  .catch(error => console.error('Error:', error));
            } else {
                // get the JWT Token from localStorage
                var token = localStorage.getItem('token');
                // check if token is valid, then go ahead or get new token
                fetch('https://directory.whoi.edu/wp-json/jwt-auth/v1/token/validate', {
                        method: 'POST', // or 'PUT'
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                    })
                  .then(response => response.json())
                  .then(data => {
                      console.log(data);

                      if (data.code == 'jwt_auth_valid_token') {

                      } else {

                      }
                  })
                  .catch(error => console.error('Error:', error));

            }




            /*
            fetch('https://directory.whoi.edu/wp-json/wp/v2/users/329?context=view', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                console.log(data);
                $("#whoi-directory-search-feedback").html( "<h2>The request was successful </h2><br>" );
                $("#whoi-directory-search-results").html( data.hr_first_name + data.hr_last_name );
            });


            // get the JWT Token from localStorage
            var token = localStorage.getItem('token');

            // serialize the form data
            var ajax_form_data = $("#whoi-directory-search-form").serialize();
            console.log(ajax_form_data);

            fetch('https://directory.whoi.edu/wp-json/wp/v2/users/329?context=view', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                console.log(data);
            });

            // Connect to Directory API, retrieve search results
            $.ajax({
                url:    'https://directory.whoi.edu/wp-json/wp/v2/users/329?context=view',
                type:   'get',
                //data:   ajax_form_data,
                dataType: 'JSON',
                beforeSend: function (xhr) {
                    var token = localStorage.getItem('token');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                },
            })

            .done( function( response ) { // response from the PHP action
                console.log(response);
                $("#whoi-directory-search-feedback").html( "<h2>The request was successful </h2><br>" );
                $("#whoi-directory-search-results").html( response.hr_first_name + response.hr_last_name );
            })

            // something went wrong
            .fail( function() {
                $("#whoi-directory-search-feedback").html( "<h2>Error connecting to Directory API</h2><br>" );
            })

            // clear the form after submitting
            .always( function() {
                event.target.reset();
            });
            */
       });
   });

})( jQuery );
