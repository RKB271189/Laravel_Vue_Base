function initialstate() {
    return {
        loading: false,
        user: [],
        crt_updt_user: {
            id: null,
            name: null,
            email: null,
        }
    }
}
const getters = {
    loading: state => state.loading,
    user: state => state.user,
    crt_updt_user: state => state.crt_updt_user
}

const actions = {
    fetchdata({ commit }) {
        commit('setloading', true);
        axios.get('/user/summary')
            .then((response) => {
                let details = response.data;
                commit('setuser', details);
            }).catch((error) => {
                //Display error in sweet alert
            }).finally(() => {
                commit('setloading', false);
            })
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
    setuser(state, user) {
        state.user = user;
    }
}

export default {
    namespaced: true,
    state: initialstate,
    getters,
    actions,
    mutations
}