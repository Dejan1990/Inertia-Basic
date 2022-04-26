<template>
    <div>
        <h1>Hello, {{ name }}</h1>

        <p>In this series we will use the following frameworks:</p>

        <li v-for="framework of frameworks" v-text="framework"></li>
    </div>
</template>
<script>
export default {
    props: {
        name: String,
        frameworks: Array
    }
}
</script>