<template>
  <div>
    <img alt="Vue logGod Please" src="./assets/logo.png">
    <HelloWorld msg="Thanks GOD" />
    {{ users.length }}
    <ul class="my-list" v-if="users.length">
      <li v-for="user in users" :key="user.id"> <b>{{ user.name }}</b> : {{ user.email }}</li>
    </ul>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'App',
  components: {
    HelloWorld
  },

  data: function () {
    return {
      users: [],
      isLoading: false
    }
  },
  methods: {
    fetchData() {
      this.isLoading = true
      this.$http.get('/users')
        .then(response => {
          console.log(response.data);
          this.users = response.data
          this.isLoading = false
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
  mounted() {
    this.fetchData()
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.border-red {
  border: 1px solid red;
}

.text-dark {
  color: black;
}

.my-list {
  text-align: left;
  width: 50%;
  margin: 0 auto;
}
</style>
