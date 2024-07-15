<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5">
      <div class="card">
        <div class="card-body" v-if="user">
          <h3>Update Profile</h3>
          <p>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</p>
          <div class="profile-photo">
            <div class="photo-placeholder">
              <img :src="photo" alt="Profile Photo" v-if="photo"/>
              <span v-else>Photo</span>
            </div>
            <input type="file" @change="uploadPhoto">
            <button @click="triggerPhotoUpload">Upload your photo</button>
          </div>
          <form @submit.prevent="updateProfile">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fullName">Full Name</label>
                  <input type="text" id="fullName" v-model="form.fullName" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <input type="date" id="dob" v-model="form.dob" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="email">Company Email</label>
                  <input type="email" id="email" v-model="form.email" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" v-model="form.password" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="position">Position</label>
                  <select id="position" v-model="form.position" class="form-control">
                    <option value="">Choose your position</option>
                    <!-- Add more position options as needed -->
                  </select>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea id="description" v-model="form.description" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="companyName">Company Name</label>
                  <input type="text" id="companyName" v-model="form.companyName" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="industry">Industry</label>
                  <select id="industry" v-model="form.industry" class="form-control">
                    <option value="">Choose your industry</option>
                    <!-- Add more industry options as needed -->
                  </select>
                </div>
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" id="city" v-model="form.city" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" id="country" v-model="form.country" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="benefits">Benefits</label>
                  <input type="text" id="benefits" v-model="form.benefits" class="form-control"/>
                </div>
              </div>
            </div>
            <div class="form-actions mt-3">
              <button type="submit" class="btn btn-warning">Update</button>
              <button type="button" class="btn btn-danger" @click="logout">Logout</button>
            </div>
          </form>
          <div class="account-actions mt-3">
            <router-link to="/login" class="btn btn-link">Already have an account? Sign In</router-link>
            <button type="button" class="btn btn-danger" @click="deleteAccount">Delete Account?</button>
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
import { useRouter } from 'vue-router';

export default {
  components: {
    NavbarComponent,
    BackgroundComponent
  },
  props: ['id'],
  setup(props) {
    let user = ref({});
    let photo = ref('');
    let form = ref({
      fullName: '',
      dob: '',
      email: '',
      password: '',
      position: '',
      description: '',
      companyName: '',
      industry: '',
      city: '',
      country: '',
      benefits: ''
    });
    const router = useRouter();

    onMounted(() => {
      axios.get(`http://localhost:8000/employer/${props.id}`)
        .then(response => {
          user.value = response.data.Employer; // Adjust to API data structure
          form.value.fullName = user.value.fullname;
          form.value.dob = user.value.dob;
          form.value.email = user.value.email;
          form.value.position = user.value.position;
          form.value.description = user.value.description;
          form.value.companyName = user.value.companyName;
          form.value.industry = user.value.industry;
          form.value.city = user.value.city;
          form.value.country = user.value.country;
          form.value.benefits = user.value.benefits;
          // Load the photo if available
          photo.value = user.value.photo;
        })
        .catch(error => {
          console.error('Error fetching employer:', error);
        });
    });

    const uploadPhoto = event => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          photo.value = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };

    const triggerPhotoUpload = () => {
      document.querySelector('input[type="file"]').click();
    };

    const updateProfile = () => {
      // Handle profile update logic here
      axios.put(`http://localhost:8000/employer/${props.id}`, form.value)
        .then(() => {
          alert('Profile updated successfully');
        })
        .catch(error => {
          console.error('Error updating profile:', error);
        });
    };

    const logout = () => {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      user.value = null;
      router.push({ name: 'karir.roles.login' });
    };

    const deleteAccount = () => {
      if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        axios.delete(`http://localhost:8000/employer/${props.id}`)
          .then(() => {
            alert('Account deleted successfully');
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            router.push({ name: 'karir.roles.login' });
          })
          .catch(error => {
            console.error('Error deleting account:', error);
          });
      }
    };

    return {
      user,
      photo,
      form,
      uploadPhoto,
      triggerPhotoUpload,
      updateProfile,
      logout,
      deleteAccount
    };
  }
};
</script>

<style scoped>
.update-profile {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.profile-photo {
  text-align: center;
  margin-bottom: 20px;
}
.photo-placeholder {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: #f0f0f0;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 10px;
}
.photo-placeholder img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}
.form-group {
  margin-bottom: 20px;
  width: 100%;
}
.form-actions {
  display: flex;
  justify-content: space-between;
  width: 100%;
  margin-top: 20px;
}
.btn-update {
  background: #ffcc00;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}
.btn-logout {
  background: #ff4d4d;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}
.account-actions {
  display: flex;
  justify-content: space-between;
  width: 100%;
  margin-top: 20px;
}
.account-actions a {
  color: #ff1493;
}
.btn-delete {
  background: #ff4d4d;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}
</style>
