<template>
    <div>
        <input type="text" class="form-control m-1" placeholder="Nome" v-model="user.name">
        <input type="email" class="form-control m-1" placeholder="Email" v-model="user.email">
        <input type="password" class="form-control m-1" placeholder="Senha" v-model="user.password">
        <button class="btn btn-primary m-1 btn-block" @click="register">Registrar</button>   
    </div>
</template>

<script>
export default {
    data() {
        return{
            user:{
                name:'',
                email:'',
                password:''
            }
        }   
    },
    methods:{
        register(){
            axios.post('api/register', this.user).then(response=>{

            })
        }
    }
}
</script>