<template>
  <div class="content">
    <img alt="Vue logo" src="../assets/logo.png" />
    <div class="text">Sign in</div>
    <form @submit.prevent="handleLogin" class="form form-login">
      <div class="field">
        <input type="text"  placeholder="Email" v-model="form.email" />
      </div>
      <div class="field">
        <input
                type="password"
                placeholder="Password"
                v-model="form.password"
        />
      </div>
      <button type="submit">Log in</button>
      <div v-if="error">
        <span class="text-error">{{ error }} </span>
      </div>
    </form>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "LoginView",
  data: function () {
    return {
      form: {
        email: "",
        password: "",
      },
      error:null,
    };
  },
  methods: {
    async handleLogin() {
      const email = this.form.email;
      const password = this.form.password;
        try {
          const response =  await this.$http.post("/login", { email, password });
          const {user, access_token} = response.data;

          if (access_token && 200 === response.status) {
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("access_token", access_token);
            this.$router.push("/users");
          }
        } catch (error) {
          if( error) {
            const err = error.response['data']['message']; // object
            this.error = err;
            console.log('err', err)
          }
        }
    },
  },

  created() {
    const accessToken = localStorage.getItem("access_token");
    const user = localStorage.getItem("user");

    if (accessToken && user) {
      // Rediriger vers la page users
      this.$router.push("/users");
    }
  },
};
</script>
<style >
  .text-error {
    color: darkred;
    font-size: 14px;
    text-align: left;
    margin-left: 6px;
  }
</style>