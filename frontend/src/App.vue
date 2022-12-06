<template>
  <div>
    <board-compo></board-compo>
    <nav class="p-30">
      <router-link to="/">Home</router-link><a> | </a>
      <router-link to="/about">About</router-link> <a> | </a>
      <!-- <a
        v-if="cookies.indexOf('logged') > -1"
        @click="logout()"
        class="cursor-pointer"
        >Logout</a
      > -->
      <a v-if="false"></a>
      <router-link to="/login" v-else>Login</router-link>
      <a> | </a>
      <router-link to="/register">register</router-link>
    </nav>
    <div
      id="menuButton"
      class="w-[20vw] h-[10vh] rounded-full max-w-[200px] text-[30pt] leading-[10vh]"
      click="menuFun()"
    >
      menu
    </div>
    <router-view />
  </div>
</template>

<script>
import BoardCompo from "./components/BoardCompo.vue";
import BoardCompoVue from "./components/BoardCompo.vue";
export default {
  components: { BoardCompo },
  component: {
    BoardCompoVue,
  },
  data() {
    return {
      cookies: {},
      menuVal: false,
    };
  },
  mounted() {},
  methods: {
    logout() {},
    menuFun() {
      this.menuVal = !this.menuVal;
      print(this.menuVal);
    },
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

nav a,
board {
  font-weight: bold;
  font-size: clamp(15pt, 2.5vw, 30pt);
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
#menuButton {
  background-color: #40f7a5;
  color: #2c3e50;
  box-shadow: 1px 1px 10px 1px #98c4b0;
  line-height: 10vh;
  font-size: clamp(15pt, 2.5vw, 30pt);
  font-weight: bold;
  cursor: pointer;
  position: fixed;
  right: 5%;
  bottom: 10%;
}
</style>
