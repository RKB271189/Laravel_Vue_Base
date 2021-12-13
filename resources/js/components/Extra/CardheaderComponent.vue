<template>
  <div class="card-header">
    {{ headerprops.headername }}
    <ul
      class="nav nav-tabs card-header-tabs"
      style="float: right"
      v-if="headerprops.issummary"
    >
      <li class="pr-4" v-if="headerprops.isadd_icon">
        <router-link
          :to="{
            name: headerprops.add_route,
          }"
        >
          <i
            :class="headerprops.add_icon"
            aria-hidden="true"
            style="float: right; cursor: pointer"
            :title="headerprops.add_title"
          >
          </i>
        </router-link>
      </li>
      <li v-if="headerprops.isrestore_icon">
        <router-link
          :to="{
            name: headerprops.restore_route,
          }"
        >
          <i
            :class="headerprops.restore_icon"
            aria-hidden="true"
            style="float: right; cursor: pointer"
            :title="headerprops.restore_title"
          ></i>
        </router-link>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: ["headerprops"],
  data() {
    return {
      //Code
    };
  },
};
</script>

<style>
</style>