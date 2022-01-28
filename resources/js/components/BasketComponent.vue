<template>
    <div>
        <div v-if="errors" class="alert alert-danger">
            <ul>
                <li v-for="(error, idx) in errors" :key="idx">
                    {{ error[0] }}
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
            <input v-model="name" :disabled="isDisabled" class="form-control mb-2">

            <label>Адресс</label>
            <input v-model="mainAddress" :disabled="isDisabled" class="form-control mb-2">

            <label>Почта</label>
            <input v-model="email" :disabled="isDisabled" type='email' class="form-control mb-2">

            <button
                @click="submit"
                :disabled="processing"
                class="btn btn-success submit-button"
            >
                <div v-if="processing" class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span v-else>Оформить заказ</span>
                
            </button>
        </template>

    </div>
</template>

<script>
    export default {
        props: [
            'errorList',
            'routeLogin',
            'routeHome',
            'routeOrders',
            'products',
            'name',
            'email',
            'mainAddress'
            ],
        data () {
            return {
                processing: false,
                errors: null,
                isDisabled: true
            }
        },
        computed: {
            itogo () {
                return this.products.reduce( (sum, product) =>  {
                    return sum += product['price'] * product['quantity'];
                }, 0)
            }
        },
        methods: {
            submit () {
                this.processing = true
                this.errors = null
                const params = {
                    name: this.name,
                    email: this.email,
                    address: this.mainAddress
                }
                axios.post('/basket/createOrder', params)
                    .then(() => {
                        this.$swal({
                            title: 'Заказ успешно создан!',
                            icon: 'success',
                            confirmButtonText: 'Супер!'
                        }).then(() => {
                            window.location.href = this.routeOrders
                        })
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors
                    })
                    .finally(() => {
                        this.processing = false
                    })
            }
        },
        mounted () {
            for (let error in this.errorList) {
                this.errors.push(this.errorList[error][0])
            }
            if (!this.email) {
                this.isDisabled = false
            }
        }
        
    }
</script>

<style scoped>
    .itogo {
        text-align: right;
    }
    .submit-button {
        min-width: 137px;
        height: 37px;
    }
    .spinner-border {
        height: 24px;
        width: 24px
    }
</style>