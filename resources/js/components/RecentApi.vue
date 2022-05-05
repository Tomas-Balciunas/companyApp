<template>
    <div class="container border border-secondary rounded d-inline-flex flex-column m-2 pb-2 recentCont">
    <h5 class="text-center mt-3 text-light font-weight-bold">Five newest companies</h5>
        <template v-for="e in companies">
            <div class="row m-2 border rounded bg-light d-inline-flex align-items-center">
                <div class="col-auto p-0 m-1">
                    <img v-if="e.logo != null" :src="'/storage/' + e.logo" width="50">
                    <img v-else :src="'/storage/placeholder/placeholder.png'" width="50">
                </div>
                <div class="col p-0 m-1">
                    <span>{{e.name}}</span>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                companies: '',
            }
        },
        mounted() {
            axios.get('/api/recent').then(response => {
                this.companies = response.data;
        }).catch(error => {
                console.log(error);
            })
        }
    }
</script>
