<template>
    <div>
        <div v-if="pinnedTasks.length">
            <div class="" v-for="(pinnedTask, index) in pinnedTasks" :key="pinnedTask.main_key" :index="pinnedTask.main_key">
                <SingleTask :data="pinnedTask" :indexValue="index" @pinItem="pinItem" @deleteItem="deleteItem(index, true)"></SingleTask>
            </div>
            <hr v-if="todoItems.length > 0" class="pb-4">
        </div>
        <div v-if="todoItems.length">
            <div class="" v-for="(todoItem, index) in todoItems" :key="todoItem.id" :index="parseInt(todoItem.id)+1">
                <SingleTask :indexValue="index" :data="todoItem"  @pinItem="pinItem" @deleteItem="deleteItem(index, false)"></SingleTask>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'AllTasks',
    props: ["data", "pinnedTasks"],
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

        allPinnedTasks() {
            return this.pinnedTasks ? this.pinnedTasks : {};
        },
        
    },

    methods: {
        deleteItem(index, pin)
        {
            if (pin) {
                this.pinnedTasks.splice(index, 1);
            } else {
                this.todoItems.splice(index, 1);
            }
        },

        pinItem(data)
        {
            if (data.task.pinned) {
                this.pinnedTasks.push(data.task);
                this.todoItems.splice(data.indexValue, 1);

            }else{
                this.todoItems.push(data.task);
                this.pinnedTasks.splice(data.indexValue, 1);
            }

        }
    }
}
</script>
