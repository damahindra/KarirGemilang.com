<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5 mb-5">
      <div class="card">
        <div class="card-body" v-if="user">
          <h3 class="mb-4">Update Profile</h3>
          <form @submit.prevent="updateProfile">
            <div class="form-group">
              <label for="fullname">Full Name</label>
              <input type="text" id="fullname" v-model="form.fullname" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="birthdate">Date of Birth</label>
              <input type="date" id="birthdate" v-model="form.birthdate" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" v-model="form.email" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" v-model="form.password" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="phone_number">Phone Number</label>
              <input type="phone_number" id="phone_number" v-model="form.phone_number" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="last_education">Last Education</label>
              <select id="last_education" v-model="form.last_education" class="form-control">
                <option value="">Choose your education</option>
                <option value="high_school">High School</option>
                <option value="bachelor">Bachelor's Degree</option>
                <option value="master">Master's Degree</option>
                <option value="phd">PhD</option>
              </select>
            </div>
            <div class="form-actions mt-3">
              <button type="submit" class="btn btn-warning" @click="updateProfile">Update</button>
              <button type="button" class="btn btn-danger ms-3" @click="logout">Logout</button>
            </div>
          </form>
          <div class="account-actions mt-3">
            <div></div>
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
    let form = ref({
      fullname: '',
      birthdate: '',
      email: '',
      password: '',
      phone_number: '',
      last_education: ''
    });
    const router = useRouter();

    onMounted(() => {
      axios.get(`http://localhost:8000/user/${props.id}`)
        .then(response => {
          console.log(response);
          user.value = response.data.user; // Adjust to API data structure
          form.value.fullname = user.value.fullname;
          form.value.birthdate = user.value.birthdate;
          form.value.email = user.value.email;
          form.value.password = user.value.password;
          form.value.phone_number = user.value.phone_number;
          form.value.last_education = user.value.last_education;
        })
        .catch(error => {
          console.error('Error fetching user:', error);
        });
    });

    const updateProfile = () => {
      // Handle profile update logic here
      axios.put(`http://localhost:8000/user/${props.id}`, form.value)
        .then(() => {
          alert('Profile updated successfully');
          window.location.reload();
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
        axios.delete(`http://localhost:8000/user/${props.id}`)
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
      form,
      updateProfile,
      logout,
      deleteAccount
    };
  }
};
</script>

<style scoped>
.update-profile {
  max-width: 600px;
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
  justify-content: start;
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
