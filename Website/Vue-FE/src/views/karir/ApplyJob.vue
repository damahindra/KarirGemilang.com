<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container mt-5" v-if="user">
        <div class="card mx-auto" style="max-width: 600px;">
          <div class="card-body">
            <h2 class="card-title">Submit Your Application</h2>
            <h4>{{ jobTitle }}</h4>
            <p class="text-danger">{{ companyName }}</p>
            <form @submit.prevent="submitApplication">
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <h5>{{ user.fullname }}</h5>
              </div>
              <div class="mb-3">
                <label for="birthDate" class="form-label">Birth Date</label>
                <h5>{{ user.birthdate }}</h5>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <h5>{{ user.email }}</h5>
              </div>
              <div class="mb-3">
                <label for="whatsAppNumber" class="form-label">WhatsApp Number (Starts with +62)</label>
                <h5>{{ user.phone_number }}</h5>
              </div>
              <div class="mb-3">
                <label for="cv" class="form-label">CV</label>
                <input type="file" id="cv" @change="handleFileUpload" class="form-control" accept="application/pdf" required />
              </div>
              <div class="text-center">
                <button @click="submitForm" type="submit" class="btn btn-warning">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
    data() {
    return {
      form: {
        resume_path : '',
      },
    };
  },
    setup() {
      let user = ref(null);
      onMounted(() => {
        const userData = localStorage.getItem('user');
        if (userData) {
          user.value = JSON.parse(userData); // Parse JSON string to object
        }
      });
      return {
        user
      };
    },
    methods : {
      submitForm(jobId, userId) {
        const formData = {
            resume_path : this.form.resume_path
          };
        // Lakukan request POST menggunakan Axios
        axios.post('http://127.0.0.1:8000/job/' + jobId + '/user/' + userId + '/application', formData)
          .then(response => {
            // Handle response dari backend sesuai kebutuhan
            console.log('Response:', response.data);
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
    }
  };
  </script>
  
  <style scoped>
  .card-title {
    font-weight: bold;
  }
  .btn-warning {
    background-color: #FFE767;
    border-color: #FFE767;
    color: #000;
  }
  </style>
  