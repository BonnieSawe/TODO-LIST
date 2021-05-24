<template>
    <div v-if="todoItems.length">
        <div class="" v-for="todoItem in todoItems" :key="todoItem.id">
            <SingleTask :data="todoItem"></SingleTask>
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
    computed: {
        todoItems() {
            return this.data ? this.data : {};
        },
        
    },
}
</script>
