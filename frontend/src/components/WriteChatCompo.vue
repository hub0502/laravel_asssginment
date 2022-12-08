<template>
  <div>
    <div id="modal_bg" class="w-[100%] h-[100%] absolute top-0 bg-black"></div>
    <div
      class="w-full max-w-xs m-auto absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"
    >
      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="content"
          >
            content
          </label>

          <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-[150px] resize-none"
            v-model="content"
            type="content"
            placeholder="content"
          >
          </textarea>
        </div>

        <div class="flex items-center justify-between">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline m-auto"
            type="button"
            @click="write()"
          >
            send
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import * as chats from "@/api/chats.js";
import { getToken } from "@/api/token";
export default {
  data() {
    return {
      content: "",
    };
  },
  methods: {
    write() {
      // let self = this;
      chats
        .store(this.content, this.$route.params.id, getToken())
        .then((res) => {
          if (res.status == 200) {
            alert("add chats");
            window.location.href = `/about/${this.$route.params.id}`;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style></style>
