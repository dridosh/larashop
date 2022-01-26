<template>
    <div>
        <div class="row">
            <template v-if="loading">
                <img style="width: 50px; height: 25px;" src='/storage/img/loaders/loader.gif'>
            </template>
            <div v-else v-for="product in products" :key="product.id" class="col-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img :src="'/storage/img/products/' + product.picture" class="card-img-top" :alt="product.name">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{product.name}}
                        </h5>
                        <p class="card-text">
                            {{ product.description }}
                        </p>
                        <div class="card-basket-buttons">
                            <button
                                v-if="product.quantity > 0"
                                @click="basket(product.id, 'remove', product.quantity)"
                                :disabled="product.quantity == 0"
                                class="btn btn-danger">
                                -
                            </button>
                            <button
                                v-else
                                :disabled="product.quantity == 0"
                                class="btn btn-danger">
                                -
                            </button>
                            <div class="card-basket-quantity">
                                {{product.quantity}}
                            </div>
                            <button @click="basket(product.id, 'add')" type="submit" class="btn btn-success">+</button>
                        </div>

                        <div class="card-price">
                            {{product.price}} руб.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['categoryId'],
        data () {
            return {
                products: [],
                loading: true
            }
        },
        methods: {
            basket (productId, method, quantity) {

                if (method == 'remove' && quantity == 0) {
                    alert('ай яй яй')
                }

                const params = {
                    id: productId
                }
                axios.post(`/basket/product/${method}`, params)
                    .then(({data}) => {
                        const idx = this.products.findIndex((product) => {
                            return product.id == productId
                        })
                        this.products[idx].quantity = data.quantity
                    })
            }
        },
        mounted () {
            axios.get(`/categories/${this.categoryId}/getProducts`)
                .then(response => {
                    this.products = response.data
                })
                .catch(error => {

                })
                .finally(() => {
                    this.loading = false
                })
        }
    }
</script>

<style scoped>

    a:active,
    a:hover,
    a {
        text-decoration: none;
        color: black;
    }

    .card:hover {
        box-shadow: 0.4em 0.4em 5px rgb(122 122 122 / 50%);
    }

    .card-basket-buttons {
        display: flex;
        justify-content: space-between;
    }

    .card-basket-quantity {
        line-height: 34px;
    }

    .card-price {
        text-align: center;
        font-size: 20px;
        margin-top: 10px;
        border-bottom: 2px solid gray;
    }

    .card-text {
        height: 70px;
    }

    .card-title {
        height: 45px;
        text-align: center;
        font-weight: bold;
    }

</style>