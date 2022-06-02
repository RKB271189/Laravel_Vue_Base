<template>
  <section class="content pt-3">
    <div class="container-fluid">
      <div class="content-wrapper">
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <!-- Header of the page Apply cardprops details -->
              <cardheader-component
                :headerprops="headerprops"
              ></cardheader-component>
              <div class="card-body">
                <!-- Full screen loader -->
                <loadingoverlay-component
                  v-if="loading"
                ></loadingoverlay-component>
                <!-- Simple loader -->
                <!-- <loadingtable-component v-if="loading"></loadingtable-component> -->
                <!-- Product Summary Here -->
                <datatable v-if="!loading" v-bind="$data" :data="product" />
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Restorebutton from "../Extra/Table/DeletebuttonComponent.vue";
export default {
  data() {
    return {
      tblClass: "table-bordered",
      tblStyle: "color:#194894",
      columns: [
        {
          title: "Restore",
          tdComp: Restorebutton,
          visible: true,
          thClass: "text-center",
          tdClass: "text-center",
        },
        { title: "Name", field: "name" },
        { title: "Price", field: "price" },
        { title: "Quantity", field: "quantity" },
      ],
      total: 0,
      summary: {},
      query: {},
      Pagination: false,
      HeaderSettings: false,
      xprops: {
        module: "ProductIndex",
        title: "Are you sure?",
        text: "You are about to restore product",
        type: "warning",
        cancel: true,
        button: "Proceed",
        color: "#dd4b39",
        btnvalue: "Restore",
        btnclass: "btn-success",
        btnaction: "restoredata",
        btnbackaction: "fetchdeleteddata",
        eventfailed: "delete-success",
        eventsuccess: "update-success",
        deletemessage: "",
        editroute: "",
      },
      headerprops: {
        headername: "Products - Restore",
        issummary: false,
      },
    };
  },
  created() {
    this.fetchdeleteddata();
  },
  destroyed() {
    this.resetstate();
  },
  computed: {
    ...mapGetters("ProductIndex", ["loading", "product"]),
  },
  methods: {
    ...mapActions("ProductIndex", ["resetstate", "fetchdeleteddata"]),
  },
};
</script>
<style scoped>
</style>
