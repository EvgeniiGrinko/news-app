<template>
    <div  v-for="(news,index) in news.data" :key="index" class="blog-post mt-4" >
        <h2 class="blog-post-title">{{ news.title}}</h2>
        <p class="blog-post-meta">News was created: {{ news.created}}</p>
        <p>{{ news.body }}</p>
        <router-link :to="`/news/show/${news.id}`" class="btn btn-success m-1">Show Full</router-link>
    </div>
    <Bootstrap4Pagination :data="news" @pagination-change-page="list"></Bootstrap4Pagination>
</template>

<script>
import { Bootstrap4Pagination } from 'laravel-vue-pagination'

export default {
    name:"All News",
    emits: ['updatetoken'],
    components:{
        Bootstrap4Pagination
    },
    data(){
        return {
            news:{
                type:Object,
                default:null
            }
        }
    },
    mounted(){
        this.list()
    },
    methods:{
         list(page=1){
             axios.get(`/api/news?page=${page}`).then(({data})=>{
                this.news = data
            }).catch(({ response })=>{
                console.error(response)
            })
        },
    }
}
</script>

<style scoped>
.Bootstrap4Pagination{
    margin-bottom: 0;
}
</style>
