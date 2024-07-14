<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="signup-container">
      <div class="signup-content">
        <h1>Sign Up</h1>
        <p>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" v-model="form.fullname" placeholder="Enter your first name" required />
          </div>
          <div class="form-group">
            <label for="birthdate">Date of Birth</label>
            <input type="date" id="birthdate" v-model="form.birthdate" placeholder="Enter your date of birth" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="form.email" placeholder="Enter your email" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" v-model="form.password" placeholder="Enter your password" required />
          </div>
          <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" v-model="form.phone_number" placeholder="Enter your password" required />
          </div>
          <div class="form-group">
            <label for="last_education">Last Education</label>
            <select id="last_education" v-model="form.last_education" required>
              <option value="" disabled>Choose your education</option>
              <option value="highSchool">High School</option>
              <option value="bachelor">Bachelor's Degree</option>
              <option value="master">Master's Degree</option>
              <option value="phd">PhD</option>
            </select>
          </div>
          <button type="submit" class="cta-button">Create Account</button>
        </form>
        <div class="signin-text">
          <p>Already have an account? <router-link :to="{ name: 'karir.signin' }">Sign In</router-link></p>
        </div>
      </div>
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
      form: {
        fullname: '',
        birthdate: '',
        email: '',
        password: '',
        phone_number: '',
        last_education: '',
      },
    };
  },
  methods: {
    submitForm() {
      const formData = {
          fullname: this.form.fullname,
          birthdate: this.form.birthdate,
          email: this.form.email,
          password: this.form.password,
          phone_number: this.form.phone_number,
          last_education: this.form.education,
        };
      // Lakukan request POST menggunakan Axios
      axios.post('http://127.0.0.1:8000/user/signup', formData)
        .then(response => {
          // Handle response dari backend sesuai kebutuhan
          console.log('Response:', response.data);
          this.$router.push({ name: 'karir.signin' });
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
  display: flex;
  justify-content: center;
  padding: 20px;
}

.signup-content {
  max-width: 600px;
  padding: 40px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  text-align: left;
}

.signup-content h1 {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 10px;
  
}

.signup-content p {
  font-size: 18px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f9f9f9;
}

.form-group input::placeholder {
  color: #aaa;
}

.cta-button {
  width: 100%;
  background-color: #ffd700;
  color: #000;
  padding: 15px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
}

.cta-button:hover {
  background-color: #ffc700;
}

.signin-text {
  margin-top: 20px;
  text-align: center;
}

.signin-text a {
  color: #FF3380;
  text-decoration: none;
}

.signin-text a:hover {
  text-decoration: underline;
}
</style>
