<section id="contact-section">
  <h2>Contact</h2>
  <section class="contact-content">
    <section class="contact-left">
      <h3>Contact me</h3>
      <form method="post">
        <div class="form-row">
          <label for="">Name</label>
          <input type="text" name="name" id="name" placeholder="Enter your name" value="<?= $name ? $name : ''?>" >
          <?php if (!empty($nameError)){ ?>
            <p class="error"><?php echo $nameError; ?></p>
          <?php } ?>
        </div>
        <div class="form-row">
          <label for="">Email</label>
          <input type="text" name="email" id="email" placeholder="Enter your email" value="<?= $email ? $email : ''?>" >
          <?php if (!empty($emailError)){ ?>
            <p class="error"><?php echo $emailError; ?></p>
          <?php } ?>
        </div>
        <div class="form-row">
          <label for="">Message</label>
          <textarea name="message" id="message" rows="4" placeholder="Enter your message"></textarea>
          <?php if (!empty($messageError)){ ?>
            <p class="error"><?php echo $messageError; ?></p>
          <?php } ?>
        </div>
        <input type="submit" id="submit" value="Submit" name="submit">
        <?php if (!empty($sendError)){ ?>
          <p class="error"><?php echo $sendError; ?></p>
        <?php }  
        else { 
          echo '<p>'.$success.'</p>';  
        } ?>
      </form>
    </section>
    <section class="contact-right">
      <div class="contact-row">
        <h3>Email</h3>
        <a href="">daanphin@gmail.com</a>
      </div>
      <div class="contact-row">
        <h3>Phonenumber</h3>
        <p>06-10764657</p>
      </div>
      <div class="contact-row">
        <h3>Socials</h3>
        <div class="socials">
          <a href="https://x.com/Aefryr"><i class="fa-brands fa-twitter"></i></a>
          <a href="https://www.linkedin.com/in/daanphi-nguyen-9a80a4367"><i class="fa-brands fa-linkedin"></i></a>
        </div>
      </div>
    </section>
  </section>
</section>