<template>
    <li class="nav-item">
        <a class="nav-link" :href="routeBasket">
            Корзина {{ quantity }}
        </a>
    </li>
</template>

<script>
    export default {
        props: ['routeBasket'],
        computed: {
            quantity () {
                const qn = this.$store.state.basketProductsQuantity
                return qn ? `(${qn})` : ''
            }
        },
        mounted () {
            this.$store.dispatch('getBasketProductsQuantity', {})

        }
    }
</script>
