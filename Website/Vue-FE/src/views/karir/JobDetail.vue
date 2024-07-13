<template>
    <div>
      <NavbarComponent />
      <div class="container mt-5">
        <div class="card">
          <div class="card-body">
            <h3>{{ job.job_title }}</h3>
            <p>{{ job.company_name }}</p>
            <div v-html="job.job_description"></div>
            <!-- Tambahkan detail lowongan lainnya -->
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  import NavbarComponent from '@/views/auth/NavbarComponent.vue';
  
  export default {
    components: {
      NavbarComponent
    },
    props: ['id'],
    setup(props) {
      let job = ref({});
  
      onMounted(() => {
        axios.get(`http://localhost:8000/job/${props.id}`)
          .then(response => {
            job.value = response.data.Job; // Sesuaikan dengan struktur data API
          })
          .catch(error => {
            console.error('Error fetching job:', error);
          });
      });
  
      return {
        job
      };
    }
  };
  </script>
  
  <style scoped>
  /* Tambahkan styling tambahan sesuai kebutuhan */
  </style>
  