<template>
  <div>
    <nav class="p-30">
      <router-link to="/">Home</router-link><a> | </a>

      <!-- <a
        v-if="cookies.indexOf('logged') > -1"
        @click="logout()"
        class="cursor-pointer"
        >Logout</a
      > -->
      <a v-if="logged !== false" @click="logout()">Logout</a>
      <router-link to="/login" v-else>Login</router-link>
      <a> | </a>
      <router-link to="/register">Register</router-link>
      <router-link to="/myboard" v-if="logged !== false"
        ><a> | </a>Myboard</router-link
      >
    </nav>

    <router-view />
    <div class="h-[200px]"></div>
  </div>
</template>

<script>
import * as token from "./api/token";
export default {
  components: {},
  data() {
    return { logged: {} };
  },
  methods: {
    logout() {
      let expires = new Date();
      expires.setMinutes(expires.getMinutes() - 1);
      document.cookie = `logged=no;expires=${expires.toGMTString()}`;
      window.location.href = "/";
    },
  },
  mounted() {
    this.logged = token.getToken();
  },
  // watch: {
  //   $route(to, form) {
  //     if (to.path !== form.path) {
  //       this.$cookie = {};
  //       let cookie = document.cookie.split(";");
  //       cookie.forEach((data) => {
  //         this.$cookie[data.split("=")[0]] = data.split("=")[1];
  //       });
  //       console.log(this.$cookie);
  //     }
  //   },
  // },
};
</script>

<style>
* {
  color: black;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a,
board {
  font-weight: bold;
  font-size: clamp(15pt, 2.5vw, 30pt);
  color: #2c3e50;
  cursor: pointer;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
