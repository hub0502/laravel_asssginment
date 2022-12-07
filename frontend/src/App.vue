<template>
  <div>
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

    <div v-if="this.$modalOpened">
      <write-board-compo></write-board-compo>
    </div>
    {{ opened }}

    <div
      id="boardModalBtn"
      class="w-[15vw] h-[7vh] rounded-full max-w-[150px] min-h-[60px] text-[30pt] leading-[10vh]"
      @click="modalOpenFunc()"
    >
      new
    </div>

    <router-view />
  </div>
</template>

<script>
import WriteBoardCompo from "./components/WriteBoardCompo.vue";
export default {
  components: {
    WriteBoardCompo,
  },
  data() {
    return {
      cookies: {},
      opened: this.$modalOpened,
    };
  },
  methods: {
    modalOpenFunc() {
      this.$modalOpened = !this.$modalOpened;
      this.opened = this.$modalOpened;
      console.log(this.opened);
    },
  },
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
}

nav a.router-link-exact-active {
  color: #42b983;
}
#boardModalBtn {
  background-color: #40f7a5;
  color: #2c3e50;
  line-height: 7vh;
  box-shadow: 1px 1px 10px 1px #98c4b0;
  font-size: clamp(15pt, 2.5vw, 30pt);
  font-weight: bold;
  cursor: pointer;
  position: fixed;
  right: 5%;
  bottom: 10%;
}
#modal_bg {
  opacity: 70%;
}
</style>
