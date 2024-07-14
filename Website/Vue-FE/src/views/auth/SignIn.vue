<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="signin-container">
        <div class="signin-header">
          <h1>Sign In</h1>
          <p>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
        </div>
        <form class="signin-form" @submit.prevent="submitForm">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="email" placeholder="Enter your email" required />
            <a href="#" class="forgot-password">Forgot Password?</a>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" v-model="password" placeholder="Enter your password" required />
          </div>
          <button type="submit" class="btn btn-primary signin-btn">Sign In</button>
          <div class="signup-text">
          <p>Already have an account? <router-link :to="{ name: 'karir.signup' }">Sign Up</router-link></p>
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
        email: '',
        password: '',
      };
    },
    methods: {
      submitForm() {
        // Handle form submission logic
        const formData = {
          email: this.email,
          password: this.password,
        };
        // Lakukan request POST menggunakan Axios
      axios.post('http://127.0.0.1:8000/user/login', formData)
        .then(response => {
          // Handle response dari backend sesuai kebutuhan
          console.log('Response:', response.data);
          localStorage.setItem('token', response.data.token);
          localStorage.setItem('user', JSON.stringify(response.data.user));
          console.log(response.data)
          this.$router.push({ name: 'karir.home' });
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
  .signin-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .signin-header {
    text-align: left;
    margin-bottom: 20px;
  }
  
  .signin-header .logo {
    height: 32px;
  }
  
  .signin-form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .form-group {
    margin-bottom: 15px;
    position: relative;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  .form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .forgot-password {
    position: absolute;
    right: 0;
    bottom: -40px;
    font-size: 12px;
    color: #888;
    text-decoration: none;
  }
  
  .forgot-password:hover {
    text-decoration: underline;
  }
  
  .signin-btn {
    background-color: #FFE767;
    color: #000;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .signin-btn:hover {
    background-color: #e6d156;
  }
  
  .signup-text {
    text-align: center;
    margin-top: 10px;
  }
  
  .signup-text a {
    color: #FF3380;
    text-decoration: none;
  }
  
  .signup-text a:hover {
    text-decoration: underline;
  }
  </style>
  