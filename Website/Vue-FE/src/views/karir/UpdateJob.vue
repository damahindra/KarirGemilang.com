<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="update-job-details">
        <h1>Update Job Details</h1>
        <p>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
  
          <div class="form-group">
            <label for="job.job_title">Job Title</label>
            <input type="text" v-model="job.job_title" id="job.job_title" />
          </div>
  
          <div class="form-group">
            <label for="job.location_type">Location type</label>
            <select v-model="job.location_type" id="job.location_type">
              <option value="Hybrid">Hybrid</option>
              <option value="Remote">Remote</option>
              <option value="On-site">On-site</option>
            </select>
          </div>
  
          <div class="form-group">
            <label for="job.job_location">Location</label>
            <input type="text" v-model="job.job_location" id="job.job_location" />
          </div>
  
          <div class="form-group">
            <label for="job.apply_before">Application Deadline</label>
            <input type="date" v-model="job.apply_before" id="job.apply_before" />
          </div>
  
          <div class="form-group">
            <label for="job.exp_level">Experience Level (Full-Time, Part Time, or Internship)</label>
            <input type="text" v-model="job.exp_level" id="job.exp_level" />
          </div>
  
          <div class="form-group">
            <label for="job.job_description">Job description</label>
            <textarea v-model="job.job_description" id="job.job_description"></textarea>
          </div>
  
          <div class="form-group">
            <label for="job.prerequisites">Pre-Requisites</label>
            <textarea v-model="job.prerequisites" id="job.prerequisites"></textarea>
          </div>
  
          <button @click="submitForm" class="update-btn">Update</button>
          <button type="button" @click="cancel" class="cancel-btn">Cancel</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  import { useRouter } from 'vue-router';
  import { ref } from 'vue';
  import { onMounted } from 'vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
    props: ['id'],
    setup(props) {
      const router = useRouter();
      let job = ref({
        job_id: '',
        job_title: '',
        location_type: '',
        job_location: '',
        apply_before: '',
        exp_level: '',
        job_description: '',
        prerequisites: ''
    });
    const submitForm = () => {
          // Handle form submission
          console.log('Form submitted:', job.value);
          // Handle profile update logic here
          axios.put(`http://localhost:8000/job/${props.id}`, job.value)
            .then(() => {
              alert('Job updated successfully');
              router.push({ name: 'karir.employer.job' });
            })
            .catch(error => {
              console.error('Error updating profile:', error);
            });
        };
      onMounted(() => {
        axios.get(`http://localhost:8000/job/${props.id}`)
        .then(response => {
          console.log(response);
          job.value.job_id = response.data.Job.job_id;
          job.value.job_title = response.data.Job.job_title;
          job.value.location_type = response.data.Job.location_type;
          job.value.job_location = response.data.Job.job_location;
          job.value.apply_before = response.data.Job.apply_before;
          job.value.exp_level = response.data.Job.exp_level;
          job.value.job_description = response.data.Job.job_description;
          job.value.prerequisites = response.data.Job.prerequisites;
        })
        .catch(error => {
          console.error('Error fetching user:', error);
        });
        
      })
      return {
      job,
      submitForm
    };
    },
    methods: {
      cancel() {
        // Handle cancel action
        console.log('Form cancelled');
        this.$router.back();
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
  