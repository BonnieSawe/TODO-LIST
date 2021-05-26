<template>
    <div v-if="todoItems.length">
        <div class="" v-for="todoItem in todoItems" :key="todoItem.main_key" :index="parseInt(todoItem.id)+1">
            <SingleTask :data="todoItem" @deleteItem="deleteItem"></SingleTask>
        </div>
    </div>
    
    <div v-else>
        <NoItems></NoItems>
    </div>
</template>
<script>

export default {
    name: 'AllTasks',
    props: ["data"],
    data(){
        return{
            day: {},
            Hash: new Date().getTime()
        }
    },
    computed: {
        todoItems() {
            return this.data ? this.data : {};
        },
        
    },

    methods: {
        deleteItem(main_key)
        {
            console.log(main_key);
            this.todoItems.splice(this.todoItems.indexOf(main_key), 1);
        },
    }
}
</script>
