<template>
    <div>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center header-main-box">

                    <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><router-link to="login" class="nav-link px-2 link-dark">Login</router-link></li>
                        <li><router-link to="register" class="nav-link px-2 link-dark">Registrar</router-link></li>
                    </ul>

                    <a href="/" class="logo d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                        <img src="/images/logo-black.png" alt="Petaxxon" width="200"/>
                    </a>

                    <div class="row right-box">
                        <div class="col-12">
                            <form class="col-12 col-lg-auto mb-3 mb-lg-0">
                                <input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="row m-3 main-content">
            <div class="col-md-3 themed-grid-col left-sidebar">
                <a class="d-block"><img class="mw-100" src="/images/add-01.jpg" alt="Cifras" /></a>
            </div>
            <div class="col-md-6 themed-grid-col">

                <div  v-for="post in posts.data" :key="post.id" class="my-3">
                    <h4>{{post.title}}</h4>

                    <p>{{post.body}}</p>

                    <div class="comments-box">
                        <ul class="list-group" v-for="comments in post.comments" :key="comments.id">
                            <li class="list-group-item">
                                <p class="float-start me-2">{{comments.comment}}</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <pagination align="center" :data="posts" @pagination-change-page="getPosts" >
                    <span slot="prev-nav">&lt;</span>
                    <span slot="next-nav">&gt;</span>
                </pagination>
            </div>
            <div class="col-md-3 themed-grid-col right-sidebar">
                <a class="d-block"><img class="mw-100" src="/images/add-02.jpg" alt="Cifras" /></a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            post:{
                id:'',
                title:'',
                body:''
            },
            posts:{}
        }
    },
    methods:{
        getPosts(page = 1){
            axios.get('api/getposts?page='+ page).then(response=>{
                this.posts=response.data.data
            })
        }
    },
    mounted(){
        this.getPosts()
    }
}
</script>

<style lang="scss" src="./Style.scss" />