function initialstate() {
    return {
        loading: false,
    }
}
const getters = {
    loading: state => state.loading
}
const actions = {
    resetstate({ commit }) {
        commit('resetstate');
    },
    testfirebase({ commit }) {
        commit('setloading', true);
        axios.get('/test/firebase')
            .then((response) => {
                let details = response.data;
            }).catch((error) => {
                //Display error in sweet alert                
            }).finally(() => {
                commit('setloading', false);
            });
    },
    testsocket({ commit }) {
        commit('setloading', true);
        return new Promise((resolve, reject) => {
            axios.get('/test/websocket')
                .then((response) => {
                    let details = response.data;
                    resolve(details);
                }).catch((error) => {
                    //Display error in sweet alert                
                }).finally(() => {
                    commit('setloading', false);
                });
        });
    }
}
const mutations = {
    resetstate(state) {
        state = Object.assign(state, initialstate());
    },
    setloading(state, status) {
        state.loading = status;
    },
}
export default {
    namespaced: true,
    state: initialstate,
    getters,
    actions,
    mutations
}