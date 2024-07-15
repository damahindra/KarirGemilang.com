<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container mt-5 fade-in">
        <h2 class="text-center">Add New Job</h2>
        <p class="text-center">Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
        <div class="card p-5">
          <form @submit.prevent="submitJob">
            <div class="mb-3">
              <label for="job_title" class="form-label">Job Title</label>
              <input type="text" class="form-control" id="job_title" v-model="job_title" required>
            </div>
            <div class="mb-3">
              <label for="location_type" class="form-label">Location type</label>
              <select class="form-select" id="location_type" v-model="location_type" required>
                <option value="" disabled>Select location type</option>
                <option value="On-Site">On-Site</option>
                <option value="Remote">Remote</option>
                <option value="Hybrid">Hybrid</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="apply_before" class="form-label">Application Deadline</label>
              <input type="date" class="form-control" id="apply_before" v-model="apply_before" required>
            </div>
            <div class="mb-3">
              <label for="job_location" class="form-label">Location</label>
              <input type="text" class="form-control" id="job_location" v-model="job_location" required>
            </div>
            <div class="mb-3">
              <label for="exp_level" class="form-label">Experience Level</label>
              <select class="form-select" id="exp_level" v-model="exp_level" required>
                <option value="" disabled>Select experience level</option>
                <option value="fullTime">Full-Time</option>
                <option value="partTime">Part-Time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="job_description" class="form-label">Job description</label>
              <textarea class="form-control" id="job_description" rows="3" v-model="job_description" required></textarea>
            </div>
            <div class="mb-3">
              <label for="prerequisites" class="form-label">Pre-Requisites</label>
              <textarea class="form-control" id="prerequisites" rows="3" v-model="prerequisites" required></textarea>
            </div>
            <button @click="submitJob(user)" type="submit" class="btn btn-primary w-100">Add Job</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  import { onMounted, ref } from 'vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
    data() {
      return {
        job_title: '',
        location_type: '',
        apply_before: '',
        job_location: '',
        exp_level: '',
        job_description: '',
        prerequisites: ''
      };
    },

    setup() {
      let user = ref(null);
      onMounted(() => {
        const userData = localStorage.getItem('user');
        if (userData) {
          console.log(userData);
          user.value = JSON.parse(userData); // Parse JSON string to object
        }
      });
      return {
          user
      }
    },
    methods: {
      submitJob(user) {
        const jobData = {
          job_title: this.job_title,
          location_type: this.location_type,
          apply_before: this.apply_before,
          job_location: this.job_location,
          exp_level: this.exp_level,
          job_description: this.job_description,
          prerequisites: this.prerequisites
        };

        console.log(user)
        axios.post('http://localhost:8000/employer/' + user.employer_id + '/job', jobData)
          .then(response => {
            console.log('Job added successfully', response.data);
            this.$router.push({ name: 'employer.home' });
          })
          .catch(error => {
            console.error('Error adding job:', error);
          });
      }
    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
  }
  
  .card {
    border-radius: 20px;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .btn-primary {
    color: #000;
    background-color: #FFE767;
    border-color: #FFE767;
    border-radius: 20px;
  }

  @keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.fade-in {
  animation: fadeIn 1s ease-in-out;
}
  </style>
  