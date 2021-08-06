<template>
    <div>
        <button class="btn btn-danger ml-4" @click="reactPost" >{{ reacts }}  <i :class="[status? 'fas fa-heart':'far fa-heart']" aria-hidden="true"></i> </button>
    </div>

</template>

<script>
    export default {
        props:{
            post: {
                type: Object,
                required: true
            },
            user_id: {
                type: Number,
                required: true
            }
        },

        mounted() {
            this.status = this.user_ids.includes(this.user_id)
            console.log(this.post);
            console.log("User_id"+this.user_id);
            console.log('Component mounted.')
            console.log(this.user_ids);
        },

        data:function(){
            return {
                status: false,
                user_ids: this.post.reacts.map(react => react.user_id),
                reacts: this.post.reacts_count
            }
        },

        methods:{
            
            reactPost(){
               
                axios.post(`/posts/${this.post.id}/reacts/${this.user_id}`)
                .then(({data}) =>{
                    this.status = ! this.status;
                    if (data == "unheart") {
                        this.reacts -= 1
                    }else {
                        this.reacts += 1
                    } 
                })
                .catch(errors =>{
                if(errors.response.status==401){
                    window.location ="/login";
                }
            })
            }
        },

        computed: {
            buttonText(){
                return "fa fa-heart"+ (this.status)? '':'-o';
            }
        }
    }
</script>