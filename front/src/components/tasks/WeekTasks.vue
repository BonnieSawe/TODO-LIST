<template>
    <div v-if="todoItems.length">
        <div class="" v-for="dayItems in todoItems" :key="dayItems">
            <DayTasks :data="dayItems"></DayTasks>
        </div>
    </div>
    <div v-else>
        <!-- <NoItems></NoItems> -->
        <h3>Hello no</h3>
    </div>
</template>
<script>

export default {
    name: 'WeekTasks',
    props: ["data"],
    computed: {
        todoItems() {
            console.log(this.data.length);
            return this.data ? this.data : {};
        },
        
    },
}
</script>
