<template>
    <Head>
        <title>{{ blog.title }} − {{ setting.site_title }}</title>
        <meta name="description" :content="description" />

        <meta property="og:type" content="article" />
        <meta property="og:url" :content="current_url" />
        <meta property="og:title" :content="blog.title" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="`${app_url}/storage/${blog.image}`" />

        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" :content="current_url" />
        <meta property="twitter:title" :content="blog.title" />
        <meta property="twitter:description" :content="description" />
        <meta property="twitter:image" :content="`${app_url}/storage/${blog.image}`" />
    </Head>

    <LayoutUser :setting="setting" 
        navBgClass="bg-white">
        
        <div class="container d-flex flex-column flex-center pt-md-10 mt-20">
            <div class="w-100">
                
                <div class="mw-800px mx-auto mb-7 d-flex justify-content-start">
                    <a href="/blogs" class="ms-n1 text-gray-500 d-flex align-items-center gap-2 fw-semibold fs-5 transition-hover text-decoration-none">
                        <i class="ri-arrow-left-line fs-3 text-gray-500"></i>
                        Kembali ke Daftar Blog
                    </a>
                </div>

                <div class="mw-800px mx-auto mb-10 text-start">
                    <h1 style="font-weight: 800 !important;" class="text-dark lh-sm fw-bolder fs-3x mb-5">
                        {{ blog.title }}
                    </h1>
                    <div class="d-flex align-items-center justify-content-start text-gray-600 fs-5 gap-4">
                        <span class="d-flex align-items-center gap-2 fw-semibold fs-5">
                            <i class="ri-calendar-line fs-5 text-gray-600"></i> 
                            {{ formatDate(blog.created_at) }}
                        </span>
                        <span class="bullet bullet-dot bg-gray-500 h-5px w-5px"></span>
                        <span class="d-flex align-items-center gap-2 fw-semibold fs-5">
                            <i class="ri-time-line fs-5 text-gray-600"></i> 
                            {{ readingTime }}
                        </span>
                    </div>
                </div>

                <div class="w-100 mw-1000px mx-auto overflow-hidden border border-gray-300 rounded-4 mb-14 ratio ratio-4x3 position-relative">
                    <img
                        :src="`/storage/${blog.image}`"
                        :alt="blog.title"
                        class="img-fluid object-fit-cover"
                    />
                </div>

                <article class="mw-800px mx-auto blog-content text-gray-800 fs-4 lh-lg mb-14" v-html="blog.content"></article>

                <div class="mw-800px mx-auto border border-gray-300 p-8 d-flex flex-column flex-sm-row align-items-center justify-content-between gap-6 bg-light rounded-4">
                    <div class="d-flex flex-column text-center text-sm-start">
                        <span class="fw-bolder fs-3 text-dark mb-1">Bagikan Blog Ini</span>
                        <span class="fs-5 text-gray-600">Teruskan inspirasi ini ke jaringan Anda.</span>
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
            blog: Object,
            description: String,
            current_url: String,
            app_url: String,
        },

        setup(props) {
            const formatDate = (dateString) => {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            };

            const readingTime = computed(() => {
                if (!props.blog || !props.blog.content) return '1 menit baca';

                const plainText = props.blog.content.replace(/<[^>]+>/g, '');
                const wordCount = plainText.trim().split(/\s+/).length;
                const wordsPerMinute = 200;
                const minutes = Math.ceil(wordCount / wordsPerMinute);
                
                return `${minutes} menit baca`;
            });
            
            const encodedUrl = computed(() => encodeURIComponent(props.current_url));
            const encodedTitle = computed(() => encodeURIComponent(props.blog.title));

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
                        customClass: {
                            popup: 'swal-custom-icon',
                        },
                    });
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyalin!',
                        text: err,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                        },
                    });
                }
            };

            return { 
                formatDate, 
                readingTime,
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

    .blog-content {
        line-height: 1.8;
        font-size: 1.15rem; 
    }

    .blog-content h2, 
    .blog-content h3, 
    .blog-content h4 {
        font-weight: 800;
        color: #181C32; 
        margin-top: 1.8em;
        margin-bottom: 0.8em;
        line-height: 1.4;
    }

    .blog-content h2 {
        font-size: 2rem; 
    }

    .blog-content h3 {
        font-size: 1.65rem;
    }

    .blog-content h4 {
        font-size: 1.35rem; 
    }

    .blog-content p {
        margin-bottom: 1.5em;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 2rem 0;
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.05);
    }

    .blog-content blockquote {
        font-style: italic;
        color: var(--bs-gray-700);
        border-left: 4px solid var(--base-color-600);
        padding-left: 1.5rem;
        margin: 2rem 0;
        background: var(--bs-gray-100);
        padding: 1.5rem;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .blog-content a {
        color: var(--base-color-600);
        text-decoration: none;
        font-weight: 700;
    }

    .blog-content a:hover {
        text-decoration-color: var(--base-color-600);
    }

    .blog-content ul, 
    .blog-content ol {
        margin-bottom: 1.5em;
        padding-left: 2rem;
    }

    .blog-content li {
        margin-bottom: 0.5em;
    }

    .share-btn {
        transition: transform 0.3s ease;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
</style>