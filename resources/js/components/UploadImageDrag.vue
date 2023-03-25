<template>
    <div>
        <a class="btn btn-warning" @click="toggleShow">{{nametitle}}</a>
        <input type="hidden" name="collection" :value="collection">
        <my-upload field="file"
                   @crop-success="cropSuccess"
                   @crop-upload-success="cropUploadSuccess"
                   v-model="show"
                   :width="1080"
                   :height="1080"
                   :url="url"
                   :params="params"
                   langType="ru"
                   :max-size=40000
                   :headers="headers"
                   img-format="jpg"
                   :ref="collection"
                   :id="collection"

        >

        </my-upload>
        <div class="mt-3">
            <div class="single_image last_padding">
                <img lazy="loading" class="rounded-circle" :src="imgDataUrl" style="max-width:200px">
                <div class="image_overlay">
                    <a v-on:click="onFileDelete()">{{ __('travels.removeCover') }}</a>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload';
    import $ from 'jquery'

    export default {
        name: 'UploadImageDrag',
        props: [
            'media',
            'collection',
            'travelsrc',
            'uploaded-images',
            'max-number-of-files',
            'max-file-size-in-mb',
            'accepted-file-types',
            'url',
            'nametitle'
        ],
        data() {
            return {
                show: false,
                params: {
                    collection: this.collection,
                },
                imgDataUrl: this.travelsrc, // the datebase64 url of created image
                mutableDragUploadedImages: [],
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        },
        components: {
            'my-upload': myUpload,
        },
        http: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        methods: {
            getFilesDrag() {
                return this.mutableDragUploadedImages;
            },
            clearFilesDrag() {
                this.mutableDragUploadedImages = [];
            },
            onFileDelete: function onFileDelete(file, error, xhr) {
                let files = this.uploadedImages;
                this.imgDataUrl = '/media/nomainfoto.png';

                files.forEach(function (field, key) {
                    field['action'] = 'delete';
                });
                this.mutableDragUploadedImages = files;
            },
            toggleShow() {
                this.show = !this.show;
            },
            cropUploadSuccess(jsonData, field) {
                if (jsonData.path) {
                    this.mutableDragUploadedImages = this.uploadedImages;
                    if (this.mutableDragUploadedImages[0]) {
                        this.mutableDragUploadedImages[0]['action'] = 'delete';
                    }
                    this.mutableDragUploadedImages.push({
                        collection_name: this.collection,
                        path: jsonData.path,
                        action: 'add',
                         meta_data: {

                        }
                    });
                }
            },
            cropSuccess(imgDataUrl, field) {
                this.imgDataUrl = imgDataUrl;

            },
        }
    };
</script>
