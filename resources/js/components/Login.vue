<template>
    <div class="login">
        <div class="login-left">
            <img src="/images/logo.png" alt="Petaxxon" />
        </div>

        <div class="login-right">
            <form @submit.prevent="loginSubmit" class="login-form">
                <img src="/images/logo-black.png" alt="Petaxxon" />
                <h1>Login</h1>

                <div class="loginInputEmail">
                    <input type="text" placeholder="Usuário" v-model="user.name">
                </div>

                <div class="loginInputPassword">
                    <input type="password" placeholder="Senha" v-model="user.password">
                </div>

                <h4 class="forgot-pass">Esqueceu sua senha?</h4>
                <button class="btn btn-primary m-3 btn-block" type="submit">Entrar</button>
                <h6 class="m-0">Não possui uma conta?</h6>
                <router-link to="register" class="btn btn-primary m-3 btn-block">Criar nova conta</router-link>
            </form>
        </div>
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
        loginSubmit(){
            axios.post('api/login', this.user).then(response=>{
                if(response.data.status=='success'){
                    let token=response.data.token
                    localStorage.setItem('token', token)
                    Toast.fire({
                        icon: 'success',
                        title: 'Login efetuado com sucesso!'
                    })
                    this.$router.push('/posts')
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: 'Usuário ou senha inválidos!'
                    })
                }
            })
        }
    }
}
</script>

<style lang="scss" src="./Style.scss" />