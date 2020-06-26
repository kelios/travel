<template>

    <div class="comments-app">
        <h1>{{__('travels.comment')}}</h1>
        <!-- From -->
        <div class="comment-form" v-if="user">
            <!-- Comment Avatar -->
            <div class="comment-avatar">
                <img :src="user.user_avatar_thumb_url">
            </div>
            <form class="form" name="form">
                <div class="form-row">
                    <textarea class="input" :placeholder="__('travels.addcomment')" required v-model="message"></textarea>
                    <span class="input" v-if="errorComment" style="color:red">{{errorComment}}</span>
                </div>
                <div class="form-row">
                    <input class="input" placeholder="Name" type="text" disabled :value="user.name">
                </div>
                <div class="form-row">
                    <input type="button" class="btn btn-success" @click="saveComment" :value="__('travels.addcomment')">
                </div>
            </form>
        </div>
        <!-- Comments List -->
        <div v-if="comments">
            <div class="comments" v-for="(comment, index) in commentsData" v-bind:key="comment.id">
                <!-- Comment -->
                <div class="comment">
                    <!-- Comment Avatar -->
                    <div class="comment-avatar">
                        <img :src="comment.user.user_avatar_thumb_url">
                    </div>
                    <!-- Comment Box -->
                    <div class="comment-box">
                        <div class="comment-text" v-html="comment.comment"></div>
                        <div class="comment-footer">
                            <div class="comment-info">
                       <span class="comment-author">
                               <em>{{ comment.user.name}}</em>
                           </span>
                                <span class="comment-date">{{ comment.created_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    var _ = require('lodash');
    import Vue from 'vue'
    import axios from 'axios';

    export default {
        props: ['auth_user', 'travel'],
        data() {
            return {
                commentreplies: [],
                comments: 0,
                commentBoxs: [],
                message: null,
                commentsData: [],
                viewcomment: [],
                show: [],
                errorComment: null,
                travelId: this.travel.id,
                user: this.auth_user,
            }
        },
        methods: {
            fetchComments() {
                axios.get('/comments/' + this.travelId).then(res => {
                    this.commentsData = res.data.data;
                    this.comments = 1;
                }).catch(err => {
                    console.log(err)
                });
            },
            showComments(index) {
                if (!this.viewcomment[index]) {
                    Vue.set(this.show, index, "hide");
                    Vue.set(this.viewcomment, index, 1);
                } else {
                    Vue.set(this.show, index, "view");
                    Vue.set(this.viewcomment, index, 0);
                }
            },
            openComment(index) {
                if (this.user.auth) {
                    if (this.commentBoxs[index]) {
                        Vue.set(this.commentBoxs, index, 0);
                    } else {
                        Vue.set(this.commentBoxs, index, 1);
                    }
                }
            },

            saveComment() {
                if (this.message !== null && this.message != ' ') {
                    this.errorComment = null;
                    axios.post('/comments', {
                        travel_id: this.travelId,
                        comment: this.message,
                        users_id: this.user.id
                    }).then(res => {
                        if (res.data.status) {
                            this.commentsData.unshift({
                                "commentId": res.data.commentId,
                                "name": this.user.name,
                                "comment": this.message,
                                "user": this.user,
                                "created_at": new Date().toLocaleDateString()
                            });
                            this.message = null;
                        }
                    })
                } else {
                    this.errorComment = "Please enter a comment before saving";
                }
            },
        },
        mounted() {
            this.fetchComments();
        }
    }
</script>
<style>
    .text-right {
        text-align: right;
    }

    .comments-app {
        margin: 50px auto;
        padding: 0 50px;
        width: 100%;
    }

    .comments-app h1 {
        color: #191919;
        margin-bottom: 1.5em;
        text-align: center;
        text-shadow: 0 0 2px rgba(152, 152, 152, 1);
    }

    .comment-form {
    }

    .comment-form .comment-avatar {
    }

    .comment-v {
        margin-top: 5px;
    }

    .comment-form .form {
        margin-left: 100px;
    }

    .comment-form .form .form-row {
        margin-bottom: 10px;
    }

    .comment-form .form .form-row:last-child {
        margin-bottom: 0;
    }

    .comment-form .form .input {
        background-color: #f1fbff;
        border: none;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        color: #555f77;
        font-family: inherit;
        font-size: 14px;
        padding: 5px 10px;
        outline: none;
        width: 100%;
        -webkit-transition: 350ms box-shadow;
        -moz-transition: 350ms box-shadow;
        -ms-transition: 350ms box-shadow;
        -o-transition: 350ms box-shadow;
        transition: 350ms box-shadow;
    }

    .comment-form .form textarea.input {
        height: 100px;
        padding: 15px;
    }

    .comment-form .form label {
        color: #555f77;
        font-family: inherit;
        font-size: 14px;
    }

    .comment-form .form input[type=submit] {
        background-color: #555f77;
        border: none;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        color: #fff;
        cursor: pointer;
        display: block;
        margin-left: auto;
        outline: none;
        padding: 6px 15px;
        -webkit-transition: 350ms box-shadow;
        -moz-transition: 350ms box-shadow;
        -ms-transition: 350ms box-shadow;
        -o-transition: 350ms box-shadow;
        transition: 350ms box-shadow;
    }

    .comment-form .form .input:focus,
    .comment-form .form input[type=submit]:focus,
    .comment-form .form input[type=submit]:hover {
        box-shadow: 0 2px 6px rgba(121, 137, 148, .55);
    }

    .comment-form .form.ng-submitted .input.ng-invalid,
    .comment-form .form .input.ng-dirty.ng-invalid {
        box-shadow: 0 2px 6px rgba(212, 47, 47, .55) !important;
    }

    .comment-form .form .input.disabled {
        background-color: #E8E8E8;
    }

    .comments {
    }

    .comment-form,
    .comment {
        margin-bottom: 20px;
        position: relative;
        z-index: 0;
    }

    .comment-form .comment-avatar,
    .comment .comment-avatar {
        border: 2px solid #fff;
        border-radius: 50%;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
        height: 80px;
        left: 0;
        overflow: hidden;
        position: absolute;
        top: 0;
        width: 80px;
    }

    .comment-form .comment-avatar img,
    .comment .comment-avatar img {
        display: block;
        height: auto;
        width: 100%;
    }

    .comment .comment-box {
        background-color: #fcfcfc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        margin-left: 100px;
        min-height: 60px;
        position: relative;
        padding: 15px;
    }

    .comment .comment-box:before,
    .comment .comment-box:after {
        border-width: 10px 10px 10px 0;
        border-style: solid;
        border-color: transparent #FCFCFC;
        content: "";
        left: -10px;
        position: absolute;
        top: 20px;
    }

    .comment .comment-box:before {
        border-color: transparent rgba(0, 0, 0, .05);
        top: 22px;
    }

    .comment .comment-text {
        color: #555f77;
        font-size: 15px;
        margin-bottom: 25px;
        word-wrap: break-word;
    }

    .comment .comment-footer {
        color: #acb4c2;
        font-size: 13px;
    }

    .comment .comment-footer:after {
        content: "";
        display: table;
        clear: both;
    }

    .comment .comment-footer a {
        color: #acb4c2;
        text-decoration: none;
        -webkit-transition: 350ms color;
        -moz-transition: 350ms color;
        -ms-transition: 350ms color;
        -o-transition: 350ms color;
        transition: 350ms color;
    }

    .comment .comment-footer a:hover {
        color: #555f77;
        text-decoration: underline;
    }

    .comment .comment-info {
        float: left;
        width: 85%;
    }

    .comment .comment-author {
    }

    .comment .comment-date {
    }

    .comment .comment-date:before {
        content: "|";
        margin: 0 10px;
    }

    .comment-actions {
        float: left;
        text-align: right;
        width: 15%;
    }

    .reply {
        margin-top: 5px;
        margin-left: 60px;
    }

    .list {
        list-style: none;
        list-style-type: none;
        display: inline !important;
    }
</style>
