<template>
  <div>
    title : {{ boardAbout.title }} <br />
    content : {{ boardAbout.content }} <br />

    <div v-if="parent !== 'myBoard'">
      creater : {{ boardAbout.userId }} <br />
      created_at : {{ boardAbout.created_at }} <br />
      updated_at : {{ boardAbout.updated_at }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    boardAbout: Array,
    parent: String,
  },
};
</script>

<style></style>
