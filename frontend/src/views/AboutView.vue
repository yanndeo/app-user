<template>
  <div class="container">
    <table class="neumorphic" style="width: 400px;">
        <thead>
          <tr>
            <th>Name</th>
            <th>Total user </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups" :key="group.id">
            <td>{{group.name}}</td>
            <td> --</td>
          </tr>
        </tbody>
      </table>
  </div>
</template>

<script>
  // @ is an alias to /src
  // import HelloWorld from "@/components/HelloWorld.vue";

  export default {
    name: "AboutView",
    data: function () {
      return {
        groups: [],
        isLoading: true,
        auth: null,
        error: false,
      };
    },
    methods: {
      async fetchData() {
        try {
          const response = await this.$http.get("/groups");
          if (response) {
            console.log(response.data);
            this.groups = response.data.data;
            this.isLoading = false;
          }
        } catch (e) {
          console.log(e);
        }
      },

      async handleShow(groupId) {
        let _this = this;
        try {
          const response = await this.$http.get(`/groups/${groupId}`,);
          if (response && 200 === response.status) {
            const {group} = response.data;
            this.form = {...group}
          }
          _this.isLoading = false;
        } catch (e) {
          console.log(e)
        }
      },

      _getAuthorizationConfig() {
        const access_token = localStorage.getItem("access_token");
        return {
          headers: {
            Authorization: `Bearer ${access_token}`,
          },
        };
      },
    },
    mounted() {
      this.fetchData();
      this.isLoading = false;
    },
  };
</script>
