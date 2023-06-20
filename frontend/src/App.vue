<template>
    <nav>
    <!-- <router-link to="/">Login</router-link> | -->
    <router-link to="/users">UTILISATEURS</router-link> &
    <router-link to="/group">GROUPES</router-link>
  </nav>
  <div class="border-red">
    <router-view />
  </div>
  
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
  border: 2px solid red;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
.border-red {
  border: 2px solid red;
}

.w-100 {
  width: 100%;
}
.h-100 {
  height: 100%;
}
</style>
