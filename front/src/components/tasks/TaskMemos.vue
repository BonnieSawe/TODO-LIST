<template>
    <div v-if="memos.length">
        <div class="" v-for="memo in memos" :key="memo.id">
            <span class="">{{memo.name}}</span>
        </div>
    </div>
</template>
<script>

export default {
    name: 'TaskMemos',
    props: ["data"],
    computed: {
        memos() {
            return this.data ? this.data : {};
        },
    },
}
</script>
