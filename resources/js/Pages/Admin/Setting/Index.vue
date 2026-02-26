<template>

    <Head>
        <title>Pengaturan − Admin {{ setting.site_title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/dashboard" class="btn-link-myprimary fw-bolder pe-3">Dashboard</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Pengaturan</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 fw-bolder text-dark">Pengaturan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="card rounded-4 border border-gray-300">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div
                                        class="card-header p-6 d-flex flex-column m-0 border-0"
                                        style="min-height: unset"
                                    >
                                        <h3 class="mb-0 fw-bolder">Informasi Umum</h3>
                                        <p
                                            class="fs-5 d-none d-md-block text-gray-500 mt-3 mb-0 fw-normal"
                                        >
                                            Mengelola data dasar dan identitas
                                            situs
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="d-md-none border-bottom border-gray-300"
                                ></div>
                                <div
                                    class="col-12 col-md-8 col-xl-9 card-body p-6"
                                >
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >Nama Website</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.site_title"
                                            required
                                            placeholder="Masukkan nama disini..."
                                            :class="{
                                                'is-invalid': errors.site_title,
                                            }"
                                        />
                                        <div
                                            v-if="errors.site_title"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.site_title }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >Link Website</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.site_url"
                                            required
                                            placeholder="Masukkan link disini..."
                                            :class="{
                                                'is-invalid': errors.site_url,
                                            }"
                                        />
                                        <div
                                            v-if="errors.site_url"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.site_url }}
                                        </div>
                                    </div>
                                    <div class="mb-5 row g-5">
                                        <div class="col-12 col-xl-6 fv-row">
                                            <label
                                                class="required form-label fs-6"
                                                >Logo</label
                                            >
                                            <div
                                                id="logo-dropzone"
                                                :key="dropzoneKey"
                                                class="dropzone border-dashed border-myprimary rounded-3 p-5 text-center"
                                            >
                                                <div
                                                    class="dz-message needsclick flex-column text-center gap-5 p-5"
                                                >
                                                    <i
                                                        class="ri-image-add-line text-myprimary fs-3x"
                                                    ></i>
                                                    <div>
                                                        <h3
                                                            class="fs-5 fw-bolder text-gray-900 mb-2"
                                                        >
                                                            Jatuhkan file di
                                                            sini / klik untuk
                                                            mengunggah.
                                                        </h3>
                                                        <span
                                                            class="fs-7 fw-semibold text-gray-500"
                                                            >Maksimal 10
                                                            MB</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                v-if="errors.site_logo"
                                                class="text-mydanger mt-2"
                                            >
                                                {{ errors.site_logo }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 fv-row">
                                            <label
                                                class="required form-label fs-6"
                                                >Favicon</label
                                            >
                                            <div
                                                id="favicon-dropzone"
                                                :key="dropzoneKey"
                                                class="dropzone border-dashed border-myprimary rounded-3 p-5 text-center"
                                            >
                                                <div
                                                    class="dz-message needsclick flex-column text-center gap-5 p-5"
                                                >
                                                    <i
                                                        class="ri-image-add-line text-myprimary fs-3x"
                                                    ></i>
                                                    <div>
                                                        <h3
                                                            class="fs-5 fw-bolder text-gray-900 mb-2"
                                                        >
                                                            Jatuhkan file di
                                                            sini / klik untuk
                                                            mengunggah.
                                                        </h3>
                                                        <span
                                                            class="fs-7 fw-semibold text-gray-500"
                                                            >Maks. 10 MB • Rasio
                                                            1:1</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                v-if="errors.site_favicon"
                                                class="text-mydanger mt-2"
                                            >
                                                {{ errors.site_favicon }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset">
                                        <h3 class="mb-0 fw-bolder">Sosial Media</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-500 mt-3 mb-0 fw-normal">
                                            Mengatur tautan kontak dan sosial media
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Alamat Email</label>
                                        <input
                                            type="email"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.email"
                                            required
                                            placeholder="Masukkan alamat email disini..."
                                            :class="{ 'is-invalid': errors.email }"
                                        />
                                        <div v-if="errors.email" class="text-mydanger mt-2">
                                            {{ errors.email }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Instagram</label>
                                        <input
                                            type="url"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.instagram"
                                            required
                                            placeholder="Masukkan link instagram disini..."
                                            :class="{ 'is-invalid': errors.instagram }"
                                        />
                                        <div v-if="errors.instagram" class="text-mydanger mt-2">
                                            {{ errors.instagram }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">LinkedIn</label>
                                        <input
                                            type="url"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.linkedin"
                                            required
                                            placeholder="Masukkan link linkedin disini..."
                                            :class="{ 'is-invalid': errors.linkedin }"
                                        />
                                        <div v-if="errors.linkedin" class="text-mydanger mt-2">
                                            {{ errors.linkedin }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div
                                        class="card-header p-6 d-flex flex-column m-0 border-0"
                                        style="min-height: unset"
                                    >
                                        <h3 class="mb-0 fw-bolder">SEO</h3>
                                        <p
                                            class="fs-5 d-none d-md-block text-gray-500 mt-3 mb-0 fw-normal"
                                        >
                                            Mengatur informasi SEO untuk halaman
                                            ini
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="d-md-none border-bottom border-gray-300"
                                ></div>
                                <div
                                    class="col-12 col-md-8 col-xl-9 card-body p-6"
                                >
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >Judul</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.meta_title"
                                            required
                                            placeholder="Masukkan judul disini..."
                                            :class="{
                                                'is-invalid': errors.meta_title,
                                            }"
                                        />
                                        <div
                                            v-if="errors.meta_title"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.meta_title }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >Deskripsi</label
                                        >
                                        <textarea
                                            class="form-control rounded-3 fs-5"
                                            data-kt-autosize="true"
                                            rows="3"
                                            required
                                            placeholder="Masukkan deskripsi disini..."
                                            v-model="form.meta_description"
                                            :class="{
                                                'is-invalid':
                                                    errors.meta_description,
                                            }"
                                        >
                                        </textarea>
                                        <div
                                            v-if="errors.meta_description"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.meta_description }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6"
                                            >Kata Kunci</label
                                        >
                                        <textarea
                                            class="form-control rounded-3 fs-5"
                                            data-kt-autosize="true"
                                            rows="2"
                                            required
                                            placeholder="Masukkan kata kunci disini..."
                                            v-model="form.meta_keywords"
                                            :class="{
                                                'is-invalid':
                                                    errors.meta_keywords,
                                            }"
                                        >
                                        </textarea>
                                        <div
                                            v-if="errors.meta_keywords"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.meta_keywords }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div
                                        class="card-header p-6 d-flex flex-column m-0 border-0"
                                        style="min-height: unset"
                                    >
                                        <h3 class="mb-0 fw-bolder">Open Graph</h3>
                                        <p
                                            class="fs-5 d-none d-md-block text-gray-500 mt-3 mb-0 fw-normal"
                                        >
                                            Mengatur metadata untuk berbagi di
                                            sosial media
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="d-md-none border-bottom border-gray-300"
                                ></div>
                                <div
                                    class="col-12 col-md-8 col-xl-9 card-body p-6"
                                >
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >Judul</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.og_title"
                                            required
                                            placeholder="Masukkan judul disini..."
                                            :class="{
                                                'is-invalid': errors.og_title,
                                            }"
                                        />
                                        <div
                                            v-if="errors.og_title"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.og_title }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >Deskripsi</label
                                        >
                                        <textarea
                                            class="form-control rounded-3 fs-5"
                                            data-kt-autosize="true"
                                            rows="3"
                                            required
                                            placeholder="Masukkan deskripsi disini..."
                                            v-model="form.og_description"
                                            :class="{
                                                'is-invalid':
                                                    errors.og_description,
                                            }"
                                        >
                                        </textarea>
                                        <div
                                            v-if="errors.og_description"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.og_description }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6"
                                            >Gambar</label
                                        >
                                        <div
                                            id="image-dropzone"
                                            :key="dropzoneKey"
                                            class="dropzone border-dashed border-myprimary rounded-3 p-5 text-center"
                                        >
                                            <div
                                                class="dz-message needsclick flex-column text-center gap-5 p-5"
                                            >
                                                <i
                                                    class="ri-image-add-line text-myprimary fs-3x"
                                                ></i>
                                                <div>
                                                    <h3
                                                        class="fs-5 fw-bolder text-gray-900 mb-2"
                                                    >
                                                        Jatuhkan file di sini /
                                                        klik untuk mengunggah.
                                                    </h3>
                                                    <span
                                                        class="fs-7 fw-semibold text-gray-500"
                                                        >Maksimal 10 MB</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            v-if="errors.og_image"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.og_image }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div
                                        class="card-header p-6 d-flex flex-column m-0 border-0"
                                        style="min-height: unset"
                                    >
                                        <h3 class="mb-0 fw-bolder">Konfigurasi</h3>
                                        <p
                                            class="fs-5 d-none d-md-block text-gray-500 mt-3 mb-0 fw-normal"
                                        >
                                            Mengatur integrasi layanan pihak
                                            ketiga yang digunakan.
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="d-md-none border-bottom border-gray-300"
                                ></div>
                                <div
                                    class="col-12 col-md-8 col-xl-9 card-body p-6"
                                >
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6"
                                            >API Key TinyMCE</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.api_tinymce_key"
                                            required
                                            placeholder="Masukkan key disini..."
                                            :class="{
                                                'is-invalid':
                                                    errors.api_tinymce_key,
                                            }"
                                        />
                                        <div
                                            v-if="errors.api_tinymce_key"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.api_tinymce_key }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6"
                                            >GA Property ID</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.ga_property_id"
                                            placeholder="Masukkan id disini..."
                                            :class="{
                                                'is-invalid':
                                                    errors.ga_property_id,
                                            }"
                                        />
                                        <div
                                            v-if="errors.ga_property_id"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.ga_property_id }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="form-label fs-6"
                                            >GA Measurement ID</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-3 fs-5"
                                            v-model="form.ga_measurement_id"
                                            placeholder="Masukkan id disini..."
                                            :class="{
                                                'is-invalid':
                                                    errors.ga_measurement_id,
                                            }"
                                        />
                                        <div
                                            v-if="errors.ga_measurement_id"
                                            class="text-mydanger mt-2"
                                        >
                                            {{ errors.ga_measurement_id }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <button
                                type="submit"
                                id="submit_button"
                                class="btn btn-sm btn-myprimary-filled rounded-3 fw-bolder fs-5"
                            >
                                <span class="indicator-label">
                                    Simpan Perubahan
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu...
                                    <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"
                                    ></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import { Head, Link, router, usePage } from "@inertiajs/vue3";
    import { reactive, ref, onMounted, nextTick } from "vue";
    import Dropzone from "dropzone";
    import Swal from "sweetalert2";

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            errors: Object,
            setting: Object,
        },

        setup(props) {
            const dropzoneImage = ref(null);
            const dropzoneFavicon = ref(null);
            const dropzoneOgImage = ref(null);
            const dropzoneKey = ref(Date.now());
            const originalImage = ref(props.setting.site_logo ?? null);
            const originalFavicon = ref(props.setting.site_favicon ?? null);
            const originalOgImage = ref(props.setting.og_image ?? null);

            const imageFile = ref(null);
            const faviconFile = ref(null);
            const ogImageFile = ref(null);

            const form = reactive({
                site_title: props.setting.site_title,
                site_url: props.setting.site_url,
                site_logo: props.setting.site_logo,
                site_favicon: props.setting.site_favicon,
                email: props.setting.email,   
                instagram: props.setting.instagram, 
                linkedin: props.setting.linkedin,
                meta_title: props.setting.meta_title,
                meta_description: props.setting.meta_description,
                meta_keywords: props.setting.meta_keywords,
                og_title: props.setting.og_title,
                og_description: props.setting.og_description,
                og_image: props.setting.og_image,
                api_tinymce_key: props.setting.api_tinymce_key,
                ga_property_id: props.setting.ga_property_id ?? '',
                ga_measurement_id: props.setting.ga_measurement_id ?? '',
            });

            onMounted(() => {
                nextTick(() => {
                    dropzoneImage.value = new Dropzone("#logo-dropzone", {
                        url: "/",
                        maxFiles: 1,
                        maxFilesize: 10,
                        acceptedFiles: "image/jpeg,image/png",
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictRemoveFile: "Hapus",
                        init: function () {
                            if (originalImage.value) {
                                const mockFile = {
                                    name: originalImage.value.split("/").pop(),
                                    size: 12345,
                                };

                                let imageUrl = originalImage.value;
                                if (!imageUrl.startsWith("/storage/") && !imageUrl.startsWith("http")) {
                                    imageUrl = `/storage/${imageUrl}`;
                                }

                                this.emit("addedfile", mockFile);
                                this.emit("thumbnail", mockFile, imageUrl);
                                this.emit("complete", mockFile);
                                mockFile.previewElement.classList.add("dz-success", "dz-complete");
                            }

                            this.on("addedfile", (file) => {
                                imageFile.value = file;
                                if (this.files.length > 1) {
                                    this.removeFile(this.files[0]);
                                }
                            });

                            this.on("removedfile", () => {
                                imageFile.value = null;
                            });
                        },
                    });

                    dropzoneFavicon.value = new Dropzone("#favicon-dropzone", {
                        url: "/",
                        maxFiles: 1,
                        maxFilesize: 10,
                        acceptedFiles: "image/jpeg,image/png",
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictRemoveFile: "Hapus",
                        init: function () {
                            if (originalFavicon.value) { 
                                const mockFile = {
                                    name: originalFavicon.value.split("/").pop(),
                                    size: 12345,
                                };

                                let imageUrl = originalFavicon.value;
                                if (!imageUrl.startsWith("/storage/") && !imageUrl.startsWith("http")) {
                                    imageUrl = `/storage/${imageUrl}`;
                                }

                                this.emit("addedfile", mockFile);
                                this.emit("thumbnail", mockFile, imageUrl);
                                this.emit("complete", mockFile);
                                mockFile.previewElement.classList.add("dz-success", "dz-complete");
                            }

                            this.on("addedfile", (file) => {
                                faviconFile.value = file;
                                if (this.files.length > 1) {
                                    this.removeFile(this.files[0]);
                                }
                            });

                            this.on("removedfile", () => {
                                faviconFile.value = null;
                            });
                        },
                    });

                    dropzoneOgImage.value = new Dropzone("#image-dropzone", {
                        url: "/",
                        maxFiles: 1,
                        maxFilesize: 10,
                        acceptedFiles: "image/jpeg,image/png",
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictRemoveFile: "Hapus",
                        init: function () {
                            if (originalOgImage.value) {
                                const mockFile = {
                                    name: originalOgImage.value.split("/").pop(),
                                    size: 12345,
                                };

                                let imageUrl = originalOgImage.value;
                                if (!imageUrl.startsWith("/storage/") && !imageUrl.startsWith("http")) {
                                    imageUrl = `/storage/${imageUrl}`;
                                }

                                this.emit("addedfile", mockFile);
                                this.emit("thumbnail", mockFile, imageUrl);
                                this.emit("complete", mockFile);
                                mockFile.previewElement.classList.add("dz-success", "dz-complete");
                            }

                            this.on("addedfile", (file) => {
                                ogImageFile.value = file;
                                if (this.files.length > 1) {
                                    this.removeFile(this.files[0]);
                                }
                            });

                            this.on("removedfile", () => {
                                ogImageFile.value = null;
                            });
                        },
                    });
                });
            });

            const submit = () => {
                const submitBtn = document.querySelector("#submit_button");
                if (submitBtn) {
                    submitBtn.setAttribute("data-kt-indicator", "on");
                    submitBtn.setAttribute("disabled", true);
                }

                const payload = new FormData();
                payload.append("_method", "PUT");

                payload.append("site_title", form.site_title);
                payload.append("site_url", form.site_url);
                payload.append("email", form.email);          
                payload.append("instagram", form.instagram);  
                payload.append("linkedin", form.linkedin);
                payload.append("meta_title", form.meta_title);
                payload.append("meta_description", form.meta_description);
                payload.append("meta_keywords", form.meta_keywords);
                payload.append("og_title", form.og_title);
                payload.append("og_description", form.og_description);
                payload.append("api_tinymce_key", form.api_tinymce_key);
                payload.append("ga_property_id", form.ga_property_id);
                payload.append("ga_measurement_id", form.ga_measurement_id);

                if (imageFile.value instanceof File) {
                    payload.append("site_logo", imageFile.value);
                } else {
                    payload.append("site_logo_old", originalImage.value);
                }

                if (faviconFile.value instanceof File) {
                    payload.append("site_favicon", faviconFile.value);
                } else {
                    payload.append("site_favicon_old", originalFavicon.value);
                }

                if (ogImageFile.value instanceof File) {
                    payload.append("og_image", ogImageFile.value);
                } else {
                    payload.append("og_image_old", originalOgImage.value);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute("data-kt-indicator");
                        submitBtn.removeAttribute("disabled");
                    }
                };

                router.post(`/admin/settings`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: "Pengaturan Berhasil Diperbarui!",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: "swal-custom-icon",
                            },
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    onFinish: cleanup,
                });
            };

            return {
                form,
                submit,
                dropzoneKey,
            };
        },
    };
</script>

<style>

</style>
