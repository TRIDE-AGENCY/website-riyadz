<template>
    <Head>
        <title>{{ book.title }} − {{ setting.site_title }}</title>
        <meta name="description" :content="description" />

        <meta property="og:type" content="book" />
        <meta property="og:url" :content="current_url" />
        <meta property="og:title" :content="book.title" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="`${app_url}/storage/${book.image}`" />

        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" :content="current_url" />
        <meta property="twitter:title" :content="book.title" />
        <meta property="twitter:description" :content="description" />
        <meta property="twitter:image" :content="`${app_url}/storage/${book.image}`" />
    </Head>

    <LayoutUser :setting="setting" 
        navBgClass="bg-white">
        
        <div class="container d-flex flex-column flex-center pt-md-10 mt-20">
            <div class="w-100">
                
                <div class="mw-800px mx-auto mb-7 d-flex justify-content-start">
                    <a href="/books" class="ms-n1 text-gray-500 d-flex align-items-center gap-2 fw-semibold fs-5 transition-hover text-decoration-none">
                        <i class="ri-arrow-left-line fs-3 text-gray-500"></i>
                        Kembali ke Daftar Buku
                    </a>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-10 mw-800px mx-auto">
                    <div class="d-flex flex-column flex-fill order-sm-1">
                        <div class="mb-10 text-start">
                            <h1 style="font-weight: 800 !important;" class="text-dark lh-sm fw-bolder fs-3x mb-5">
                                {{ book.title }}
                            </h1>
                            <div class="d-flex flex-wrap align-items-center justify-content-start text-gray-600 fs-5 gap-4">
                                <span class="d-flex align-items-center gap-2 fw-semibold fs-5">
                                    <i class="ri-user-line fs-5 text-gray-600"></i> 
                                    {{ book.author }}
                                </span>
                                <span class="bullet bullet-dot bg-gray-500 h-5px w-5px"></span>
                                <span class="d-flex align-items-center gap-2 fw-semibold fs-5">
                                    <i class="ri-article-line fs-5 text-gray-600"></i> 
                                    {{ book.total_pages }} Hal ({{ getYear(book.launch_date) }})
                                </span>
                            </div>
                        </div>

                        <div class="text-start">
                            <h3 class="fw-bolder text-dark mb-4 fs-2">Sinopsis / Deskripsi</h3>
                            <p class="text-gray-600 fs-5 lh-lg mb-0 book-description">
                                {{ book.description || 'Tidak ada deskripsi untuk buku ini.' }}
                            </p>
                        </div>
                    </div>
                    <div class="position-sticky w-100 mw-sm-225px order-sm-0 mw-md-250px flex-shrink-0 align-self-start" style="top: 105px;">
                        <img
                            :src="`/storage/${book.image}`"
                            :alt="book.title"
                            class="img-fluid w-100 rounded-3 object-fit-cover"
                        />
                        <a :href="gdriveLink" target="_blank" class="btn ps-7 pe-6 btn-myprimary-filled w-100 rounded-pill fs-4 mt-6 d-flex align-items-center justify-content-center gap-2">
                            <span class="fw-bolder">Baca Layar Penuh</span>
                            <i class="fs-3 ri-external-link-line"></i>
                        </a>
                    </div>
                </div>
                
                <div v-if="book.id_book" class="mw-1000px mx-auto my-14">
                    <div class="w-100 rounded-4 overflow-hidden border border-gray-300 bg-light h-800px">
                        <iframe 
                            :src="gdriveEmbedLink" 
                            width="100%" 
                            height="100%" 
                            allow="autoplay" 
                            title="Preview Buku"
                            frameborder="0"
                        ></iframe>
                    </div>
                    <p class="text-gray-500 fs-6 mt-6 mb-0 text-center">
                        <i class="me-1 ri-information-line"></i> Jika preview tidak muncul, silakan gunakan tombol <strong class="text-gray-600">"Baca Layar Penuh"</strong> di bagian atas.
                    </p>
                </div>

                <div class="mw-800px mx-auto border border-gray-300 p-8 d-flex flex-column flex-sm-row align-items-center justify-content-between gap-6 bg-light rounded-4">
                    <div class="d-flex flex-column text-center text-sm-start">
                        <span class="fw-bolder fs-3 text-dark mb-1">Bagikan Buku Ini</span>
                        <span class="fs-5 text-gray-600">Rekomendasikan buku ini ke jaringan Anda.</span>
                    </div>
                    <div class="d-flex gap-3">
                        <a :href="whatsappLink" target="_blank" class="btn btn-icon btn-myprimary-tinted rounded-circle share-btn" title="Bagikan ke WhatsApp">
                            <i class="ri-whatsapp-fill fs-1"></i>
                        </a>
                        <a :href="twitterLink" target="_blank" class="btn btn-icon btn-myprimary-tinted rounded-circle share-btn" title="Bagikan ke X">
                            <i class="ri-twitter-x-fill fs-2"></i>
                        </a>
                        <a :href="facebookLink" target="_blank" class="btn btn-icon btn-myprimary-tinted rounded-circle share-btn" title="Bagikan ke Facebook">
                            <i class="ri-facebook-circle-fill fs-1"></i>
                        </a>
                        <button @click="copyLink" class="btn btn-icon btn-myprimary-tinted rounded-circle share-btn" title="Salin Tautan">
                            <i class="ri-links-line fs-2 text-dark"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </LayoutUser>
