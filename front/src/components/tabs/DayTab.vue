<template>

    <b-tab class="tab1" title="Day">

        <DayCarousel :data="currentDate" :weekSelected="false"
            @triggerSwipeDay="triggerSwipeDay">

        </DayCarousel>

        <AddTask :data="currentDate.date" @newTodoItem="addTodoItem"></AddTask>

        <AllTasks v-if="todoItems.length" :pinnedTasks="pinnedTasks" :data="todoItems"> </AllTasks>
    
        <NoItems v-if="todoItems.length == 0 && pinnedTasks.length == 0"></NoItems>

    </b-tab>
</template>
<script>

import Todo from '@/services/todo';
import moment from 'moment'

export default {
    name: 'DayTab',
    props: {},
    data() {
        return {
            pinnedTasks: [],
            currentDate:{},
            unformatedDate:{},
            todoItems:[],
        }
    },
    mounted() {
        this.formatDate(Date.now());
    },
    methods: { 
        triggerSwipeDay(date, direction) {
            
            this.formatDate(
                moment(date).add(direction, 'days')
            )		
        },

        formatDate(timestamp)
        {
            this.currentDate = {
                date: moment(timestamp).format("MMM D, YYYY"),
                day: moment(timestamp).format("dddd"),
            }

            this.getDayItems(this.currentDate.date);
        },

        async getDayItems(date){
            const {todo_items, pinned_items, success, message} = await Todo.getDayItems(date);
            if (success) {
                this.todoItems = todo_items;
                this.pinnedTasks = pinned_items;
            }else{
                this.todoItems = [];
            }
        },

        addTodoItem(item) {
            this.todoItems.push(item);
        },
    }

}
</script>