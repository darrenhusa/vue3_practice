<template>
    <h1>{{ greeting }}</h1>
</template>
<script>
import { ref } from 'vue'

export default {
    props: ['greeting'],

    
    setup(props) {
        // greeting: 'Hello World from Vue 3!'
        const greeting = ref('Hello World from Vue 3!')
        console.log('inside setup()....')
        // console.log(greeting.value)
        // console.log(props.greeting)
        // greeting = props
        return {
            greeting,
        }
    }
}
</script>
