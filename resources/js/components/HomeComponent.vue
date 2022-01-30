<template>
    <div>
        <div class="row">
            <div v-for="category in categories" :key="category.id" class="col-3">
                <a :href="'categories/' + category.id">
                    <div class="card mb-4">
                        <div class="image">
                        <img  :src="`/storage/img/categories/` + category.picture" class="card-img-top" alt="">
                        </div>
                            <div class="card-body">
                            <h5 class="card-title">
                                {{ category.name }}
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


<style scoped>

a:active,
a:hover,
a {
    text-decoration: none;
    color: black;
}

.card {
   min-height: 20rem;
}


.card:hover {
    box-shadow: 0.4em 0.4em 5px rgb(122 122 122);

}

.image{
    height: 240px;
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
