<template>
  <form class="absolute left-[50%] translate-x-[-50%] text-[15pt] mt-[60px]">
    <legend>chats</legend>
    <tr v-for="(data, idx) in chatList" :key="idx">
      <td>{{ idx }}</td>
      <td class="opacity-0 px-2">X</td>
      <td class="px-[40px] w-[10px]">
        {{ data.chat_content }}
      </td>
      <td>
        {{ data.user_id }}
      </td>
      <td class="text-red-500 px-2">
        <div class="text-red-500 cursor-pointer" @click="chatDestroy(data.id)">
          X
        </div>
      </td>
    </tr>
  </form>
</template>

<script>
import * as chats from "@/api/chats.js";
export default {
  props: {
    chatList: Array,
  },
  methods: {
    chatDestroy(id) {
      chats.destroy(id).then((res) => {
        if (res.data.status == "success") {
          alert("chat deleted");
          window.location.href = `/about/${this.$route.params.id}`;
        } else {
          alert(res.data.status);
        }
      });
    },
  },
};
</script>

<style></style>
