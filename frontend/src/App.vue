<template>
    <nav>
    <!-- <router-link to="/">Login</router-link> | -->
    <router-link to="/users">UTILISATEURS</router-link> &
    <router-link to="/group">GROUPES</router-link>
  </nav>
    <button v-if="isAuth" type="button" @click.prevent="handleLogout">Deconnexion</button>
    <router-link to="/" v-else>Se connecter</router-link>
    <div>
    <router-view />
  </div>
  
</template>

<script>
    export  default  {
        name: "App",
        data: function() {
            return {
                isAuth: false
            }
        },
        methods: {
          async handleLogout() {
              const access_token = localStorage.getItem("access_token");
              const config = {
                  headers: {
                      Authorization: `Bearer ${access_token}`,
                  },
              };

              try {
                    const response = await this.$http.post(`/logout`, config);
                    console.log('res', response);
                    /*if( 200 === response.status) {
                        console.log('rr', response)
                        localStorage.removeItem('access_token');
                        localStorage.removeItem('user');

                        this.$router.push("/login");
                    }*/
              } catch (error) {
                    console.log('err', error)
              }

            }
        },
        created() {
            //fake simulation
            const access_token = localStorage.getItem("access_token");
            if(access_token) {
                this.isAuth = true
            }
        }
    }

</script>

<style lang="scss">
@import "@/assets/scss/main.scss";

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
    position: relative;
    height: 100%;
}

nav {
  padding: 30px;
  margin-bottom: 60px;
    text-align: center;
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
