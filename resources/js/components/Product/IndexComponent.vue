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
import Editbutton from "../Extra/Table/EditbuttonComponent.vue";
import Deletebutton from "../Extra/Table/DeletebuttonComponent.vue";
export default {
  data() {
    return {
      tblClass: "table-bordered",
      tblStyle: "color:#194894",
      columns: [
        {
          title: "Edit",
          tdComp: Editbutton,
          visible: true,
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          title: "Delete",
          tdComp: Deletebutton,
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
        text: "You are about to delete product",
        type: "warning",
        cancel: true,
        button: "Delete",
        color: "#dd4b39",
        btnvalue: "Delete",
        btnclass: "btn-danger",
        btnaction: "deletedata",
        btnbackaction: "fetchdata",
        eventfailed: "delete-success",
        eventsuccess: "update-success",
        deletemessage: "Product deleted successfully",
        editroute: "product.edit",
      },
      headerprops: {
        headername: "Products",
        issummary: true,
        isadd_icon: true,
        add_icon: "fa fa-plus",
        add_route: "product.create",
        add_title: "Add Product",
        isrestore_icon: true,
        restore_icon: "fa fa-trash-restore",
        restore_route: "product.restore",
        restore_title: "Restore Deleted Product",
      },
    };
  },
  created() {
    this.fetchdata();
  },
  destroyed() {
    this.resetstate();
  },
  computed: {
    ...mapGetters("ProductIndex", ["loading", "product"]),
  },
  methods: {
    ...mapActions("ProductIndex", ["resetstate", "fetchdata"]),
  },
};
</script>
<style scoped>
</style>
