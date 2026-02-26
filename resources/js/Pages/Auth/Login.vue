<template>

    <Head>
        <title>Masuk − {{ setting.site_title }}</title>
    </Head>

    <div class="card rounded-4 w-100 w-sm-450px w-lg-500px border border-gray-300">
        <div class="card-body p-8 p-sm-10 p-md-12">
            <form class="form w-100" @submit.prevent="submit">
                <div class="text-center mb-8 mb-sm-10 mb-md-12">
                    <h1 class="text-center text-dark lh-sm fw-bolder fs-2qx fs-xl-2x mb-4">
                        Administrator
                    </h1>
                    <p class="text-center text-gray-500 fs-5 mb-0 mw-300px mw-lg-325px mx-auto">
                        Masuk untuk mengelola halaman utama
                    </p>
                </div>

                <div class="mb-6 fv-row">
                    <label class="required form-label fs-6">Alamat Email</label>
                    <input type="email" class="form-control rounded-3 fs-5" name="email" autocomplete="off" v-model="form.email"
                        required placeholder="Contoh: admin@gmail.com" :class="{ 'is-invalid': errors.email }"/>
                    <div v-if="errors.email" class="text-mydanger mt-2">
                        {{ errors.email }}
                    </div>
                </div>
                <div class="mb-8 mb-sm-10 mb-md-12 fv-row">
                    <label class="required form-label fs-6">Kata Sandi</label>
                    <input type="password" class="form-control rounded-3 fs-5" name="password" autocomplete="off" v-model="form.password"
                        required placeholder="********" :class="{ 'is-invalid': errors.password }"/>
                    <div v-if="errors.password" class="text-mydanger mt-2">
                        {{ errors.password }}
                    </div>
                </div>
                
                <div class="mb-8 mb-sm-10 mb-md-12">
                    <button type="submit" id="kt_sign_in_submit" class="btn fs-5 fw-bolder btn-myprimary-filled rounded-3 w-100">
                        <span class="indicator-label">
                            Masuk Sekarang
                        </span>
                        <span class="indicator-progress">
                            Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                
                <p class="text-center text-gray-500 fs-5 mb-0">
                    Kembali ke
                    <a href="/" class="btn-link-myprimary fw-bolder">Beranda</a>
                </p>
            </form>
        </div>
    </div>
</template>

<script>
    import {
        Head,
        Link,
        router
    } from '@inertiajs/vue3';
    import {
        reactive
    } from 'vue';
    import LayoutAuth from '../../Layouts/Auth.vue'; 

    export default {
        layout: LayoutAuth,

        components: {
            Head,
            Link
        },

        props: {
            setting: Object,
            errors: Object,
            session: Object
        },

        setup() {
            const form = reactive({
                email: '',
                password: '',
            });

            const submit = () => {
                const submitBtn = document.querySelector('#kt_sign_in_submit');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                router.post('/admin/login', {
                    email: form.email,
                    password: form.password,
                }, {
                    onSuccess: () => {
                        window.location.reload();
                    },
                    onFinish: () => {
                        if (submitBtn) {
                            submitBtn.removeAttribute('data-kt-indicator');
                            submitBtn.removeAttribute('disabled');
                        }
                    }
                });
            }

            return {
                form,
                submit,
            };
        }
    }
</script>
