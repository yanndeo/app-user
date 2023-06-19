<template>
    <div class="content">
      <img alt="Vue logo" src="../assets/logo.png" >

      <div class="text">Sign in</div>

      <div class="field">
          <input type="text" required placeholder="Email">
        </div>
        <div class="field">
          <input type="password" required placeholder="Password">
        </div>
        <button>Log in</button>
    </div>
  </template>
  
  <script>
  // @ is an alias to /src
  
  export default {
    name: 'LoginView',
    data:function() {
        return {
            form: {

            }
        }
    },
  }
  </script>
  