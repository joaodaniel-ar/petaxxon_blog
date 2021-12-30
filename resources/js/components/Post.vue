<template>
    <div>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center header-main-box">
                    <a href="/" class="logo d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                        <img src="/images/logo-black.png" alt="Petaxxon" width="200"/>
                    </a>

                    <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><router-link to="login" class="nav-link px-2 link-dark">Login</router-link></li>
                        <li><router-link to="register" class="nav-link px-2 link-dark">Registrar</router-link></li>
                        <li><router-link to="posts" class="nav-link px-2 link-dark">Posts</router-link></li>
                    </ul>

                    <div class="row right-box">
                        <div class="col-9">
                            <form class="col-12 col-lg-auto mb-3 mb-lg-0">
                                <input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Search">
                            </form>
                        </div>

                        <div class="col-3">
                            <div class="dropdown text-end">
                                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                                    <li><a class="dropdown-item" href="#">Configurações</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Sair</a></li>
                                </ul>
                            </div>
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
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-if="edit" class="modal-title" id="exampleModalLabel">Editar Post</h5>
                            <h5 v-else class="modal-title" id="exampleModalLabel">Criar Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" :class="['form-control my-2', errors.title?'is-invalid':'']" placeholder="Título" v-model="post.title">
                            <span v-if="errors.title" class="bg-danger text-white p-1 rounded">{{errors.title[0]}}</span>
                            <textarea :class="['form-control my-2', errors.title?'is-invalid':'']" placeholder="Conteúdo" v-model="post.body"></textarea>
                            <span v-if="errors.body" class="bg-danger text-white p-1 rounded">{{errors.body[0]}}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button v-if="edit" type="button" class="btn btn-success" @click="updatePost" data-bs-dismiss="modal">Atualizar</button>
                            <button v-else type="button" class="btn btn-success" @click="createPost" data-bs-dismiss="modal">Criar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Novo Post
                </button>

                <div  v-for="post in posts.data" :key="post.id" class="my-3">
                    <h4>{{post.title}}</h4>

                    <p>{{post.body}}</p>

                    <div class="row">
                        <div class="col">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item">
                                    <a class="btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                            <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a class="btn" data-bs-toggle="collapse" href="#collapseComments" role="button" aria-expanded="false" aria-controls="collapseComments">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                            <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a class="btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                            <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col">
                            <ul class="list-group list-group-horizontal justify-content-end">
                                <li class="list-group-item"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="editPost(post)">Editar</button></li>
                                <li class="list-group-item"><button type="button" class="btn btn-danger btn-sm" @click="deletePost(post.id)">Deletar</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="collapse" id="collapseComments">
                        <ul class="list-group" v-for="comments in post.comments" :key="comments.id">
                            <li class="list-group-item">{{comments.comment}}</li>
                        </ul>
                    </div>

                    <div class="comment-form my-3">
                        <textarea class="form-control" placeholder="Escreva um comentário..."></textarea>
                        <button type="button" class="btn btn-success float-end" @click="postComment">Enviar</button>
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
                body:'',
                author:'1'
            },
            posts:{},
            edit:false,
            errors:[]
        }
    },
    methods:{
        postComment(){
        },
        createPost(){
            let token=localStorage.getItem('token')
            axios.post('api/createpost?token='+token,this.post).then(response=>{
                if(response.data.status == 'error'){
                    this.errors = response.data.errors
                } else if(response.data.status == 'success'){
                    this.getPosts()
                    Toast.fire({
                        icon: 'success',
                        title: 'Post inserido com sucesso!'
                    })
                    this.errors=[]
                    this.post={
                        id:'',
                        title:'',
                        body:''
                    }
                }
            })
        },
        updatePost(){
            let token=localStorage.getItem('token')
            axios.put('api/updatepost/'+this.post.id+'?token='+token,this.post).then(response=>{
                if(response.data.status == 'error'){
                    this.errors = response.data.errors
                } else if(response.data.status == 'success'){
                    Toast.fire({
                        icon: 'success',
                        title: 'Post atualizado!'
                    })
                    this.errors=[]
                    this.post={
                        id:'',
                        title:'',
                        body:''
                    }
                }
            })
        },
        editPost(post){
            this.post=post
            this.edit=true
        },
        getPosts(page = 1){
            axios.get('api/getposts?page='+ page).then(response=>{
                this.posts=response.data.data
            })
        },
        deletePost(postid){
            let token=localStorage.getItem('token')
            Swal.fire({
            title: 'Você tem certeza?',
            text: "O post será deletado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('api/deletepost/'+postid+'?token='+token).then(response=>{
                        if(response.data.status=='success'){
                            Swal.fire(
                                'Deletado!',
                                'O post foi deletado.',
                                'success'
                            )
                            this.getPosts()
                        }
                    })
                }
            })
        }
    },
    created(){
        this.getPosts()
    }
}
</script>

<style lang="scss" src="./Style.scss" />