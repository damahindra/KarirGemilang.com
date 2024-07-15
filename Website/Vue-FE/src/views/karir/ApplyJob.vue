<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5 mb-5" v-if="user">
      <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
          <h2 class="card-title">Submit Your Application</h2>
          <div class="mt-3 mb-3">
            <h4>{{ job.job_title }}</h4>
            <div class="text-danger">
              <p>{{ company.company_name }}</p>
            </div>
          </div>
          <p class="text-danger">{{ companyName }}</p>
          <form @submit.prevent="submitForm(user.user_id)">
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
              <label for="whatsAppNumber" class="form-label">WhatsApp Number</label>
              <h5>{{ user.phone_number }}</h5>
            </div>
            <div class="mb-3">
              <label for="resume_path" class="form-label">CV</label>
              <input type="file" id="resume_path" @change="handleFileUpload" class="form-control" accept="application/pdf" required />
            </div>
            <div class="text-center mt-4 mb-4">
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
import { onMounted, ref } from 'vue';
import NavbarComponent from '@/components/NavbarComponent.vue';
import BackgroundComponent from '@/components/BackgroundComponent.vue';
import { useRouter } from 'vue-router';

export default {
  props: ['id'],
  components: {
    NavbarComponent,
    BackgroundComponent
  },
  setup(props) {
    const router = useRouter();
    let user = ref(null);
    let job = ref({});
    let company = ref({});
    let resumeFile = ref(null);

    onMounted(() => {
      axios.get(`http://localhost:8000/job/${props.id}`)
        .then(response => {
          job.value = response.data.Job;
          job.value.exp_level = job.value.exp_level.replace("['", "").replace("']", ""); // Adjust to your API data structure
          job.value.prerequisites = job.value.prerequisites.replace(/<[^>]+>/g, ''); // Adjust to your API data structure
          company.value = response.data.Company; // Adjust to your API data structure
        })
        .catch(error => {
          console.error('Error fetching job:', error);
        });

        const userData = localStorage.getItem('user');
        if (userData) {
          user.value = JSON.parse(userData); // Parse JSON string to object
        }
    });

    const handleFileUpload = (event) => {
      resumeFile.value = event.target.files[0];
    };

    const submitForm = (userId) => {
      const formData = new FormData();
      formData.append('resume_path', resumeFile.value);

      // Make the POST request using Axios
      axios.post(`http://127.0.0.1:8000/job/${props.id}/user/${userId}/application`, formData)
        .then(response => {
          console.log('Response:', response.data);
          router.push({ name: 'karir.home' });
          alert('Application submitted successfully!')
        })
        .catch(error => {
          console.error('Error:', error);
        });
    };

    return {
      user,
      job,
      company,
      handleFileUpload,
      submitForm
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
  width: 200px;
  border-radius: 20px;
}
</style>
