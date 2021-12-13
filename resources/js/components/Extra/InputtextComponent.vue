<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ inputprops.label }}</label>
    <div class="col-sm-10">
      <input
        :name="inputprops.propertyname"
        type="text"
        class="form-control"
        :placeholder="inputprops.placeholder"
        :value="value"
        @input="action"
        :required="inputprops.required"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: ["inputprops","value","action"],
};
</script>

<style>
</style>