<template>

    <b-tab class="tab1" title="Day">

        <DayCarousel :data="currentDate"
            @triggerSwipeDay="triggerSwipeDay">

        </DayCarousel>

        <AddTask :data="currentDate.date" @newTodoItem="addTodoItem"></AddTask>

        <hr v-if="pinnedTasks" class="mt-2">

        <AllTasks :data="todoItems"> </AllTasks>

        <!-- <b-button
        id="show-btn"
        @click="$bvModal.show('bv-modal-example')"
        >
        Open Modal
        </b-button>
        <b-modal id="bv-modal-example">Hello From My Modal!</b-modal> -->


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
            pinnedTasks: false,
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
            const {todo_items, success, message} = await Todo.getDayItems(date);
            if (success) {
                this.todoItems = todo_items;
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