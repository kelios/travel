<template>
    <div class="padding30">
        <b-form>
            <b-form-group>
                <img lazy="loading" class=avatar-photo :src="authUserAvatar">
                <input class="input" placeholder="Name" type="text" disabled :value="authUserName">
            </b-form-group>

            <b-form-group>
                    <textarea type="text" class="form-control"
                              v-model="content"
                              :placeholder="__('travels.addMessage')"
                    ></textarea>
            </b-form-group>


            <b-button class="btn btn-success"
                      v-on:click="sendTo()"
            >
                {{__('travels.sendMessage')}}
            </b-button>

        </b-form>
    </div>
</template>

<script>
    import {BButton, BFormGroup, BForm} from 'bootstrap-vue';

    export default {
        name: "MessageSend",
        props: ['recipient_id'],
        components: {
            'b-button': BButton,
            'b-form-group': BFormGroup,
            'b-form': BForm,
        },
        data() {
            return {
                content: ''
            }
        },
        methods: {
            async sendTo() {
                axios.post('/api/messages', {
                    message: this.content,
                    travel_id: this.travel_id,
                    recipient_id: this.recipient_id,
                    sender_id: this.authUserId
                }).then(response => {
                    this.$store.commit('SET_MESSAGES_BETWEEN_NEW', {
                        'user_id': parseInt(this.authUserId),
                        'body': this.content
                    });

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
