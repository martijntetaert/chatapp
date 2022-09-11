<template>
    <div class="background">
        <div class="usernameScreen" v-if="usernameScreen">
            <div class="container-fluid">
                <div class="row">
                    <div class="col position-relative">
                        <input type="text" @keydown.enter.prevent="buttonUsername" :class=" (usernameWarning ? 'border-danger' : '') +' form-control position-absolute text-center'" v-model="username" placeholder="Username">
                        <button :class=" 'btn btn-secondary text-center position-absolute text-uppercase'" @click="buttonUsername">Start chat</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!usernameScreen" class="chatScreen">
            <div class="messages d-flex flex-column">
                <article v-for="message in messages" :class="(message.username === username ? 'home' : 'away' )">
                    <p>{{message.username}}</p>
                    <div class="content">
                        {{message.message}}
                    </div>
                </article>
            </div>
            <div class="position-relative mx-auto" id="inputbox">
                <textarea type="text" class="form-control" v-model="message" @keydown.enter.prevent="sendMessage"></textarea>
                <button @click="sendMessage" class="border-0 p-0"><font-awesome-icon icon="fa-solid fa-paper-plane" /></button>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: "App.vue",

    mounted() {
        window.Echo.channel(`chat`).error(e=>{
        }).listen('.send', (e)=>{
            if (e.username !== this.username){
                this.messages.push({username: e.username, message: e.message});
            }
        });

    },

    data() {
        return {
            username: "",
            usernameWarning: false,
            usernameScreen: true,
            messages: [],
            message: '',
        }
    },
    methods: {
        buttonUsername() {
            if (this.username !== null){
                this.usernameScreen = false;
                this.messages = [];
            }else{
                this.usernameWarning = true;
            }
        },
        sendMessage(){
            if (this.message !== ''){
                this.messages.push({username: this.username, message: this.message});
                axios.post('/',
                    {
                        message: this.message,
                        username: this.username
                    },
                    {
                        // Config
                    }
                );
                this.message = '';
                this.scrollToElement();
            }

        },
        scrollToElement() {
            const el = this.$el.querySelector(".messages");
            el.scrollTop = el.scrollHeight + 99999;
        }
    },
}
</script>

<style scoped>

</style>
