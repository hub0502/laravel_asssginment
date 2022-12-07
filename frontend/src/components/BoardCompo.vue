<template>
  <div></div>
</template>

<script>
import * as boardsApi from "@/api/boards.js";
export default {
  data() {
    return {
      boardList: [],
    };
  },
  methods: {},
  mounted() {
    boardsApi
      .index()
      .then((res) => {
        if (res.status == 200) {
          this.boardList.push(res);
          console.log(res);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>

<style></style>
