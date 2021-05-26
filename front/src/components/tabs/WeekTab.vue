<template>

    <b-tab class="tab1" title="Week">

        <WeekCarousel
            @triggerSwipeWeek="getWeekItems">
        </WeekCarousel>

        <hr v-if="pinnedTasks" class="mt-2">

        <WeekTasks :data="days"> </WeekTasks>

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
        }
    },
    methods: { 
        async getWeekItems(startDate, endDate){
            const {days, success, message} = await Todo.getWeekItems(startDate, endDate);

            if (success) {
                this.days = days;
            }else{
                this.days = [];
            }
        },

        addTodoItem(item) {
            console.log(item)
            // this.todoItems.push(item);
        },
    }

}
</script>