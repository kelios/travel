<template>
    <section class="feedback-form">
        <form
            role="form"
            @submit.prevent="onSubmit"
        >
            <div class="form-group">
                <label
                    class="form-label"
                    for="feedback-name"
                >{{trans('main.name')}}:*</label>
                <input
                    class="form-control"
                    v-model="nameField"
                    id="feedback-name"
                    type="text"
                />
            </div>
            <div class="form-group">
                <label
                    class="form-label"
                    for="feedback-email"
                >Email:</label>
                <input
                    class="form-control"
                    v-model="emailField"
                    id="feedback-email"
                    type="email"
                />
            </div>
            <div class="form-group">
                <label
                    class="form-label"
                    for="feedback-body"
                >{{trans('main.comment')}}:*</label>
                <textarea
                    class="form-control"
                    resize="false"
                    id="feedback-body"
                    type="text"
                    v-model="body"
                />
            </div>
            <p v-if="success" class="text-success text-center">
                {{trans('main.sendFeedbackSuccess')}}
            </p>
            <p v-if="errors_feedback" class="text-danger text-center">
                {{ errors_feedback }}
            </p>
            <button
                :disabled="!isValid"
                class="form-control btn btn-primary"
                type="submit"
            >
                <div
                    v-if="isLoading"
                    class="spinner-border spinner-border-sm"
                    role="status"
                >
                    <span class="sr-only">{{trans('main.loading')}}...</span>
                </div>
                <div v-else>
                    {{trans('main.send')}}
                </div>
            </button>
        </form>
    </section>
</template>

<style lang="scss">
    .feedback-form {
        z-index: 100;
        bottom: 1em;
        right: 1em;

        .form {
            max-width: 16em;
            padding: 1em;
            background: white;
            border-radius: 5px;
            border: 1px solid darkgray;
        }

        .feedback-btn {
            font-size: 1.5em;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            color: white;
        }
    }
</style>

<script>
    import axios from 'axios';

    export default {
        props: ['name', 'email'],
        data() {
            return {
                emailField: this.email,
                nameField: this.name,
                body: null,
                isLoading: false,
                errors_feedback: null,
                success: false,
            };
        },
        computed: {
            isValid() {
                if (this.isLoading) {
                    return false;
                }

                if (!this.nameField) {
                    return false;
                }

                if (!this.body) {
                    return false;
                }
                return true;
            },
        },

        methods: {
            async onSubmit() {
                try {
                    this.errors_feedback = null;
                    this.success = false;
                    this.isLoading = true,

                    await axios.post(`/feedback`, {
                        name: this.nameField,
                        email: this.emailField,
                        body: this.body,
                    });

                    this.isLoading = false;
                    this.success = true;

                    this.reset();
                } catch (error) {
                    this.isLoading = false;
                    this.errors_feedback = error.message;
                }
            },

            reset() {
                this.body = null;
            },
        },

        mounted() {
            this.reset();
        },
    };
</script>
