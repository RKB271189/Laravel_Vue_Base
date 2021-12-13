import Vue from 'vue';
import Vuex from 'vuex';
// import LandingSingle from './modules/landing/single';
import ProductIndex from './modules/fld_product/index';
import UserIndex from './modules/fld_user/index';
import TestIndex from './modules/fld_test/index';
Vue.use(Vuex);
export default new Vuex.Store({
    modules: {
        //LandingSingle
        ProductIndex,
        UserIndex,
        TestIndex
    },
    strict: true
});