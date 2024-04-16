<?php require_once('layouts/header.php'); ?>

    <!-- section abt_one -->
    <div class="container-fluid contact_section">
      <div class="row" data-aos="fade-zoom-in" data-aos-duration="1000">
          <div class="col-md-7 ipad_foot">
              <!-- <p class="contact_head mb-5 pt-3">hello<span>.</span></p> -->
              <h2 class="contact_txt">It's <span class="" id="sys-time"></span> <span class="toolate">and never too</span><span class="toolate"> late to say hi!</span></h2>
              <div class="contact_info">
                <h3 class="mb-4">Together we can create something beautiful...</h3>
                <h4 class="mb-3">Do you have a creative challenge for us? <span>Let's connect.</span></h4>
                <p>info@nextdecipher.com</p>
              </div>
          </div>
          <div class="col-md-5 contact_form_wrap ipad_foot">
            <form>
              <div class="contact_form">
                <h2 class="mb-4">Let’s get in touch!</h2>
                <div class="form-group">
                  <label for="name">Your Name <span class="text-danger">*</span></label>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="con_icons"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                  <input type="text" class="form-control" id="name" aria-describedby="yourName" placeholder="Your Name">
                </div>
                <div class="form-group">
                  <label for="email">Your Email <span class="text-danger">*</span></label>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="con_icons"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Your email">
                </div>
                <div class="form-group">
                  <label for="subject">Subject</label>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="con_icons"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                  <input type="text" class="form-control" id="subject" aria-describedby="subject" placeholder="Subject">
                </div>
                <div class="form-group">
                  <label for="message">Message</label>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="con_icons"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                  <textarea name="message" id="message" rows="4" class="form-control" placeholder="Your Message"></textarea>
                </div>
                <div id="message-success" style="display: none;">
                  <div class="alert alert-success fade show" role="alert">
                    Thanks for reaching out!
                  </div>
                </div>
                <div id="message-error" style="display: none;">
                  <div class="alert alert-danger fade show" role="alert">
                    Sorry! We failed to get your request. Please try again later.
                  </div>
                </div>
                <button id="submitContact" type="submit" class="btn btn-primary col-md-12">Send Message</button>
              </div>
            </form>
          </div>
      </div>
    </div>

  <?php require_once('layouts/footer.php'); ?>

  <script>
    window.onload = function() {
      startTime();
    };
    $(document).ready(function() {
      $("#submitContact").click(function(event) {
        event.preventDefault();
        // Reset error messages
        $("#message-error").hide();
        $("#message-success").hide();

        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var subject = $("#subject").val().trim();
        var message = $("#message").val().trim();
        if(name=='' || email=='') {
          $("#message-error .alert").text('Please fill out the required fields.');
          $("#message-error").show();
          return false;
        }

        $.ajax({
          url: 'contact-submit.php',
          method: 'POST',
          data: {name: name, email: email, subject: subject, message: message}
        })
        .done(function(data) {
          var data = $.parseJSON(data);
          if(data.success) {
            $("#message-success .alert").text('Thanks for reaching out!');
            $("#message-success").show();

            // Reset form data
            $("#name").val('');
            $("#email").val('');
            $("#subject").val('');
            $("#message").val('');
          }
          else
            $("#message-error").show();
        })
        .fail(function(data) {
            $("#message-error .alert").text('Sorry! We failed to get your request. Please try again later.');
            $("#message-error").show();
        });
      });
    });
  </script>  
</body>

</html>