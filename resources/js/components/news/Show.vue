<template>
    <div class="blog-post mt-4">

        <p v-if="deleted">
            <b>{{ message }}</b>
        </p>
        <p v-if="errors.length">
            <b>Some error(s) occurred:</b>
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
        </p>

        <h2 class="blog-post-title">{{ news.title }}</h2>
        <p class="blog-post-meta">News was created: {{ news.created }}</p>
        <p class="blog-post-meta">News id: {{ news.id }}</p>
        <p>{{ news.body }}</p>
        <router-link v-if="admin" :to="`/news/update/${news.id}`" class="btn btn-primary m-1">Update</router-link>
        <a v-if="admin" @click.prevent="destroy(news.id)" href="#" class="btn btn-danger m-1">Delete</a>
    </div>
</template>

<script>

export default {
    name: "Show",
    emits: ['updatetoken'],


    data() {
        return {
            news: {
                type: Object,
            },
            active: true,
            deleted: false,
            message: '',
            errors: [],
            admin:false
        }
    },
    beforeMount() {
        this.admin = localStorage.getItem('x_secret') === 'yes'
    },

    mounted() {
        this.load()
    },
    methods: {
        load() {
            axios.get(`/api/news/${this.$route.params.id}`)
                .then((res) => {
                    this.news = res.data
                }).catch(({e}) => {
                this.$router.push({name: '404'})
            })
        },
        destroy(id) {
            if (this.active) {
                axios.delete(`/api/news/${id}`)
                    .then((response) => {
                        if (response.status === 200) {
                            this.message = response.message
                            this.deleted = true
                        }
                        setTimeout(2000)
                        this.$router.push({name: 'news.all'})

                    }).catch((e) => {
                    console.error(e)
                    if (typeof e === 'string' || e instanceof String) {
                        this.error.push = e
                    }
                })
            }

        }
    }
}
</script>

<style scoped>

</style>
