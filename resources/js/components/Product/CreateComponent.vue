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
              <form @submit.prevent="submitform" class="form-horizontal">
                <div class="card-body">
                  <!-- Full screen loader -->
                  <loadingoverlay-component
                    v-if="loading"
                  ></loadingoverlay-component>
                  <!-- Simple loader -->
                  <!-- <loadingtable-component v-if="loading"></loadingtable-component> -->
                  <!-- Simple type text input form -->
                  <inputtext-component
                    :inputprops="input1"
                    :value="crt_updt_product.name"
                    :action="updatename"
                  ></inputtext-component>
                  <inputtext-component
                    :inputprops="input2"
                    :value="crt_updt_product.quantity"
                    :action="updatequantity"
                  ></inputtext-component>
                  <inputtext-component
                    :inputprops="input3"
                    :value="crt_updt_product.price"
                    :action="updateprice"
                  ></inputtext-component>
                </div>
                <cardfooter-component
                  :footerprops="footerprops"
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
        headername: "Product - Create",
        issummary: false,
      },
      footerprops: {
        isfooter: true,
        submitclass: "btn btn-success btn-block",
        submitname: "Save",
      },
      input1: {
        label: "Name",
        propertyname: "name",
        placeholder: "enter product name..",
        required: "required",
      },
      input2: {
        label: "Quantity",
        propertyname: "quantity",
        placeholder: "enter product quantity..",
        required: "required",
      },
      input3: {
        label: "Price",
        propertyname: "price",
        placeholder: "enter product price..",
        required: "required",
      },
    };
  },
  created() {},
  destroyed() {
    this.resetstate();
  },
  computed: {
    ...mapGetters("ProductIndex", ["loading", "crt_updt_product"]),
  },
  methods: {
    ...mapActions("ProductIndex", [
      "resetstate",
      "setname",
      "setquantity",
      "setprice",
      "createdata",
    ]),
    updatename(e) {
      this.setname(e.target.value);
    },
    updatequantity(e) {
      this.setquantity(e.target.value);
    },
    updateprice(e) {
      this.setprice(e.target.value);
    },
    submitform() {
      this.createdata()
        .then((response) => {
          //awsome notification create success
          this.$eventHub.$emit(
            "create-success",
            "Product created successfully",
            response
          );
          this.$router.push({ name: "product.summary" });
        })
        .catch((error) => {
          //awsome notification error
          this.$eventHub.$emit("delete-success", error);
        });
    },
  },
};
</script>

<style>
</style>