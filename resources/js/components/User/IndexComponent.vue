<template>
  <div class="col-md-11">
    <div class="card">
      <cardheader-component :headerprops="headerprops"></cardheader-component>
      <div class="card-body">
        <!-- Full screen loader -->
        <loadingoverlay-component v-if="loading"></loadingoverlay-component>
        <!-- Simple loader -->
        <!-- <loadingtable-component v-if="loading"></loadingtable-component> -->
        <!-- User Summary Here -->
        <datatable v-if="!loading" v-bind="$data" :data="user" />
      </div>
    </div>
  </div>
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
        { title: "Email", field: "email" },
      ],
      total: 0,
      summary: {},
      query: {},
      Pagination: false,
      HeaderSettings: false,
      xprops: {
        module: "UserIndex",
        title: "Are you sure?",
        text: "You are about to delete user",
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
        deletemessage: "User deleted successfully",
        editroute: "user.edit",
      },
      headerprops: {
        headername: "Users",
        issummary: true,
        isadd_icon: true,
        add_icon: "fa fa-plus",
        add_route: "user.create",
        add_title: "Add User",
        isrestore_icon: true,
        restore_icon: "fa fa-trash-restore",
        restore_route: "user.restore",
        restore_title: "Restore Deleted User",
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
    ...mapGetters("UserIndex", ["loading", "user"]),
  },
  methods: {
    ...mapActions("UserIndex", ["resetstate", "fetchdata"]),
  },
};
</script>
<style scoped>
</style>
