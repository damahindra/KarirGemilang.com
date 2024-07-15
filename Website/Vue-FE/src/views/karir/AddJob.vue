<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container mt-5">
        <h2 class="text-center">Add New Job</h2>
        <p class="text-center">Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
        <div class="card p-5">
          <form @submit.prevent="submitJob">
            <div class="mb-3">
              <label for="jobTitle" class="form-label">Job Title</label>
              <input type="text" class="form-control" id="jobTitle" v-model="jobTitle" required>
            </div>
            <div class="mb-3">
              <label for="locationType" class="form-label">Location type</label>
              <select class="form-select" id="locationType" v-model="locationType" required>
                <option value="" disabled>Select location type</option>
                <option value="On-Site">On-Site</option>
                <option value="Remote">Remote</option>
                <option value="Hybrid">Hybrid</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="applicationDeadline" class="form-label">Application Deadline</label>
              <input type="date" class="form-control" id="applicationDeadline" v-model="applicationDeadline" required>
            </div>
            <div class="mb-3">
              <label for="location" class="form-label">Location</label>
              <input type="text" class="form-control" id="location" v-model="location" required>
            </div>
            <div class="mb-3">
              <label for="experienceLevel" class="form-label">Experience Level (Full-Time, Part Time, or Internship)</label>
              <input type="text" class="form-control" id="experienceLevel" v-model="experienceLevel" required>
            </div>
            <div class="mb-3">
              <label for="jobDescription" class="form-label">Job description</label>
              <textarea class="form-control" id="jobDescription" rows="3" v-model="jobDescription" required></textarea>
            </div>
            <div class="mb-3">
              <label for="preRequisites" class="form-label">Pre-Requisites</label>
              <textarea class="form-control" id="preRequisites" rows="3" v-model="preRequisites" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Job</button>
          </form>
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
      BackgroundComponent
    },
    data() {
      return {
        jobTitle: '',
        locationType: '',
        applicationDeadline: '',
        location: '',
        experienceLevel: '',
        jobDescription: '',
        preRequisites: ''
      };
    },
    methods: {
      submitJob() {
        const jobData = {
          job_title: this.jobTitle,
          location_type: this.locationType,
          application_deadline: this.applicationDeadline,
          location: this.location,
          experience_level: this.experienceLevel,
          job_description: this.jobDescription,
          pre_requisites: this.preRequisites
        };
        axios.post('http://localhost:8000/jobs', jobData)
          .then(response => {
            console.log('Job added successfully', response.data);
            // Redirect or give feedback to the user
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
  </style>
  