</template>

<script>
    import { Head, Link } from '@inertiajs/vue3'; 
    import LayoutUser from '../../../Layouts/User.vue';
    import Swal from 'sweetalert2';
    import { computed } from 'vue';

    export default {
        components: {
            Head,
            Link, 
            LayoutUser,
        },

        props: {
            setting: Object,
            book: Object,
            description: String,
            current_url: String,
            app_url: String,
        },

        setup(props) {
            const getYear = (dateString) => {
                if (!dateString) return '-';
                return new Date(dateString).getFullYear();
            };

            // Link Google Drive untuk buka di tab baru
            const gdriveLink = computed(() => {
                return props.book.id_book 
                    ? `https://drive.google.com/file/d/${props.book.id_book}/view` 
                    : '#';
            });

            // Link Embed Google Drive untuk Iframe (perhatikan penggunaan /preview)
            const gdriveEmbedLink = computed(() => {
                return props.book.id_book 
                    ? `https://drive.google.com/file/d/${props.book.id_book}/preview` 
                    : null;
            });

            // SHARE LINKS
            const encodedUrl = computed(() => encodeURIComponent(props.current_url));
            const encodedTitle = computed(() => encodeURIComponent(`Buku: ${props.book.title} oleh ${props.book.author}`));

            const whatsappLink = computed(() => `https://api.whatsapp.com/send?text=${encodedTitle.value}%0A${encodedUrl.value}`);
            const twitterLink = computed(() => `https://twitter.com/intent/tweet?url=${encodedUrl.value}&text=${encodedTitle.value}`);
            const facebookLink = computed(() => `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl.value}`);

            const copyLink = async () => {
                try {
                    await navigator.clipboard.writeText(props.current_url);
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersalin!',
                        text: 'Tautan berhasil disalin ke papan klip.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: { popup: 'swal-custom-icon' },
                    });
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyalin!',
                        text: err,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: { popup: 'swal-custom-icon' },
                    });
                }
            };

            return { 
                getYear,
                gdriveLink,
                gdriveEmbedLink,
                whatsappLink,
                twitterLink,
                facebookLink,
                copyLink
            };
        }
    }
</script>

<style>
    .transition-hover {
        transition: color 0.3s ease, transform 0.3s ease;
    }
    
    .transition-hover:hover {
        transform: translateX(-5px);
    }

    .book-description {
        white-space: pre-line;
    }

    .share-btn {
        transition: transform 0.3s ease;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
</style>