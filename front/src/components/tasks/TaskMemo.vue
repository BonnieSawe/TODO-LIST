<template>
    <div v-if="memo" class="checkbox-span">
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

<style lang="scss">
    .chekbox-span{
    }
</style>


