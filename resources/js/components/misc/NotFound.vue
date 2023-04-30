<template>

    <h1 class="h3 mb-3 fw-normal">404 </h1>
    <h4 class="h3 mb-3 fw-normal">The Resource you are looking for has not been found ...</h4>
    <br>
    <router-link :to="{ name: 'news.all'}" class="nav-link">Return to <i>All News Page</i></router-link>
</template>

<script>

export default {
    name: "Not Found",
    emits: ['updatetoken'],

}
</script>

<style scoped>

</style>
