<template>

    <Head>
        <title>Edit Buku − Admin {{ setting.site_title }}</title>
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
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/books" class="btn-link-myprimary fw-bolder pe-3">Daftar Buku</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Edit</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 fw-bolder text-dark">Edit Buku</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="row g-6">
                            <div class="col-md-4">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0 fw-bolder">Data Buku</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Judul</label>
                                            <textarea class="form-control rounded-3 fs-5" data-kt-autosize="true" rows="2"
                                                required placeholder="Masukkan judul disini..."
                                                v-model="form.title" :class="{ 'is-invalid': errors.title }">
                                            </textarea>
                                            <div v-if="errors.title" class="text-mydanger mt-2">
                                                {{ errors . title }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">ID Buku</label>
                                            <input type="text" class="form-control rounded-3 fs-5" v-model="form.id_book"
                                                required placeholder="Masukkan ID gdrive disini..."
                                                :class="{ 'is-invalid': errors.id_book }" />
                                            <div v-if="errors.id_book" class="text-mydanger mt-2">
                                                {{ errors . id_book }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Penulis</label>
                                            <input class="form-control rounded-3 fs-5" v-model="form.author" required
                                                placeholder="Masukkan penulis disini..." 
                                                :class="{ 'is-invalid': errors.author }" />
                                            <div v-if="errors.author" class="text-mydanger mt-2">
                                                {{ errors . author }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Tanggal Rilis</label>
                                            <input class="form-control rounded-3 fs-5" v-model="form.launch_date" required
                                                placeholder="Pilih tanggal rilis disini..." id="kt_datepicker_1"
                                                :class="{ 'is-invalid': errors.launch_date }" />
                                            <div v-if="errors.launch_date" class="text-mydanger mt-2">
                                                {{ errors . launch_date }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Jumlah Halaman</label>
                                            <div class="input-group fs-5">
                                                <input type="number" class="form-control rounded-3 rounded-end-0" v-model="form.total_pages" aria-describedby="basic-addon2"
                                                    required placeholder="Masukkan jumlah hal disini..." :class="{ 'is-invalid': errors.total_pages }"/>
                                                <span class="input-group-text rounded-3 rounded-start-0" id="basic-addon2">Halaman</span>
                                            </div>
                                            <div v-if="errors.total_pages" class="text-danger mt-2">
                                                {{ errors . total_pages }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="required fw-bolder mb-0">Sampul Buku</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div id="book-dropzone" class="dropzone border-dashed border-myprimary rounded-3 p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-2">Jatuhkan file di sini / klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-500">Maksimal 10 MB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.image" class="text-mydanger mt-2">
                                            {{ errors . image }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 border border-gray-300 mt-6">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="fw-bolder mb-0">Deskripsi Buku</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="fv-row">
                                            <textarea class="form-control rounded-3 fs-5" data-kt-autosize="true" rows="8"
                                                placeholder="Masukkan deskripsi disini..."
                                                v-model="form.description" :class="{ 'is-invalid': errors.description }">
                                            </textarea>
                                            <div v-if="errors.description" class="text-mydanger mt-2">
                                                {{ errors . description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <Link href="/admin/books" type="button" class="btn btn-sm btn-mytertiary-tinted rounded-3 fw-bolder fs-5 me-3">Batal</Link>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary-filled rounded-3 fw-bolder fs-5">
                                <span class="indicator-label">
                                    Edit Buku
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, onMounted, watch } from 'vue';
    import Swal from 'sweetalert2';
    import Dropzone from 'dropzone';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            setting: Object,
            errors: Object,
            book: Object,
        },

        setup(props) {
            const form = reactive({
                title: props.book.title,
                id_book: props.book.id_book,
                author: props.book.author,
                launch_date: props.book.launch_date,
                total_pages: props.book.total_pages,
                description: props.book.description ?? '',
                image: null,
            });

            onMounted(() => {
                flatpickr("#kt_datepicker_1", {
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    altInput: true,     
                    altFormat: "d / m / Y",
                    onChange: function(selectedDates, dateStr) {
                        form.launch_date = dateStr; 
                    }
                });

                const dz = new Dropzone('#book-dropzone', {
                    url: '/', 
                    paramName: 'image',
                    maxFiles: 1,
                    maxFilesize: 10,
                    acceptedFiles: 'image/jpeg,image/png',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Hapus',
                    init: function () {
                        this.on('addedfile', function (file) {
                            form.image = file;
                        });
                        this.on('removedfile', function () {
                            form.image = null;
                        });

                        if (props.book.image) {
                            const mockFile = {
                                name: props.book.image_name ?? 'Sampul Buku',
                                size: props.book.image_size ?? 12345
                            };
                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, `/storage/${props.book.image}`);
                            this.emit('complete', mockFile);
                            mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                        }
                    },
                });
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('title', form.title);
                payload.append('id_book', form.id_book);
                payload.append('author', form.author);
                payload.append('launch_date', form.launch_date);
                payload.append('total_pages', form.total_pages);
                payload.append('description', form.description);
                if (form.image && (form.image instanceof File || form.image instanceof Blob)) {
                    payload.append('image', form.image);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/books/${props.book.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Buku Berhasil Diperbarui!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                    },
                    onFinish: cleanup
                });
            }

            return {
                form,
                submit,
            };
        }
    }
</script>

<style>

</style>
