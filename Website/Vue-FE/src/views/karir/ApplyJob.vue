<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
          <div class="card-body">
            <h2 class="card-title">Submit Your Application</h2>
            <h4>{{ jobTitle }}</h4>
            <p class="text-danger">{{ companyName }}</p>
            <form @submit.prevent="submitApplication">
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" id="fullName" v-model="form.fullName" class="form-control" placeholder="Enter your Name" required />
              </div>
              <div class="mb-3">
                <label for="birthDate" class="form-label">Birth Date</label>
                <input type="date" id="birthDate" v-model="form.birthDate" class="form-control" placeholder="Enter Your Date of Birth" required />
              </div>
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" id="location" v-model="form.location" class="form-control" placeholder="Example: Kota Jakarta" required />
              </div>
              <div class="mb-3">
                <label for="whatsAppNumber" class="form-label">WhatsApp Number (Starts with +62)</label>
                <input type="text" id="whatsAppNumber" v-model="form.whatsAppNumber" class="form-control" placeholder="Example: +62812345678910" required />
              </div>
              <div class="mb-3">
                <label for="cv" class="form-label">CV</label>
                <input type="file" id="cv" @change="handleFileUpload" class="form-control" accept="application/pdf" required />
              </div>
              <div class="mb-3">
                <label for="portfolioLink" class="form-label">Portfolio Link</label>
                <input type="url" id="portfolioLink" v-model="form.portfolioLink" class="form-control" placeholder="https://..." />
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-warning">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref } from 'vue';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
    props: ['jobTitle', 'companyName'],
    setup() {
      const form = ref({
        fullName: '',
        birthDate: '',
        location: '',
        whatsAppNumber: '',
        cv: null,
        portfolioLink: ''
      });
  
      const handleFileUpload = event => {
        form.value.cv = event.target.files[0];
      };
  
      const submitApplication = () => {
        const formData = new FormData();
        formData.append('fullName', form.value.fullName);
        formData.append('birthDate', form.value.birthDate);
        formData.append('location', form.value.location);
        formData.append('whatsAppNumber', form.value.whatsAppNumber);
        formData.append('cv', form.value.cv);
        formData.append('portfolioLink', form.value.portfolioLink);
  
        axios.post('http://localhost:8000/applications', formData)
          .then(response => {
            console.log(response)
            alert('Application submitted successfully');
          })
          .catch(error => {
            console.error('Error submitting application:', error);
          });
      };
  
      return {
        form,
        handleFileUpload,
        submitApplication
      };
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
  