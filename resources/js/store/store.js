import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        basketProductsQuantity: 0
    },
    getters: {

    },
    mutations: {
        setBasketProductsQuantity (state, payload) {
            state.basketProductsQuantity = payload
        }
    },
    actions: {

        changeBasketProductsQuantity (context, payload) {
            context.commit('setBasketProductsQuantity', payload)
        },
        getBasketProductsQuantity (context, payload) {
            axios.get('/basket/getProductsQuantity')
                .then((response) => {
                    context.commit('setBasketProductsQuantity', response.data)
                })
        }
    }
})

export default store
