<template>
    <div>
        <div class="row">
            <div v-for="category in categories" :key="category.id" class="col-3">
                <a :href="'categories/' + category.id">
                    <div class="card mb-4" style="width: 18rem;">
                        <img :src="`/storage/img/categories/` + category.picture" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{category.name}}
                            </h5>
                            <p class="card-text">
                                {{ category.description }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['categories', 'source']
    }
</script>