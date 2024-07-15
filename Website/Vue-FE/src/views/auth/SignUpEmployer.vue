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
              <label for="fullname">Full name</label>
              <input type="text" id="fullname" v-model="fullname" placeholder="Enter your name" />
            </div>
            <div class="form-group">
              <label for="company_name">Company Name</label>
              <input type="text" id="company_name" v-model="company_name" placeholder="Enter your company name" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="birthdate">Date of birth</label>
              <input type="date" id="birthdate" v-model="birthdate" placeholder="Enter your date of birth" />
            </div>
            <div class="form-group">
              <label for="company_industry">Industry</label>
              <input type="text" id="company_industry" v-model="company_industry" placeholder="Choose your company industry" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Company Email</label>
              <input type="email" id="email" v-model="email" placeholder="Enter your email" />
            </div>
            <div class="form-group">
              <label for="company_city">City</label>
              <input type="text" id="company_city" v-model="company_city" placeholder="Enter your company city" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" v-model="password" placeholder="Enter your password" />
            </div>
            <div class="form-group">
              <label for="company_country">Country</label>
              <input type="text" id="company_country" v-model="company_country" placeholder="Enter your company country" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="position">Position</label>
              <select id="position" v-model="position">
                <option value="" disabled>Choose your position</option>
                <option value="Executive Team">Executive Team</option>
                <option value="Operations Team">Operations Team</option>
                <option value="Finance Team">Finance Team</option>
                <option value="Engineering Team">Engineering Team</option>
                <option value="Product Team">Product Team</option>
                <option value="Sales Team">Sales Team</option>
                <option value="Marketing Team">Marketing Team</option>
                <option value="Human Resource Team">Human Resource Team</option>
                <option value="Customer Support Team">Customer Support Team</option>
                <option value="Design Team">Design Team</option>
                <option value="Data Team">Data Team</option>
                <option value="IT Team">IT Team</option>
                <option value="Legal Team">Legal Team</option>
                <option value="Research and Development Team">Research and Development Team</option>
                <option value="Quality Assurance Team">Quality Assurance Team</option>
                <option value="Business Development Team">Business Development Team</option>
                <option value="Public Relations Team">Public Relations Team</option>
              </select>
            </div>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown button
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="company_description">Description</label>
            <textarea id="company_description" v-model="company_description" placeholder="Enter a brief description of your company"></textarea>
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
  import axios from 'axios';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent,
    },
    data() {
      return {
        fullname: '',
        birthdate: '',
        email: '',
        password: '',
        position: '',
        company_name: '',
        company_industry: '',
        company_city: '',
        company_country: '',
        company_benefits: '',
        company_description: '',
      };
    },
    methods: {
      submitForm() {
        // Handle form submission logic
        const formData = {
          fullname: this.fullname,
          birthdate: this.birthdate,
          email: this.email,
          password: this.password,
          position: this.position,
          company_name: this.company_name,
          company_industry: this.company_industry,
          company_city: this.company_city,
          company_country: this.company_country,
          company_benefits: this.company_benefits,
          company_description: this.company_description,
        };
        console.log('Form submitted:', formData);
        // Lakukan request POST menggunakan Axios
        axios.post('http://127.0.0.1:8000/employer/signup', formData)
          .then(response => {
            // Handle response dari backend sesuai kebutuhan
            console.log('Response:', response.data);
            this.$router.push({ name: 'karir.signupemployer' });
            // Contoh: Redirect ke halaman setelah login berhasil
            // this.$router.push('/dashboard');
          })
          .catch(error => {
            // Handle error dari request
            console.error('Error:', error);
            // Contoh: Tampilkan pesan error kepada pengguna
            // alert('Login failed. Please check your credentials.');
          });
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
  