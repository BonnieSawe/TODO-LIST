<template>
    <div class="mb-3 row d-flex">

        <div class="float-left pr-2 invisible">
            <i class="fa fa-thumb-tack pinned"></i>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" :id="todoItem.id" name="">
            <label class="custom-control-label" :for="todoItem.id">{{todoItem.name}}</label>

            <TaskMemos :data="todoItem.memos"></TaskMemos>
        </div>

        <!-- <AddMemo></AddMemo> -->


        <div class="ml-auto pl-5">
            <Actions 
                :data="todoItem.id" 
                @deleteItem="deleteItem" 
                @triggerAddMemo="triggerAddMemo"
            >

            </Actions>
        </div>
    </div>
</template>
<script>

export default {
    name: 'SingleTask',
    props: ["data"],
    computed: {
        todoItem() {
            return this.data ? this.data : {};
        },        
    },
    methods: {
        deleteItem(todoItemId)
        {
            this.$emit("deleteItem", todoItemId);
        },

        triggerAddMemo(todoItemId) {
            this.$emit("triggerAddMemo", todoItemId);
        },
    }
}
</script>
