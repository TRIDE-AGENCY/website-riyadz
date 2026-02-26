<template>
    <main
        id="kt_body"
        class="bg-white position-relative app-blank"
        data-kt-name="metronic"
        data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu"
    >
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div
                id="navigation"
                :class="['landing-header', navBgClass]"
                aria-label="Navigasi utama"
                data-kt-sticky="true"
                data-kt-sticky-name="landing-header"
                data-kt-sticky-offset="{default: '200px', lg: '300px'}"
            >
                <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-lg-start">
                            <a href="/">
                                <div class="d-flex align-items-center gap-4">
                                    <img
                                        :alt="`Logo ${setting.site_title}`"
                                        :src="`/storage/${setting.site_logo}`"
                                        class="logo-default h-40px h-lg-45px"
                                    />
                                    <img
                                        :alt="`Logo ${setting.site_title}`"
                                        :src="`/storage/${setting.site_logo}`"
                                        class="logo-sticky h-35px h-lg-40px"
                                    />
                                    <span style="font-weight: 800;"
                                        class="text-nowrap fs-1 text-myprimary">{{ setting.site_title }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex">
                            <div class="d-lg-block" id="kt_header_nav_wrapper">
                                <div
                                    class="d-lg-block p-5 p-lg-0 flex-column gap-6 justify-content-between"
                                    data-kt-drawer="true"
                                    data-kt-drawer-name="landing-menu"
                                    data-kt-drawer-activate="{default: true, lg: false}"
                                    data-kt-drawer-overlay="true"
                                    data-kt-drawer-width="225px"
                                    data-kt-drawer-direction="start"
                                    data-kt-drawer-toggle="#kt_landing_menu_toggle"
                                    data-kt-swapper="true"
                                    data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                                    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}"
                                >
                                    <div
                                        class="menu menu-column flex-nowrap gap-lg-4 pe-lg-6 pe-xxl-4 menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-4 fw-semibold"
                                        id="kt_landing_menu"
                                    >
                                        <div class="menu-item">
                                            <a href="/" :class="{ 'active': $page.url === '/' }"
                                                class="menu-link nav-link navigation navbar-link"
                                                data-kt-scroll-toggle="true"
                                                data-kt-drawer-dismiss="true"
                                            >
                                                Beranda
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="/blogs" :class="{ 'active': $page.url.startsWith('/blogs') }"
                                                class="menu-link nav-link navigation navbar-link"
                                                data-kt-scroll-toggle="true"
                                                data-kt-drawer-dismiss="true"
                                            >
                                                Blog
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="/books" :class="{ 'active': $page.url.startsWith('/books') }"
                                                class="menu-link nav-link navigation navbar-link"
                                                data-kt-scroll-toggle="true"
                                                data-kt-drawer-dismiss="true"
                                            >
                                                Buku
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#collaboration"
                                        data-kt-scroll-toggle="true"
                                        data-kt-drawer-dismiss="true"
                                        class="btn ps-6 pe-7 btn-myprimary-filled rounded-pill fs-4 d-inline-flex d-lg-none gap-1 align-items-center justify-content-center"
                                    >
                                        <i class="fs-3 ri-service-fill"></i>
                                        <span class="fw-bolder text-nowrap">Kolaborasi</span>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row text-end me-n3 me-lg-0 justify-content-lg-end w-lg-175px">
                                <a href="#collaboration"
                                    data-kt-scroll-toggle="true"
                                    data-kt-drawer-dismiss="true"
                                    class="btn ps-6 pe-7 btn-sm btn-myprimary-filled rounded-pill fs-4 d-none d-sm-inline-flex me-2 me-lg-0 gap-1 align-items-center"
                                >
                                    <i class="fs-3 ri-service-fill"></i>
                                    <span class="fw-bolder text-nowrap">Kolaborasi</span>
                                </a>
                                <button
                                    aria-label="Toggle menu navigasi"
                                    class="btn btn-icon btn-myicon w-40px h-40px d-flex d-lg-none"
                                    id="kt_landing_menu_toggle"
                                >
                                    <i class="ri-menu-line fs-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <slot />

            <div id="collaboration" class="container d-flex flex-column flex-center pt-20 mt-20">
                <div class="d-flex flex-column align-items-center w-100 mx-auto">
                    <div class="row g-6 w-100 mw-500px mw-md-800px">
                        <div class="col-12 col-md-6 px-0 px-md-5 px-lg-0">
                            <div class="d-flex flex-column flex-center flex-md-start">
                                <span style="font-weight: 800 !important; letter-spacing: 6%;" 
                                    class="text-uppercase text-center text-md-start fs-3 fw-bolder text-myprimary mb-6">
                                    Kolaborasi
                                </span>
                                <h2 style="font-weight: 800 !important;"
                                    class="text-dark text-center text-md-start lh-sm fw-bolder fs-3x mb-6 mb-md-8">
                                    Mari Bertumbuh <br> Bersama! 🚀
                                </h2>
                                <div class="d-flex gap-4 mb-10">
                                    <a v-if="setting.email" :href="`mailto:${setting.email}`" target="_blank" class="text-decoration-none">
                                        <i class="fs-2tx fs-lg-2qx text-myprimary ri-mail-fill"></i>
                                    </a>
                                    <a v-if="setting.instagram" :href="setting.instagram" target="_blank" class="text-decoration-none">
                                        <i class="fs-2tx fs-lg-2qx text-myprimary ri-instagram-line"></i>
                                    </a>
                                    <a v-if="setting.linkedin" :href="setting.linkedin" target="_blank" class="text-decoration-none">
                                        <i class="fs-2tx fs-lg-2qx text-myprimary ri-linkedin-box-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 px-0 px-md-5 px-lg-0">
                            <form @submit.prevent="submit" class="d-flex flex-column">
                                <div class="fv-row mb-6">
                                    <input type="text" v-model="form.name" autocomplete="off" class="form-control form-control-solid border border-gray-300 rounded-3 fs-5" 
                                        required placeholder="Nama Lengkap ..." />
                                    <span v-if="form.errors.name" class="text-mydanger mt-2">{{ form.errors.name }}</span>
                                </div>
                                <div class="fv-row mb-6">
                                    <input type="text" v-model="form.contact" autocomplete="off" class="form-control form-control-solid border border-gray-300 rounded-3 fs-5" 
                                        required placeholder="Alamat Email / No. WhatsApp ..." />
                                    <span v-if="form.errors.contact" class="text-mydanger mt-2">{{ form.errors.contact }}</span>
                                </div>
                                <div class="fv-row mb-10">
                                    <textarea v-model="form.message" autocomplete="off" class="form-control form-control-solid border border-gray-300 rounded-3 fs-5" data-kt-autosize="true" rows="5"
                                        required placeholder="Pesan Kolaborasi ..." ></textarea>
                                    <span v-if="form.errors.message" class="text-mydanger mt-2">{{ form.errors.message }}</span>
                                </div>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="btn ps-7 pe-6 btn-myprimary-filled justify-content-center rounded-pill fs-4 gap-1 align-items-center"
                                >
                                    <span class="fw-bolder text-nowrap">
                                        {{ form.processing ? 'Mengirim...' : 'Kirim Pesan' }}
                                    </span>
                                    <i class="ms-2 fs-3 ri-telegram-2-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <span class="fs-5 text-gray-500 text-center mt-20 mb-10">
                    © 2026 {{ setting.site_title }}  •  All Rights Reserved
                </span>
            </div>
        </div>
    </main>
</template>

<script>
    import { onMounted, onUpdated } from "vue";
    import { useForm, router } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';

    export default {
        props: {
            setting: Object,
            navBgClass: {
                type: String,
                default: 'bg-myprimary-light'
            }
        },

        setup() {
            onMounted(() => {
                window.KTMenu?.init(); 
            });

            onUpdated(() => {
                window.KTMenu?.init();
            });

            router.on('navigate', () => {
                window.KTMenu?.init();
            });

            const form = useForm({
                name: '',
                contact: '',
                message: '',
            });

            const submit = () => {
                form.post('/messages', {
                    preserveScroll: true, 
                    onSuccess: () => {
                        form.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Terkirim!',
                            text: 'Terima kasih! Pesan kolaborasi Anda berhasil dikirim.',
                            timer: 5000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                    },
                });
            };

            return { 
                form,
                submit 
            };
        }
    }
</script>

<style>

</style>
