<template>
  <section class="content pt-3">
    <div class="container-fluid">
      <div class="content-wrapper">
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
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
              </div>
              <form @submit.prevent="submitfirebase" class="form-horizontal">
                <cardfooter-component
                  :footerprops="footerprops1"
                ></cardfooter-component>
              </form>
              <form @submit.prevent="submitwebsocket" class="form-horizontal">
                <cardfooter-component
                  :footerprops="footerprops2"
                ></cardfooter-component>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      headerprops: {
        headername: "Test",
        issummary: false,
      },
      footerprops1: {
        isfooter: true,
        submitclass: "btn btn-success btn-block",
        submitname: "Notification",
      },
      footerprops2: {
        isfooter: true,
        submitclass: "btn btn-success btn-block",
        submitname: "Sockets",
      },
    };
  },
  mounted() {
    let uniqueid = 2;
    Echo.private("notification." + uniqueid).listen(".notification", () => {
      alert("Hitting");
    });
  },
  created() {},
  destroyed() {
    this.resetstate();
  },
  computed: {
    ...mapGetters("TestIndex", ["loading"]),
  },
  methods: {
    ...mapActions("TestIndex", ["resetstate", "testfirebase", "testsocket"]),
    submitfirebase() {
      this.testfirebase();
    },
    submitwebsocket() {
      this.testsocket().then((response) => {
        this.$eventHub.$emit("create-success-popup", "Successfull", response);
      });
    },
  },
};
</script>
<style scoped>
</style>
