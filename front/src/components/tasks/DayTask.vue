<template>
    <div class="mb-3">
        <h5 class="day-title pr-3">Wednesday</h5>
        <hr class="mt-2">
        <Task></Task>
    </div>
</template>

<script>

export default {
    name: 'DayTask',
    props: {},
}
</script>

<style>
    .day-title{
        width: 86px;
        color: #6f757e;
        font-size: 12px;
        font-weight: 600;
        font-style: normal;
        letter-spacing: 0.24px;
        text-align: center;
        text-transform: uppercase;
    }
</style>