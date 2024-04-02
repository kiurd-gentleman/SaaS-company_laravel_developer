<template>
    <div class="card-body">
        <form method="POST" @submit.prevent="handelSubmit()">

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" v-model="formData.email" required autocomplete="email" autofocus>
                    <span v-if="errors.email" class="text-danger" role="alert">
                        <strong>{{ errors.email[0] }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" v-model="formData.password" required autocomplete="current-password">
                    <span v-if="errors.password" class="text-danger" role="alert">
                        <strong>{{ errors.email[0] }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" :checked="formData.remember" v-model="formData.remember">

                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "LoginComponent",
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            formData: {
                email: "",
                password: "",
                remember: false,
            },
            errors: {},
        };
    },
    methods: {
        handelSubmit() {
            this.formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post("/login", this.formData).then((response) => {
                window.location.href = '/home';

                console.log(response);
            }).catch((error) => {
                console.log(error.response.data.errors);
                this.errors = error.response.data.errors;
            });
        },
        login() {
            console.log("login");
        },
    },
};
</script>
