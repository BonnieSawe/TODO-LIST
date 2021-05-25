<template>
    <div v-if="memo">
        <span class="">{{memo.name}}</span>
    </div>
</template>
<script>

export default {
    name: 'TaskMemo',
    props: ["data"],
    computed: {
        memo() {
            return this.data ? this.data : {};
        },
    },
}
</script>
