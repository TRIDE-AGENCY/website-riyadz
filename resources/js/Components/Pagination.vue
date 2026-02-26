<template>
    <nav>
        <ul :class="`pagination justify-content-${align} m-0`">
            <li :class="['page-item previous', !links[0].url ? 'disabled' : '']">
                <Link class="page-link page-link-myprimary" :href="links[0].url || '#'">
                    <i class="previous"></i>
                </Link>
            </li>

            <li v-for="(link, index) in filteredLinks" :key="index"
                :class="['page-item', link.active ? 'active' : '', !link.url ? 'disabled' : '']">
                
                <span v-if="link.label === '...'" class="page-link page-link-myprimary border-0">
                    ...
                </span>

                <Link v-else class="page-link page-link-myprimary" :href="link.url || '#'">
                    <span v-html="link.label"></span>
                </Link>
            </li>

            <li :class="['page-item next', !links[links.length - 1].url ? 'disabled' : '']">
                <Link class="page-link page-link-myprimary" :href="links[links.length - 1].url || '#'">
                    <i class="next"></i>
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script>
    import { Link } from '@inertiajs/vue3';

    export default {
        props: {
            links: Array, 
            align: String
        },

        components: {
            Link,
        },

        computed: {
            filteredLinks() {
                const cleanLinks = this.links.slice(1, this.links.length - 1);
                
                const total = cleanLinks.length;
                if (total <= 10) return cleanLinks; 

                const current = cleanLinks.findIndex(l => l.active);
                
                let res = [];
                
                if (current > 3) {
                    res.push(...cleanLinks.slice(0, 3));
                    res.push({ label: '...', url: null, active: false }); 
                } else {
                    res.push(...cleanLinks.slice(0, Math.max(current + 2, 3)));
                }

                if (current > 3 && current < total - 4) {
                    res.push(...cleanLinks.slice(current - 1, current + 2));
                }

                if (current < total - 4) {
                    res.push({ label: '...', url: null, active: false });
                    res.push(...cleanLinks.slice(total - 3, total));
                } else {
                    if(res.length > 0 && res[res.length-1].label !== '...') {
                    } else {
                        res.push(...cleanLinks.slice(Math.min(current - 1, total - 3)));
                    }
                }
                
                // PEMBERSIHAN DUPLIKAT (Penting!)
                // Karena logika irisan di atas bisa kompleks, cara termudah adalah 
                // memfilter ulang menggunakan Set berdasarkan label untuk memastikan unik
                const uniqueRes = [];
                const seenLabels = new Set();
                
                res.forEach(item => {
                    if (item.label === '...' && (uniqueRes.length === 0 || uniqueRes[uniqueRes.length-1].label === '...')) {
                         // Jangan biarkan '...' muncul berurutan atau di awal banget
                         return; 
                    }
                    // Simpan jika belum ada (kecuali '...')
                    if (item.label === '...' || !seenLabels.has(item.label)) {
                        uniqueRes.push(item);
                        seenLabels.add(item.label);
                    }
                });

                return uniqueRes;
            }
        }
    }
</script>