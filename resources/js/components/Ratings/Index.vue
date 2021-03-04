<template>
    <div class="col-md-12 col-lg-12">
        <div>
            <div v-if="voted_recently">
                <b-alert class="text-center" variant="success" show>Your vote: {{this.user_score}}</b-alert>
            </div>

            <b-form-rating v-model="user_score" @change="submit_rating" :disabled="!loggedIn"></b-form-rating>
            <div class="row">
                <div class="col-9">
                    <p class="mt-2">Current rating: {{ avg_rating }} (Total: {{ count_rating }} )</p>
                </div>
                <div v-if="user_score != 0" class="col-3">
                    <p class="mt-2">Your: {{ user_score }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['book_id'],
    data: function () {
        return {
            user_score: 0,
            avg_rating: 0,
            count_rating: 0,
            voted_recently: false,
            loggedIn: false,
        }
    },
    mounted() {
        this.get_ratings_api();
        this.check_if_logged_in();

    },
    methods : {
        get_ratings_api(){
            axios.get(`/api/v1/books/${this.book_id}/ratings`)
                .then(response => {
                    if(response.data.user_score != null){
                        this.user_score = response.data.user_score;
                    }
                    this.avg_rating = response.data.avg_score;
                    this.count_rating = response.data.count_score;
                }).catch(() => console.error('error in GET ratings api'));
        },
        post_ratings_api(){
            axios.post(`/api/v1/books/${this.book_id}/ratings`, {rating: this.user_score} )
                .then(response => {
                    this.get_ratings_api();
                }).catch(() => console.error('error in POST ratings api'));
        },
        submit_rating(){
            this.post_ratings_api();
            this.voted_recently = true;
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

