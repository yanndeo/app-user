<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    {{ users.length }}
    <ul class="my-list" v-if="users.length">
      <li v-for="user in users" :key="user.id"> <b>{{ user.first_name }}</b> : {{ user.email }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
 
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
