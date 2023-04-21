$(document).ready(function() {
    // Add event listener for form submission
    $("#registration-form").submit(function(event) {
      // Prevent default form submission behavior
      event.preventDefault();
  
      // Validate form fields
      if (!validateForm()) {
        return;
      }
  
      // Submit form data using AJAX
      $.ajax({
        type: "POST",
        url: "process-registration.php",
        data: $("#registration-form").serialize(),
        success: function(response) {
          // Display success message
          alert(response);
        },
        error: function(xhr, status, error) {
          // Display error message
          alert("Error: " + error);
        }
      });
    });
  
    // Function to validate form fields
    function validateForm() {
      var isValid = true;
  
      // Check if Firstname field is not empty
      if ($("#Firstname").val().trim() == "") {
        alert("Firstname field is required.");
        isValid = false;
      }
  
      // Check if email field is not empty and is a valid email address
      if ($("#email").val().trim() == "") {
        alert("Email field is required.");
        isValid = false;
      } else if (!isValidEmail($("#email").val().trim())) {
        alert("Please enter a valid email address.");
        isValid = false;
      }
  
      // Check if password field is not empty and has at least 8 characters
      if ($("#password").val().trim() == "") {
        alert("password field is required.");
        isValid = false;
      } else if ($("#password").val().trim().length < 8) {
        alert("password must be at least 8 characters long.");
        isValid = false;
      }
  
      // Check if confirm password field is not empty and matches password field
      if ($("#confirm-password").val().trim() == "") {
        alert("Confirm password field is required.");
        isValid = false;
    } else if ($("#confirm-password").val().trim() != $("#password").val().trim()) {
        alert("passwords do not match.");
        isValid = false;
      }
      
      // Check if contact number field is not empty and is a valid phone number
      if ($("#contact-no").val().trim() == "") {
        alert("Contact number field is required.");
        isValid = false;
      } else if (!isValidPhoneNumber($("#contact-no").val().trim())) {
        alert("Please enter a valid phone number.");
        isValid = false;
      }
      
      return isValid;
    }

    // Function to validate email address format
    function isValidEmail(email) {
    var emailRegex = /^([\w-.]+@([\w-]+.)+[\w-]{2,4})?$/;
    return emailRegex.test(email);
    }
    
    // Function to validate phone number format
    function isValidPhoneNumber(phoneNumber) {
    var phoneNumberRegex = /^\d{10}$/;
    return phoneNumberRegex.test(phoneNumber);
    }
    });
  

    $(document).ready(function() {
        // Handle form submission
        $('#login-form').submit(function(event) {
          // Prevent default form submission
          event.preventDefault();
          
          // Get form data
          var formData = {
            'Firstname': $('input[name=Firstname]').val(),
            'password': $('input[name=password]').val()
          };
          
          // Validate form data
          var errors = [];
          if (formData.Firstname === '') {
            errors.push('Please enter a Firstname');
          }
          if (formData.password === '') {
            errors.push('Please enter a password');
          }
          
          // If there are errors, display them and return
          if (errors.length > 0) {
            $('#error-list').empty();
            for (var i = 0; i < errors.length; i++) {
              $('#error-list').append('<li>' + errors[i] + '</li>');
            }
            $('#error-message').show();
            return;
          }
          
          // If there are no errors, submit the form
          $('#error-message').hide();
          this.submit();
        });
      });
      
      $(document).ready(function() {
        // Handle form submission
        $('#update-form').submit(function(event) {
            event.preventDefault();
    
            // Validate form fields
            var errors = validateForm();
            if (errors.length > 0) {
                alert(errors.join('\n'));
                return;
            }
    
            // Submit form data to PHP script
            var formData = $(this).serialize();
            $.ajax({
                url: 'update-profile.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response);
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
    });
    
    function validateForm() {
        var errors = [];
    
        // Validate Firstname field
        var firstname = $('#Firstname').val();
        if (firstname === '') {
            errors.push('First Name is required');
        }
    
        // Validate email field
        var email = $('#email').val();
        if (email === '') {
            errors.push('Email is required');
        } else if (!isValidEmail(email)) {
            errors.push('Invalid email format');
        }
    
        // Validate password field
        var password = $('#password').val();
        if (password === '') {
            errors.push('Password is required');
        }
    
        // Validate contact_no field
        var contact_no = $('#contact_no').val();
        if (contact_no === '') {
            errors.push('Contact Number is required');
        }
    
        // Validate dob field
        var dob = $('#dob').val();
        if (dob === '') {
            errors.push('Date of Birth is required');
        }
    
        return errors;
    }
    
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    