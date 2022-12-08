<template>
  <div
    v-for="data in boardList"
    :key="data"
    class="m-[2.5%] h-[50px] inline-block relative w-[20%]"
  >
    <board-compo :boardAbout="data" :parent="'myBoard'"> </board-compo>
    <button
      class="absolute top-[-30px] right-0 bg-[#40f7a5] color-[#2c3e50] rounded-[30px] p-2"
      @click="setData(data)"
    >
      update
    </button>
    <button class="text-red-500 font-bold" @click="delData(data.id)">X</button>
  </div>

  <div v-if="modalOpen">
    <board-update-compo :data="sendBoard"></board-update-compo>
  </div>
</template>

<script>
import * as boards from "@/api/boards.js";
import BoardCompo from "@/components/BoardCompo.vue";
import BoardUpdateCompo from "@/components/BoardUpdateCompo.vue";
export default {
  components: { BoardCompo, BoardUpdateCompo },

  data() {
    return {
      boardList: [],
      modalOpen: false,
      sendBoard: Array,
    };
  },
  methods: {
    getData() {
      boards
        .shows()
        .then((res) => {
          if (res.data.status == "success") {
            this.boardList = res.data.boards;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    delData(id) {
      boards.destroy(id).then((res) => {
        console.log(res);
        window.location.href = "/myboard";
      });
    },
    setData(data) {
      this.sendBoard = data;
      this.modalOpen = !this.modalOpen;
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style></style>
