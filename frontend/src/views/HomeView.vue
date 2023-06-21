<template>
  <div class="container">
    {{ users.length }}
    <div
      v-if="isLoading === false"
      style="
        display: flex;
        justify-content: space-between;
        width: 40%;
        margin-bottom: 20px;
      "
    >
      <h3 v-if="auth" class="title">
        Bonjour, <b>{{ auth.email }}</b>
      </h3>
      <b class="text-error" v-if="error">Error: unauthorized! </b>
    </div>
    <div v-if="users.length">
      <table class="neumorphic">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>
              <span v-if="user.first_name">{{ user.first_name }}</span>
              <span v-else>-</span>
            </td>
            <td>
              <span v-if="user.last_name">{{ user.first_name }}</span>
              <span v-else>-</span>
            </td>
            <td>{{ user.email }}</td>
            <td>
              <span v-if="user.phone">{{ user.phone }}</span>
              <span v-else>-</span>
            </td>
            <td>
              <div class="actions">
                <button type="button">View</button>
                <button type="button">Edit</button>
                <button type="button" @click.prevent="handleDelete(user.id)">
                  Delete
                </button>
              </div>
            </td>
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

    <aside>
      xxx
      <div class="h-100">
        <form class="form form-register" @submit.prevent="handleSubmit">
          <div class="field">
            <input type="text" placeholder="Email" v-model="form.email" />
          </div>
          <div class="field">
            <input
              type="text"
              placeholder="FirstName"
              v-model="form.first_name"
            />
          </div>
          <div class="field">
            <input
              type="text"
              placeholder="LastName"
              v-model="form.last_name"
            />
          </div>
          <div class="field">
            <input type="text" placeholder="Phone" v-model="form.phone" />
          </div>
          <div class="field">
            <input type="text" placeholder="Address" v-model="form.address" />
          </div>

          <button type="submit">Save</button>
        </form>
      </div>
    </aside>
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
      isLoading: true,
      auth: null,
      error: false,
      form: {
        phone: "",
        address: "",
        last_name: "",
        first_name: "",
        email: "",
      },
    };
  },
  methods: {
    async fetchData() {
      try {
        const response = await this.$http.get("/users");
        if (response) {
          console.log(response.data);
          this.users = response.data.data;
          this.isLoading = false;
        }
      } catch (e) {
        console.log(e);
      }
    },

    async isUserLoggin() {
      const access_token = localStorage.getItem("access_token");
      if (access_token) {
        try {
          const response = await this.$http.get(
            "/user-detail",
            this._getAuthorizationConfig()
          );
          const { user } = response.data;
          if (user) {
            this.auth = user;
          }
        } catch (e) {
          console.log(e);
        }
      }
    },

    async handleDelete(userId) {
      let _this = this;
      try {
        const response = await this.$http.delete(
          `/users/${userId}`,
          _this._getAuthorizationConfig()
        );
        _this.isLoading = false;
        if (response) {
          const index = _this.users.findIndex((user) => user.id === userId);
          if (index !== -1) {
            this.users.splice(index, 1);
          }
        }
      } catch (error) {
        console.log(error);
        _this.error = true;
      }
    },

    handleSubmit() {
      const data = {
        email: this.form.email,
        first_name: this.form.first_name,
        last_name: this.form.last_name,
        phone: this.form.phone,
        address: this.form.address,
      };
      const access_token = localStorage.getItem("access_token");
      const config = {
        headers: {
          Authorization: `Bearer ${access_token}`,
        },
      };
      this.$http
        .post("/api/users", data, config)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
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
    this.isUserLoggin();
    this.isLoading = false;
  },
};
</script>
<style scoped>
.title {
  font-size: 14px;
  font-weight: 400;
  margin-bottom: 20px;
  text-align: left;
}
</style>
