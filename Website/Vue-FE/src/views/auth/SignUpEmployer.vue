<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="signup-container">
        <div class="signup-header">
          <h1>Sign Up</h1>
          <p>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
        </div>
        <form class="signup-form" @submit.prevent="submitForm">
          <div class="form-row">
            <div class="form-group">
              <label for="fullName">Full name</label>
              <input type="text" id="fullName" v-model="fullName" placeholder="Enter your name" />
            </div>
            <div class="form-group">
              <label for="companyName">Company Name</label>
              <input type="text" id="companyName" v-model="companyName" placeholder="Enter your company name" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="dob">Date of birth</label>
              <input type="date" id="dob" v-model="dateOfBirth" placeholder="Enter your date of birth" />
            </div>
            <div class="form-group">
              <label for="industry">Industry</label>
              <input type="text" id="industry" v-model="industry" placeholder="Choose your company industry" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Company Email</label>
              <input type="email" id="email" v-model="companyEmail" placeholder="Enter your email" />
            </div>
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" id="city" v-model="city" placeholder="Enter your company city" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" v-model="password" placeholder="Enter your password" />
            </div>
            <div class="form-group">
              <label for="country">Country</label>
              <input type="text" id="country" v-model="country" placeholder="Enter your company country" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="position">Position</label>
              <input type="text" id="position" v-model="position" placeholder="Choose your position" />
            </div>
            <div class="form-group">
              <label for="benefits">Benefits</label>
              <select id="benefits" v-model="benefits">
                <option value="" disabled>Choose your benefits</option>
                <option value="medicalInsurance">Medical Insurance</option>
                <option value="transportation">Transportation</option>
                <option value="paidSickDay">Paid Sick Day</option>
                <option value="bonusSystem">THR/Bonus System</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" v-model="description" placeholder="Enter a brief description of your company"></textarea>
          </div>
          <button type="submit" class="btn btn-primary create-account-btn">Create Account</button>
          <div class="signin-text">
          <p>Already have an account? <router-link :to="{ name: 'karir.signin' }">Sign In</router-link></p>
        </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent,
    },
    data() {
      return {
        fullName: '',
        dateOfBirth: '',
        companyEmail: '',
        password: '',
        position: '',
        companyName: '',
        industry: '',
        city: '',
        country: '',
        benefits: '',
        description: '',
      };
    },
    methods: {
      submitForm() {
        // Handle form submission logic
        const formData = {
          fullName: this.fullName,
          dateOfBirth: this.dateOfBirth,
          companyEmail: this.companyEmail,
          password: this.password,
          position: this.position,
          companyName: this.companyName,
          industry: this.industry,
          city: this.city,
          country: this.country,
          benefits: this.benefits,
          description: this.description,
        };
        console.log('Form submitted:', formData);
      },
    },
  };
  </script>
  
  <style scoped>
  .signup-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .signup-header {
    text-align: left;
    margin-bottom: 20px;
  }
  
  .signup-header .logo {
    height: 32px;
  }
  
  .signup-form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .form-row {
    display: flex;
    justify-content: space-between;
  }
  
  .form-group {
    flex: 1;
    margin-right: 10px;
  }
  
  .form-group:last-child {
    margin-right: 0;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .create-account-btn {
    background-color: #FFE767;
    color: #000;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .create-account-btn:hover {
    background-color: #e6d156;
  }
  
  .signin-text {
  margin-top: 20px;
  text-align: center;
}

.signin-text a {
  color: #FF3380;
  text-decoration: none;
}
  
  .signin-link a:hover {
    text-decoration: underline;
  }
  </style>
  