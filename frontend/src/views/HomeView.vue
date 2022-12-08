<template>
  <div>
    <div v-if="boardList.length > 0" class="flex flex-wrap">
      <router-link
        id="boardBox"
        v-for="data in boardList"
        :key="data"
        class="w-[20%] h-[100px] m-[2.5%] rounded-[20px] flex flex-col justify-between"
        :to="{ name: 'about', params: { id: data.id } }"
      >
        <p>{{ data.id }}</p>
        <p v-if="data.content.length < 15">{{ data.title }}</p>
        <p v-else>{{ data.content.substr(0, 15) }}...</p>
        <p class="">{{ data.userId }}</p>
      </router-link>
    </div>

    <div v-if="this.opened && logged !== undefined">
      <write-board-compo></write-board-compo>
    </div>
    <div
      id="boardModalBtn"
      class="w-[15vw] h-[7vh] rounded-full max-w-[150px] text-[30pt] leading-[10vh]"
      @click="modalOpenFunc()"
    >
      new
    </div>
  </div>
</template>

<script>
import WriteBoardCompo from "@/components/WriteBoardCompo.vue";
import * as token from "@/api/token.js";
import * as boards from "@/api/boards.js";

export default {
  components: { WriteBoardCompo },
  data() {
    return {
      opened: false,
      logged: "",
      boardList: [],
    };
  },
  methods: {
    modalOpenFunc() {
      this.logged = token.getToken();
      console.log(this.logged);
      if (this.logged == false) {
        alert("need login");
        window.location.href = "/login";
      } else {
        this.opened = !this.opened;
      }
    },
  },
  mounted() {
    let self = this;
    boards.index().then((res) => {
      if (res.status == 200) {
        self.boardList = res.data.boards;
      }
    });
  },
};
</script>

<style>
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
#boardBox {
  box-sizing: border-box;
  padding: 10px;
  box-shadow: 1px 1px 10px 1px #c7c7c78f;
}
</style>
