<template>
    <h1 class="h3 mb-3 fw-normal">Update News</h1>
    <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
    <ul>
        <li v-for="error in errors">{{ error }}</li>
    </ul>
    </p>
    <form>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="title">Title</span>
            </div>
            <input v-model="title" type="text" class="form-control"
                   aria-label="Title of the news" aria-describedby="title">
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Text</span>
            </div>
            <textarea v-model="text" class="form-control" aria-label="Body of the news"></textarea>
        </div>

        <input @click.prevent="update" class="w-20 btn btn-lg btn-success mt-4" value="Save News" type="submit"
               :disabled="disabled">
    </form>
</template>

<script>
export default {
    name: "Update",
    emits: ['updatetoken'],
    data() {
        return {
            title: null,
            text: null,
            disabled: false,
            errors: [],

        }
    },
    mounted() {
        this.edit()
    },

    methods: {
        edit() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/news/${this.$route.params.id}/edit`).then(r => {
                    this.title = r.data.title
                    this.text = r.data.body
                }).catch(e => {
                })
            });

        },
        update() {
            this.errors = [];

            if (!this.title) {
                this.errors.push('Title is required.');
            }
            if (!this.text) {
                this.errors.push('Text is required.');
            }
            this.disabled = true
            setTimeout(() => {
                this.disabled = false
                this.errors = []
            }, 2000)
            if (this.title && this.text) {
                let tokenRaw = localStorage.getItem("token")
                let index = tokenRaw.indexOf('|')
                let cutToken = tokenRaw.substring(index)
                axios.get('/sanctum/csrf-cookie').then(response => {
                     axios.put(`/api/news/${this.$route.params.id}/   `, {
                         id : this.$route.params.id,
                            title: this.title,
                            body: this.text,
                        },
                        {
                            headers: {Authorization: `Bearer ${tokenRaw}`}
                        }).then(r => {
                        if (r.status === 205) {
                            localStorage.setItem("x_xsrf_token", r.config.headers["X-XSRF-TOKEN"]);
                            this.$router.push({name: 'news.all'})
                            this.title = r.data.title
                            this.body = r.data.text
                        }
                    }).catch(e => {
                    })
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
