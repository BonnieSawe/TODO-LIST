<template>

    <b-tab class="tab1" title="Week">

        <WeekCarousel
            @triggerSwipeWeek="getWeekItems">
        </WeekCarousel>

        <hr v-if="pinnedTasks" class="mt-2">

        <WeekTasks :data="days" :pinnedTasks="pinnedTasks"> </WeekTasks>

    </b-tab>
</template>
<script>

import Todo from '@/services/todo';
import moment from 'moment'

export default {
    name: 'WeekTab',
    props: {},
    data() {
        return {
            pinnedTasks: false,
            days:[],
            pinnedTasks:[],
        }
    },
    methods: { 
        async getWeekItems(startDate, endDate){
            const {days, pinned_items, success, message} = await Todo.getWeekItems(startDate, endDate);

            if (success) {
                this.days = days;
                this.pinnedTasks = pinned_items;
            }else{
                this.days = [];
            }
        },

        addTodoItem(item) {
            // this.todoItems.push(item);
        },
    }

}
</script>