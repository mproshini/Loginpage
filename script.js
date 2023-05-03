 // For the register file jquery
$(document).ready(function() {
  // Validate the registration form on submission
  $('#registration-form').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Get the form data
    var formData = {
      'username': $('input[name="username"]').val(),
      'email': $('input[name="email"]').val(),
      'password': $('input[name="password"]').val(),
      'confirm-password': $('input[name="confirm-password"]').val(),
      'contact-no': $('input[name="contact-no"]').val()
    };

    // Validate the form fields
    if (formData.username === '' || formData.email === '' || formData.password === '' || formData['confirm-password'] === '' || formData['contact-no'] === '') {
      alert('Please fill in all required fields.');
      return false;
    }

    if (formData.password !== formData['confirm-password']) {
      alert('Passwords do not match.');
      return false;
    }

    // Submit the form with Ajax
    $.ajax({
      type: 'POST',
      url: 'register.php', // Replace '#' with the URL to your server-side script that handles the form submission
      data: formData,
      success: function(response) {
        alert('Registration successful!');
        // Redirect the user to the login page
        window.location.href = 'login.html';
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('An error occurred: ' + errorThrown);
      }
    });
  });
});
// register file ends


// login file
$(document).ready(function() {
  // Validate the login form on submission
  $('#login-form').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Get the form data
    var formData = {
      'username': $('input[name="username"]').val(),
      'password': $('input[name="password"]').val()
    };

    // Validate the form fields
    if (formData.username === '' || formData.password === '') {
      alert('Please fill in all required fields.');
      return false;
    }

    // Submit the form with Ajax
    $.ajax({
      type: 'POST',
      url: 'login.php', // Replace '#' with the URL to your server-side script that handles the form submission
      data: formData,
      success: function(response) {
        window.location.href = 'profile.html';
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('An error occurred: ' + errorThrown);
      }
    });
  });
});

  

  //Profile page js file
  $(document).ready(function() {
    // Retrieve user data from the server using Ajax
    $.ajax({
      type: 'POST',
      url: 'profile.php', // Replace '#' with the URL to your server-side script that retrieves user data
      success: function(response) {
        // Parse the response JSON data
        var userData = JSON.parse(response);
  
        // Display the user data on the profile page
        $('#username').text(userData.username);
        $('#email').text(userData.email);
        $('#contact-no').text(userData.contact_no);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('An error occurred: ' + errorThrown);
      }
    });
  });
  
  //profile file ends