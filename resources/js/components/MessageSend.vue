<template>
    <div class="padding30">
        <b-form>
            <b-form-group>
                <img class=avatar-photo :src="authUserAvatar">
                <input class="input" placeholder="Name" type="text" disabled :value="authUserName">
            </b-form-group>

            <b-form-group>
                    <textarea type="text" class="form-control"
                              v-model="content"
                              :placeholder="translate('travels.addMessage')"
                    ></textarea>
            </b-form-group>


            <b-button class="btn btn-success"
                      v-on:click="sendTo()"
            >
                {{translate('travels.sendMessage')}}
            </b-button>

        </b-form>
    </div>
</template>

<script>
    export default {
        name: "MessageSend",
        props: ['messagesBetween', 'recipient_id'],
        data() {
            return {
                content: '',
                newMes: this.messagesBetween
            }
        },

        mounted() {
            console.log(this.recipient_id);
            console.log(this.messagesBetween);
            console.log(this.newMes);
        },
        methods: {

            sendTo() {
                axios.post('/api/messages', {
                    message: this.content,
                    travel_id: this.travel_id,
                    recipient_id: this.recipient_id,
                    sender_id: this.authUserId
                }).then(response => {
                    var mes = {};
                    mes.messages_latest = [];
                    mes.messages_latest.push({
                        'user_id': this.authUserId,
                        'body': this.content
                    });
                    this.newMes.data.unshift(mes);
                    this.content = '';
                    if (!response.data.error) {
                        this.content = '';
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
