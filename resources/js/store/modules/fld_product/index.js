function initialstate() {
    return {
        loading: false,
        product: [],
        crt_updt_product: {
            id: null,
            name: null,
            quantity: null,
            price: null
        }
    }
}
const getters = {
    loading: state => state.loading,
    product: state => state.product,
    crt_updt_product: state => state.crt_updt_product,
}
const actions = {
    fetchdata({ commit }) {
        commit('setloading', true);
        axios.get('/product/summary')
            .then((response) => {
                let details = response.data;
                commit('setproduct', details);
            }).catch((error) => {
                //Display error in sweet alert
            }).finally(() => {
                commit('setloading', false);
            });
    },
    deletedata({ commit }, value) {
        commit('setloading', true);
        return new Promise((resolve, reject) => {
            let id = value;
            let message = '';
            axios.get('/product/summary/delete/' + id)
                .then((response) => {
                    message = response.data;
                }).catch(error => {
                    reject(error.response.data);
                }).finally(() => {
                    commit('setloading', false);
                    resolve(message);
                });
        });
    },
    createdata({ commit, state }) {
        commit('setloading', true);
        let message = '';
        return new Promise((resolve, reject) => {
            let params = _.cloneDeep(state.crt_updt_product);
            axios.post('/product/summary/create', params)
                .then((response) => {
                    message = response.data;
                }).catch(error => {
                    reject(error.response.data);
                }).finally(() => {
                    commit('setloading', false);
                    resolve(message);
                });
        });
    },
    fetcheditdata({ commit }, value) {
        commit('setloading', true);
        axios.get('/product/summary/get/' + value)
            .then((response) => {
                let details = response.data;
                commit('mutateproduct', details);
            }).catch((error) => {
                //Display error in sweet alert                
            }).finally(() => {
                commit('setloading', false);
            });
    },
    updatedata({ commit, state }) {
        commit('setloading', true);
        let message = '';
        return new Promise((resolve, reject) => {
            let params = _.cloneDeep(state.crt_updt_product);
            axios.post('/product/summary/update', params)
                .then((response) => {
                    message = response.data;
                }).catch(error => {
                    reject(error.response.data);
                }).finally(() => {
                    commit('setloading', false);
                    resolve(message);
                });
        });
    },
    fetchdeleteddata({ commit }) {
        commit('setloading', true);
        axios.get('/product/summary/deleted')
            .then((response) => {
                let details = response.data;
                commit('setproduct', details);
            }).catch((error) => {
                //Display error in sweet alert                
            }).finally(() => {
                commit('setloading', false);
            });
    },
    restoredata({ commit }, value) {
        commit('setloading', true);
        return new Promise((resolve, reject) => {
            let id = value;
            let message = '';
            axios.get('/product/summary/restore/' + id)
                .then((response) => {
                    message = response.data;
                }).catch(error => {
                    reject(error.response.data);
                }).finally(() => {
                    commit('setloading', false);
                    resolve(message);
                });
        });
    },
    setname({ commit }, value) {
        commit('mutatename', value);
    },
    setquantity({ commit }, value) {
        commit('mutatequantity', value);
    },
    setprice({ commit }, value) {
        commit('mutateprice', value);
    },
    resetstate({ commit }) {
        commit('resetstate');
    }
}
const mutations = {
    resetstate(state) {
        state = Object.assign(state, initialstate());
    },
    setloading(state, status) {
        state.loading = status;
    },
    setproduct(state, product) {
        state.product = product;
    },
    mutatename(state, value) {
        state.crt_updt_product.name = value;
    },
    mutatequantity(state, value) {
        state.crt_updt_product.quantity = value;
    },
    mutateprice(state, value) {
        state.crt_updt_product.price = value;
    },
    mutateproduct(state, value) {
        state.crt_updt_product = value;
    }
}
export default {
    namespaced: true,
    state: initialstate,
    getters,
    actions,
    mutations
}