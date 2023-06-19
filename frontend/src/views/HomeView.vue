<template>
    <div class="container">
      {{ users.length }}

      <table class="neumorphic" v-if="users.length">
        <thead>
          <tr>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>Column 3</th>
            <th>Column 4</th>
            <th>Column 5</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>Cell 1</td>
            <td>Cell 2</td>
            <td>Cell 3</td>
            <td>Cell 4</td>
            <td>Cell 5</td>
          </tr>
         
        </tbody>
      </table>
      <div class="pagination">
  <a href="#" class="pagination__link pagination__link--prev"></a>
  <a href="#" class="pagination__link">1</a>
  <a href="#" class="pagination__link">2</a>
  <a href="#" class="pagination__link">3</a>
  <a href="#" class="pagination__link">4</a>
  <a href="#" class="pagination__link">5</a>
  <a href="#" class="pagination__link pagination__link--next"></a>
</div>


    </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "HomeView",
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
          this.users = response.data.data
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
};
</script>
