<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5 d-flex justify-content-start">
        <!-- Kolom 1 -->
        <div class="card same-height mb-3 col-md-1 position-fixed">
          <div class="card-body text-center">
            <div class="mt-2">
              <h4 class="card-text">{{ job.job_title }}</h4>
            </div>
            <div class="mt-2">
              <p class="card-text text-danger">{{ company.company_name }}</p>
            </div>
            <div class="row mt-4 mb-4">
              <div class="col">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <img class="mb-3 me-2" src="@/assets/case.svg" alt="case">
                  <p>{{ job.exp_level }}</p>
                </div>
              </div>
              <div class="col">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <img class="mb-3 me-2" src="@/assets/location.svg" alt="location">
                  <p>{{ job.location_type }}</p>
                </div>
              </div>
              <div class="col">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <img class="mb-3 me-2" src="@/assets/money.svg" alt="money">
                  <p>Negotiable</p>
                </div>
              </div>
              <div class="col">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <img class="mb-3 me-2" src="@/assets/city.svg" alt="city">
                  <p v-if="job.job_location !== ''">{{ job.job_location }}</p>
                  <p v-else>-</p>
                </div>
              </div>
            </div>
            <div>
              <router-link class="btn btn-primary mb-5" :to="{ name: 'karir.job.update'}">Update Job Details</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col me-5">
          <h4 class="mb-3 ms-2">{{ job.total_applicants }} Applicants</h4>
          <div class="container mt-2" v-for="application in applications" :key="application.application_id">
              <!-- Kolom 1 -->
              <div class="card mb-1">
                <div class="card-body text-start">
                  <div class="mt-2">
                    <h4 class="card-text">{{ application.fullname }}</h4>
                  </div>
                  <div class="mt-2">
                    <p class="card-text text-danger">{{ application.email }}</p>
                  </div>
                  <div class="row mt-4 mb-4">
                    <div class="col">
                      <div class="d-flex flex-column align-items-center">
                        <h6>Birth Date</h6>
                        <p>{{ application.birthdate }}</p>
                      </div>
                    </div>
                    <div class="col">
                      <div class="d-flex flex-column align-items-center">
                        <h6>Phone Number</h6>
                        <p>{{ application.phone_number }}</p>
                      </div>
                    </div>
                    <div class="col">
                      <div class="d-flex flex-column align-items-center">
                        <button @click="downloadResume(job.job_id, application.application_id, application.fullname)" class="btn btn-primary">Download Resume</button>
                      </div>
                    </div>
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
import { onMounted, ref } from 'vue';
import NavbarComponent from '@/components/NavbarComponent.vue';
import BackgroundComponent from '@/components/BackgroundComponent.vue';

export default {
  components: {
    NavbarComponent,
    BackgroundComponent
  },
  props: ['id'],
  methods: {
  downloadResume(job_id, application_id, username) {
    axios.get(`http://localhost:8000/job/${job_id}/application/${application_id}/download`, { responseType: 'blob' })
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        let fileName = 'resume-' + username + '.pdf';
        link.setAttribute('download', fileName);
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error('Error downloading resume:', error);
      });
  }
},
  setup(props) {
    let job = ref({});
    let company = ref({});
    let applications = ref([]);

    onMounted(() => {
      axios.get(`http://localhost:8000/job/${props.id}/applications`)
      .then(response => {
          applications.value = response.data.Applications;
        })
        .catch(error => {
          console.error('Error fetching job:', error);
        });
      });
      axios.get(`http://localhost:8000/job/${props.id}`)
        .then(response => {
          job.value = response.data.Job;
          job.value.exp_level = job.value.exp_level.replace("['", "").replace("']", "");
          job.value.prerequisites = job.value.prerequisites.replace("<p>", "").replace("</p>", "").replace("<div>", "").replace("</div>").replace("<br>", "");
          company.value = response.data.Company;
        })
        .catch(error => {
          console.error('Error fetching job:', error);
        });
      
    return {
      job,
      company,
      applications
    };
  }
};
</script>

<style scoped>
.same-height {
  height: 250px;
  width: 600px;
  margin-left: 10px;
  margin-right: 10px;
  margin-top: 90px
}

.btn-primary {
  color: #000;
  background-color: #FFE767;
  border-color: #FFE767;
  border-radius: 20px;
  width: 200px;
}

.container .card {
  min-height: 200px;
}

.container .card .card-body {
  height: 100%;
}

.d-flex {
  display: flex !important;
}

.align-items-center {
  align-items: center !important;
}

.justify-content-center {
  justify-content: center !important;
}
</style>
