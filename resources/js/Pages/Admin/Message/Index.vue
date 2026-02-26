<template>

    <Head>
        <title>Pesan Masuk − Admin {{ setting.site_title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Pesan Masuk</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 fw-bolder text-dark">Pesan Masuk</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="card rounded-4 border border-gray-300">
                        <div class="d-flex flex-grow border-0 p-6 gap-4 flex-column flex-md-row">
                            <div class="flex-grow-1 ">
                                <form @submit.prevent="handleSearch"
                                    class="d-flex align-items-center position-relative my-1w-100 w-md-300px">
                                    <i class="ri-search-line position-absolute ms-5 fs-3"></i>
                                    <input type="text" class="form-control form-control-solid rounded-3 ps-13 fs-5"
                                        placeholder="Cari sesuatu disini..." v-model="search" />
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-gray-300 py-10 px-6" v-if="messages.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-3 fw-bolder">Pesan Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada pesan atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table table-hover align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#
                                            </th>
                                            <th class="bg-secondary min-w-250px" style="letter-spacing: 0.04em;">Dari / Oleh</th>
                                            <th class="bg-secondary min-w-300px" style="letter-spacing: 0.04em;">Pesan</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(message, index) in messages.data" :key="index"
                                            :class="[{ 'bg-myprimary-lightest': message.status === 'pending' }]">
                                            <td class="ps-6">
                                                {{ ++index + (messages . current_page - 1) * messages . per_page }}
                                            </td>
                                            <td class="d-flex align-items-center gap-3">
                                                <div class="symbol symbol-45px symbol-circle">
                                                    <div class="symbol-label fs-4 fw-bolder bg-myprimary text-white">{{ getInitials(message . name) }}</div>
                                                </div>
                                                <div>
                                                    <p class="text-dark text-truncate-1 fs-5 fw-bolder mb-0">{{ message . name }}</p>
                                                    <p class="fs-7 mb-0 text-truncate-1">{{ message . contact }}</p>
                                                </div>
                                            </td>
                                            <td class="mw-300px">
                                                <p class="text-truncate-2 mb-0">
                                                    {{ message . message }}
                                                </p>
                                            </td>
                                            <td class="text-end pe-6">
                                                <button @click="editMessage(message)"
                                                    class="btn btn-sm btn-icon btn-myprimary-tinted rounded-3 me-2">
                                                    <i class="ri-eye-fill fs-3"></i></button>
                                                <button @click.prevent="destroy(message.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger-tinted rounded-3">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination v-if="messages.data != 0"
                                :links="messages.links" align="end" class="py-5 px-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div id="kt_drawer_example_advanced" class="bg-body" style="overflow-x: hidden;" data-kt-drawer="true" data-kt-drawer-activate="true"
                data-kt-drawer-toggle="#kt_drawer_example_advanced_button"
                data-kt-drawer-close="#kt_drawer_example_advanced_close" data-kt-drawer-name="docs"
                data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'100%', 'md': '500px'}"
                data-kt-drawer-direction="end">
                <div class="card w-100 rounded-0">
                    <div class="card-header ps-6 pe-3 h-60px border-bottom border-gray-300 h-60px h-lg-70px">
                        <div class="card-title">
                            <h2 class="fw-bolder">Pesan Masuk</h2>
                        </div>
                        <div class="card-toolbar" id="kt_drawer_example_advanced_close">
                            <div class="btn btn-sm btn-icon btn-mytertiary-ghost rounded-pill">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light p-6 d-flex flex-column gap-7">
                        <div class="flex-grow-1">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder">Pemberi Pesan</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="symbol symbol-45px symbol-circle">
                                            <div class="symbol-label fs-4 fw-bolder bg-myprimary text-white">{{ getInitials (selectedMessage?.name) }}</div>
                                        </div>
                                        <div>
                                            <p class="text-dark fs-5 fw-bolder mb-0">{{ selectedMessage?.name }}</p>
                                            <p class="text-gray-600 fs-7 mb-0">{{ selectedMessage?.contact }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4 border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder">Detail Pesan</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <p class="fs-4 text-dark fw-bold mb-3">{{ selectedMessage?.message || form.message }}</p>
                                    <p class="fs-7 text-gray-600 mb-0">Dikirim pada {{ formatDate(selectedMessage?.created_at) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_drawer_submit_button"
                                class="btn btn-sm btn-myprimary-filled rounded-3 fw-bolder w-100 fs-5"
                                :disabled="selectedMessage?.status === 'complete'">
                                <span class="indicator-label">
                                    {{ selectedMessage?.status === 'complete' ? 'Sudah Selesai' : 'Tandai Selesai' }}
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import Pagination from '../../../Components/Pagination.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, ref, nextTick, watch } from 'vue';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Pagination
        },

        props: {
            setting: Object,
            errors: Object,
            messages: Object,
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/messages', {
                    q: search.value,
                });
            }

            const openDrawer = async () => {
                await nextTick();

                const drawerEl = document.querySelector('#kt_drawer_example_advanced');
                if (drawerEl && window.KTDrawer) {
                    const drawer = KTDrawer.getInstance(drawerEl) || new KTDrawer(drawerEl);
                    drawer.show();
                }
            };

            const form = reactive({
                message: '',
            });

            const selectedMessage = ref(null);  
            const isEditMode = ref(false);

            const formatDate = (iso) => {
                if (!iso) return '-';
                try {
                    const d = new Date(iso);
                    const opts = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                    return new Intl.DateTimeFormat('id-ID', opts).format(d);
                } catch {
                    return iso;
                }
            };

            const resetForm = () => {
                form.message = '';
                isEditMode.value = false;
                selectedMessage.value = null;

                const drawerCloseBtn = document.querySelector('#kt_drawer_example_advanced_close');
                if (drawerCloseBtn) drawerCloseBtn.click();
            };

            const submit = () => {
                const submitBtn = document.querySelector('#kt_drawer_submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                const payload = new FormData();
                payload.append('_method', 'PUT');
                payload.append('status', 'complete');

                router.post(`/admin/messages/${selectedMessage.value.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pesan berhasil ditandai selesai.',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            },
                        });
                        resetForm();
                    },
                    onError: () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tidak dapat menandai pesan. Coba lagi.',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            },
                        });
                    },
                    onFinish: cleanup,
                    preserveScroll: true,
                });
            };

            const editMessage = (message) => {
                isEditMode.value = true;
                selectedMessage.value = { ...message };
                form.message = message.message || '';
                openDrawer();
            };

            const destroy = (id) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    showCancelButton: true,
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    customClass: {
                        popup: 'swal-custom-icon',
                        confirmButton: "btn btn-sm btn-myprimary-filled rounded-3 fw-bolder",
                        cancelButton: "btn btn-sm btn-mydanger-tinted rounded-3 fw-bolder"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        router.delete(`/admin/messages/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Pesan Berhasil Dihapus!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            },
                        });
                    }
                });
            };

            const getInitials = (name) => {
                if (!name) return '';
                return name
                    .split(' ')               
                    .map(word => word[0])   
                    .join('') 
                    .substring(0, 2)              
                    .toUpperCase();          
            };

            return {
                search,
                handleSearch,
                form,
                submit,
                destroy,
                resetForm,
                editMessage,
                getInitials,
                isEditMode,
                openDrawer,
                selectedMessage,
                formatDate,
            };
        }
    }
</script>

<style>

</style>
