<template>
    <div>
        <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" v-model="formData.title"
                       class="form-control" id="title"
                       placeholder="Enter title">
                <span class="text-danger" role="alert" v-if="errors.password">
                        <strong>{{ errors.password[0] }}</strong>
                    </span>
            </div>
            <div class="form-group">
                <label for="inventory_id">Inventory</label>
                <select name="inventory_id" id="inventory_id" class="form-control" v-model="formData.inventory_id">
                    <option value="">Select One</option>
                    <option v-for="inventory in inventories" :value="inventory.id">{{ inventory.title }}</option>
                </select>
                <span class="text-danger" role="alert" v-if="errors.password">
                        <strong>{{ errors.password[0] }}</strong>
                    </span>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" v-model="formData.quantity"
                       class="form-control" id="quantity"
                       placeholder="Enter quantity">
                <span class="text-danger" role="alert" v-if="errors.quantity">
                        <strong>{{ errors.password[0] }}</strong>
                    </span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" v-model="formData.description">
                    {{ formData.description}}
                </textarea>
            </div>
            <div class="from-group">
                <label for="image">Image</label>
                <input type="file" multiple @change="handleFileChange" class="form-control">
                <span class="text-danger" role="alert" v-if="errors.images">
                        <strong>{{ errors.images[0] }}</strong>
                </span>
            </div>
            <div>
                <ul class="list-group" >
                    <label for="description">Image Preview</label>
                    <li v-for="file in formData.images" class="list-group-item">
                        <img :src="'/'+file.path" width="10%">
                        <span class="mx-lg-2">{{ file.path }}</span>
                        <button type="button" class="btn btn-danger bt- btn-sm float-end" @click="removeServerFile(file.id)">Remove</button>
                    </li>
                    <li v-for="(rawFile , i) in selectedFiles" class="list-group-item">
                        <img :src="fileGetUrl(i)" width="10%">
                        <span class="mx-lg-2">{{ rawFile.name }} - {{ rawFile.size }} bytes</span>
                        <button type="button" class="btn btn-danger bt- btn-sm float-end" @click="removeFile(rawFile)">Remove</button>
                    </li>
                </ul>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    name      : "CreateComponent",
    props     : ['inventory_item','inventories'],
    components: {},
    data() {
        return {
            selectedFiles: [],
            formData     : {
                title       : '',
                inventory_id: '',
                quantity    : '',
                description : '',
                images      : []
            },
            errors       : {}
        }
    },
    methods: {
        submitForm() {
            const formData = new FormData();
            this.selectedFiles.forEach(file => {
                formData.append('images[]', file);
            });
            console.log('submit form', formData.images);
            formData.append('title', this.formData.title);
            formData.append('inventory_id', this.formData.inventory_id);
            formData.append('quantity', this.formData.quantity);
            formData.append('description', this.formData.description);
            formData.append('_method', 'put');
            axios.post('/inventory-items/'+this.inventory_item.id, formData)
                .then(response => {
                    window.location = '/inventory-items';
                    console.log(response.data);
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        handleFileChange(event) {
            this.selectedFiles = Array.from(event.target.files);
        },
        fileGetUrl(i) {
            return URL.createObjectURL(this.selectedFiles[i]);
        },
        removeFile(file) {
            this.selectedFiles = this.selectedFiles.filter(f => f !== file);
        },
        removeServerFile(file) {
            let formData = new FormData();
            formData.append('file', file);
            formData.append('inventory_item', this.inventory_item.id);
            formData.append('_method', 'delete');
            axios.post('/inventory-items/images/'+file , formData)
                .then(response => {
                    for (let i = 0; i < this.formData.images.length; i++) {
                        if (this.formData.images[i].id === file) {
                            this.formData.images.splice(i, 1);
                        }
                    }
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        }
    },
    mounted() {
        this.formData.title = this.inventory_item.title;
        this.formData.inventory_id = this.inventory_item.inventory_id;
        this.formData.quantity = this.inventory_item.quantity;
        this.formData.description = this.inventory_item.description;
        this.formData.images = this.inventory_item.images;
    }
}
</script>

<style scoped>

</style>
