<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="update-job-details">
        <h1>Update Job Details</h1>
        <p>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
  
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label for="jobTitle">Job Title</label>
            <input type="text" v-model="jobTitle" id="jobTitle" />
          </div>
  
          <div class="form-group">
            <label for="locationType">Location type</label>
            <select v-model="locationType" id="locationType">
              <option value="Hybrid">Hybrid</option>
              <option value="Remote">Remote</option>
              <option value="On-site">On-site</option>
            </select>
          </div>
  
          <div class="form-group">
            <label for="location">Location</label>
            <input type="text" v-model="location" id="location" />
          </div>
  
          <div class="form-group">
            <label for="applicationDeadline">Application Deadline</label>
            <input type="date" v-model="applicationDeadline" id="applicationDeadline" />
          </div>
  
          <div class="form-group">
            <label for="experienceLevel">Experience Level (Full-Time, Part Time, or Internship)</label>
            <input type="text" v-model="experienceLevel" id="experienceLevel" />
          </div>
  
          <div class="form-group">
            <label for="jobDescription">Job description</label>
            <textarea v-model="jobDescription" id="jobDescription"></textarea>
          </div>
  
          <div class="form-group">
            <label for="preRequisites">Pre-Requisites</label>
            <textarea v-model="preRequisites" id="preRequisites"></textarea>
          </div>
  
          <button type="submit" class="update-btn">Update</button>
          <button type="button" @click="cancel" class="cancel-btn">Cancel</button>
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
      BackgroundComponent
    },
    data() {
      return {
        jobTitle: '',
        locationType: '',
        location: '',
        applicationDeadline: '',
        experienceLevel: '',
        jobDescription: '',
        preRequisites: ''
      }
    },
    methods: {
      submitForm() {
        // Handle form submission
        console.log('Form submitted:', this.$data);
      },
      cancel() {
        // Handle cancel action
        console.log('Form cancelled');
      }
    }
  }
  </script>
  
  <style scoped>
  .update-job-details {
    max-width: 600px;
    margin: 50px auto; /* Added margin to move it down from the navbar */
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    text-align: center;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  input,
  select,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
  }
  
  textarea {
    resize: vertical;
  }
  
  button {
    width: 48%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .update-btn {
    background-color: #ffc107;
    color: #fff;
    margin-right: 4%;
  }
  
  .cancel-btn {
    background-color: #dc3545;
    color: #fff;
  }
  </style>
  