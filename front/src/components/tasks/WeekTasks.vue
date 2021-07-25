<template>
    <div v-if="days.length">
        <div class="" v-for="day in days" :key="day.index">
            <DayTasks :data="day" :pinnedTasks="pinnedTasks"></DayTasks>
        </div>
    </div>
    <div v-else>
        <NoItems></NoItems>
    </div>
</template>
<script>

export default {
    name: 'WeekTasks',
    props: ["data", "pinnedTasks"],
    computed: {
        days() {
            return this.data ? this.data : {};
        },
        
    },
}
</script>
