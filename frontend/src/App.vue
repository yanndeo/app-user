<template>
  <nav>
    <!-- <router-link to="/">Login</router-link> | -->
    <router-link to="/users">UTILISATEURS</router-link> &
    <router-link to="/group">GROUPES</router-link>
  </nav>
  <router-view />
</template>

<style lang="scss">
@import "@/assets/scss/main.scss";

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
  margin-bottom: 60px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
