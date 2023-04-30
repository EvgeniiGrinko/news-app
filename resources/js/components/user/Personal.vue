<template>
    <main class="w-50 m-auto">
        <h1 class="card-title personal-card-title mt-10">Personal information</h1>
        <div class="card mb-2 box-shadow">
            <div class="card-header">
                <h4 class="my-2 font-weight-normal">Name: {{ this.name }}</h4>
            </div>
            <div class="card-body">
                <h1 class="h2 mb-3 fw-normal">Date of registration: <small class="text-muted"> {{ this.date }}</small>
                </h1>
                <h1 class="h2 mb-3 fw-normal">Email: <small class="text-muted"> {{ this.email }}</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Badges:</li>
                    <li>Perfect reader</li>
                    <li>Intelligent reviewer</li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Login",
    emits: ['updatetoken'],

    data() {
        return {
            name: null,
            email: null,
            date: null,
        }
    },
    mounted() {
        this.fetchUser()
    },
    methods: {
        fetchUser() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/user')
                    .then(r => {
                        this.name = r.data.name;
                        this.email = r.data.email;
                        this.date = r.data.date;
                    })
            });
        }
    }
}
</script>

<style scoped>

</style>

