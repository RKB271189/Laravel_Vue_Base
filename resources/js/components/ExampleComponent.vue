<template>
  
</template>

<script>
export default {
  props: {
    app_name: {
      type: String,
      default: null,
    },
  },
  created(){
    this.$router.push({ name: "dashboard.detail" }).catch(() => {});
  }
};
</script>
