<template>
  <div
    v-for="data in boardList"
    :key="data"
    class="m-[2.5%] h-[50px] inline-block relative w-[20%]"
  >
    <board-compo :boardAbout="data" :parent="'myBoard'"> </board-compo>
    <button
      class="absolute top-[-30px] right-0 bg-[#40f7a5] color-[#2c3e50] rounded-[30px] p-2"
    >
      update
    </button>
    <button class="text-red-500 font-bold" @click="delData(data.id)">X</button>
  </div>

  <div></div>
</template>

<script>
import * as boards from "@/api/boards.js";
import BoardCompo from "@/components/BoardCompo.vue";
export default {
  components: { BoardCompo },
  componenets: {
    BoardCompo,
  },
  data() {
    return {
      boardList: [],
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
  },
  mounted() {
    this.getData();
  },
};
</script>

<style></style>
