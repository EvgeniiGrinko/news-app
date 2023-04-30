<template>
    <h1 class="h3 mb-3 fw-normal">Create News</h1>
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
        <input v-model="title" type="text" class="form-control" placeholder="Polar bears living closer to arctic communities"
               aria-label="Title of the news" aria-describedby="title">
    </div>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Text</span>
        </div>
        <textarea v-model="text" class="form-control" aria-label="Body of the news" placeholder="2023 marks the 50th Anniversary of the 1973 Agreement on the Conservation of Polar Bears. There are reasons to celebrate. Through coordinated management actions, the Agreement’s parties consisting of Canada, Greenland, Norway, Russia and the United States have worked to reduce the primary threat at the time of signing: large-scale commercial and recreational hunting. In 2013, the parties came together to renew their commitment to polar bear conservation, recognising the climate crisis as today’s primary threat to the long-term survival of polar bears."></textarea>
    </div>

    <input @click.prevent="save" class="w-20 btn btn-lg btn-success mt-4" value="Save News" type="submit" :disabled="disabled">
    </form>
</template>

<script>
export default {
    name: "Create",
    emits: ['updatetoken'],

    data(){
        return {
            title: null,
            text: null,
            disabled: false,
            errors: [],
        }
    },
    updated(){

    },
    methods: {
        save(){
            this.errors = [];

            if (!this.title) {
                this.errors.push('Title is required.');
            }
            if (!this.text) {
                this.errors.push('Text is required.');
            }
            this.disabled = true
            setTimeout( () => {
                this.disabled = false
                this.errors = []
            }, 2000)
            if (this.title && this.text) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/news', {
                        title: this.title,
                        text: this.text,
                    }).then(r => {
                        if(r.status === 201){
                            localStorage.setItem("x_xsrf_token", r.config.headers["X-XSRF-TOKEN"]);
                            this.$router.push({name: 'news.all'})
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
