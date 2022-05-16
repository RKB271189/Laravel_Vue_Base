<template>
  <div></div>
</template>


<script>
export default {
  data() {
    return {
      // Code...
    };
  },
  created() {
    this.$eventHub.$on("create-success-popup", this.itemConfirmWithOk);
    this.$eventHub.$on("create-success", this.itemCreated);
    this.$eventHub.$on("update-success", this.itemUpdated);
    this.$eventHub.$on("delete-success", this.itemDeleted);
  },
  //go to this site for various options after submit  https://f3oall.github.io/awesome-notifications/docs/popups/confirmation-window
  methods: {
    itemCreated(message) {
      this.$awn.success(message);
    },
    itemUpdated(message) {
      this.$awn.success(message);
    },
    itemDeleted(message) {
      this.$awn.warning(message);
    },
    itemConfirmWithOk(process, message) {
      let onOk = () => {
        //this.$awn.info("You pressed OK");
        // return true;
      };
      this.$awn.confirm(message, onOk, true, {
        labels: {
          confirm: process,
        },
      });
    },
  },
};
</script>
<style scoped>
</style>