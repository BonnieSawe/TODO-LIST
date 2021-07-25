<template>
    <div class="mb-3">
        <h5 class="day-title pr-3">{{day.day_name}}</h5>
        <hr class="mt-2">
        <AllTasks v-if="todoItems.length || pinnedTasks.length" :pinnedTasks="pinnedTasks" :data="todoItems"> </AllTasks>
    </div>
</template>

<script>

export default {
    name: 'DayTasks',
    props: ["data", "pinnedTasks"],
    computed: {
        day() {
            return this.data ? this.data : {};
        },

        todoItems() {
            return this.data.todo_items ? this.data.todo_items : {};
        }
    },
    methods: {
        deleteItem(todoItemKey)
        {
            this.todoItems.splice(this.todoItems.indexOf(todoItemKey), 1);
        },
    }
    
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