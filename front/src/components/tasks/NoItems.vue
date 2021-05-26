<template>
    <div>
        <p class="empty-p">This database is empty. Either the Todo is new, or something is really wrong.</p>
    </div>
</template>
<script>
export default {
    name: 'NoItems',
}
</script>
<style scoped>
    .empty-p{
        color: #6f757e !important;
        font-size: 14px;
    }
</style>