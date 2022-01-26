<template>
    <div>
        <div v-if="errors.length" class="alert alert-danger">
            <ul>
                <li v-for="(error, idx) in errors" :key="idx">
                    {{ error }}
                </li>
                <template v-if="errors.email">
                    Ссылка на <a :href="routeLogin">вход</a>
                </template>
            </ul>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{product['name']}}</td>                    
                    <td>{{product['price']}}</td>                    
                    <td>{{product['quantity']}}</td>                    
                    <td>{{product['quantity'] * product['price']}}</td>                    
                </tr>
                <tr v-if="!products.length">
                    <td class="text-center" colspan="4">
                        Ваша корзина пока что пуста. Начните <a :href="routeHome">покупать!</a>
                    </td>
                </tr>
                <tr v-else>
                    <td class="itogo" colspan=3>
                        Итого:
                    </td>
                    <td>
                        <strong>
                         {{ itogo }}
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <template v-if="products.length">
            <label>Имя</label>
            <input v-model="name" class="form-control mb-2">

            <label>Адресс</label>
            <input class="form-control mb-2">

            <label>Почта</label>
            <input v-model="email" type='email' class="form-control mb-2">

            <button class="btn btn-success">Оформить заказ</button>
        </template>

    </div>
</template>

<script>
    export default {
        props: ['errorList', 'routeLogin', 'routeHome', 'products'],
        data () {
            return {
                errors: [],
                name: '',
                email: ''
            }
        },
        computed: {
            itogo () {
                return this.products.reduce( (sum, product) =>  {
                    return sum += product['price'] * product['quantity'];
                }, 0)
            }
        },
        mounted () {
            for (let error in this.errorList) {
                this.errors.push(this.errorList[error][0])
            }
        }
        
    }
</script>

<style scoped>
    .itogo {
        text-align: right;
    }
</style>