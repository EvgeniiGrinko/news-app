import {defineStore} from "pinia";

export let useTokenStore = defineStore( 'token', {
    state(){
        return {
            token: null
        }
    }
});
