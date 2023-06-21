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
          <tr v-for="user in users" :key="user.id"   @click.prevent="handleShow(user.id)">
            <td>
              <span v-if="user.first_name">{{ user.first_name }}</span>
              <span v-else>-</span>
            </td>
            <td>
              <span v-if="user.last_name">{{ user.last_name }}</span>
              <span v-else>-</span>
            </td>
            <td>{{ user.email }}</td>
            <td>
              <span v-if="user.phone">{{ user.phone }}</span>
              <span v-else>-</span>
            </td>
            <td>
              <div class="actions">
                <button type="button" @click.prevent="handleShow(user.id)">View</button>
                <button type="button" @click.prevent="handleDelete(user.id)" v-if="auth && auth.email !== user.email" >
                  Delete
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>



      <div class="pagination">
        <a href="#" class="pagination__link pagination__link--prev" @click="fetchData(pagination.prevPage)"></a>
        <a href="#" class="pagination__link "  v-for="page in pagination.lastPage" :key="page" @click="fetchData(page)" >{{page}}</a>
        <a href="#" class="pagination__link pagination__link--next" @click="fetchData(pagination.nextPage)" ></a>
      </div>
    </div>

    <aside>
      <b v-if="form.id">{{form.id}} </b>
      <div class="h-100">
        <form class="form form-register" @submit.prevent="handleSubmit">
          <div class="field" v-if="!form.id">
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

          <div class="neumorphic-select  w-100" >
            <select v-model="form.groupe">
              <option :value="group.id"  :selected="form.groupe === group.id" v-for="group in groups" :key="group.id">{{group.name}}</option>
            </select>
          </div>

          <button type="submit" >Save</button>

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
      pagination: {
        currentPage: null,
        lastPage: null,
        nextPage: null,
        prevPage: null,
      },
      groups: [],
      form: {
        groupe: "",
        phone: "",
        address: "",
        last_name: "",
        first_name: "",
        email: "",
        id:""
      },
    };
  },
  methods: {
    async fetchData(page) {
      try {
        const response = await this.$http.get(`/users?page=${page}`);
        if (response) {
          console.log(response.data);
          this.users = response.data.data;
          this.isLoading = false;

          const pagination = response.data.meta;

          this.pagination.currentPage = pagination.current_page;
          this.pagination.lastPage = pagination.last_page;
          this.pagination.nextPage = pagination.links.next;
          this.pagination.prevPage = pagination.links.prev;

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

    async handleShow(userId) {
      let _this = this;
      try {
        const response = await this.$http.get(`/users/${userId}`,);
        if (response && 200 === response.status) {
          const {user} = response.data;
          this.form = {...user};
          console.log('user', user)
        }
        _this.isLoading = false;
      } catch (e) {
        console.log(e)
      }
    },

    async handleSubmit() {
      const data = {
        email: this.form.email,
        first_name: this.form.first_name,
        last_name: this.form.last_name,
        phone: this.form.phone,
        address: this.form.address,
        groupe: this.form.groupe,
      };

      try {
        const response =  await this.$http.post("/users", data, this._getAuthorizationConfig())
        if(201 === response.status) {
          console.log(response);
          const userIndex = this.users.findIndex(user => user.id === response.data.user.id);
          if (userIndex !== -1) {
           this.users.splice(userIndex, 1, response.data.user);
          } else {
            this.users.unshift(response.data.user);
          }
        }
      } catch (error) {
        console.log(error);
      }

    },

    async fetchGroupe() {
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
    this.fetchData(1);
    this.fetchGroupe();
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
