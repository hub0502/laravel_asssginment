<template>
  <div></div>
</template>

<script>
import * as boardApi from "@/api/board.js";
export default {
  data() {
    return {
      title: "",
      conent: "",
    };
  },
  methods: {
    write() {
      boardApi
        .store(this.title, this.content)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style></style>
