<template>
    

<div>

    <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>

</div>





</template>

<script>
    export default {


        props: ['userId', 'follows'],


        mounted() {
            console.log('Component mounted.')
        },


        data: function(){

            return{

                status: this.follows,

            }


        },


        methods: {

            followUser(){

            axios.post('/follow/'+ this.userId)
                .then(response=>{


                    this.status =! this.status;

                    console.log(response.data);

                }) //se conecta con las ruta (web)

               

                .catch(errors=>{

                    if(errors.response.status == 401){

                        window.location='/login';

                    }

                    //si hay algun error 401 con el follow (no autorizado(no logeado)), mande al login


                })

            }
        },


        computed: {

            buttonText(){

                return (this.status) ? 'Unfollow' : 'Follow';

            }



        }



    }
</script>
