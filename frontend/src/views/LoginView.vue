<template>
  <div class="content">
    <img alt="Vue logo" src="../assets/logo.png" />

    <div class="text">Sign in</div>

    <div class="field">
      <input type="text" required placeholder="Email" v-model="form.email" />
    </div>
    <div class="field">
      <input
        type="password"
        required
        placeholder="Password"
        v-model="form.password"
      />
    </div>
    <button @click="handleLogin">Log in</button>
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
    };
  },
  methods: {
    handleLogin() {
      const email = this.form.email;
      const password = this.form.password;

      this.$http
        .post("/api/login", { email, password })
        .then((response) => {
          const user = response.data.user;
          const accessToken = response.data.access_token;
          // Stocker l'utilisateur et le jeton d'accès dans le stockage local ou les cookies
          localStorage.setItem("user", JSON.stringify(user));
          localStorage.setItem("access_token", accessToken);
          this.$router.push("/home");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
