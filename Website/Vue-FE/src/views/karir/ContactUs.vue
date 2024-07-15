<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="contact-page">
        <div class="contact-content">
          <h1>Contact Us</h1>
          <p class="intro">
            If you have any questions or need further information, feel free to contact us through the following channels:
          </p>
          <div class="form-group">
            <label for="email">Email</label>
            <p id="email">support@karirgemilang.com</p>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <p id="phone">+62 123 456 7890</p>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <p id="address">Jl. Sudirman No. 123, Jakarta, Indonesia</p>
          </div>
          <div class="form-group">
            <label>Social Media</label>
            <p>Follow us on our social media platforms for the latest updates:</p>
            <ul class="social-links">
              <li><a href="https://www.facebook.com/karirgemilang">Facebook</a></li>
              <li><a href="https://www.twitter.com/karirgemilang">Twitter</a></li>
              <li><a href="https://www.instagram.com/karirgemilang">Instagram</a></li>
              <li><a href="https://www.linkedin.com/company/karirgemilang">LinkedIn</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
  };
  </script>
  
  <style scoped>
  .contact-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }
  
  .contact-content {
    text-align: center;
    max-width: 800px;
    width: 100%;
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
  }
  
  .intro {
    font-size: 1.2em;
    margin-bottom: 30px;
    color: #555;
  }
  
  .form-group {
    margin-bottom: 20px;
    width: 100%;
  }
  
  label {
    font-size: 1.1em;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
  }
  
  p {
    font-size: 1.1em;
    color: #666;
    margin: 0;
  }
  
  .social-links {
    list-style: none;
    padding: 0;
  }
  
  .social-links li {
    margin: 5px 0;
  }
  
  .social-links a {
    color: #5f3dc4;
    text-decoration: none;
    font-weight: bold;
  }
  
  .social-links a:hover {
    text-decoration: underline;
  }
  </style>
  