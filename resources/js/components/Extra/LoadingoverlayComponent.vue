<template>
  <div class="row align-items-center w-100 h-100 loading">   
    <div class="col-md-12 d-flex justify-content-center align-items-center">
      <div class="spinner-grow text-warning"></div>
      <div class="spinner-grow text-primary"></div>
      <div class="spinner-grow text-success"></div>
      <div class="spinner-grow text-danger"></div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
*.hidden {
  display: none !important;
}

div.loading {
  position: fixed;
  top: 0;
  left: 0;
  background-color:#101010b0;
  z-index: 1000;
}
</style>