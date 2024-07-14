import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index'
import store from './store'; // Impor store Vuex
import 'bootstrap/dist/css/bootstrap.css';


const app = createApp(App)
app.use(store)
app.use(router)
app.mount('#app')
