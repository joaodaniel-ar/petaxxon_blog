<template>
    <div>
        <input type="text" class="form-control m-1" placeholder="Nome" v-model="user.name">
        <input type="password" class="form-control m-1" placeholder="Senha" v-model="user.password">
        <button class="btn btn-primary m-1 btn-block" @click="login">Login</button>
        <div v-if="error" class="alert alert-danger">error!!!</div>
    </div>
</template>

<script>
export default {
    data() {
        return{
            user:{
                name:'',
                password:''
            },
            error:false
        }   
    },
    methods:{
        login(){
            axios.post('api/login', this.user).then(response=>{
                if(response.data.status=='success'){
                    let token=response.data.token
                    localStorage.setItem('token', token)
                    this.error=false
                }else{
                    this.error=true
                }
            })
        }
    }
}
</script>