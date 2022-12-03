<template>
  <div class="about">
    {{ users }}
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      users: "",
    };
  },
  async mounted() {
    await axios.post("/api/get_user").then((res) => (this.users = res.body));
  },
};
</script>
