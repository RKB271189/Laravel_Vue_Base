<template>
  <div class="btn-group table_button">
    <router-link
      :to="{
        name: xprops.editroute,
        params: { id: row.id },
      }"
      class="btn btn-success btn-sm"
    >
      Edit
    </router-link>
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
  methods: {},
};
</script>

<style scoped>
</style>>