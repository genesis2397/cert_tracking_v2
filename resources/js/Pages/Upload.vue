
<template>
    <app-layout>
        <v-row>
            <v-snackbar
            v-model="snackbar"
            :timeout="3000"
            :value="true"
            absolute
            bottom
            color="success"
            success
            top
            right
            >
            <v-icon>mdi-check</v-icon>
            Images uploaded successfully.
            </v-snackbar>
            <div class="uploader"
            @dragenter="OnDragEnter"
            @dragleave="OnDragLeave"
            @dragover.prevent
            @drop="onDrop"
            :class="{ dragging: isDragging }">

            <div class="upload-control" v-show="images.length">
                <label for="file">Select a file</label>
                <button @click="upload">Upload</button>
            </div>

            <div v-show="!images.length">
                <v-icon color="white" large>mdi-cloud-upload</v-icon>
                <p>Drag your images here</p>
                <div>OR</div>
                <div class="file-input">
                    <label for="file">Select a file</label>
                    <input type="file" id="file" @change="onInputChange" multiple>
                </div>
            </div>

            <div class="images-preview" v-show="images.length">
                <div v-for="(image, index) in images" :key="index">
                        <v-btn
                            class="mx-2"
                            fab
                            dark
                            small
                            color="#0000B9"
                            @click="remove_item([image,files[index]])"
                            >
                            <v-icon dark color="white">
                                mdi-close
                            </v-icon>
                        </v-btn>
                    <div class="img-wrapper">
                        <img :src="image" :alt="`Image Uplaoder ${index}`">
                        <div class="details">
                            <span class="name" v-text="files[index].name"></span>
                            <span class="size" v-text="getFileSize(files[index].size)"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </v-row>
        <!-- table for images -->
        <v-row>

        <v-col cols="12" sm="6" md="3">
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
        </v-col>

        </v-row>
        <v-row class="mt-10">
            <div>
                <template>
                    <v-data-table
                        :search="search"
                        :headers="headers"
                        :items="items"
                        :page.sync="page"
                        :items-per-page="itemsPerPage"
                        hide-default-footer
                        @page-count="pageCount = $event"
                        class="elevation-1"
                        :loading='isLoading'
                    >
                        <template slot="item.actions" slot-scope="props">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <!-- <template slot="item.cert_image" slot-scope="props"> -->
                            <!-- <img :src="require('../../../storage/app/images/'+props.item.cert_image).default" style="width:30px; height:auto; cursor:pointer;" @click='scar(props.item.cert_image)'> -->
                        <!-- </template> -->
                    </v-data-table>
                </template>
                <div class="text-center pt-2">
                <v-pagination
                    v-model="page"
                    :length="pageCount"
                    circle
                    :total-visible="7"
                ></v-pagination>
                </div>
            </div>
            <div v-if="awesome">
                <v-btn
                class="float-left"
                fab
                dark
                x-small
                color="primary"
                style="position:relative; left:105px; bottom:25px;"
                @click="awesome=false"
                >
                <v-icon dark>
                    mdi-close
                </v-icon>
                </v-btn>
          <!-- <img :src="require('../../../storage/app/images/'+changed).default" style="width:500px; height:auto; cursor:pointer; position:relative; left:100px;"> -->
            </div>
        </v-row>
    </app-layout>
</template>

