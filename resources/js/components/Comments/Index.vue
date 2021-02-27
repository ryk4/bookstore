<template>
    <div>
        <div class="headings d-flex justify-content-between align-items-center mb-3">
            <h5>Comments ({{ comments.length }})</h5>
            <div class="buttons">
                <div class="form-check form-switch"></div>
            </div>
        </div>
        <div class="card p-3 mt-2" v-for="comment in comments" :key="comment.id">
            <div class="d-flex justify-content-between align-items-center">
                <div class="user d-flex flex-row align-items-center">
                    <img src="/assets/images/topbar/user.jpg" width="30"
                         class="user-img rounded-circle mr-2"> <span>
                            <small
                                class="font-weight-bold text-primary">{{comment.user_id}}</small>
                            <small class="font-weight-bold">{{comment.actual_comment}}</small></span>
                </div>
                <small>{{comment.created_at}}</small>
            </div>
            <div class="action d-flex justify-content-between mt-2 align-items-center">
                <div class="reply px-4"></div>
                <div class="icons align-items-center"><i
                    class="fa fa-check-circle-o check-icon text-primary"></i></div>
            </div>
        </div>
        <form @submit.prevent="submit_comment" v-show="loggedIn">
            <div class="card p-3 mt-2">
                <div class="row justify-content-center">
                    <div class="col-9">
                        <input v-model="fields.comment" class="form-control" id="comment_field" name="comment"
                               placeholder="Enter your comment">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-outline-primary"  :disabled="fields.comment == ''">
                            Comment
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['book_id'],
    data: function () {
        return {
            comments: {},
            fields: {
                comment: ''
            },
            loggedIn: false,
        }
    },
    mounted() {
        this.check_if_logged_in();
        this.get_comments_api();
    },
    methods: {
        get_comments_api() {
            axios.get(`/api/v1/books/${this.book_id}/comments`)
                .then(response => {
                    this.comments = response.data.data;
                });
        },
        post_comment_api(){
            axios.post(`/api/v1/books/${this.book_id}/comments`, this.fields)
                .then(response => {

                });
        },
        submit_comment() {
            const authMiddleware = () => {
                axios.get('/user').catch(() => console.error('user is not logged in!'));
            };

            this.post_comment_api();
            this.get_comments_api();

            //reset fields
            this.fields.comment = '';
        },
        check_if_logged_in(){
            axios.get('/api/v1/user/status')
                .then(response => {
                    console.log('user logged in!');
                    this.loggedIn = true;
                })
                .catch(() => console.error('user is not logged in!'));;
        }
    }
}

</script>
