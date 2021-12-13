<template>
  <div class="btn-group table_button">
    <a @click="deleterow(row.id)" class="btn btn-sm" :class="xprops.btnclass">{{xprops.btnvalue}}</a>
  </div>
</template>

<script>
export default {
  props: ["row", "xprops"],
  data() {
    return {
      // Code
    };
  },
  created() {
    // Code
  },
  computed: {},
  methods: {
    deleterow(id) {
      this.$swal({
        title: this.xprops.title,
        text: this.xprops.text,
        type: this.xprops.type,
        showCancelButton: this.xprops.cancel,
        confirmButtonText: this.xprops.button,
        confirmButtonColor: this.xprops.color,
        focusCancel: true,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          //Accepting the condition by client
          this.$store
            .dispatch(this.xprops.module + "/" + this.xprops.btnaction, id) //Calling delete method from stored action
            .then((result) => {
              this.$eventHub.$emit(this.xprops.eventsuccess, result);
              this.$store.dispatch(
                this.xprops.module + "/" + this.xprops.btnbackaction
              );
            })
            .catch((error) => {
              this.$eventHub.$emit(this.xprops.eventfailed, error);
            });
        }
      });
    },
  },
};
</script>

<style scoped>
</style>>