<script>
    import AppLayout from '../Layouts/AppLayout'
    export default {
        components: {
            AppLayout,
        },
            data: () => ({
        absolute : false,
        awesome : false,
        snackbar : false,
        isDragging: false,
        search : '',
        dialog : true,
        dragCount: 0,
        files: [],
        changed: '',
        images: [],
        status: '',
        isLoading: true,
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
                headers: [
                // Dynamic headers
                {
                    text: 'ID',
                    value: 'id',
                    class: 'blue'
                },
                {
                    text: 'Employee ID',
                    value: 'emp_id',
                    class: 'blue'
                },
                {
                    text: 'Employee Name',
                    value: 'name',
                    class: 'blue'
                },
                {
                    text: 'Certification Name',
                    value: 'cert_name',
                    class: 'blue'
                },
                {
                    text: 'Certification Photo',
                    value: 'cert_image',
                    class: 'blue'
                },
                {
                    text: 'Date Uploaded',
                    value: 'uploaded_date',
                    class: 'blue'
                },
                {
                    text: 'Action',
                    value: 'actions',
                    class: 'blue',
                    sortable: false
                },
            ],
            items: [
                // {
                //     emp_id: '#2354461',
                //     name: 'Jane Doe'
                // },
                // {
                //     emp_id: '#1944545',
                //     name: 'Michael Jordan'
                // }
            ]
    }),

    created : function(){
        axios.get('/delano')
        .then(response =>{
         this.items = response.data;
         this.isLoading = false;
        })
        .catch(error =>{
        console.log(error);
        })
    },

        methods: {
        scar(data){
            this.awesome = true
            this.changed = data
        },
        OnDragEnter(e) {
            e.preventDefault();

            this.dragCount++;
            this.isDragging = true;

            return false;
        },
        remove_item(image){
           this.images.splice(this.images.indexOf(image[0]), 1)
           this.files.splice(this.files.indexOf(image[1]), 1)
        },
        OnDragLeave(e) {
            e.preventDefault();
            this.dragCount--;

            if (this.dragCount <= 0)
                this.isDragging = false;
        },
        onInputChange(e) {
            const files = e.target.files;

            Array.from(files).forEach(file => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false;

            const files = e.dataTransfer.files;

            Array.from(files).forEach(file => this.addImage(file));
        },
        addImage(file) {
            if (!file.type.match('image.*')) {
                this.$toastr.e(`${file.name} is not an image`);
                return;
            }

            this.files.push(file);

            const img = new Image(),
                reader = new FileReader();

            reader.onload = (e) => this.images.push(e.target.result);

            reader.readAsDataURL(file);
        },
        getFileSize(size) {
            const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
            let i = 0;

            while(size > 900) {
                size /= 1024;
                i++;
            }

            return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
        },
        upload() {
            const formData = new FormData();

            this.files.forEach(file => {
                formData.append('images[]', file, file.name);
            });

            axios.post('/images-upload', formData)
                .then(response => {
                    this.images = [];
                    this.files = [];
                    this.status = response.data.status;
                    this.snackbar = true;
                })
        }
    }

    }
</script>

<style lang="scss" scoped>
.uploader {
    width: 100%;
    background: #306EFF;
    color: #fff;
    padding: 40px 15px;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #fff;
    font-size: 20px;
    position: relative;

    &.dragging {
        background: #fff;
        color: #2196F3;
        border: 3px dashed #2196F3;

        .file-input label {
            background: #2196F3;
            color: #fff;
        }
    }

    i {
        font-size: 85px;
    }

    .file-input {
        width: 200px;
        margin: auto;
        height: 68px;
        position: relative;

        label,
        input {
            background: #fff;
            color: #2196F3;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            padding: 10px;
            border-radius: 4px;
            margin-top: 7px;
            cursor: pointer;
        }

        input {
            opacity: 0;
            z-index: -2;
        }
    }

    .images-preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;

        .img-wrapper {
            width: 160px;
            display: flex;
            flex-direction: column;
            margin: 10px;
            height: 150px;
            justify-content: space-between;
            background: #fff;
            box-shadow: 5px 5px 20px #3e3737;

            img {
                max-height: 105px;
            }
        }

        .details {
            font-size: 12px;
            background: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: self-start;
            padding: 3px 6px;

            .name {
                overflow: hidden;
                height: 18px;
            }
        }
    }

    .upload-control {
        position: absolute;
        width: 100%;
        background: #0000B9;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;

        button, label {
            background: #2196F3;
            border: 2px solid #03A9F4;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        label {
            padding: 2px 5px;
            margin-right: 10px;
        }
    }
    .name{
        font-weight: 1000;
    }
}
</style>

<style>
  tbody tr:nth-of-type(even) {
    background-color: rgba(0, 0, 0, .05);
  }
</style>

