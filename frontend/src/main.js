
import { createApp } from 'vue'
import axios from 'axios'
import App from './App.vue'
import router from './router'
import store from './store'

// Créer une instance Axios
const axiosInstance = axios.create({
  baseURL: 'http://localhost/api',
})

// Créez une application Vue
const app = createApp(App)

// Ajouter l'instance Axios à Vue.prototype
app.config.globalProperties.$http = axiosInstance

// Montez l'application Vue
app.use(store).use(router).mount('#app')
