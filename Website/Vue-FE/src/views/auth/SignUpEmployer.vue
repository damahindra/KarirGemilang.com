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
            <select id="company_industry" v-model="company_industry">
              <option value="" disabled>Choose Your Company Industry</option>
              <option value="informationTechnology">Information Technology</option>
              <option value="finance">Finance</option>
              <option value="healthcare">Healthcare</option>
              <option value="education">Education</option>
              <option value="manufacturing">Manufacturing</option>
              <option value="retail">Retail</option>
              <option value="transportation">Transportation</option>
              <option value="construction">Construction</option>
              <option value="energy">Energy</option>
              <option value="telecommunications">Telecommunications</option>
              <option value="hospitality">Hospitality</option>
              <option value="realEstate">Real Estate</option>
              <option value="entertainment">Entertainment</option>
              <option value="foodAndBeverage">Food & Beverage</option>
              <option value="legal">Legal</option>
              <option value="consulting">Consulting</option>
              <option value="marketingAndAdvertising">Marketing & Advertising</option>
              <option value="nonprofit">Nonprofit</option>
              <option value="pharmaceuticals">Pharmaceuticals</option>
              <option value="publicSector">Public Sector</option>
            </select>
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
              <option value="executiveTeam">Executive Team</option>
              <option value="operationsTeam">Operations Team</option>
              <option value="financeTeam">Finance Team</option>
              <option value="engineeringTeam">Engineering Team</option>
              <option value="productTeam">Product Team</option>
              <option value="salesTeam">Sales Team</option>
              <option value="marketingTeam">Marketing Team</option>
              <option value="humanResourceTeam">Human Resource Team</option>
              <option value="customerSupportTeam">Customer Support Team</option>
              <option value="designTeam">Design Team</option>
              <option value="dataTeam">Data Team</option>
              <option value="itTeam">IT Team</option>
              <option value="legalTeam">Legal Team</option>
              <option value="researchAndDevelopmentTeam">Research and Development Team</option>
              <option value="qualityAssuranceTeam">Quality Assurance Team</option>
              <option value="businessDevelopmentTeam">Business Development Team</option>
              <option value="publicRelationsTeam">Public Relations Team</option>
            </select>
          </div>
          <div class="form-group">
            <label for="company_benefits">Benefits</label>
            <div class="dropdown" @click="toggleDropdown">
              <button type="button" class="dropdown-toggle">{{ company_benefits.length > 0 ? company_benefits.join(', ') : 'Choose Your Benefits' }}</button>
              <div class="dropdown-menu justify-content-start row" v-if="isDropdownOpen" @click.stop>
                <div class="dropdown-item col">
                  <label for="medicalInsurance">Medical Insurance</label>
                  <input type="checkbox" id="medicalInsurance" value="Medical Insurance" v-model="company_benefits">
                </div>
                <div class="dropdown-item col">
                  <label for="transportation">Transportation</label>
                  <input type="checkbox" id="transportation" value="Transportation" v-model="company_benefits">
                </div>
                <div class="dropdown-item col">
                  <label for="paidSickDay">Paid Sick Day</label>
                  <input type="checkbox" id="paidSickDay" value="Paid Sick Day" v-model="company_benefits">
                </div>
                <div class="dropdown-item col">
                  <label for="bonusSystem">THR/Bonus System</label>
                  <input type="checkbox" id="bonusSystem" value="THR/Bonus System" v-model="company_benefits">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="phone_number" id="phone_number" v-model="phone_number" placeholder="Enter your password" />
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
import { useRouter } from 'vue-router';

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
      phone_number: '',
      position: '',
      company_name: '',
      company_industry: '',
      company_city: '',
      company_country: '',
      company_benefits: [],
      company_description: '',
      isDropdownOpen: false,
    };
  },
  methods: {
    submitForm() {
      const router = useRouter();
      // Handle form submission logic
      const formData = {
        fullname: this.fullname,
        birthdate: this.birthdate,
        email: this.email,
        password: this.password,
        phone_number: this.phone_number,
        position: this.position,
        company_name: this.company_name,
        company_industry: this.company_industry,
        company_city: this.company_city,
        company_country: this.company_country,
        company_benefits: this.company_benefits.toString(),
        company_description: this.company_description,
      };
      console.log('Form submitted:', formData);

      axios.post('http://127.0.0.1:8000/employer/signup', formData)
        .then(response => {
          // Handle response dari backend sesuai kebutuhan
          console.log('Response:', response.data);
          router.push({ name: 'karir.signin' });
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
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
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
  flex-wrap: wrap;
}

.form-group {
  flex: 1;
  margin-right: 10px;
  min-width: 280px; /* Adjust as needed */
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

.dropdown {
  position: relative;
  display: inline-block;
  width: 100%;
}

.dropdown-toggle {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  cursor: pointer;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  text-align: left;
}

.dropdown-menu {
  display: block;
  position: absolute;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 1;
  width: 100%;
  padding: 10px;
  max-height: 200px;
  overflow-y: auto;
}

.dropdown-item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  justify-content: space-between;
}

.dropdown-item label {
  margin-left: 5px;
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

.form-group .dropdown-menu .dropdown-item {
  display: flex;
  align-items:start;
  margin-bottom: 10px;
  justify-content: space-between;
}

.form-group .dropdown-menu .dropdown-item input[type="checkbox"] {
  margin-left: 10px;
}
</style>
