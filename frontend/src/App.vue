<template>
  <div>
    <nav class="p-30">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <!-- <a
        v-if="cookies.indexOf('logged') > -1"
        @click="logout()"
        class="cursor-pointer"
        >Logout</a
      > -->
      <a v-if="false"></a>
      <router-link to="/login" v-else>Login</router-link>

      |
      <router-link to="/register">register</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script>
export default {
  data() {
    return {
      cookies: {},
    };
  },
  mounted() {},
  methods: {
    logout() {},
  },
};
</script>

<style>
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

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
