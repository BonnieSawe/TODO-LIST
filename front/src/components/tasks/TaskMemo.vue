<template>
    <p v-if="memo" class="memo-text">{{memo.name}}</p>
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
    .memo-text{
        width: 155px;
        height: 15px;
        color: #6f757e;
        font-size: 12px;
        font-weight: 600;
        font-style: normal;
        letter-spacing: 0.24px;
    }
</style>


