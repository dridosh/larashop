<template>
    <div>
        <button @click="clickCounter" class="btn" :class="customClass">{{name}} {{ counter }}</button>
    </div>
</template>

<script>
export default {
    props: ['name', 'customClass'],
    data () {
        return {
            counter: 0
        }
    },
    methods: {
        clickCounter () {
            this.counter++
            const params = {
                name: this.name,
                counter: this.counter
            }
            this.$emit('clickerClicked', params)
        }
    }
}
</script>
