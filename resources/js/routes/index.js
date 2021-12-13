import Vue from 'vue';
import VueRouter from 'vue-router';
//import Dashboard from '../components/dashboard/DataAnalysis.vue';
import DashboardIndex from '../components/Dashboard/IndexComponent.vue';
import ProductIndex from '../components/Product/IndexComponent.vue';
import ProductCreate from '../components/Product/CreateComponent.vue';
import ProductEdit from '../components/Product/UpdateComponent.vue';
import ProductRestore from '../components/Product/RestoreComponent.vue';
import UserIndex from '../components/User/IndexComponent.vue';

import TestIndex from '../components/TestComponent.vue';
Vue.use(VueRouter);
const routes = [
    //Paths Here
    // { path: '/dashboard', component: Dashboard, name: 'owner.dashboard' },
    { path: '/dasboard/detail', component: DashboardIndex, name: 'dashboard.detail' },
    { path: '/product/summary', component: ProductIndex, name: 'product.summary' },
    { path: '/product/create', component: ProductCreate, name: 'product.create' },
    { path: '/product/edit/:id', component: ProductEdit, name: 'product.edit' },
    { path: '/product/restore', component: ProductRestore, name: 'product.restore' },
    { path: '/user/summary', component: UserIndex, name: 'user.summary' },

    //only for testing purpose use this component

    { path: '/test/component', component: TestIndex, name: 'test.component' }
];
export default new VueRouter({
    mode: 'history',
    base: '/project',
    routes
});