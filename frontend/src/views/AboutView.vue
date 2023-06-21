<template>
  <div class="container">
    <table class="neumorphic" style="width: 400px;">
        <thead>
          <tr>
            <th>Name</th>
              <th>Total user </th>
              <th>Action </th>

          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups" :key="group.id">
            <td>{{group.name}}</td>
            <td> {{ group.users.length}}</td>
              <button type="button" @click.prevent="handleShow(group.id)">View</button>
          </tr>
        </tbody>
      </table>

      <aside>
          <div class="h-100">
                  <h4 v-for="( user, i) in users_group" :key="i">{{i+1}} - {{ user.name}}</h4>
          </div>
      </aside>
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
          users_group: [],
          isLoading: true,
          auth: null,
          error: false,
      };
    },
    methods: {
      async fetchData() {
        try {
          const response = await this.$http.get("/groupes");
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
          const response = await this.$http.get(`/groupes/${groupId}`,);
          if (response && 200 === response.status) {
              console.log(response.data);
              this.users_group = response.data.groupe.users
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
