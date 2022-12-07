<template>
  <div class="about"></div>

  <div v-if="boardAbout">
    <board-compo-vue :boardAbout="boardAbout"></board-compo-vue>
  </div>

  <div class="chatting"></div>

  <div v-if="openModal && logged !== false">
    <write-chat-compo-vue></write-chat-compo-vue>
  </div>

  <div
    id="boardModalBtn"
    class="w-[15vw] h-[7vh] rounded-full max-w-[150px] text-[30pt] leading-[10vh]"
    @click="modalOpenFunc()"
  >
    new
  </div>
</template>
<script>
import * as boards from "@/api/boards.js";
import * as token from "@/api/token.js";
import BoardCompoVue from "@/components/BoardCompo.vue";
import WriteChatCompoVue from "@/components/WriteChatCompo.vue";
export default {
  components: {
    BoardCompoVue,
    WriteChatCompoVue,
  },
  data() {
    return { boardAbout: [], openModal: false, logged: false };
  },
  methods: {
    modalOpenFunc() {
      this.openModal = !this.openModal;
      this.logged = token.getToken();
      if (this.logged == false) {
        alert("need login");
        this.openModal = false;
      }
    },
  },
  mounted() {
    boards.show(this.$route.params.id).then((res) => {
      if (res.status == 200) {
        this.boardAbout = res.data.board;
      }
    });
  },
};
</script>
