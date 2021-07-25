<template>

    <b-tab class="tab1" title="Day">

        <DayCarousel :data="currentDate" :weekSelected="false"
            @triggerSwipeDay="triggerSwipeDay">

        </DayCarousel>

        <AddTask :data="currentDate.date" @newTodoItem="addTodoItem"></AddTask>

        <div v-if="pinnedTasks.length">
            <div class="" v-for="pinnedTask in pinnedTasks" :key="pinnedTask.main_key" :index="pinnedTask.main_key">
                <SingleTask :data="pinnedTask" @pinItem="pinItem" @deleteItem="deleteItem"></SingleTask>
            </div>
            <hr v-if="todoItems.length > 0" class="pb-4">
        </div>

        <AllTasks v-if="todoItems.length" :data="todoItems"> </AllTasks>
    
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

        deleteItem(main_key)
        {
            this.pinnedTasks.splice(this.todoItems.indexOf(main_key), 1);
        },

        pinItem(task)
        {
            if (task.pinned) {
                this.pinnedTasks.push(task);
                this.todoItems.splice(this.todoItems.indexOf(task.main_key), 1);

            }else{
                this.pinnedTasks.splice(this.pinnedTasks.indexOf(task.main_key), 1);
                this.todoItems.push(task);
            }

        }
    }

}
</script>