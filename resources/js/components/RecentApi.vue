<template>
    <div>
        <template v-for="e in companies">
            <div>
                <img v-if="e.logo != null" :src="'/storage/' + e.logo" width="60">
                <img v-else :src="'/storage/placeholder/placeholder.png'" width="60">
                <span>{{e.name}}</span>
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
