<template>
    <div class="login">
        <div class="login-left">
            <img src="/images/logo.png" alt="Petaxxon" />
        </div>

        <div class="login-right">
            <div class="login-form">
                <img src="/images/logo-black.png" alt="Petaxxon" />

                <h1>Registrar</h1>

                <div class="loginInputUser">
                    <input type="text" placeholder="Usuário" v-model="user.name">
                </div>

                <div class="loginInputEmail">
                    <input type="text" placeholder="Email" v-model="user.email">
                </div>

                <div class="loginInputPassword">
                    <input type="password" placeholder="Senha" v-model="user.password">
                </div>

                <h4 class="forgot-pass">Esqueceu sua senha?</h4>
                <button class="btn btn-primary m-3 btn-block" @click="register">Cadastrar-se</button>
                <h6 class="m-0">Já tem uma conta?</h6>
                <router-link to="login" class="btn btn-primary m-3 btn-block">Entrar</router-link>
            </div>
        </div>
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
                if(response.data.status=='success'){
                    Toast.fire({
                        icon: 'success',
                        title: 'Cadastro efetuado com sucesso!'
                    })
                    this.$router.push('/login')
                    this.user={
                        id:'',
                        title:'',
                        body:''
                    }
                }
            })
        }
    }
}
</script>

<style lang="scss" src="./Style.scss" />