<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container mt-4">
        <h2 class="mb-3">Explore Jobs</h2>
        <div class="input-group mb-3">
          <input 
            v-model="searchQuery" 
            type="text" 
            class="form-control" 
            placeholder="What are you looking for?" 
            aria-label="Recipient's username" 
            aria-describedby="button-addon2"
          />
          <button @click="searchJobs" class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
        </div>
        <div v-if="loading" class="text-center">
          <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
        <div class="container mt-4">
          <h2 class="mb-3">Your Jobs</h2>
          <div class="search-add-job mb-3">
            <input 
              type="text" 
              class="form-control search-bar" 
              v-model="searchQuery" 
              placeholder="Search by job title" 
              @input="searchJobs"
            />
            <button class="btn btn-warning add-job" @click="addJob">+ Add Job</button>
          </div>
          <div class="job-list row">
            <div class="col-md-4" v-for="job in filteredJobs" :key="job.id">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="job-card-header d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      <img :src="job.companyLogo" alt="Company Logo" class="company-logo me-2">
                      <h5>{{ job.title }}</h5>
                    </div>
                    <button class="btn btn-danger btn-delete" @click="deleteJob(job.id)">X</button>
                  </div>
                  <p class="card-text text-danger">{{ job.companyName }}</p>
                  <div class="d-flex flex-row mt-4">
                    <div class="d-flex flex-column ms-5">
                      <div class="d-flex flex-row mb-3">
                        <img class="me-2" src="@/assets/case.svg" alt="case">
                        <p>{{ job.exp_level }}</p>
                      </div>
                      <div class="d-flex flex-row mb-3">
                        <img class="me-2" src="@/assets/location.svg" alt="location">
                        <p>{{ job.location_type }}</p>
                      </div>
                    </div>
                    <div class="d-flex flex-column ms-5">
                      <div class="d-flex flex-row mb-3">
                        <img class="me-2" src="@/assets/money.svg" alt="money">
                        <p>Negotiable</p>
                      </div>
                      <div class="d-flex flex-row mb-3">
                        <img class="me-2" src="@/assets/city.svg" alt="city">
                        <p v-if="job.job_location !== ''">{{ job.job_location }}</p>
                        <p v-else>-</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-muted text-center text-secondary fs-6">
                  Apply before {{ job.apply_before }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref, onMounted, computed } from 'vue';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
    setup() {
      const jobs = ref([]);
      const employer = ref(null);
      const loading = ref(true);
      const searchQuery = ref('');
  
      const fetchJobs = () => {
        const employerData = localStorage.getItem('user');
        if (!employerData) {
          return;
        }
        employer.value = JSON.parse(employerData); // Parse JSON string to object
        console.log(employer.value.employer_id);
        // Get API from Laravel Backend
        axios.get(`http://127.0.0.1:8000/employer/${employer.value.employer_id}/jobs`)
          .then(response => {           
            // Assign state posts with response data
            console.log(response);
            jobs.value = response.data.jobs.map(job => {
              job.exp_level = job.exp_level.replace("['", "").replace("']", "");
              return job;
            });
            loading.value = false;
          }).catch(error => {
            console.log(error.response);
            loading.value = false;
          });
      };
  
      const deleteJob = (jobId) => {
        if (confirm('Are you sure you want to delete this job?')) {
          axios.delete(`http://127.0.0.1:8000/jobs/${jobId}`)
            .then(() => {
              jobs.value = jobs.value.filter(job => job.id !== jobId);
              alert('Job deleted successfully');
            })
            .catch(error => {
              console.error('Error deleting job:', error);
            });
        }
      };
  
      const searchJobs = () => {
        // Filter jobs based on searchQuery
        if (searchQuery.value.trim() !== '') {
          jobs.value = jobs.value.filter(job =>
            job.job_title.toLowerCase().includes(searchQuery.value.trim().toLowerCase())
          );
        } else {
          // Reset jobs to original list if searchQuery is empty
          fetchJobs();
        }
      };
  
      const addJob = () => {
        // Redirect to add job page
      };
  
      onMounted(() => {
        fetchJobs();
      });
  
      return {
        jobs,
        loading,
        searchQuery,
        deleteJob,
        searchJobs,
        addJob,
        filteredJobs: computed(() => {
          if (!searchQuery.value) {
            return jobs.value;
          }
          return jobs.value.filter(job => job.title.toLowerCase().includes(searchQuery.value.toLowerCase()));
        })
      };
    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  .search-add-job {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .search-bar {
    flex-grow: 1;
    margin-right: 10px;
  }
  .add-job {
    background-color: #ffcc00;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  .job-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  .job-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: calc(33.333% - 20px);
    box-sizing: border-box;
  }
  .job-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .company-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }
  .btn-delete {
    background: #ff4d4d;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
  }
  </style>
  
