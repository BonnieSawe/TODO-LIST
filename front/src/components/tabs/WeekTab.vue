<template>

    <b-tab class="tab1" title="Week">

        <WeekCarousel :data="currentWeek"
            @triggerSwipeWeek="triggerSwipeWeek">
        </WeekCarousel>

        <AddTask :data="currentWeek.startDate"></AddTask>

        <hr v-if="pinnedTasks" class="mt-2">

        <WeekTasks :data="todoItems"> </WeekTasks>

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
            currentWeek:{},
            unformatedDate:{},
            todoItems:[],
        }
    },
    mounted() {
        this.formatDate(Date.now());
    },
    methods: { 
        triggerSwipeWeek(date, direction) {
            this.formatDate(
                moment(date).add(direction, 'weeks')
            )		
        },

        formatDate(timestamp)
        {
            this.currentWeek = {
                startDate: moment(timestamp),
                startDate: moment(timestamp),
                startDateDay: moment(timestamp).format("dddd"),
                endDate: moment(timestamp).add(6, 'days'),
                endDateDay: moment(timestamp).add(6, 'days').format("dddd"),
            }

            this.getWeekItems(moment(this.currentWeek.startDate).format("MMM D, YYYY"), moment(this.currentWeek.endDate).format("MMM D, YYYY"));
        },

        async getWeekItems(startDate, endDate){

            const {todo_items, success, message} = await Todo.getWeekItems(startDate, endDate);

            if (success) {
                this.todoItems = todo_items;
            }else{
                this.todoItems = [];
            }
        },
    }

}
</script>