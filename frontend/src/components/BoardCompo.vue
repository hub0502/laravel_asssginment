<template>
  <div>
    title : {{ boardAbout.title }} <br />
    content : {{ boardAbout.content }} <br />
    creater : {{ boardAbout.userId }} <br />
    created_at : {{ boardAbout.created_at }} <br />
    updated_at : {{ boardAbout.updated_at }}
  </div>
</template>

<script>
export default {
  props: {
    boardAbout: Array,
  },
};
</script>

<style></style>
