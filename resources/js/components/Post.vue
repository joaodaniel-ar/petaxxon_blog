<template>
    <div>
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
                    <button v-if="edit" type="button" class="btn btn-success" @click="updatePost">Atualizar</button>
                    <button v-else type="button" class="btn btn-success" @click="createPost">Criar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Novo Post
        </button>

        <div v-for="post in posts.data" :key="post.id" class="my-3">
            <h4>{{post.title}}</h4>
            <p>{{post.body}}</p>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="editPost(post)">
                Editar
            </button>
            <button type="button" class="btn btn-danger btn-sm" @click="deletePost(post.id)">
                Deletar
            </button>
        </div>

        <pagination align="center" :data="posts" @pagination-change-page="getPosts" >
            <span slot="prev-nav">&lt;</span>
	        <span slot="next-nav">&gt;</span>
        </pagination>
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
            posts:{},
            edit:false,
            errors:[]
        }
    },
    methods:{
        createPost(){
            axios.post('api/createpost',this.post).then(response=>{
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
            axios.put('api/updatepost/'+this.post.id,this.post).then(response=>{
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
                    axios.delete('api/deletepost/'+postid).then(response=>{
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