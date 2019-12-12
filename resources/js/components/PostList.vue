<template>
    <div>
        <div class="special">
        <form @submit.prevent="addPost">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="post.title">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Body" v-model="post.body"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <button @click.prevent="clearForm()" class="btn btn-warning">Clear Form</button>
        </form>
            <div class="alert  alert-success alert-flash" role="alert" v-show="show">
            {{ message }}
            </div>
        </div>

        <nav>
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item">
                     <a class="page-link" href="#" @click="getPosts(pagination.first_page)">&laquo;</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="getPosts(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item">
                    <span class="page-link" >{{ pagination.current_page }} of {{ pagination.last_page }}</span>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="getPosts(pagination.next_page_url)">Next</a>
                </li>
                <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item">
                     <a class="page-link" href="#" @click="getPosts(pagination.last_page_url)">&raquo;</a>
                </li>
            </ul>
        </nav>

        <div class="card mb-2" v-for="post in posts" v-bind:key="post.id">
            <div class="card-body ">
                <h4 class="card-title">{{ post.title }}</h4>
                <p class="card-text">{{ post.body }}</p>
                <button type="button" @click="deletePost(post.id)" class="btn btn-secondary">Delete</button>
                <button type="button" @click="updatePost(post)" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       // props:['message'],
        data() {
            return {
                posts: [],
                pagination: {},
                post: {
                    id: null,
                    title: null,
                    body: null
                },
                update: false,
                message:null,
                show: false,
                post_id: null
            };
        },

        created() {
            this.getPosts();
        },

        methods: {
            getPosts(api_url) {
                let vm = this;
                api_url = api_url || '/api/posts';
                axios.get(api_url)
                .then(response=>{
                      vm.posts = response.data.data
                      vm.paginator(response.data.meta, response.data.links)
                     })
                .catch(error => console.log(error));
            },

            paginator(meta, links) {
                this.pagination = {
                    first_page:links.first,
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    last_page_url: links.last
                };
            },

            addPost() {
                let config={headers: {'content-type': 'application/json'}};
                 if (this.update === false) {
                    axios
                    .post('api/post', this.post,config)
                    .then(data => {
                        this.clearForm();
                        this.message="New Post created";
                        this.show=true;
                        this.getPosts();
                        this.hideMsg();
                    })
                    .catch(error => console.log(error));
                } else {
                axios
                .put('api/post', this.post,config)
                //.then( console.log(response.data))
                .then()
                .then(data => {
                    this.clearForm();
                    this.message="Post Updated";
                    this.show=true;
                    this.getPosts();
                    this.hideMsg();
                    })
                .catch(error => console.log(error));
                }
            },
              deletePost(id) {
                axios
                .delete('api/post/' + id)
                    //.then( console.log(response.data))
                    .then(data => {
                        this.getPosts();
                    })
                    .catch(err => console.log(err));
            },
            updatePost(post) {
                this.update = true;
                this.post.id = post.id;
                this.post.post_id = post.id;
                this.post.title = post.title;
                this.post.body = post.body;
            },
            clearForm() {
                this.update = false;
                this.post.id = null;
                this.post.post_id = null;
                this.post.title = '';
                this.post.body = '';
            },
            hideMsg() {
                setTimeout(() => {
                    this.show = false;
                }, 4000);
            }

        }
    };
</script>
<style>
    .alert-flash {
        left: 200px;
        top: 200px;
    }
</style>
