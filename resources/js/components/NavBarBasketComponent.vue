<template>
    <li class="nav-item">
        <a class="nav-link" href="/">
            Корзина {{ quantity }}
        </a>
    </li>
</template>

<script>
    export default {
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
