<template>
    <div>
        <a class="btn btn-warning" @click="toggleShow">{{ translate('travels.uploadCover') }}</a>
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
                <img class="rounded-circle" :src="imgDataUrl" style="max-width:200px">
                <div class="image_overlay">
                    <a v-on:click="onFileDelete()">{{ translate('travels.removeCover') }}</a>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload';

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
        ],
        data() {
            return {
                show: false,
                params: {
                    collection: 'travelMainImage',
                },
                imgDataUrl: this.travelsrc, // the datebase64 url of created image
                mutableDragUploadedImages: [],
                travelMainImage: [],
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
                this.mutableDragUploadedImages = this.uploadedImages;
                if (this.mutableDragUploadedImages[0]) {
                    this.mutableDragUploadedImages[0]['action'] = 'delete';
                    this.imgDataUrl = '/media/nomainfoto.png';
                }
            },
            toggleShow() {
                this.show = !this.show;
            },
            cropUploadSuccess(jsonData, field) {
                if (jsonData.path) {
                    this.pathToFile = jsonData.path;
                    this.mutableDragUploadedImages = this.uploadedImages;
                    if (this.mutableDragUploadedImages[0]) {
                        this.mutableDragUploadedImages[0]['action'] = 'delete';
                    }
                    this.mutableDragUploadedImages.push({
                        collection_name: this.collection,
                        path: jsonData.path,
                        action: 'add',
                        meta_data: {
                            /*   name: '',
                               file_name: '',
                               width: _this2.$refs[this.collection].width,
                               height: _this2.$refs[this.collection].height*/
                        }
                    });
                }
                // console.log('this.mutableDragUploadedImages');
                // console.log(this.mutableDragUploadedImages);
                /* _this.mutableUploadedImages.forEach(function (field, key) {

                     _this.manuallyAddFile({
                         name: file['name'],
                         size: file['size'],
                         type: file['type'],
                         url: file['url']
                     }, file['thumb_url'], false, false, {
                         dontSubstractMaxFiles: false,
                         addToFiles: true
                     });
                 });*/
            },
            cropSuccess(imgDataUrl, field) {
                this.imgDataUrl = imgDataUrl;

            },
        }
    };
</script>
