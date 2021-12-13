<template>
  <div class="card-footer" v-if="footerprops.isfooter">
    <div class="row">
      <div class="offset-md-11 col-md-1">
        <button type="submit" :class="footerprops.submitclass">
          {{ footerprops.submitname }}
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["footerprops"],
};
</script>

<style>
</style>