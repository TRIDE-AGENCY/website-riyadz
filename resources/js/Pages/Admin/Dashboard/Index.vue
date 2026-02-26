<template>

    <Head>
        <title>Dashboard − Admin {{ setting.site_title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div
                        class="page-title d-flex justify-content-between flex-column gap-6 flex-sm-row w-100"
                    >
                        <div class="flex-fill">
                            <h1 class="page-heading d-flex text-dark fw-bolder flex-column justify-content-center my-0 mb-2">
                                Selamat Datang {{ $page . props . auth . user . name }}
                            </h1>
                            <p class="fs-4 text-gray-600 m-0">Kelola website landing page <a target="_blank" :href="setting.site_url" class="btn-link-myprimary fw-bolder text-myprimary">{{ setting.site_url }}</a></p>
                        </div>
                        <div
                            class="dropdown-center d-flex gap-4 align-self-end w-100 w-sm-auto"
                        >
                            <button
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                class="dropdown-toggle w-100 fw-bolder rounded-3 btn btn-sm btn-myprimary-tinted fs-5 d-flex align-items-center justify-content-center gap-2 pe-5 text-nowrap"
                            >
                                <span>{{ rangeLabel[activeRange] }}</span>
                            </button>
                            <ul class="dropdown-menu mt-2 fs-5 p-2 rounded-3 shadow-none border border-gray-300">
                                <li>
                                    <a
                                        class="fw-bolder mb-1 btn-myprimary-light px-6 py-3 rounded dropdown-item"
                                        :class="{
                                            active: activeRange === 'weekly',
                                        }"
                                        href="#"
                                        @click.prevent="changeRange('weekly')"
                                        >Minggu ini</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="fw-bolder mb-1 btn-myprimary-light px-6 py-3 rounded dropdown-item"
                                        :class="{
                                            active: activeRange === 'monthly',
                                        }"
                                        href="#"
                                        @click.prevent="changeRange('monthly')"
                                        >Bulan ini</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="fw-bolder btn-myprimary-light px-6 py-3 rounded dropdown-item"
                                        :class="{
                                            active: activeRange === 'yearly',
                                        }"
                                        href="#"
                                        @click.prevent="changeRange('yearly')"
                                        >Tahun ini</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="row g-6">
                        <div class="col-12 col-sm-6 col-xxl-3">
                            <div
                                class="card rounded-4 border border-gray-300 h-100"
                            >
                                <div
                                    class="card-body d-flex flex-column p-6 gap-3 justify-content-between"
                                >
                                    <div
                                        class="d-flex flex-grow align-items-start gap-5"
                                    >
                                        <div
                                            class="d-flex flex-column flex-grow-1"
                                        >
                                            <p
                                                class="fs-5 fw-bolder text-dark mb-2 text-truncate-1 white-space-nowrap"
                                            >
                                                Pesan Masuk
                                            </p>
                                            <h1
                                                class="fs-3qx fs-md-2x fw-bolder mb-0"
                                            >
                                                0
                                            </h1>
                                        </div>
                                        <div
                                            class="p-5 bg-myprimary rounded d-flex align-items-center justify-content-center"
                                        >
                                            <i
                                                class="ri-chat-history-fill text-white fs-3qx fs-md-2x"
                                            ></i>
                                        </div>
                                    </div>
                                    <p
                                        class="fs-7 text-gray-500 mb-0 text-truncate-1 white-space-nowrap"
                                    >
                                        Perlu Ditinjau
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xxl-3">
                            <div
                                class="card rounded-4 border border-gray-300 h-100"
                            >
                                <div
                                    class="card-body d-flex flex-column p-6 gap-3 justify-content-between"
                                >
                                    <div
                                        class="d-flex flex-grow align-items-start gap-5"
                                    >
                                        <div
                                            class="d-flex flex-column flex-grow-1"
                                        >
                                            <p
                                                class="fs-5 fw-bolder text-dark mb-2 text-truncate-1 white-space-nowrap"
                                            >
                                                Total Pengunjung
                                            </p>
                                            <h1
                                                class="fs-3qx fs-md-2x fw-bolder mb-0"
                                            >
                                                {{
                                                    total_visits.toLocaleString(
                                                        "id-ID"
                                                    )
                                                }}
                                            </h1>
                                        </div>
                                        <div
                                            class="p-5 bg-myprimary-light rounded d-flex align-items-center justify-content-center"
                                        >
                                            <i
                                                class="ri-team-fill text-myprimary fs-3qx fs-md-2x"
                                            ></i>
                                        </div>
                                    </div>
                                    <p
                                        class="fs-7 text-gray-500 mb-0 text-truncate-1 white-space-nowrap"
                                    >
                                        Pada Hal. Utama
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xxl-3">
                            <div
                                class="card rounded-4 border border-gray-300 h-100"
                            >
                                <div
                                    class="card-body d-flex flex-column p-6 gap-3 justify-content-between"
                                >
                                    <div
                                        class="d-flex flex-grow align-items-start gap-5"
                                    >
                                        <div
                                            class="d-flex flex-column flex-grow-1"
                                        >
                                            <p
                                                class="fs-5 fw-bolder text-dark mb-2 text-truncate-1 white-space-nowrap"
                                            >
                                                Rata-Rata Durasi
                                            </p>
                                            <h1
                                                class="fs-3qx fs-md-2x fw-bolder mb-0"
                                            >
                                                {{ avg_session_duration }}
                                            </h1>
                                        </div>
                                        <div
                                            class="p-5 bg-mywarning-light rounded d-flex align-items-center justify-content-center"
                                        >
                                            <i
                                                class="ri-timer-flash-fill text-mywarning fs-3qx fs-md-2x"
                                            ></i>
                                        </div>
                                    </div>
                                    <p
                                        class="fs-7 text-gray-500 mb-0 text-truncate-1 white-space-nowrap"
                                    >
                                        Per Kunjungan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xxl-3">
                            <div
                                class="card rounded-4 border border-gray-300 h-100"
                            >
                                <div
                                    class="card-body d-flex flex-column p-6 gap-3 justify-content-between"
                                >
                                    <div
                                        class="d-flex flex-grow align-items-start gap-5"
                                    >
                                        <div
                                            class="d-flex flex-column flex-grow-1"
                                        >
                                            <p
                                                class="fs-5 fw-bolder text-dark mb-2 text-truncate-1 white-space-nowrap"
                                            >
                                                Tanpa Interaksi
                                            </p>
                                            <h1
                                                class="fs-3qx fs-md-2x fw-bolder mb-0"
                                            >
                                                {{ bounce_rate }}%
                                            </h1>
                                        </div>
                                        <div
                                            class="p-5 bg-mydanger-light rounded d-flex align-items-center justify-content-center"
                                        >
                                            <i
                                                class="ri-drag-drop-line text-mydanger fs-3qx fs-md-2x"
                                            ></i>
                                        </div>
                                    </div>
                                    <p
                                        class="fs-7 text-gray-500 mb-0 text-truncate-1 white-space-nowrap"
                                    >
                                        {{
                                            bounce_rate <= 30
                                                ? "Ideal Rendah"
                                                : bounce_rate <= 60
                                                ? "Moderate Normal"
                                                : "Tinggi Risiko"
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card rounded-4 border border-gray-300">
                                <div
                                    class="card-header p-0 d-flex align-items-center flex-nowrap justify-content-between m-0 border-bottom border-gray-300"
                                    style="min-height: unset"
                                >
                                    <h3 class="ps-6 py-6 mb-0 fw-bolder fw-bolder text-truncate">
                                        Tren Kunjungan & Pengguna Harian
                                    </h3>
                                    <div class="d-flex gap-5 mx-6 h-100">
                                        <p
                                            class="fs-5 text-dark fw-bold d-flex align-items-center gap-2 mb-0"
                                        >
                                            <i
                                                class="fs-4 text-myprimary ri-checkbox-blank-circle-fill"
                                            ></i>
                                            <span>Kunjungan</span>
                                        </p>
                                        <p
                                            class="fs-5 text-dark fw-bold d-flex align-items-center gap-2 mb-0"
                                        >
                                            <i
                                                class="fs-4 text-mydanger ri-checkbox-blank-circle-fill"
                                            ></i>
                                            <span>Pengguna</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body p-6 h-350px">
                                    <canvas ref="trendRef"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div
                                class="card rounded-4 border border-gray-300 h-100"
                            >
                                <div
                                    class="card-header p-0 d-flex flex-nowrap justify-content-between m-0 border-bottom border-gray-300"
                                    style="min-height: unset"
                                >
                                    <h3 class="ps-6 py-6 mb-0 fw-bolder text-truncate">
                                        Sumber Kunjungan
                                    </h3>
                                    <ul
                                        class="nav nav-tabs flex-nowrap nav-line-tabs nav-stretch fs-5 gap-5 h-100 mx-6 border-0"
                                    >
                                        <li class="nav-item">
                                            <button
                                                class="nav-link active me-0"
                                                data-bs-toggle="tab"
                                                data-bs-target="#referrer-tab"
                                            >
                                                Tautan
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button
                                                class="nav-link ms-0"
                                                data-bs-toggle="tab"
                                                data-bs-target="#device-tab"
                                            >
                                                Perangkat
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div
                                    class="card-body p-6 tab-content h-300px h-lg-350px"
                                >
                                    <div
                                        class="tab-pane fade show active h-100"
                                        id="referrer-tab"
                                    >
                                        <canvas ref="referrerRef"></canvas>
                                    </div>

                                    <div
                                        class="tab-pane fade h-100"
                                        id="device-tab"
                                    >
                                        <canvas ref="deviceRef"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div
                                class="card rounded-4 border border-gray-300 h-100"
                            >
                                <div
                                    class="card-header p-0 d-flex flex-nowrap justify-content-between m-0 border-bottom border-gray-300"
                                    style="min-height: unset"
                                >
                                    <h3 class="ps-6 py-6 mb-0 fw-bolder text-truncate">
                                        Distribusi Pengunjung
                                    </h3>
                                    <ul
                                        class="nav nav-tabs flex-nowrap nav-line-tabs nav-stretch fs-5 gap-5 h-100 mx-6 border-0"
                                    >
                                        <li class="nav-item">
                                            <button
                                                class="nav-link active me-0"
                                                data-bs-toggle="tab"
                                                data-bs-target="#country-tab"
                                            >
                                                Negara
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button
                                                class="nav-link ms-0"
                                                data-bs-toggle="tab"
                                                data-bs-target="#browser-tab"
                                            >
                                                Browser
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div
                                    class="card-body p-6 tab-content h-300px h-lg-350px"
                                >
                                    <div
                                        class="tab-pane fade show active h-100"
                                        id="country-tab"
                                    >
                                        <canvas ref="countryRef"></canvas>
                                    </div>

                                    <div
                                        class="tab-pane fade h-100"
                                        id="browser-tab"
                                    >
                                        <canvas ref="browserRef"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="card rounded-4 border border-gray-300 h-100">
                                <div
                                    class="card-header p-6 border-bottom m-0 border-bottom border-gray-300"
                                    style="min-height: unset"
                                >
                                    <h3 class="mb-0 fw-bolder">Halaman Terpopuler</h3>
                                </div>

                                <div
                                    class="card-body p-0 table-responsive h-300px"
                                >
                                    <table
                                        id="kt_datatable_horizontal_scroll"
                                        class="table align-start table-row-bordered fs-5 gy-5 mb-0"
                                    >
                                        <thead class="sticky-top">
                                            <tr
                                                class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0"
                                            >
                                                <th
                                                    class="w-20px ps-6 text-center bg-secondary"
                                                    style="
                                                        letter-spacing: 0.04em;
                                                    "
                                                >
                                                    #
                                                </th>
                                                <th
                                                    class="bg-secondary"
                                                    style="
                                                        letter-spacing: 0.04em;
                                                    "
                                                >
                                                    Halaman
                                                </th>
                                                <th
                                                    class="bg-secondary text-center pe-6"
                                                    style="
                                                        letter-spacing: 0.04em;
                                                    "
                                                >
                                                    Kunjungan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="fw-semibold text-gray-500"
                                        >
                                            <tr
                                                v-for="(
                                                    page, index
                                                ) in top_pages"
                                                :key="page.pageTitle"
                                            >
                                                <td class="ps-6 text-center">
                                                    {{ index + 1 }}
                                                </td>
                                                <td class="fw-bold">
                                                    <a
                                                        target="_blank"
                                                        :href="
                                                            page.pageUrl.startsWith(
                                                                'http'
                                                            )
                                                                ? page.pageUrl
                                                                : 'https://' +
                                                                  page.pageUrl
                                                        "
                                                        class="btn-link-myprimary"
                                                    >
                                                        <span
                                                            class="text-dark d-flex align-items-center gap-2"
                                                            >{{
                                                                page.pageTitle
                                                            }}
                                                            <i
                                                                class="fs-3 ri-arrow-right-up-line"
                                                            ></i
                                                        ></span>
                                                    </a>
                                                </td>
                                                <td class="pe-6 text-center">
                                                    {{ page.screenPageViews }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import { Head, Link, router } from "@inertiajs/vue3";
    import { onMounted, ref } from "vue";
    import Chart from "chart.js/auto";

    Chart.defaults.font.family = "Nunito Sans, sans-serif";
    Chart.defaults.font.size = 10;
    Chart.defaults.color = "#94a3b8";

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link
        },

        props: {
            setting: Object,
            total_visits: Number,
            total_users: Number,
            new_users: Number,
            bounce_rate: Number,
            avg_session_duration: String,
            visits_users_trend: Array,
            top_pages: Array,
            countries: Array,
            referrers: Array,
            browsers: Array,
            devices: Array,
            filters: Object,
        },

        setup(props) {
            const activeRange = ref(props.filters?.date_range ?? "weekly");

            const rangeLabel = {
                weekly: "Minggu ini",
                monthly: "Bulan ini",
                yearly: "Tahun ini",
            };

            const changeRange = (range) => {
                activeRange.value = range;

                router.get(
                    "/admin/dashboard",
                    { date_range: range },
                    {
                        preserveScroll: true,
                        replace: true,
                    }
                );
            };

            const trendRef = ref();
            const barRef = ref();
            const countryRef = ref();
            const referrerRef = ref();
            const browserRef = ref();
            const deviceRef = ref();

            const hexWithAlpha = (hex, alpha = 0.3) => {
                if (!hex) return hex;

                const a = Math.round(alpha * 255)
                    .toString(16)
                    .padStart(2, "0");

                return hex + a;
            };

            const getPaletteShades = (palette) => {
                const order = ["500", "400", "300", "200", "100", "50"];

                return order
                    .map((key) => palette.find((c) => c.name === key)?.hexcode)
                    .filter(Boolean);
            };

            const generatePaletteColors = (palette, count) => {
                const shades = getPaletteShades(palette);

                return Array.from({ length: count }, (_, i) => {
                    return shades[i % shades.length];
                });
            };

            const getDeviceColors = (palette) => {
                const order = ["500", "300", "100"];

                return order
                    .map((key) => palette.find((c) => c.name === key)?.hexcode)
                    .filter(Boolean);
            };

            onMounted(() => {
                const createLineGradient = (ctx, hex) => {
                    const gradient = ctx.createLinearGradient(0, 0, 0, 300);

                    gradient.addColorStop(0, hexWithAlpha(hex, 0.4));
                    gradient.addColorStop(1, hexWithAlpha(hex, 0));

                    return gradient;
                };

                const primaryColor = props.setting?.site_color || "#64748b";
                const dangerColor = "#ef4444";
                const ctx = trendRef.value.getContext("2d");
                const gradient = createLineGradient(ctx, primaryColor);
                const dangerGradient = createLineGradient(ctx, dangerColor);

                new Chart(trendRef.value, {
                    type: "line",
                    data: {
                        labels: props.visits_users_trend.map((i) => i.label),
                        datasets: [
                            {
                                label: "Kunjungan",
                                data: props.visits_users_trend.map((i) => i.views),
                                borderColor: primaryColor,
                                backgroundColor: gradient,
                                fill: true,
                                pointRadius: 4,
                                pointBackgroundColor: primaryColor,
                            },
                            {
                                label: "Pengguna",
                                data: props.visits_users_trend.map((i) => i.users),
                                borderColor: dangerColor,
                                backgroundColor: dangerGradient,
                                fill: true,
                                pointRadius: 4,
                                pointBackgroundColor: dangerColor,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                backgroundColor: "#0f172a",
                                titleColor: "#fff",
                                bodyColor: "#fff",
                                padding: 10,
                                callbacks: {
                                    title(context) {
                                        const index = context[0].dataIndex;
                                        const dateStr =
                                            props.visits_users_trend[index].date;
                                        const date = new Date(dateStr);
                                        return date.toLocaleDateString("id-ID", {
                                            weekday: "long",
                                            day: "numeric",
                                            month: "long",
                                            year: "numeric",
                                        });
                                    },
                                },
                            },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: "#0f172a",
                                },
                                grid: {
                                    color: "#e2e8f0",
                                },
                            },
                            y: {
                                grid: {
                                    color: "#e2e8f0",
                                },
                            },
                        },
                    },
                });

                new Chart(barRef.value, {
                    type: "bar",
                    data: {
                        labels: props.top_pages.map((i) => i.pageTitle),
                        datasets: [
                            {
                                label: "Total Pengunjung",
                                data: props.top_pages.map((i) => i.screenPageViews),
                                backgroundColor: hexWithAlpha(primaryColor, 0.4),
                                borderRadius: 6,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    },
                });

                const countryColors = generatePaletteColors(
                    props.setting.site_color_palette,
                    props.countries.length
                );
                new Chart(countryRef.value, {
                    type: "bar",
                    data: {
                        labels: props.countries.map((i) => i.country),
                        datasets: [
                            {
                                label: "Total Pengunjung",
                                data: props.countries.map((i) => i.screenPageViews),
                                backgroundColor: countryColors,
                                borderRadius: 4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                backgroundColor: "#0f172a",
                                titleColor: "#fff",
                                bodyColor: "#fff",
                                padding: 10,
                            },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: "#0f172a",
                                },
                                grid: {
                                    color: "#e2e8f0",
                                },
                            },
                            y: {
                                grid: {
                                    color: "#e2e8f0",
                                },
                            },
                        },
                    },
                });

                const browserColors = generatePaletteColors(
                    props.setting.site_color_palette,
                    props.browsers.length
                );
                new Chart(browserRef.value, {
                    type: "bar",
                    data: {
                        labels: props.browsers.map((i) => i.browser),
                        datasets: [
                            {
                                label: "Total Pengunjung",
                                data: props.browsers.map((i) => i.screenPageViews),
                                backgroundColor: browserColors,
                                borderRadius: 4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                backgroundColor: "#0f172a",
                                titleColor: "#fff",
                                bodyColor: "#fff",
                                padding: 10,
                            },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: "#0f172a",
                                },
                                grid: {
                                    color: "#e2e8f0",
                                },
                            },
                            y: {
                                grid: {
                                    color: "#e2e8f0",
                                },
                            },
                        },
                    },
                });

                const referrerColors = generatePaletteColors(
                    props.setting.site_color_palette,
                    props.referrers.length
                );
                new Chart(referrerRef.value, {
                    type: "doughnut",
                    data: {
                        labels: props.referrers.map((i) => i.pageReferrer),
                        datasets: [
                            {
                                data: props.referrers.map((i) => i.screenPageViews),
                                backgroundColor: referrerColors,
                                borderWidth: 0,
                                radius: "90%",
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: "bottom",
                                labels: {
                                    color: "#0f172a",
                                    usePointStyle: true,
                                },
                            },
                        },
                    },
                });

                const deviceColors = getDeviceColors(
                    props.setting.site_color_palette
                );
                new Chart(deviceRef.value, {
                    type: "doughnut",
                    data: {
                        labels: props.devices.map((i) => i.deviceCategory),
                        datasets: [
                            {
                                data: props.devices.map((i) => i.screenPageViews),
                                backgroundColor: deviceColors,
                                borderWidth: 0,
                                radius: "90%",
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: "bottom",
                                labels: {
                                    color: "#0f172a",
                                    usePointStyle: true,
                                },
                            },
                        },
                    },
                });
            });

            return {
                Head,
                Link,
                activeRange,
                rangeLabel,
                changeRange,
                trendRef,
                barRef,
                countryRef,
                referrerRef,
                browserRef,
                deviceRef,
            };
        },
    };
</script>

<style scoped>
    .dropdown-item.active {
        background-color: var(--base-color-600) !important;
        color: var(--bs-white) !important;
    }
    .dropdown-item.active:hover {
        background-color: var(--base-color-700) !important;
        color: var(--bs-white) !important;
    }
</style>