<template>
    <div>
        <form method="POST" @submit.prevent="handelSubmit()">
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" v-model="formData.name" required autocomplete="name" autofocus>
                    <span class="text-danger" role="alert" v-if="errors.name">
                        <strong>{{errors.name[0]}}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" v-model="formData.email" required autocomplete="email">
                    <span class="text-danger" v-if="errors.email" role="alert">
                        <strong>{{ errors.email[0] }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" v-model="formData.password" required autocomplete="new-password">
                    <span class="text-danger" role="alert" v-if="errors.password">
                        <strong>{{errors.password[0]}}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" v-model="formData.password_confirmation" type="password" class="form-control" required autocomplete="new-password">
                    <span class="text-danger" role="alert" v-if="errors.password_confirmation">
                        <strong>{{errors.password_confirmation[0]}}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    name: "RegisterComponent",
    data() {
        return {
            formData: {
                name                 : "",
                email                : "",
                password             : "",
                password_confirmation: "",
            },
            errors  : {},
        };
    },
    methods: {
        handelSubmit() {
            axios.post("/register", this.formData)
                .then((response) => {
                    console.log(response);
                    window.location.href = '/home';
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
}
</script>

<style scoped>

</style>
